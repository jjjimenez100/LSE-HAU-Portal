<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminHomeController extends Controller
{
    public function __construct(){
        $this->middleware('role:Admin');
    }

    public function index(){
        return view('admin-home');
    }
}
