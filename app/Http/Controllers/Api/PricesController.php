<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PriceRequest;
use App\Http\Requests\UpdatePriceRequest;
use App\Http\Resources\PriceResource;
use App\Models\Fridge;
use App\Models\PriceList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PricesController extends Controller
{
    public function index(){
        $user_id=Auth::user()->id;
        $price=PriceList::Select("*")->where("user_id",$user_id)->orderby("id","ASC")->get();
        if($price ->count() > 0){
            return response()->json([
                'status'=>200,
                //'pricers'=> $price
                'prices'=>PriceResource::collection($price)
            ],200);
        }else{
            return response()->json([
                'status'=>200,
                'message'=> 'No Fridge Found',
                'prices'=>PriceResource::collection($price)
            ],200);
        }
    }
    public function store(PriceRequest $Request){
        $userId=Auth::user()->id;
            $price=PriceList::create([
                'vegetable_name'=> $Request->vegetable_name,
                'ton'=> $Request->ton,
                'small_shakara'=> $Request->small_shakara,
                'big_shakara'=> $Request->big_shakara,
                'user_id'=> $userId,
            ]);
            if($price){
            return response()->json([
                'status'=>200,
                'message'=>"Price Created Successfully",
                'prices'=>PriceResource::make($price)
            ],200); 

        }else{
            return response()->json([
                'status'=>404,
                'message'=>"something went woring"
            ],404);
            }
        }
        public function update(UpdatePriceRequest $Request , int $price){
            $user_id=Auth::user()->id;
            $prices=PriceList::where('id',$price)->where("user_id",$user_id)->first();
            if($prices){
            $prices->update([
                'vegetable_name'=> $Request->vegetable_name,
                'ton'=> $Request->ton,
                'small_shakara'=> $Request->small_shakara,
                'big_shakara'=> $Request->big_shakara,
                'user_id'=> $user_id,
            ]);
             return response()->json([
                  'status'=>200,
                  'message'=>"Price Updated Successfully",
                  'prices'=>PriceResource::make($prices)

              ],200); 
          }else{
             return response()->json([
             'status'=>404,
             'message'=>"No Such Price Found !"
              ],404);
          }
        }
        public function show($price){
            $user_id=Auth::user()->id;
            $prices=PriceList::select('*')->where('id',$price)->where('user_id',$user_id)->first();
            if($prices){
             return response()->json([
                 'status'=>200,
                 'price'=>$prices,
                 'price'=>PriceResource::make($prices)
            ],200);
            }else{
             return response()->json([
                 'status'=>404,
                 'message'=>"No Such Price Found!"
             ],404);
         }
        }
        public function destroy($price){
            $user_id=Auth::user()->id;
            $prices=PriceList::where('id',$price)->where('user_id',$user_id)->first();
            if($prices){
                $prices->delete();
             return response()->json([
                 'status'=>200,
                 'message'=>"Price Deleted Successfully"
                 
            ],200);
            }else{
             return response()->json([
                 'status'=>404,
                 'message'=>"No Such Price Found!"
             ],404);
         }
     } 
}
