<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use dev\mailWrapper;
use App\Mail\Notices;
class EmailController extends Controller
{

    function sendEmail(Request $request){
        $mailable = new MailWrapper(new Notices($request->input("subject"),
            $request->input("emailContent"),
            "Hello there," ));
        $mailable->sendEmail(preg_split('/\r\n|[\r\n]/', $request->input("emailInputs")));
        return view('confirmation');
    }
}
