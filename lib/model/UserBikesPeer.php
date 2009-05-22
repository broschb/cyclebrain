<?php

class UserBikesPeer extends BaseUserBikesPeer
{

    static public function getUserBikes() {
        $u_id =  sfContext::getInstance()->getUser()->getAttribute('subscriber_id', '-1', 'subscriber');
        if($u_id){
            $c = new Criteria();
            $c->add(UserBikesPeer::USER_ID, $u_id);
            $c->addAscendingOrderByColumn(UserBikesPeer::BIKE_MAKE);
            $rs = UserBikesPeer::doSelect($c);
              return $rs;
        }else
            return null;
      
    }

    static public function getUserBikesWithShelf(){
        $bikeArray = UserBikesPeer::getUserBikes();
        $shelfItem = new UserBikes();
        $shelfItem->setBikeMake("Shelf Item");
        array_push($bikeArray, $shelfItem);
        return $bikeArray;
    }

    static public function getUserBikesWithAll(){
        $bikeArray = UserBikesPeer::getUserBikes();
        $shelfItem = new UserBikes();
        $shelfItem->setBikeMake("(All Bikes)");
        array_push($bikeArray, $shelfItem);
        return $bikeArray;
    }
}
