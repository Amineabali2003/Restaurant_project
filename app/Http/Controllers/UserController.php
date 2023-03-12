<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\ConfirmedOrders;
use App\Models\FormOrder;

class UserController extends Controller
{
    //

    public function AddtoCart(request $request){
        $idUser=$request->idUser;
        $idPlat=$request->idPlat;

        //check if idplat & iduser existing
        $check =Cart::where([

            ["idUser", "=",$idUser],

            ["idPlat", "=",$idPlat]

        ]);
        if($check->exists()){
            return response()->json(['Msg'=>'Plat Already Exist']);
        }
        else{
            $cart=new Cart;
            $cart->idUser=$idUser;
            $cart->idPlat=$idPlat;
            $cart->Quantity=1;

            $cart->save();

            return response()->json(['Msg'=>'Plat Added to Cart Succesfully!']);
        }

        //else add idplat to iduser




    }

    public function ViewOrders(){

        $Orders=Auth::user()->FormOrder;


        return view('UserDashboard.Orders')->with('Orders',$Orders);
    }




    public function ViewCart(){

        // dd(Auth::user()->cart);

        $cart=Auth::user()->cart;
        return view("UserDashboard.Cart")->with('carts',$cart);
        //
    }

    public function UpdateQuantity(request $request){

        $idUser=$request->idUser;
        $Quantity = $request->Quantity;
        $idPlat=$request->idPlat;

        $cart=Cart::where([

            ["idUser", "=",$idUser],

            ["idPlat", "=",$idPlat]

        ])->first();
        $cart->Quantity = $Quantity;

        $cart->save();
        return response()->json(['Msg'=>'nice']);



    }


    public function DltPlatCart(request $request){

        $idUser=$request->idUser;
        $idPlat=$request->idPlat;

        $cart=Cart::where([

            ["idUser", "=",$idUser],

            ["idPlat", "=",$idPlat]

        ])->first();
        $cart->delete();

        return response()->json(['Msg'=>'nice']);



    }

    public function OrderNow(Request $request){

        $carts=Auth::user()->cart;
        if(count($carts)>0){
            $Form=new FormOrder;
            $Form->idUser=Auth::user()->id;
            $Form->Fullname=$request->Fullname;
            $Form->Phone=$request->Phone;
            $Form->Address=$request->Address;
            $Form->City=$request->City;
            $Form->Zip=$request->Zip;
            $Form->totalOrder=$request->totalOrder;
            $Form->save();

            $idForm=$Form->id;

            $carts=Auth::user()->cart;
            foreach($carts as $cart){
                $ConfirmedOrder=new ConfirmedOrders;
                $ConfirmedOrder->idPlat=$cart->idPlat;
                $ConfirmedOrder->Quantity=$cart->Quantity;
                $ConfirmedOrder->idForm=$idForm;
                $ConfirmedOrder->save();
                $cart->delete();
            }

        }



        return response()->json(['Msg'=>'aha']);
    }

}
