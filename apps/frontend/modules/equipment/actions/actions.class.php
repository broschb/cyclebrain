<?php

/**
 * equipment actions.
 *
 * @package    bike
 * @subpackage equipment
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12479 2008-10-31 10:54:40Z fabien $
 */
class equipmentActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
    $this->forward('default', 'module');
  }

  public function executeAdd(){
      $userId = sfContext::getInstance()->getUser()->getAttribute('subscriber_id',null,'subscriber');
      if ($this->getRequest()->getMethod() == sfRequest::POST)
      {
          if($userId)
          {
              $this->userEquip = new UserEquipement();
              if($this->getRequestParameter('purchaseDate')){
                $this->userEquip->setPurchaseDate(join("/",$this->getRequestParameter('purchaseDate')));
              }
                $this->userEquip->setUserId($userId);
                $this->userEquip->setEquipFunction($this->getRequestParameter('equip_id'));
                $associationId = $this->getRequestParameter('assocId');
                if($associationId && $associationId>=0){
                    $this->userEquip->setBikeId($associationId);
                }
                $this->userEquip->setPurchasePrice($this->getRequestParameter('cost'));
                $this->userEquip->setDescription($this->getRequestParameter('description'));
                $this->userEquip->setMake($this->getRequestParameter('make'));
                $this->userEquip->setModel($this->getRequestParameter('model'));

              $this->userEquip->save();
              return $this->redirect('userbike/index');
          }
      }
      return sfView::SUCCESS;
  }

  public function executeDeleteBikeEquipment(){
       $userId = sfContext::getInstance()->getUser()->getAttribute('subscriber_id',null,'subscriber');
       $this->equip = $this->getRequestParameter('equip');
       if ($this->getRequest()->getMethod() == sfRequest::POST)
    {
        //delete user stat equip
        $c = new Criteria();
        $c->add(UserStatEquipPeer::USER_EQUIP_ID,$this->equip);
        $s=UserStatEquipPeer::doSelect($c);
        foreach($s as $se){
            $se->delete();
        }
        //delete equip
        $userEquip = UserEquipementPeer::retrieveByPK($this->equip);
        $userEquip->delete();
        return $this->redirect('userbike/index');
    }
  }

  public function executeEditBikeEquipment(){
     $userId = sfContext::getInstance()->getUser()->getAttribute('subscriber_id',null,'subscriber');
       $this->equip = $this->getRequestParameter('equip');
       $this->userEquip = UserEquipementPeer::retrieveByPK($this->equip);

        if ($this->getRequest()->getMethod() == sfRequest::POST && $this->userEquip)
    {
              if($this->getRequestParameter('purchaseDate')){
                $this->userEquip->setPurchaseDate(join("/",$this->getRequestParameter('purchaseDate')));
              }
                $this->userEquip->setUserId($userId);
                $this->userEquip->setEquipFunction($this->getRequestParameter('equip_id'));
                $associationId = $this->getRequestParameter('assocId');
                if($associationId && $associationId>=0){
                    $this->userEquip->setBikeId($associationId);
                }
                $this->userEquip->setPurchasePrice($this->getRequestParameter('cost'));
                $this->userEquip->setDescription($this->getRequestParameter('description'));
                $this->userEquip->setMake($this->getRequestParameter('make'));
                $this->userEquip->setModel($this->getRequestParameter('model'));

              $this->userEquip->save();
              return $this->redirect('userbike/index');
    }
  }

  public function executeGetBikeEquipment($request){
      $this->forward404unless($request->isXmlHttpRequest());

      //get bikeId
      $bikeId = intval($request->getParameter("param"));
          
      //get userId
      $userId = sfContext::getInstance()->getUser()->getAttribute('subscriber_id',null,'subscriber');
      if($userId && $bikeId){

          $c = new Criteria();
          $c->add(UserEquipementPeer::BIKE_ID, $bikeId);
          $c->add(UserEquipementPeer::USER_ID, $userId);
          $this->equips = UserEquipementPeer::doSelect($c);
          //now get the mileage for each equipment
          $mileage = UserEquipement::getEquipmentMileage($userId, $bikeId);

          //now set mileage on equipment
          if($mileage && $this->equips){
               foreach($this->equips as $userEquip){
                   //if(in_array($userEquip->getEquipmentId(),$mileage)){
                   if(isset( $mileage[$userEquip->getEquipmentId()] )){
               //        echo 'found';
               $userEquip->setMileage(utils::getMileageFromMeters($mileage[$userEquip->getEquipmentId()]));
                   }
                    else{
              //          echo $userEquip->getEquipmentId();
                     $userEquip->setMileage(0);
                    }
               }
          }
      }else{
          $this->equips = null;
      }

  }

}
