<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct(){
        $this->middleware('role:User');
    }

    public function index(){
        return view('portal.portal-home-user');
    }
}
