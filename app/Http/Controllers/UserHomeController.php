<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserHomeController extends Controller
{
    public function __construct(){
        $this->middleware('role:User');
    }

    public function index(){
        return view('user-home');
    }
}
