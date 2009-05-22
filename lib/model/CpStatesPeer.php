<?php

class CpStatesPeer extends BaseCpStatesPeer
{
    static public function getAllStatesByCountry($countryId) {
         $c = new Criteria();
         $c->add(CpStatesPeer::COUNTRY_ID, $countryId);
         $c->addAscendingOrderByColumn(CpStatesPeer::NAME);
        $rs = CpStatesPeer::doSelect($c);
        return $rs;
    }
}
