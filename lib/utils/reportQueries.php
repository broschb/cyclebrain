<?php
class reportQueries{
    /*
     * note use mktime with week in year *7 to get day in year
     */
    public static function getDistanceReportData($report,$userId,$bikeId,$rideId,$fromDate,$toDate){
        $dateFormat='%v';
        $datasetName='Weekly Total';
        $week=true;
        if($report==1){//month query
            $dateFormat='%M';
            $datasetName='Monthly Total';
            $week=false;
        }
        $weekAvg = array();
        $avg = array();
        $connection = Propel::getConnection();
        $query = "select date_FORMAT(us.ride_date,'%x') as year, date_FORMAT(us.ride_date,'".$dateFormat."') as weekinyear, sum(ur.mileage) as mileage from user_stats us, user_rides ur where us.user_id=? and date_FORMAT(us.RIDE_DATE,'%Y%m%d')>=? and date_FORMAT(us.RIDE_DATE,'%Y%m%d')<=? and ur.USER_RIDE_ID=us.RIDE_KEY ";
        $bikeclause=" and us.bike_id=".$bikeId;
        $rideclaue=" and us.ride_key=".$rideId;
        $groupclause=" group by weekinyear order by 1,2 asc";
        if($bikeId && $bikeId>=0){
            $query=$query.$bikeclause;
        }
        if($rideId && $rideId>=0){
            $query=$query.$rideclaue;
        }
        $query=$query.$groupclause;
        sfContext::getInstance()->getLogger()->info('@@@@@@@@@@@@@@@executing week query '.$query);
        $statement = $connection->prepare($query);
        $statement->bindValue(1, $userId);
        $statement->bindValue(2, date("Ymd",strtotime($fromDate)));
        $statement->bindValue(3, date("Ymd",strtotime($toDate)));
        $resultset = $statement->execute();
        $count=0;
        $total=0;
        while ($row=$statement->fetch())
        {
            $mileage = utils::getMileageFromMeters($row['mileage']);
            $weekInYear = $row['weekinyear'];
            $year = $row['year'];
            $display=$weekInYear;
            if($week){
                $display = reportQueries::getStartOfWeekFromWeekYear($weekInYear, $year);
            }
            $display=$display."-".$year;
            $weekAvg[$display]=$mileage;
            $avg[$display]=0;
            $total=$total+$mileage;
            $count++;
        }
        //go through and set avg
        if($count>0){
            $average=$total/$count;
        }else{
            $average=0;
        }
        foreach (array_keys($weekAvg) as $a){
            $avg[$a]=$average;
        }
        $return = array($datasetName=>$weekAvg,'Average'=>$avg);
        
        return $return;
    }

    public static function getRideTimeReportData($report,$userId,$bikeId,$rideId,$fromDate,$toDate){
        $dateFormat='%v';
        $datasetName='Weekly Total';
        $week=true;
        if($report==3){//month query
            $dateFormat='%M';
            $datasetName='Monthly Total';
            $week=false;
        }
        $weekAvg = array();
        $avg = array();
        $connection = Propel::getConnection();
        $query = "select date_FORMAT(us.ride_date,'%x') as year, date_FORMAT(us.ride_date,'".$dateFormat."') as weekinyear, us.ride_time as ridetime from user_stats us where us.user_id=? and date_FORMAT(us.RIDE_DATE,'%Y%m%d')>=? and date_FORMAT(us.RIDE_DATE,'%Y%m%d')<=? ";
        $bikeclause=" and us.bike_id=".$bikeId;
        $rideclaue=" and us.ride_key=".$rideId;
        $groupclause=" group by weekinyear order by 1,2 asc";
        if($bikeId && $bikeId>=0){
            $query=$query.$bikeclause;
        }
        if($rideId && $rideId>=0){
            $query=$query.$rideclaue;
        }
        $query=$query.$groupclause;
        sfContext::getInstance()->getLogger()->info('@@@@@@@@@@@@@@@executing Time query '.$query);
        $statement = $connection->prepare($query);
        $statement->bindValue(1, $userId);
        $statement->bindValue(2, date("Ymd",strtotime($fromDate)));
        $statement->bindValue(3, date("Ymd",strtotime($toDate)));
        $resultset = $statement->execute();
        $count=0;
        $total=0;
        while ($row=$statement->fetch())
        {
            $ridetime = $row['ridetime'];
            $weekInYear = $row['weekinyear'];
            $year = $row['year'];
            $display=$weekInYear;
            if($week){
                $display = reportQueries::getStartOfWeekFromWeekYear($weekInYear, $year);
            }
            $display=$display."-".$year;
            $weekAvg[$display]=$ridetime;
            $avg[$display]=0;
            $total=$total+$ridetime;
            $count++;
        }
        //go through and set avg
        if($count>0){
            $average=$total/$count;
        }else{
            $average=0;
        }
        foreach (array_keys($weekAvg) as $a){
            $avg[$a]=$average;
        }
        $return = array($datasetName=>$weekAvg,'Average'=>$avg);

        return $return;
    }

