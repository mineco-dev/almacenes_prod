<?php
require_once "Mail.php";

$from = "Edy Cortes<ecortes@mineco.gob.gt>";
$to = "Edy Cortes<ecortes@mineco.gob.gt>";
$subject = "Hi!";
$body = "Hi,\n\nHow are you?";

$host = "me-s-mail";
$username = "infocomex";
$password = "cafta2006";

$headers = array ('From' => $from,
  'To' => $to,
  'Subject' => $subject);
$smtp = Mail::factory('smtp',
  array ('host' => $host,
    'auth' => true,
    'username' => $username,
    'password' => $password));

$mail = $smtp->send($to, $headers, $body);

if (PEAR::isError($mail)) {
  echo("<p>" . $mail->getMessage() . "</p>");
 } else {
  echo("<p>Message successfully sent!</p>");
 }
?>