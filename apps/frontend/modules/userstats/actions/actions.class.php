<?php

/**
 * userstats actions.
 *
 * @package    bike
 * @subpackage userstats
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12479 2008-10-31 10:54:40Z fabien $
 */
class userstatsActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
    $u_id =  sfContext::getInstance()->getUser()->getAttribute('subscriber_id', '-1', 'subscriber');
    if($u_id){
        $c = new Criteria();
        $c->add(UserStatsPeer::USER_ID, $u_id);
        $this->user_stats = UserStatsPeer::doSelectJoinAll($c);
    }else{
        $this->stats = array('No Rides');
    }
  }

  public function executeDelete(){
       $userId = sfContext::getInstance()->getUser()->getAttribute('subscriber_id',null,'subscriber');
       $this->statid = $this->getRequestParameter('statid');
       /*if($userId && $statid){
           $c = new Criteria();
           $c->add(UserStatsPeer::USER_ID,$userId);
           $c->add(UserStatsPeer::STAT_NO,$statid);
           $this->stat=UserStatsPeer::doSelect($c);
       }else{
          $this->stat=null;
       }*/
       if ($this->getRequest()->getMethod() == sfRequest::POST)
    {
        //need to delete user_stat_equipment
        $c = new Criteria();
        $c->add(UserStatEquipPeer::USER_STAT_ID, $this->statid);
        $statequip = UserStatEquipPeer::doSelect($c);
        foreach($statequip as $se){
            $se->delete();
        }
        //delete user_stat
        $c = new Criteria();
         $c->add(UserStatsPeer::USER_ID,$userId);
         $c->add(UserStatsPeer::STAT_NO,$this->statid);
         $s=UserStatsPeer::doSelect($c);
         foreach($s as $stat){
            $stat->delete();
        }
        return $this->redirect('userstats/index');
    }
  }

  public function executeEdit(){
      $userId = sfContext::getInstance()->getUser()->getAttribute('subscriber_id',null,'subscriber');
       $this->statid = $this->getRequestParameter('statid');
        $c = new Criteria();
        $c->add(UserStatsPeer::USER_ID,$userId);
        $c->add(UserStatsPeer::STAT_NO,$this->statid);
        $stat=UserStatsPeer::doSelect($c);

        foreach($stat as $s){
           $this->userStat=$s;
           $this->ride_date = $s->getRideDate();
           $this->ride_time = $s->getRideTime();
           $this->speed = $s->getAvgSpeed();
           $this->calories = $s->getCaloriesBurned();
           $this->route = $s->getRideKey();
           $this->bike = $s->getBikeId();
        }
       if ($this->getRequest()->getMethod() == sfRequest::POST)
    {
        if($this->userStat){
             $this->userStat->setRideDate(join("/",$this->getRequestParameter('ride_date')));
             $this->userStat->setBikeId($this->getRequestParameter('user_bike_id'));
             $this->userStat->setRideKey($this->getRequestParameter('user_ride_id'));
             $this->userStat->setRideTime($this->getRequestParameter('ride_time'));
             $this->userStat->setAvgSpeed($this->getRequestParameter('avg_speed'));
             $this->userStat->setCaloriesBurned($this->getRequestParameter('cal_burned'));
             $this->userStat->save();
        }
        return $this->redirect('userstats/index');
    }

  }

  public function executeAdd()
  {
      $this->userStat = new UserStats();
      $this->bikes = null;
      $userId = sfContext::getInstance()->getUser()->getAttribute('subscriber_id',null,'subscriber');
       if ($this->getRequest()->getMethod() == sfRequest::POST)
    {
         if($userId)
         {
             $this->userStat->setRideDate(join("/",$this->getRequestParameter('ride_date')));
             $this->userStat->setBikeId($this->getRequestParameter('user_bike_id'));
             $this->userStat->setRideKey($this->getRequestParameter('user_ride_id'));
             $this->userStat->setRideTime($this->getRequestParameter('ride_time'));
             $this->userStat->setAvgSpeed($this->getRequestParameter('avg_speed'));
             $this->userStat->setCaloriesBurned($this->getRequestParameter('cal_burned'));
             $this->userStat->setUserId($userId);

             $this->userStat->save();

             //now need to add the user equipment for the ride
             $c = new Criteria();
             $c->add(UserEquipementPeer::BIKE_ID,$this->userStat->getBikeId());
             $c->add(UserEquipementPeer::USER_ID,$this->userStat->getUserId());
             $equip = UserEquipementPeer::doSelect($c);
             foreach($equip as $userEquip){
                 $userStatEquip = new UserStatEquip();
                 $userStatEquip->setUserStatId($this->userStat->getStatNo());
                 $userStatEquip->setUserEquipId($userEquip->getEquipmentId());
                 $userStatEquip->save();
             }


                return $this->redirect('userstats/index');
         }

    }

   return sfView::SUCCESS;
  }

  public function executeGetStatDetails($request){
       $this->forward404unless($request->isXmlHttpRequest());
        //get rideId
      $statId = ($request->getParameter("param"));

      //get userId
      $userId = sfContext::getInstance()->getUser()->getAttribute('subscriber_id',null,'subscriber');
  
      if($userId && $statId){
       //    echo 'stst '.$statId.' u '.$userId;
          $c = new Criteria();
          $c->add(UserStatsPeer::USER_ID,$userId);
          $c->add(UserStatsPeer::STAT_NO,$statId);
          $this->stats = UserStatsPeer::doSelect($c);
      }
  }
}
