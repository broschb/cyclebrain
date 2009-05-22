<?php

class CpCitiesPeer extends BaseCpCitiesPeer
{
      static public function getAllCitiesByState($stateId) {
         $c = new Criteria();
         $c->add(CpCitiesPeer::STATE_ID, $stateId);
         $c->addAscendingOrderByColumn(CpCitiesPeer::NAME);
        $rs = CpCitiesPeer::doSelect($c);
        return $rs;
    }
}
