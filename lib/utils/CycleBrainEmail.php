<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CycleBrainEmail
 *
 * @author brandon
 */
class CycleBrainEmail {
    
    public function sendEmail($to, $from, $subject, $body)
    {
    $headers  = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
    $headers .= 'To: ' . $to . "\r\n";
    $headers .= 'From: ' . $from . "\r\n\n\n";

    if(mail($to,$subject,$body,$headers))
      return true;
   return false;
   }
}