    public static function getAvgSpeedReportData($report,$userId,$bikeId,$rideId,$fromDate,$toDate){
        $dateFormat='%v';
        $datasetName='Weekly Total';
        $week=true;
        if($report==5){//month query
            $dateFormat='%M';
            $datasetName='Monthly Total';
            $week=false;
        }
        $weekAvg = array();
        $avg = array();
        $connection = Propel::getConnection();
        $query = "select date_FORMAT(us.ride_date,'%x') as year, date_FORMAT(us.ride_date,'".$dateFormat."') as weekinyear, us.avg_speed as speed from user_stats us where us.user_id=? and date_FORMAT(us.RIDE_DATE,'%Y%m%d')>=? and date_FORMAT(us.RIDE_DATE,'%Y%m%d')<=? ";
        $bikeclause=" and us.bike_id=".$bikeId;
        $rideclaue=" and us.ride_key=".$rideId;
        $groupclause=" group by weekinyear order by 1,2 asc";
        if($bikeId && $bikeId>=0){
            $query=$query.$bikeclause;
        }
        if($rideId && $rideId>=0){
            $query=$query.$rideclaue;
        }
        $query=$query.$groupclause;
        sfContext::getInstance()->getLogger()->info('@@@@@@@@@@@@@@@executing Time query '.$query);
        $statement = $connection->prepare($query);
        $statement->bindValue(1, $userId);
        $statement->bindValue(2, date("Ymd",strtotime($fromDate)));
        $statement->bindValue(3, date("Ymd",strtotime($toDate)));
        $resultset = $statement->execute();
        $count=0;
        $total=0;
        while ($row=$statement->fetch())
        {
            $speed = $row['speed'];
            $weekInYear = $row['weekinyear'];
            $year = $row['year'];
            $display=$weekInYear;
            if($week){
                $display = reportQueries::getStartOfWeekFromWeekYear($weekInYear, $year);
            }
            $display=$display."-".$year;
            $weekAvg[$display]=$speed;
            $avg[$display]=0;
            $total=$total+$speed;
            $count++;
        }
        //go through and set avg
        if($count>0){
            $average=$total/$count;
        }else{
            $average=0;
        }
        foreach (array_keys($weekAvg) as $a){
            $avg[$a]=$average;
        }
        $return = array($datasetName=>$weekAvg,'Average'=>$avg);

        return $return;
    }

    public static function getRideCountReportData($report,$userId,$bikeId,$rideId,$fromDate,$toDate){
        $dateFormat='%v';
        $datasetName='Weekly Total';
        $week=true;
        if($report==7){//month query
            $dateFormat='%M';
            $datasetName='Monthly Total';
            $week=false;
        }
        $weekAvg = array();
        $avg = array();
        $connection = Propel::getConnection();
        $query = "select date_FORMAT(us.ride_date,'%x') as year, date_FORMAT(us.ride_date,'".$dateFormat."') as weekinyear, count(us.ride_key) as ridecount from user_stats us where us.user_id=? and date_FORMAT(us.RIDE_DATE,'%Y%m%d')>=? and date_FORMAT(us.RIDE_DATE,'%Y%m%d')<=? ";
        $bikeclause=" and us.bike_id=".$bikeId;
        $rideclaue=" and us.ride_key=".$rideId;
        $groupclause=" group by weekinyear order by 1,2 asc";
        if($bikeId && $bikeId>=0){
            $query=$query.$bikeclause;
        }
        if($rideId && $rideId>=0){
            $query=$query.$rideclaue;
        }
        $query=$query.$groupclause;
        sfContext::getInstance()->getLogger()->info('@@@@@@@@@@@@@@@executing Time query '.$query);
        $statement = $connection->prepare($query);
        $statement->bindValue(1, $userId);
        $statement->bindValue(2, date("Ymd",strtotime($fromDate)));
        $statement->bindValue(3, date("Ymd",strtotime($toDate)));
        $resultset = $statement->execute();
        $count=0;
        $total=0;
        while ($row=$statement->fetch())
        {
            $rideCount = $row['ridecount'];
            $weekInYear = $row['weekinyear'];
            $year = $row['year'];
            $display=$weekInYear;
            if($week){
                $display = reportQueries::getStartOfWeekFromWeekYear($weekInYear, $year);
            }
            $display=$display."-".$year;
            $weekAvg[$display]=$rideCount;
            $avg[$display]=0;
            $total=$total+$rideCount;
            $count++;
        }
        //go through and set avg
        if($count>0){
            $average=$total/$count;
        }else{
            $average=0;
        }
        foreach (array_keys($weekAvg) as $a){
            $avg[$a]=$average;
        }
        $return = array($datasetName=>$weekAvg,'Average'=>$avg);

        return $return;
    }

    public static function getStartOfWeekFromWeekYear($week, $year){
        $date = strtotime('+' . $week-1 . ' week',mktime(0,0,0,1,1,$year));
        $minusonedate = strtotime('-' . date("w",$date ) . 'day', $date);

        $mon = date("d-M",strtotime('+1 day',$minusonedate));
        return $mon;
    }
}
