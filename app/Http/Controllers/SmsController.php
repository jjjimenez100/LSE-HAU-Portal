<?php

namespace App\Http\Controllers;

use dev\smsWrapper;
use Illuminate\Http\Request;

class SmsController extends Controller
{
    /*

$x = new SmsWrapper("jimenez.johnjoshua.jjj@gmail.com", "kalamono");
$x->setDeviceID("52411");
$arrayy = $x->sendMessage("Hello", ["09176677145", "09175755703"]);
//echo($arrayy["response"]["result"]["success"]["0"]["status"]);

use dev\mailWrapper;
use App\Mail\Notices;
if(!empty($_POST))
echo $_POST["emails"];
//$mailable = new MailWrapper(new Notices("TEST", "TEST", "TEST" ));
//$mailable->sendEmail(["jimenez.johnjoshua.jjj@gmail.com", "lsehau@gmail.com"]);
*/
    function sendSms(Request $request){
        $sms = new SmsWrapper("jimenez.johnjoshua.jjj@gmail.com", "kalamono");
        $sms->setDeviceID("52411");
        $sms->sendMessage($request->input("message"),
            preg_split('/\r\n|[\r\n]/', $request->input("phoneNumbers")));
        return view('confirmation');
    }
}
