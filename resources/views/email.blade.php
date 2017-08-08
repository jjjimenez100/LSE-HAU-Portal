<?php
/*
use dev\smsWrapper;
$x = new SmsWrapper("jimenez.johnjoshua.jjj@gmail.com", "joshuapogi143");
$x->setDeviceID("52411");
$arrayy = $x->sendMessage("Hello", ["09176677145", "09175755703"]);
//echo($arrayy["response"]["result"]["success"]["0"]["status"]);
*/
use dev\mailWrapper;
use App\Mail\Notices;

$mailable = new MailWrapper(new Notices("TEST", "TEST", "TEST" ));
$mailable->sendEmail(["jimenez.johnjoshua.jjj@gmail.com", "lsehau@gmail.com"]);
?>

