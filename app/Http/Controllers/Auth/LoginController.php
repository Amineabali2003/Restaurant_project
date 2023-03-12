<?php

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

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
    protected $redirectTo = RouteServiceProvider::HOME;
    // protected $redirectTo;
//     protected function credentials(Request $request)
// {
//     return array_merge($request->only($this->username(), 'password'),
//     ['isBan' => 0]);
// }
    // protected function authenticated($request, $user)
    // {

    //     $userType=Auth::user()->usertype;
    //     if($userType=='1'){
    //         $redirectTo="/dashboard";
    //     }
    //     else{
    //         $redirectTo="/ahaa";
    //     }

    //     return redirect()->intended($redirectTo);
    // }



    // protected function redirectTo()
    // {
    //     // switch(Auth::user()->usertype){
    //     //     case 1: $this->redirectTo='/';
    //     //     return $this->redirectTo;
    //     //     break;
    //     //     case 0: $this->redirectTo='/dashboard';
    //     //     return $this->redirectTo;
    //     //     break;

    //     // }
    //     if(Auth::user()->usertype == 1){
    //       return  '/dashboard';
    //     //   return  $redirectTo='/dashboard';
    //     }
    //     else return '/';
    //     // else return $this->redirectTo;


    // }

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
