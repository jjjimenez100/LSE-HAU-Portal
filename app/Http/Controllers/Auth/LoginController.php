<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use Auth;
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    //protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function redirectTo(){
        $userRole = Auth::User()->role->role;
        if($userRole == "Admin" || $userRole == "Officer"){
            return ("/portal/manage/users");
        }
        return ("/portal/user/home");
    }

    protected function showLoginForm() //prevent anyone from sending get request to /login
    {
        return redirect('/');
    }

   /* protected function sendLoginResponse(Request $request){
        $request->session()->regenerate();
        $this->clearLoginAttempts($request);
        if ($request->ajax()) {
            return response()->json($this->guard()->user(), 200);
        }
        return $this->authenticated($request, $this->guard()->user())
            ?: redirect()->intended($this->redirectPath());
    }

    protected function sendFailedLoginResponse(Request $request){
        if ($request->ajax()) {
            return response()->json([
                'error' => Lang::get('auth.failed')
            ], 401);
        }
        return redirect()->back()
            ->withInput($request->only($this->username(), 'remember'))
            ->withErrors([
                $this->username() => Lang::get('auth.failed'),
            ]);
    }*/
}
