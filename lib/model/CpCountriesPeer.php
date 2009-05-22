<?php

class CpCountriesPeer extends BaseCpCountriesPeer
{
     static public function getAllCountries() {
         $c = new Criteria();
         $c->addAscendingOrderByColumn(CpCountriesPeer::NAME);
        $rs = CpCountriesPeer::doSelect($c);
        return $rs;
    }
}
