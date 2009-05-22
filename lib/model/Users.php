<?php

class Users extends BaseUsers
{
    public function saltPassword($password)
{
    $salt = md5(rand(100000, 999999).$this->getUsername().$this->getEmail());
    $this->setSalt($salt);
  $this->setPassword(sha1($salt.$password));
}

public function getMonthlyMileage(){
     $from_date = mktime(0, 0, 0, date("m"), 1, date("Y"));

         $c = new Criteria();
        $c->clearSelectColumns();
        $c->addSelectColumn('SUM('.UserRidesPeer::MILEAGE.')');
        $c->add(UserStatsPeer::USER_ID,$this->getUserId());
        $criterion = $c->getNewCriterion(UserStatsPeer::RIDE_DATE , date('Y-m-d', $from_date), Criteria::GREATER_EQUAL  );
        $c->add($criterion);
        $c->addJoin(UserRidesPeer::USER_RIDE_ID, UserStatsPeer::RIDE_KEY);
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

    public function getYearlyMileage(){
        $from_date = mktime(0, 0, 0, 1, 1, date("Y"));

         $c = new Criteria();
        $c->clearSelectColumns();
        $c->addSelectColumn('SUM('.UserRidesPeer::MILEAGE.')');
        $c->add(UserStatsPeer::USER_ID,$this->getUserId());
        $criterion = $c->getNewCriterion(UserStatsPeer::RIDE_DATE , date('Y-m-d', $from_date), Criteria::GREATER_EQUAL  );
        $c->add($criterion);
        $c->addJoin(UserRidesPeer::USER_RIDE_ID, UserStatsPeer::RIDE_KEY);
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
}
