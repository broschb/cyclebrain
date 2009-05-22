<?php
class queries{
    
    public static function getYearTopRiders(){
        $results = array();
        $from_date = date("Ymd",mktime(0, 0, 0, 1, 1, date("Y")));
        $connection = Propel::getConnection();
       // $query = "SELECT user_rides.user_id, sum(user_rides.MILEAGE) mileage FROM `user_rides`, `user_stats` WHERE user_stats.RIDE_DATE>=? AND user_rides.USER_RIDE_ID=user_stats.RIDE_KEY group by user_rides.user_id order by 2 limit 5";
        $query = "SELECT u.username username, sum(ur.MILEAGE) mileage FROM user_rides ur, user_stats us,users u WHERE date_FORMAT(us.RIDE_DATE,'%Y%m%d')>=? AND ur.USER_RIDE_ID=us.RIDE_KEY and u.user_id=ur.user_id group by ur.user_id order by 2 desc limit 5";
        $statement = $connection->prepare($query);
        $statement->bindValue(1, $from_date);
        $resultset = $statement->execute();
        $count=1;
        while ($row=$statement->fetch())
        {
            $value = $row['username'].' - '.utils::getMileageFromMeters($row['mileage']);
            $results[$count]=$value;
            $count++;
        }
        return $results;
    }

    public static function getMonthTopRiders(){
        $results = array();
        $from_date = date("Ymd",mktime(0, 0, 0, date("m"), 1, date("Y")));
        $connection = Propel::getConnection();
       // $query = "SELECT user_rides.user_id, sum(user_rides.MILEAGE) mileage FROM `user_rides`, `user_stats` WHERE user_stats.RIDE_DATE>=? AND user_rides.USER_RIDE_ID=user_stats.RIDE_KEY group by user_rides.user_id order by 2 limit 5";
        $query = "SELECT u.username username, sum(ur.MILEAGE) mileage FROM user_rides ur, user_stats us,users u WHERE date_FORMAT(us.RIDE_DATE,'%Y%m%d')>=? AND ur.USER_RIDE_ID=us.RIDE_KEY and u.user_id=ur.user_id group by ur.user_id order by 2 desc limit 5";
        $statement = $connection->prepare($query);
        $statement->bindValue(1, $from_date);
        $resultset = $statement->execute();
        $count=1;
        while ($row=$statement->fetch())
        {
            $value = $row['username'].' - '.utils::getMileageFromMeters($row['mileage']);
            $results[$count]=$value;
            $count++;
        }
        return $results;
    }

    public static function getWeekTopRiders(){
        $results = array();
        $from_date = date("Ymd",mktime(1, 0, 0, date('m'), date('d')-date('w'), date('Y')));
        $connection = Propel::getConnection();
        $query = "SELECT u.username username, sum(ur.MILEAGE) mileage FROM user_rides ur, user_stats us,users u WHERE date_FORMAT(us.RIDE_DATE,'%Y%m%d')>=? AND ur.USER_RIDE_ID=us.RIDE_KEY and u.user_id=ur.user_id group by ur.user_id order by 2 desc limit 5";
        $statement = $connection->prepare($query);
        $statement->bindValue(1, $from_date);
        $resultset = $statement->execute();
        $count=1;
        while ($row=$statement->fetch())
        {
            $value = $row['username'].' - '.utils::getMileageFromMeters($row['mileage']);
            $results[$count]=$value;
            $count++;
        }
        return $results;
    }
   
}
