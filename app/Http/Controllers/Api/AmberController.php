<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AmberRequest;
use App\Http\Requests\AmberUpdateRequest;
use App\Http\Resources\AmberResource;
use App\Models\Amber;
use App\Models\Fridge;
use Illuminate\Http\Request;

class AmberController extends Controller
{
    public function index($fridge){
        $amber=Amber::Select("*")->where("fridge_id",$fridge)->orderby("name","ASC")->get();
        if($amber ->count() > 0){
            return response()->json([
                'status'=>200,
                //'amber'=> $amber
                'amber'=>AmberResource::collection($amber)
            ],200);
        }else{
            return response()->json([
                'status'=>200,
                'message'=> 'No Fridge Found',
                'amber'=> $amber,
                'amber'=>AmberResource::collection($amber)
            ],200);
        }
    }
    //
    public function store(AmberRequest $Request,$fridge ){
         $frid=Fridge::where('id',$fridge)->first();   
            $amber=Amber::create([
                'name'=> $Request->name,
                'fridge_id'=> $fridge,
            ]);
            $count=Amber::where('fridge_id',$fridge)->count(); 
            if($amber ->count() > 0){  
                $frid->update([
                    'size'=> $count,
                ]);
            return response()->json([
                'status'=>200,
                'message'=>"amber Created Successfully"
            ],200); 
        }else{
            return response()->json([
                'status'=>404,
                'message'=>"something went woring"
            ],404);
            }
        }
        //
        public function update(AmberUpdateRequest $Request , int $amber ){
            $amb=Amber::where('id',$amber)->first();    
          if($amb){
            $amb->update([
                'name'=> $Request->name,
            ]);
             return response()->json([
                  'status'=>200,
                  'message'=>"Amber Updated Successfully",
                  'amber'=>$amb
            ],200); 
          }else{
             return response()->json([
             'status'=>422,
             'message'=>"No Such Amber Found !"
            ],404);
          }
        }
        public function show($amber){
            $amb=Amber::select("*")->where('id',$amber)->first();
            if($amb){
             return response()->json([
                 'status'=>200,
                 //'amber'=>$amber
                 'amber'=>AmberResource::make($amb)
            ],200);
            }else{
             return response()->json([
                 'status'=>404,
                 'message'=>"No Such Amber Found!"
             ],404);
         }
        }
        public function destroy($amber){
            $amb=Amber::where('id',$amber)->first();
            if($amb){
                $amb->delete();
             return response()->json([
                 'status'=>200,
                 'message'=>"Amber Deleted Successfully"
            ],200);
            }else{
             return response()->json([
                 'status'=>404,
                 'message'=>"No Such Amber Found!"
             ],404);
         }
     } 
}
