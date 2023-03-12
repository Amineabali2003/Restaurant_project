<?php

namespace App\Http\Responses;

use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;

class LoginResponse implements LoginResponseContract
{

    public function toResponse($request)
    {

        // below is the existing response
        // replace this with your own code
        // the user can be located with Auth facade
        $userType=Auth::user()->usertype;
        if($userType=='1'){
           return  redirect("/Dashboard");
        }
        else{
            return redirect("/");
        }

        // return $request->wantsJson()
        //             ? response()->json(['two_factor' => false])
        //             : redirect()->intended(config('fortify.home'));
    }

}
