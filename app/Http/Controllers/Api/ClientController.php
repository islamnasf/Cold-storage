<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\clientResource;
use App\Models\Amber;
use App\Models\Client;
use App\Models\Fridge;
use App\Models\PriceList;
use App\Models\Term;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class ClientController extends Controller
{
    public function index(){
        $user_id=Auth::user()->id;
        $client=Client::Select("*")->where('user_id',$user_id)->orderby("name","ASC")->get();
        if($client ->count() > 0){
            return response()->json([
                'status'=>200,
                //'client'=> $client
                'client'=>clientResource::collection($client),
            ],200);
        }else{
            return response()->json([
                'status'=>404,
                'message'=> 'No Client Found'
            ],404);
        }
    }
    public function store(Request $Request ,int $amber,int $fridge,int $term ,int $price){
        $amber_id=Amber::with('clients')->where('id',$amber)->first();   
        $fridge_id=Fridge::with('clients')->where('id',$fridge)->first();   
        $term_id=Term::with('clients')->where('id',$term)->first();   
        $price_id=PriceList::with('clients')->where('id',$price)->first();   
        $user_id=Auth::user()->id;
        $client=Client::create([
                'name'=> $Request->name, 
                'phone'=> $Request->phone, 
                'address'=> $Request->address, 
                'vegetable_name'=> $price_id->vegetable_name, 
                'amber'=> $amber_id->name, 
                'fridge'=> $fridge_id->name, 
                'price_all'=> $Request->price_all, 
                'location'=> $Request->location,  
                'ton'=> $Request->ton,         
                'small_shakara'=> $Request->small_shakara,
                'big_shakara'=> $Request->big_shakara,
                'price_list_id'=> $price_id->id, 
                'avrage'=> $Request->avrage,  
                'shakayir'=> $Request->shakayir,
                'price_one'=> $Request->price_one,
                'fridge_id'=> $fridge_id->id, 
                'amber_id'=> $amber_id->id, 
                'term_id'=> $term_id->id, 
                'user_id'=> $user_id,    
            ]);
            $collect=Client::where('id',$client->id)->first(); 
            //payment method
            $ton_count=$collect->ton;
            $small_count=$collect->small_shakara;
            $big_count=$collect->big_shakara;
            //Other payment method
            $avg=$collect->avrage;
            $num=$collect->shakayir;
            $one=$collect->price_one;
            if ($Request->price_all === null ) {
            if( $ton_count > 0 || $small_count > 0|| $big_count > 0 ){
                $client->update([
                    'price_all'=> $ton_count * $price_id->ton + $small_count * $price_id->small_shakara +$big_count * $price_id->big_shakara  ,
                ]);
            }
            elseif( $ton_count === null && $small_count === null && $big_count === null && $avg > 0 && $num > 0 && $one > 0){
                $client->update([
                    'price_all'=> $avg * $num * $one ,
                ]);
            }
            else{
                return response()->json([
                    'status'=>404,
                    'message'=>"The price is a must"
                ],404);
                }
            }
            if($client){
            return response()->json([
                'status'=>200,
                'message'=>"Client Created Successfully",
                //'client'=>$client,
                'client'=>ClientResource::make($client)
            ],200); 
        }else{
            return response()->json([
                'status'=>404,
                'message'=>"something went woring"
            ],404);
            }
        }
      public function update(Request $Request , int $client ,int $amber,int $fridge,int $term ,int $price){
             $user_id=Auth::user()->id;
             $clients=Client::where('id',$client)->where('user_id',$user_id)->first();
             $amber_id=Amber::with('clients')->where('id',$amber)->first();   
             $fridge_id=Fridge::with('clients')->where('id',$fridge)->first();   
             $term_id=Term::with('clients')->where('id',$term)->first();   
             $price_id=PriceList::with('clients')->where('id',$price)->first();   
             $clients->update([
                'name'=> $Request->name, 
                'phone'=> $Request->phone, 
                'address'=> $Request->address, 
                'vegetable_name'=> $price_id->vegetable_name, 
                'amber'=> $amber_id->name, 
                'fridge'=> $fridge_id->name, 
                'price_all'=> $Request->price_all, 
                'location'=> $Request->location,  
                'ton'=> $Request->ton,         
                'small_shakara'=> $Request->small_shakara,
                'big_shakara'=> $Request->big_shakara,
                'price_list_id'=> $price_id->id, 
                'avrage'=> $Request->avrage,  
                'shakayir'=> $Request->shakayir,
                'price_one'=> $Request->price_one,
                'fridge_id'=> $fridge_id->id, 
                'amber_id'=> $amber_id->id, 
                'term_id'=> $term_id->id, 
                'user_id'=> $user_id,    
             ]);
             $collect=Client::where('id',$clients->id)->first(); 
            //payment method
            $ton_count=$collect->ton;
            $small_count=$collect->small_shakara;
            $big_count=$collect->big_shakara;
            //Other payment method
            $avg=$collect->avrage;
            $num=$collect->shakayir;
            $one=$collect->price_one;
            if ($Request->price_all === null ) {
            if( $ton_count > 0 || $small_count > 0|| $big_count > 0 ){
                $clients->update([
                    'price_all'=> $ton_count * $price_id->ton + $small_count * $price_id->small_shakara +$big_count * $price_id->big_shakara  ,
                ]);
            }
            elseif( $ton_count === null && $small_count === null && $big_count === null && $avg > 0 && $num > 0 && $one > 0){
                $clients->update([
                    'price_all'=> $avg * $num * $one ,
                ]);
            }
            else{
                return response()->json([
                    'status'=>404,
                    'message'=>"The price is a must"
                ],404);
                }
        }
        if($client){
              return response()->json([
                   'status'=>200,
                   'message'=>"Client Updated Successfully",
                   //'client'=>$client,
                    'client'=>ClientResource::make($client)
               ],200); 
           }else{
             return response()->json([
              'status'=>404,
              'message'=>"No Such Client Found !"
               ],404);
           }
        }
        public function show($client){
            $clients=Client::select('*')->where('id',$client)->first();
             if($clients){
              return response()->json([
                  'status'=>200,
                  //'client'=>$clients
                  'client'=>ClientResource::make($clients)
                 ],200);
                 }else{
              return response()->json([
                  'status'=>404,
                  'message'=>"No Such client Found!"
              ],404);
          }
         }
         public function destroy($client){
             $clients=Client::where('id',$client)->first();
             if($clients){
                $clients->delete();
              return response()->json([
                  'status'=>200,
                  'message'=>"Client Deleted Successfully"
             ],200);
             }else{
              return response()->json([
                  'status'=>404,
                  'message'=>"No Such client Found!"
              ],404);
          }
      } 
      public function search(Request $request)
    {
        $user_id=Auth::user()->id;
        $query = $request->input('query');
        $results = Client::where('user_id',$user_id)
                       ->where('name', 'LIKE', '%' . $query . '%')
                       ->orWhere('phone', 'LIKE', '%' . $query . '%')
                       ->orWhere('address', 'LIKE', '%' . $query . '%')
                       ->orWhere('vegetable_name', 'LIKE', '%' . $query . '%')
                       ->orWhere('amber', 'LIKE', '%' . $query . '%')
                       ->orWhere('price_all', 'LIKE', '%' . $query . '%')
                       ->orWhere('fridge', 'LIKE', '%' . $query . '%')
                       ->get();
        return response()->json(
            [
                'status'=>200,
                'results'=>$results
           ],200
        );
    }
//Add New Term For Client 
public function newterm(Request $Request ,int $client,int $amber,int $fridge ,int $price){
    $user_id=Auth::user()->id;
    $client_id=Client::where('id',$client)->where('user_id',$user_id)->first();
    $amber_id=Amber::with('clients')->where('id',$amber)->first();   
    $fridge_id=Fridge::with('clients')->where('id',$fridge)->first();   
    $price_id=PriceList::with('clients')->where('id',$price)->first();   
    $term=Term::create([
        'name'=> $Request->name,
        'start'=> $Request->start,
        'end'=> $Request->end,
        'user_id'=> $user_id,
    ]);
    if($term){
    $client=Client::create([
            'name'=> $client_id->name, 
            'phone'=> $client_id->phone, 
            'address'=> $client_id->address, 
            'vegetable_name'=> $price_id->vegetable_name, 
            'amber'=> $amber_id->name, 
            'fridge'=> $fridge_id->name, 
            'price_all'=> $Request->price_all,  //
            'location'=> $client_id->location,  
            'ton'=> $Request->ton,             //
            'small_shakara'=> $Request->small_shakara,  //
            'big_shakara'=> $Request->big_shakara,   //
            'price_list_id'=> $price_id->id,     
            'avrage'=> $Request->avrage,    //
            'shakayir'=> $Request->shakayir,  //
            'price_one'=> $Request->price_one,  //
            'fridge_id'=> $fridge_id->id,  
            'amber_id'=> $amber_id->id, 
            'term_id'=> $term->id, 
            'user_id'=> $user_id,    
        ]);
        }else{
        return response()->json([
            'status'=>404,
            'message'=>"something went woring"
        ],404);
        }
        $collect=Client::where('id',$client->id)->first(); 
        //payment method
        $ton_count=$collect->ton;
        $small_count=$collect->small_shakara;
        $big_count=$collect->big_shakara;
        //Other payment method
        $avg=$collect->avrage;
        $num=$collect->shakayir;
        $one=$collect->price_one;
        if ($Request->price_all === null ) {
        if( $ton_count > 0 || $small_count > 0|| $big_count > 0 ){
            $client->update([
                'price_all'=> $ton_count * $price_id->ton + $small_count * $price_id->small_shakara +$big_count * $price_id->big_shakara  ,
            ]);
        }
        elseif( $ton_count === null && $small_count === null && $big_count === null && $avg > 0 && $num > 0 && $one > 0){
            $client->update([
                'price_all'=> $avg * $num * $one ,
            ]);
        }
        else{
            return response()->json([
                'status'=>404,
                'message'=>"The price is a must"
            ],404);
            }
        }
        if($client){
        return response()->json([
            'status'=>200,
            'message'=>"Client Created Successfully",
            //'client'=>$client,
            'client'=>ClientResource::make($client)
        ],200); 
    }else{
        return response()->json([
            'status'=>404,
            'message'=>"something went woring"
        ],404);
        }
    }

}