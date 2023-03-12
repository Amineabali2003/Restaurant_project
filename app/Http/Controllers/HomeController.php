<?php

namespace App\Http\Controllers;

use App\Models\food;
use App\Models\chef;
use App\Models\Reserve;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    //

    public function index(){

        $food=food::all()->where('status','=','1');
        $chef=chef::all();

        return view('home')->with(["allfood"=>$food,"allchef"=>$chef]);
    }


    // public function Admin(){

    //     return view('Admin');
    // }

    // public function checkAuth(){
    //     $userType=Auth::user()->usertype;
    //     if($userType=='1'){
    //        return view('AdminDashboard.AdminPanel');
    //     }
    //     else{
    //     //   return view('UserDashboard.UserPanel');
    //         return redirect("/");
    //     }

    //     }
 public function dashboard(){
    // return view('AdminDashboard.AdminPanel');
    return redirect('Dashboard/users');
        }

    // public function redirect(){

    //     $userType=Auth::user()->usertype;
    //     if($userType=='1'){
    //        return redirect("/Admin");
    //     }
    //     else{
    //         return redirect("/");
    //     }


    //   //  return view('Admin');

    // }

    public function Reserve(Request $request){
        $date=date('d-m-Y', strtotime($request->date));
        // dd($date);
        $reserve=new Reserve;
        $reserve->name=$request->name;
        $reserve->email=$request->email;
        $reserve->phone=$request->phone;
        $reserve->number_guests=$request->number_guests;
        $reserve->date=$date;
        $reserve->time=$request->time;
        $reserve->message;
        $reserve->save();

            return response()->json(['success'=>'Reserved successfully']);
    }


}
