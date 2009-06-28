<?php

class UserEquipement extends BaseUserEquipement
{
    protected $mileage;

    public static function getEquipmentMileage($userId,$bikeId){
         $c = new Criteria();
        $c->clearSelectColumns();
        $c->addSelectColumn('SUM('.UserStatsPeer::MILEAGE.')');
        $c->addSelectColumn(UserEquipementPeer::EQUIPMENT_ID);
        //$c->addGroupByColumn(UserRidesPeer::MILEAGE);
        $c->add(UserEquipementPeer::USER_ID,$userId);
        $c->add(UserEquipementPeer::BIKE_ID,$bikeId);
        $c->addJoin(UserEquipementPeer::EQUIPMENT_ID,UserStatEquipPeer::USER_EQUIP_ID,Criteria::INNER_JOIN);
        $c->addJoin(UserStatEquipPeer::USER_STAT_ID,UserStatsPeer::STAT_NO, Criteria::INNER_JOIN);
        //$c->addJoin(UserStatsPeer::RIDE_KEY,UserRidesPeer::USER_RIDE_ID, Criteria::INNER_JOIN);
        $c->addGroupByColumn(UserEquipementPeer::EQUIPMENT_ID);
        $stmt = UserStatsPeer::doSelectStmt($c);

       $hashmap = array();

        if($stmt){
            while($row = $stmt->fetch(PDO::FETCH_NUM)){
                if($row){
                    $sum=$row[0];
                    $eqId=$row[1];
                    //echo 'Mil '.$sum.' '.$eqId;
                    $hashmap[$eqId]=$sum;
                   // array_push($hashmap, $eqId=>$sum);
                }
            }
        }
        return $hashmap;
    }
    
    public function getMileage(){
        return $this->mileage;
    }

    public function setMileage($mileage){
        $this->mileage=$mileage;
    }
}
