<?php

class UserRidesPeer extends BaseUserRidesPeer
{
    static public function getUserRides() {
        $u_id =  sfContext::getInstance()->getUser()->getAttribute('subscriber_id', '-1', 'subscriber');
        if($u_id){
            $c = new Criteria();
            $c->add(UserRidesPeer::USER_ID, $u_id);
            $c->addAscendingOrderByColumn(UserRidesPeer::DESCRIPTION);
            $rs = UserRidesPeer::doSelect($c);
              return $rs;
        }else
            return null;

    }

    static public function getUserRidesWithAll(){
        $rideArray = UserRidesPeer::getUserRides();
        $shelfItem = new UserRides();
        $shelfItem->setDescription("(All Rides)");
        array_push($rideArray, $shelfItem);
        return $rideArray;
    }
}
