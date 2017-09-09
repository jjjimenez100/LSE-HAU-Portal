<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Event;
use App\User;
use App\Mail\Notices;
use App\Registration;
use dev\smsWrapper;
use dev\mailWrapper;
class AnnouncementsController extends Controller
{
    public function index(){
        $events = Event::all();
        return view('sendAnnouncements')
            ->with('events', $events);
    }

    public function sendAnnouncements(Request $request){
        if($request->has('subject') && $request->has('message')
        && $request->has('recipients') && $request->has('emailChoice')
        && $request->has('textChoice')){
            $subject = $request->input('subject');
            $recipients = $request->input('recipients');
            $message = $request->input('message');
            $shouldBeEmail = $request->input('emailChoice');
            $shouldBeText = $request->input('textChoice');

            $recipientUserModels = $this->getRecipientUserModels($recipients);
            $smsSuccess = "";
            $emailSuccess ="";
            $smsMessage = [];
            $emailMessage = "";
            if($shouldBeEmail != "false"){
                $this->sendEmail($recipientUserModels, $message, $subject);
                $emailSuccess = "true";
                $emailMessage = "message was queued to the mail server";
            }

            if($shouldBeText != "false"){
                $response = $this->sendSms($recipientUserModels, $message);
                if(isset($response["response"]["fails"])){
                    $smsSuccess = "false";
                    $smsMessage = $response["response"]["fails"]["errors"];
                }

                else if(isset($response["response"]["result"]["fails"][0]["errors"])){
                    $smsSuccess = "false";
                    $smsMessage = $response["response"]["result"]["fails"];
                }

                else if(isset($response["response"]["result"]["success"]["0"]["status"])){
                    $smsSuccess = "true";
                    $smsMessage = $response["response"]["result"]["success"];
                }
            }

            return response()->json([
               "success" => [
                   "smsSuccess" => $smsSuccess,
                   "emailSuccess" => $emailSuccess
               ], "message" => [
                   "smsMessage" => $smsMessage,
                    "emailMessage" => $emailMessage
                ], "recipients" => $recipientUserModels
            ]);
        }

        else{
            return response()->json([
               "success" => "false",
                "message" => "insufficient data was sent to the server"
            ]);
        }
    }

    public function getRecipientUserModels($recipients){
        if($recipients == "all"){
            $recipients = User::all();
        }

        else if($recipients == "heads"){
            $recipients = User::where('roleID', 1)->orWhere('roleID', 2)->get();
        }

        else if($recipients == "users"){
            $recipients = User::where('roleID', 3)->get();
        }

        else if($recipients == "officers"){
            $recipients = Users::where('roleID', 2)->get();
        }

        else if($recipients == "admins"){
            $recipients = Users::where('roleID', 1)->get();
        }

        else if(is_numeric($recipients)){
            $registeredUsers = Registration::where('eventID', $recipients)->get();
            $recipients = [];
            foreach($registeredUsers as $registeredUser){
                array_push($recipients, $registeredUser->member);
            }
        }

        else{
            $recipients = "";
        }

        return $recipients;
    }

    public function getUserEmails($recipientUserModels){
        $emails = [];
        foreach($recipientUserModels as $recipientUserModel){
            array_push($emails, $recipientUserModel->email);
        }

        return $emails;
    }

    public function sendEmail($userModels, $message, $subject){
        $mailable = new MailWrapper(new Notices($subject, $message, "Hello there,"));
        $mailable->sendEmail($this->getUserEmails($userModels));
    }

    public function getUserContactNumbers($recipientUserModels){
        $contactNumbers = [];
        foreach($recipientUserModels as $recipientUserModel){
            array_push($contactNumbers, $recipientUserModel->contactNumber);
        }

        return $contactNumbers;
    }

    public function sendSms($userModels, $message){
        $sms = new SmsWrapper($this->email, $this->password);
        $sms->setDeviceID($this->deviceID);
        $response = $sms->sendMessage($message, $this->getUserContactNumbers($userModels));

        return $response;
    }

    protected $email = "jimenez.johnjoshua.jjj@gmail.com";
    protected $password = "kalamono";
    protected $deviceID = "57534";
}
