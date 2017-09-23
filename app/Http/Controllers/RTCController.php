<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
class RTCController extends Controller
{
    public function index(){
        if(Auth::user()->role->role == "User"){
            return view('rtcuser');
        }
        else{
            return view('rtcadmin');
        }
    }
}
