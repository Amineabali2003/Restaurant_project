<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\chef;
use App\Models\food;
use App\Models\Cart;
use App\Models\ConfirmedOrders;
use App\Models\FormOrder;
use App\Models\Reserve;
use Illuminate\Http\Request;
use Nette\Utils\Json;

class AdminController extends Controller
{
    //USERS
    public function usersIndex(){

        $users=User::all();

        return view("AdminDashboard.Users")->with('users',$users);
    }
    public function usersSearch(request $request){

        $users = User::where("name","LIKE","%$request->search%")
        ->orWhere("email","LIKE","%$request->search%")
        ->get();
        $i=0;
        $code="";
        foreach ($users as $user){
        $code.=" <tr>
        <td>".$i++."</td>
        <td>$user->name </td>
        <td>$user->email </td>
         <td>";
        if ($user->usertype == 0){
            $code.= "<a data-id=$user->id id='dlt' class='btn btn-sm btn-danger'>Supprimer</a></td> </tr>";
            }else{
            $code.= " <button class='btn btn-sm btn-danger' disabled='disabled'>Supprimer</button></td> </tr>";
        }

                }


        // return view("AdminDashboard.Users")->with('users',$users);
        // return response()->json(['success'=> $code]);
        echo json_encode($code);
    }

    public function userDelete(Request $request){
        $user=User::find($request->id)->delete();



        return response()->json(['success'=>$request->id]);
    }

    //MENU
    public function platsIndex(request $request){

            $foods=food::all()->where("status",'=','1');





        return view("AdminDashboard.Plats")->with('food',$foods);
    }

    public function platsSearch(request $request){
        // $foods = food::Where("title","LIKE","%$request->search%")
        // ->orWhere("description","LIKE","%$request->search%")
        // ->orWhere("price","LIKE","%$request->search%")
        // ->orWhere("type","LIKE","%$request->search%")
        // ->get();

        $foods = food::where("status",'=','1')->where(function($q) use ($request) {
            // $q->where
            $q->Where("title","LIKE","%$request->search%")
            ->orWhere("description","LIKE","%$request->search%")
            ->orWhere("price","LIKE","%$request->search%")
            ->orWhere("type","LIKE","%$request->search%");


        })->get();







        return view("AdminDashboard.Plats")->with('food',$foods);


    }

    public function AddPlat(Request $request){
            // dd($request);
            // $test=$request->title;
            $food =new food;
            $food->title=$request->TitleADD;
            $food->description=$request->DescriptionADD;
            $food->type=$request->MenuType;
            $food->price=$request->PriceADD;


            $imageFile=$request->pictureADD;
            $imageName=time().'.'.$imageFile->extension();

            $request->pictureADD->move(public_path('images/menu'),$imageName);
            $food->image=$imageName;
            $food->save();
        return response()->json(['success'=>"Good"]);
    }

    public function DeletePlat(Request $request){
        // food::find($request->idPlat)->delete();
        $food=food::find($request->idPlat);
        $food->status=0;
        $food->save();

        $cart=Cart::all()->where(
             "idPlat", "=",$request->idPlat
             );
        // dd($cart);
        foreach($cart as $c){
            $c->delete();
        }
        // $cart->delete();

        return response()->json(['success'=>"nice"]);

    }


    public function UpdatePlat(Request $request){
        // dd($request);
        // $imageName=$request->replaceImg->getClientOriginalName();

        $food=food::find($request->idPlat);
        $food->title=$request->title;
        $food->description=$request->description;
        $food->type=$request->MenuType;

        $food->price=$request->price;

        if($request->hasFile('replaceImg')){

            $imageFile=$request->replaceImg;
        $imageName=time().'.'.$imageFile->extension();

        $imageFile->move(public_path('images/menu'),$imageName);
        $food->image=$imageName;

        }else{
            $imageName="";
        }


        $food->save();

        return response()->json(['success'=>$imageName]);

    }


    //chefs
    public function chefsIndex(request $request){
        if($request->search){
            $chef=chef::where("Name","LIKE","%$request->search%")
        ->orWhere("Job","LIKE","%$request->search%")
        ->get();
        }else{
            $chef=chef::all();
        }

        return view('AdminDashboard.Chefs')->with('chefs',$chef);
    }
    public function AddChef(Request $request){
        $chef=new chef();
        $chef->Name=$request->NameADD;
        $chef->Job=$request->JobADD;
        $chef->Fb=$request->FbADD;
        $chef->IG=$request->IGADD;

        $imageFile=$request->pictureADD;
        $imageName=time().'.'.$imageFile->extension();

        $request->pictureADD->move(public_path('images/chefs'),$imageName);

        $chef->Image=$imageName;

        $chef->save();

        return response()->json(['success'=>"Good"]);
    }
    public function DeleteChef(Request $request){
            $idChef=$request->idChef;
            chef::find($idChef)->delete();

            return response()->json(['success'=>"Good"]);

    }


