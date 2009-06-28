<?php

class UserBikes extends BaseUserBikes
{
    public function __toString()
{
    return $this->getBikeYear().' '.$this->getBikeMake().' '.$this->getBikeModel();
}

    public function getBikeMileage(){
        $c = new Criteria();
        $c->clearSelectColumns();
        $c->addSelectColumn('SUM('.UserStatsPeer::MILEAGE.')');
        //$c->addGroupByColumn(UserRidesPeer::MILEAGE);
        $c->add(UserStatsPeer::USER_ID,$this->getUserId());
        $c->add(UserStatsPeer::BIKE_ID,$this->getUserBikeId());
       // $c->addJoin(UserRidesPeer::USER_RIDE_ID, UserStatsPeer::RIDE_KEY);
        $stmt = UserStatsPeer::doSelectStmt($c);
        $sum=0;
        if($stmt){
            while($row = $stmt->fetch(PDO::FETCH_NUM)){
                if($row){
                    $sum=$row[0];
                }
            }
        }
        return utils::getMileageFromMeters($sum);
}

    public function getLastRideDate(){
        $c = new Criteria();
        $c->clearSelectColumns();
        $c->addSelectColumn('MAX('.UserStatsPeer::RIDE_DATE.')');
        $c->add(UserStatsPeer::USER_ID,$this->getUserId());
        $c->add(UserStatsPeer::BIKE_ID,$this->getUserBikeId());
        $stmt = UserStatsPeer::doSelectStmt($c);
        $max=null;
        if($stmt){
            while($row = $stmt->fetch(PDO::FETCH_NUM)){
                if($row){
                    $max=$row[0];
                }
            }
        }
        return $max;
}

}
