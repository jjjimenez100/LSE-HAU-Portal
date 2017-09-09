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
    public function show($id)
    {
        //
    }
}
