<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\College;
use Validator;
use Illuminate\Support\Facades\Input;
use Response;
use Illuminate\Validation\Rule;
class ProfileManagementController extends Controller
{
    public function index(){
        $colleges = College::all();
        return view('profilemanagement')
            ->with('colleges', $colleges);
    }

    public function updateProfile(Request $request){
        $userId = $request->id;
        $rules = [
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'string',
                'email',
                'max:120',
                Rule::unique('users')->ignore($userId)
            ],
            'college' => 'required|string|min:1|max:1',
            'contactNumber' => [
                'required',
                'string',
                'min:11',
                'max:11',
                Rule::unique('users')->ignore($userId)
            ]
        ];

        if($request->has('password')){
            array_push($rules, ['password' => 'required|string|min:6']);
        }

        $validation = Validator::make(Input::all(), $rules);
        if($validation->fails()){
            return Response::json(
                array('errors' => $validation->getMessageBag()->toArray()), 400);
        }

        if(User::where('id', $request->id)->count() > 0){
            $user = User::where('id', $request->id)->first();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->contactNumber = $request->contactNumber;
            if($request->has('password')){
                $user->password = bcrypt($request->password);
            }
            $user->collegeID = $request->college;
            $user->save();

            return Response::json(["success" => "true",
                "message" => "successfully updated user profile",
                "newInfo" => [
                $user
            ]]);

        }

        return response()->json([
            "success" => "false",
            "message" => "no user id match on the db"
        ]);
    }
}
