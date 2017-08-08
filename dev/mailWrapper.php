<?php
/**
 * Created by PhpStorm.
 * User: Joshua
 * Date: 7/30/2017
 * Time: 4:34 PM
 */
namespace dev;
use Illuminate\Support\Facades\Mail;
class MailWrapper{
    private $mailableInstance;

    function __construct($mailableInstance){
        $this->mailableInstance = $mailableInstance;
    }

    function sendEmail($recipients=[]){
        foreach($recipients as $recipient){
            Mail::to($recipient)->send($this->mailableInstance);
        }
    }
}
?>