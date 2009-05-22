<?php

/**
 * main actions.
 *
 * @package    bike
 * @subpackage main
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class mainActions extends sfActions
{
  /**
   * Executes index action
   *
   */
  public function executeIndex()
  {
      $u_id =  sfContext::getInstance()->getUser()->getAttribute('subscriber_id', '-1', 'subscriber');
      if ($u_id<=0){
        $this->subscribe = null;
        if ($this->getRequest()->getMethod() == sfRequest::POST)
        {
            try{
                $email=$this->getRequestParameter('email');
                $this->subscribe = 'Thanks, we will contact you shortly at the email address you have provided';
         /*$connection = new Swift_Connection_SMTP('smtp.gmail.com', 465, Swift_Connection_SMTP::ENC_SSL);
          $connection->setUsername('cyclebrain@gmail.com');
          $connection->setPassword('bRb061626');

          $mailer = new Swift($connection);
          $message = new Swift_Message('USER REQUEST-'.$email);

          // Send
          $mailer->send($message, 'cyclebrain@gmail.com', 'cyclebrain@gmail.com');
          $mailer->disconnect();
        */
              $email = new CycleBrainEmail();
              $email->sendEmail('cyclebrain@gmail.com','admin@cyclebrain.com','BETA USER',$email);
            }catch (Exception $e) {
                echo 'MainActions:Index Caught exception: ',  $e->getMessage(), "\n";
            }
        }
  }else{
      $this->user=UsersPeer::retrieveByPK($u_id);
  }
  }
}
