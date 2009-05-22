<?php
class utils{
    /**
     *Converts meters value from DB to correct mileage for user. km or miles
     * @param <type> $meterMile
     */
    public static function getMileageFromMeters($meterMile){
        sfContext::getInstance()->getLogger()->info('@@@@@@@@@getMileageFromMetersIN '.$meterMile);
        $mileagePref = sfContext::getInstance()->getUser()->getAttribute('mileage',null,'subscriber');
        $mileage=0;
        if($meterMile){
            if($mileagePref==1){//miles
                $mileage = $meterMile*.000621371192;
            }else{
                $mileage = $meterMile/1000;
            }
        }
        sfContext::getInstance()->getLogger()->info('@@@@@@@@@getMileageFromMetersOUT '.$mileagePref.' '.$mileage);
        return round($mileage,2);
    }

    /**
     *Converts user entered units(km or miles) to meters to store in the database
     * @param <type> $mileage
     */
    public static function getMetersFromMileage($mileage){
        sfContext::getInstance()->getLogger()->info('@@@@@@@@@getMetersFromMileageIN '.$mileage);
        $mileagePref = sfContext::getInstance()->getUser()->getAttribute('mileage',null,'subscriber');
         $meterMile=0;
        if($mileage){
            if($mileagePref==1){//miles
                 $meterMile = $mileage/.000621371192;
            }else{
                $meterMile = $mileage*1000;
            }
        }
        sfContext::getInstance()->getLogger()->info('@@@@@@@@@getMetersFromMileageOUT '.$mileagePref.' '.$meterMile);
        return $meterMile;
    }
    /**
     * returns the correct mileage string kil, or miles based on user settings
     */
    public static function getMileageString(){
    $mileagePref = sfContext::getInstance()->getUser()->getAttribute('mileage',null,'subscriber');
    $mileString = "miles";
    if($mileagePref==0){
        $mileString="km";
    }
    return $mileString;
    }
}
