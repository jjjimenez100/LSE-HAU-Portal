<?php

namespace App\Http\Controllers\Auth;

use Carbon\Carbon;
use App\User;
use App\College;
use App\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Auth;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;
    protected function redirectTo(){
        $userRole = Auth::User()->role->role;
        if($userRole == "Admin" || $userRole == "Officer"){
            return ("/portal/manage/users");
        }
        return ("portal/user/profile/manage/");
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:120|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'college' => 'required|string|min:3|max:5',
            'contactNumber' => 'required|string|min:11|max:13|unique:users',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'collegeID' => College::where('collegeDepartment', $data['college'])->first()->id,
            'roleID' => Role::$defaultRoleId,
            'contactNumber' => $data['contactNumber'],
        ]);
    }

    public function showRegistrationForm()
    {
        return redirect('/');
    }
}
