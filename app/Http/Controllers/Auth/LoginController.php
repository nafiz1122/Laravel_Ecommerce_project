<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;
use App\User;
class LoginController extends Controller
{
    public function login(REQUEST $request){
        $email = $request->email;
        $password =$request->password;
        $validData = User::where('email',$email)->first();
        $passwordCheck =password_verify($password,@$validData->password);
        if($passwordCheck == false){
            //notification
            $notification = array(
                'message' =>'Your email or password does not match',
                'alert-type' =>'error'
                );
            return redirect()->back()->with($notification);
        }else if($validData->status == 0){
            //notification
            $notification = array(
                'message' =>'Sorry! you are not verify yet',
                'alert-type' =>'error'
                );
            return redirect()->back()->with($notification);
        }
        if(Auth::attempt(['email' => $email, 'password' => $password])){
            return redirect()->route('login');
        }
    }
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
      //protected $redirectTo = RouteServiceProvider::HOME;
      protected function redirectTo(){

        if (Auth::user()->role_type == 'admin'){

            return '/dashboard';
        }
        else{

            return '/home';
        }
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
