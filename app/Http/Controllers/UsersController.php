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
class UsersController extends Controller
{
    protected $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:120|unique:users',
        'password' => 'required|string|min:6|confirmed',
        'college' => 'required|string|min:1|max:1',
        'contactNumber' => 'required|string|min:11|max:13|unique:users'
    ];
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validation = Validator::make(Input::all(), $this->rules);
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
            if($request->has('role')){
                //pag admin may massubmit na role
                $newUser->roleID = $request->role;
            }
            else{
                //kasi same form din gagamitin ni officer
                //kaso di niya nakikita at naeedit yung role
                //so wala siyang masusubmit na role :)
                $newUser->roleID = Role::$defaultRoleId;
            }
            $newUser->save();

            return response()->json($newUser);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
