<?php

class UserProfile extends BaseUserProfile
{
    public function getLatLong(){
         $cpCity = CpCitiesPeer::retrieveByPK($this->getCity());
         return $cpCity;
    }
}
