<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\College;
class ProfileManagementController extends Controller
{
    public function index(){
        return view('profilemanagement');
    }

    public function updateProfile(Request $request){
        if(User::where('id', $request->id)->count() > 0){
            $user = User::where('id', $request->id)->get();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->contactNumber = $request->contactNumber;
            $user->password = bcrypt($request->password);
            $user->collegeID = $request->collegeID;
            $user->save();

            return reponse()->json([
                "success" => "true",
                "message" => "successfully updated user profile",
                "newInfo" => [
                    $user
                ]
            ]);
        }

        return response()->json([
            "success" => "false",
            "message" => "no user id match on the db"
        ]);
    }
}
