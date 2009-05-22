<?php

class UserRideMap extends BaseUserRideMap
{

    public static function createMapString($mapPoints){
        $coordString="";
        if($mapPoints){
                foreach($mapPoints as $mp){
                    $coordString = $coordString.$mp->getLat()."^".$mp->getLong()."*";
                }
                sfContext::getInstance()->getLogger()->info('CoordString'.$coordString);
            }
            return $coordString;
    }
}
