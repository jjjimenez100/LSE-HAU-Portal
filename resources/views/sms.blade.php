<?php
use dev\smsWrapper;
$sms = new SmsWrapper("jimenez.johnjoshua.jjj@gmail.com", "joshuapogi143");

















































$sms->setDeviceID(52411);
$sms->sendMessage("HELLO FROM LSE.", ["09176677145", "09165730881"]);
?>