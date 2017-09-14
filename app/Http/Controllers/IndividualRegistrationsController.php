<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Registration;
use App\Event;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
class IndividualRegistrationsController extends Controller
{
    public function index(){
        if(Auth::check()){
            $userId = Auth::user()->id;
            $registrations = Registration::where('userId', $userId)->get();
            $columnNames = Schema::getColumnListing('events');
            return view('registrations')
                ->with('registrations', $registrations)
                ->with('columnNames', $columnNames);
        }
    }
}
