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
    $this->year = $this->getRequestParameter('year');
    $this->month = $this->getRequestParameter('month');
    if(!$this->year){
        $this->year = Date("Y");
    }if(!$this->month){
        $this->month= Date("m");
    }
    $curTime=mktime(0,0,0,$this->month,1,$this->year);
    //check which way to navigate if any
     $navdir= $this->getRequestParameter('navdir');
     if($navdir){
         if($navdir=='next'){
            $curTime=mktime(0,0,0,$this->month+1,1,$this->year);
         }else{
             $curTime=mktime(0,0,0,$this->month-1,1,$this->year);
         }
     }

     //get new year and month
    $this->year = date("Y", $curTime);
    $this->month= Date("m", $curTime);
    
    $this->weekArray = $this->buildCalendarArray($this->year,$this->month);
    
    $to_date = mktime(0, 0, 0, $this->month, date("t",$curTime), $this->year);
    $from_date = mktime(0, 0, 0, $this->month, 1, $this->year);

    $this->monthText = date("F",$curTime);

    if($u_id){
        $c = new Criteria();
        $c->add(UserStatsPeer::USER_ID, $u_id);
        $criterion = $c->getNewCriterion(UserStatsPeer::RIDE_DATE, date('Y-m-d', $from_date), Criteria::GREATER_EQUAL  );
        $criterion->addAnd($c->getNewCriterion(UserStatsPeer::RIDE_DATE, date('Y-m-d', $to_date), Criteria::LESS_EQUAL ));
        $c->add($criterion);

        $user_stats = UserStatsPeer::doSelectJoinAll($c);
        $this->statsByDay = array();
          if($user_stats){
              foreach ($user_stats as $i => $value) {
                  $rideDate = Date("j",strtotime($value->getRideDate()));
                if(array_key_exists($rideDate, $this->statsByDay)){
                    $tempArray=$this->statsByDay[$rideDate];
                    array_push($tempArray, $value);
                    $this->statsByDay[$rideDate]=$tempArray;
                }else{
                    $tempArray = array();
                    array_push($tempArray, $value);
                    $this->statsByDay[$rideDate]=$tempArray;
                }
              }
          }
    }else{
        $this->statsByDay = null;
    }
  }

  private function buildCalendarArray($year, $month){
   // $year = Date("Y");
    //$month= Date("m");
    $day = 1;
    $timestamp = mktime(0,0,0,$month,$day,$year);
    $daysInMonth = date("t",$timestamp);
    $NameOfDay = date('l', $timestamp);
   // echo $NameOfDay;
    $dayOfWeek=1;
    if($NameOfDay=="Sunday"){
        $dayOfWeek=1;
    }else if($NameOfDay=="Monday"){
        $dayOfWeek=2;
    }else if($NameOfDay=="Tuesday"){
        $dayOfWeek=3;
    }else if($NameOfDay=="Wednesday"){
        $dayOfWeek=4;
    }else if($NameOfDay=="Thursday"){
        $dayOfWeek=5;
    }else if($NameOfDay=="Friday"){
        $dayOfWeek=6;
    }else if($NameOfDay=="Saturday"){
        $dayOfWeek=7;
    }

    $currentCount=0;
    $foundDay=false;
    $weekArray = array();
    //for ( $i = 1; $i <= $daysInMonth; $i += 1) {
    $i=0;
    while($i<$daysInMonth){
        $tempArray = array();
        for ( $v = 1; $v <= 7; $v += 1) {
            if($dayOfWeek==$v && $foundDay==false){
                $foundDay=true;
                $currentCount+=1;
            }
            if($i<$daysInMonth ){
                $tempArray[$v]=$currentCount;
            }else{
                 $tempArray[$v]="";
            }
            if($foundDay==true){
                $currentCount+=1;
                $i+=1;
            }
    }
    $weekArray[$i]=$tempArray;
    }
    return $weekArray;
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

  public function executeView(){
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
         	$rideId = $this->getRequestParameter('user_ride_id');
         	$ride = UserRidesPeer::retrieveByPK($rideId);
             $this->userStat->setRideDate(join("/",$this->getRequestParameter('ride_date')));
             $this->userStat->setBikeId($this->getRequestParameter('user_bike_id'));
             $this->userStat->setRideKey($rideId);
             $this->userStat->setRideTime($this->getRequestParameter('ride_time'));
             $this->userStat->setAvgSpeed($this->getRequestParameter('avg_speed'));
             $this->userStat->setCaloriesBurned($this->getRequestParameter('cal_burned'));
             $this->userStat->setUserId($userId);
             $this->userStat->setMileage($ride->getMileage());

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
