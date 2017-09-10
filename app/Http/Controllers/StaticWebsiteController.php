<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\College;
use App\Event;
use App\Registration;
use Illuminate\Support\Facades\Auth;
class StaticWebsiteController extends Controller
{
    public function getListOfColleges(){
        return College::all();
    }

    public function index(){
        return view('home')->with('colleges', $this->getListOfColleges());
    }

    public function events(){
        $events = Event::orderBy('id', 'asc')->get();
        $seatCounts = [];
        foreach($events as $event){
            $registrations = Registration::where('eventID', $event->id)->get();
            array_push($seatCounts, $event->seatCount - count($registrations));
        }

        if(Auth::check()){
            if(Registration::where('userID', Auth::user()->id)->first()){
                $eventsRegistered = Registration::where('userID', Auth::user()->id)->get();
            }
        }
        return view('events')
            ->with('colleges', $this->getListOfColleges())
            ->with('events', $events)
            ->with('seatCounts', $seatCounts)
            ->with('eventsRegistered', $eventsRegistered);
    }

    public function contact(){
        return view('contacts')->with('colleges', $this->getListOfColleges());
    }

    public function aboutBirth(){
        return view('about-thebirth')->with('colleges', $this->getListOfColleges());
    }

    /*public function aboutMnv(){
        return view('home')->with('colleges', getListOfColleges());
    }

    public function gallery(){
        return view('gallery')->with('colleges', $this->getListOfColleges());
    }*/
}
