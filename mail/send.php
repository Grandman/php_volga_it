<?php

require 'Mandrill.php';
$from_email = $_POST['from_email'];
$to= $_POST['to'];
$subject = $_POST['subject'];
$body= $_POST['body'];
$mandrill = new Mandrill('3xGDzd_VFDw4tlUbMzOf5Q');

$message = array(
    'subject' => $subject,
    'from_email' => $from_email,
    'html' => $body,
    'to' => array(array('email' => $to, 'name' => 'Recipient 1')),
  );

$result = $mandrill->messages->send($message);
if($result[0]['status'] != "sent")
	echo "Don't Sended " . $result[0]['status'];
else
	echo "Sended";