<?php

/**
 * confirmation actions.
 *
 * @package    bike
 * @subpackage confirmation
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12479 2008-10-31 10:54:40Z fabien $
 */
class confirmationActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
      $uid=$this->getRequestParameter('uid');
      $conf=$this->getRequestParameter('conf');
      $c = new Criteria();
      $c->add(UsersPeer::USER_ID, $uid);
      $user = UsersPeer::doSelectOne($c);
      if (sha1($user->getSalt().$user->getUsername()) ==$conf)
      {
        $this->goodConf=true;
        $user->setActive('Y');
        $user->save();
      }else
        $this->goodConf=false;
  }
}
