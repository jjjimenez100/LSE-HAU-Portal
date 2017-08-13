<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\College;
class StaticWebsiteController extends Controller
{
    public function getListOfColleges(){
        return College::all();
    }

    public function index(){
        $colleges = College::all();
        return view('home')->with('colleges', $this->getListOfColleges());
    }

    public function events(){
        return view('events')->with('colleges', $this->getListOfColleges());
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
