<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Event;
use App\User;
use App\Registration;
use Illuminate\Support\Facades\Schema;
class RegistrationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = Event::orderBy('id', 'asc')->get();
        $seatCounts = [];
        $container = [];
        $columnNames = Schema::getColumnListing('users');
        foreach($events as $event){
            $registrations = Registration::where('eventID', $event->id)->get();
            array_push($seatCounts, $event->seatCount - count($registrations));
            $registeredUsers = [];
            foreach($registrations as $registration){
                array_push($registeredUsers, $registration->member);
            }
            $eventRegisteredUsers = [
              $event->eventName => $registeredUsers
            ];
            array_push($container, $eventRegisteredUsers);
        }
        return view('viewRegistrations')
            ->with('container', $container)
            ->with('columnNames', $columnNames)
            ->with('seatCounts', $seatCounts);
    }

    public function store(Request $request){
        $newRegistration = new Registration;
        $newRegistration->eventID = $request->eventID;
        $newRegistration->userID = $request->userID;
        $newRegistration->save();

        return response()->json($newRegistration);
    }

    public function show($id)
    {
        //
    }

    public function destroy(Request $request){
        $id = $request->id;
        $registration = Registration::where('id', $id)->first();
        if($registration->count() > 0){
            $eventName = $registration->event->eventName;
            $member = $registration->member->name;
            Registration::where('id', $id)->delete();
            return response()->json([
               "success" => "true",
                "message" => "successfully deleted registration",
                "registrationInformation" => [
                    "registrationId" => $id,
                    "event" => $eventName,
                    "member" => $member
                ]
            ]);
        }

        return response()->json([
            "success" => "false",
            "message" => "submitted id was not found in the database"
        ]);
    }
}
