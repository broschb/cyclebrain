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

require_once "Mail.php";

class CycleBrainEmail {
    
    public function sendEmail($to, $from, $subject, $message,$additional_headers="")
    {

         # Declare SMTP Server Settings
 /*   $smtp_server = "smtp.gmail.com";
    $smtp_username = "cyclebrain@gmail.com";
    $smtp_password = "bRb061626";
    $smtp_default_from = "cyclebrain@gmail.com";

    # Cast inputs to strings
    $to = (string) $to;
    $subject = (string) $subject;
    $message = (string) $message;
    $additional_headers = (string) $additional_headers;

    # Re-construct the headers into an array as expected by Pear
    $raw_headers = explode("\n", $additional_headers);
    $headers = Array("To"=>$to, "Subject"=>$subject);
    foreach($raw_headers as $raw_header) {
        $header = explode(":",$raw_header,2);
        if (count($header) != 2) {
            continue;     # Here the behaviour may differ somewhat with mail()...
                        # malformed headers will be discarded silently.
        }
        if (trim(strtolower($header[0])) == "to" || trim(strtolower($header[0])) == "subject") {
            continue;     # No overriding To and Subject
        }
        $headers[ucfirst(trim($header[0]))] = trim($header[1]); # Key will start uppercase
    }

    # Set a default From header if none was provided
    if (!array_key_exists("From", $headers)) {
        $headers["From"] = $smtp_default_from;
    }

    # Create the smtp object and send mail. Must return true on success,
    # false on failure.

    $smtp = Mail::factory("smtp", Array("host"=>$smtp_server, "auth"=>true,
                                        "username"=>$smtp_username, "password"=>$smtp_password));

    $result = $smtp->send($to, $headers, $message);

    if (PEAR::IsError($result)) {
        # echo $result->getMessage();
        return false;
    } else {
        return true;
    }*/



    $headers  = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
    $headers .= 'To: ' . $to . "\r\n";
    $headers .= 'From: ' . $from . "\r\n\n\n";

    if(mail($to,$subject,$body,$headers))
      return true;
   return false;
   }
}

