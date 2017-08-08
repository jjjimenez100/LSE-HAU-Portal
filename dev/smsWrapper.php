<?php
/**
 * Created by PhpStorm.
 * User: Joshua
 * Date: 7/28/2017
 * Time: 2:13 PM
 */
    namespace dev;
    include "smsGateway.php";
    class SmsWrapper{
        private $deviceID, $email, $password;
        private $smsGatewayObj;

        public function __construct($email, $password){
            $this->email = $email;
            $this->password = $password;
            $this->smsGatewayObj = new SmsGateway($this->email, $this->password);
        }

        public function setDeviceID($deviceID){
            $this->deviceID = $deviceID;
        }

        public function sendMessage($message, $numbers=[]){
            $result = $this->smsGatewayObj->sendMessageToManyNumbers($numbers, $message, $this->deviceID);
            return $result;
        }
    }
?>