    public function UpdateChef(Request $request){

        $chef=chef::find($request->idChef);
        $chef->Name=$request->Name;
        $chef->Job=$request->Job;
        $chef->Fb=$request->Fb;
        $chef->IG=$request->IG;

        if($request->hasFile('replaceImg')){

            $imageFile=$request->replaceImg;
        $imageName=time().'.'.$imageFile->extension();

        $imageFile->move(public_path('images/chefs'),$imageName);
        $chef->image=$imageName;

        }else{
            $imageName="";
        }


        $chef->save();

        return response()->json(['success'=>$imageName]);
    }



    //Reservation
    public function ReserveIndex(){

      $Reservations= Reserve::all()->sortByDesc('created_at');
        // dd($Reservations);
        return view('AdminDashboard.Reservation')->with('Reservations',$Reservations);
    }

    public function ReserveSearch(request $request){

        $Reserves = Reserve::where("name","LIKE","%$request->search%")
        ->orWhere("email","LIKE","%$request->search%")
        ->orWhere("phone","LIKE","%$request->search%")
        ->orWhere("number_guests","LIKE","%$request->search%")
        ->orWhere("time","LIKE","%$request->search%")
        ->orWhere("message","LIKE","%$request->search%")
        ->orWhere("date","LIKE","%$request->search%")
        ->orWhere("created_at","LIKE","%$request->search%")
        ->get();
        $i=0;
        $code="";
        foreach ($Reserves->sortByDesc('created_at') as $Reservation){
        $code.=" <tr>
        <td>".$i++."</td>


        <td>       $Reservation->created_at        </td>
        <td>       $Reservation->name        </td>

        <td>         $Reservation->email           </td>

        <td>   $Reservation->phone     </td>

        <td>        $Reservation->number_guests               </td>
        <td>        $Reservation->time               </td>
        <td>        $Reservation->date               </td>


        <td>

            <a data-id=$Reservation->id id='dlt' class='btn btn-sm btn-danger' >
                <svg xmlns='http://www.w3.org/2000/svg' width='20' height='20' fill='currentColor'
                    class='bi bi-trash' viewBox='0 0 16 16'>
                    <path
                        d='M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z' />
                    <path fill-rule='evenodd'
                        d='M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z' />
                </svg>
            </a>






        </td>



    </tr>";


                }


        // return view("AdminDashboard.Users")->with('users',$users);
        // return response()->json(['success'=> $code]);
        echo json_encode($code);
    }

    public function DeleteReserve(Request $request){
        $idReservation=$request->idReservation;
            Reserve::find($idReservation)->delete();
        return response()->json(['success'=>"aha"]);
    }


    //ViewOrders
    public function OrdersIndex(){

    //   $Users= User::all()->where('usertype','!=','1');
      $Orders= FormOrder::all();
        // dd($Reservations);
        return view('AdminDashboard.Orders')->with('Orders',$Orders);
    }

public function OrdersSearch(request $request){

    //   $Users= User::all()->where('usertype','!=','1');

    //   if($Orders1){
    //       $last=$Orders1;
    //     }
    // global $ama;


    $Order1= FormOrder::Where("Fullname","LIKE","%$request->search%")
    ->orWhere("Phone","LIKE","%$request->search%")
    ->orWhere("address","LIKE","%$request->search%")
    ->orWhere("city","LIKE","%$request->search%")
    ->orWhere("zip","LIKE","%$request->search%")
    ->orWhere("totalOrder","LIKE","%$request->search%")
    ->orWhere("created_at","LIKE","%$request->search%")
    ->get();


        $Order2= FormOrder::whereHas('items', function($item) use($request)  {

            $item->whereHas('food', function($food) use($request) {
                $food->where('title','Like',"%".$request->search."%")
                ->orWhere('price','Like',"%".$request->search."%");
            });
        })->get();

$Order3= FormOrder::whereHas('user', function($item) use($request)  {

            $item->where('name','Like',"%".$request->search."%");

        })->get();

        if($Order1->count() > 0){
            $Order=$Order1;
        }elseif($Order2->count() > 0){
            $Order=$Order2;
        }else{
            $Order=$Order3;
        }









        return view('AdminDashboard.Orders')->with('Orders',$Order);
    }




}
