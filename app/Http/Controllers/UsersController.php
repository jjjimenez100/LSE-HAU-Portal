<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use App\User;
use App\College;
use App\Role;
use Illuminate\Support\Facades\Schema;
use Validator;
use View;
use Response;
use Illuminate\Validation\Rule;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $columnNames = Schema::getColumnListing('users');
        $users = User::all();
        $colleges = College::all();
        $roles = Role::all();

        return view('manageusers')
            ->with('columnNames', $columnNames)
            ->with('users', $users)
            ->with('roles', $roles)
            ->with('colleges', $colleges);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $addRules = [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:120|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'college' => 'required|string|min:1|max:1',
            'contactNumber' => 'required|string|min:11|max:13|unique:users'
        ];

        $validation = Validator::make(Input::all(), $addRules);
        if($validation->fails()){
            return Response::json(
                array('errors' => $validation->getMessageBag()->toArray()), 404);
        }

        else{
            $newUser = new User;
            $newUser->collegeID = $request->college;
            $newUser->contactNumber = $request->contactNumber;
            $newUser->email = $request->email;
            $newUser->name = $request->name;
            $newUser->password = bcrypt($request->password);
            if(Auth::user()->role->role != "Admin"){
                $newUser->roleID = Role::$defaultRoleId;
            }

            else{
                $newUser->roleID = $request->role;
            }
            $newUser->save();

            return response()->json($newUser);
        }
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $userId = $request->id;
        $updateRules = [
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

        $validation = Validator::make(Input::all(), $updateRules);
        if($validation->fails()){
            return Response::json(
                array('errors' => $validation->getMessageBag()->toArray()), 404);
        }

        else{
            $user = User::find($userId);
            $user->name = $request->name;
            if(Auth::user()->role->role != "Admin"){
                $user->roleID = Role::$defaultRoleId;
            }

            else{
                $user->roleID = $request->role;
            }
            $user->collegeID = $request->college;
            $user->contactNumber = $request->contactNumber;
            $user->email = $request->email;
            $user->save();

            return response()->json($user);
        }
    }

    public function delete(Request $request){
        $createdAt = User::find($request->id)->created_at;
        User::destroy($request->id);
        $message = array(
            "success" => "true",
            "message" => "Successfully deleted user.",
            "timestamp" => array(
                "created_at" => $createdAt,
                "deleted_at" => Carbon::now()
            )
        );
        return json_encode($message);
    }
}
