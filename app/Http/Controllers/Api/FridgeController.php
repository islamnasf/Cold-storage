<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Http\Requests\FridgeRequest;
use App\Http\Requests\UpdateFridgeRequest;
use App\Http\Resources\FridgeResource;
use App\Models\Fridge;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class FridgeController extends Controller
{
    public function index(){
        $user_id=Auth::user()->id;
        $fridge=Fridge::Select("*")->where("user_id",$user_id)->orderby("name","ASC")->get();
        if($fridge ->count() > 0){
            return response()->json([
                'status'=>200,
                //'fridge'=> $fridge
                'fridge'=>FridgeResource::collection($fridge)
            ],200);
        }else{
            return response()->json([
                'status'=>200,
                'message'=> 'No Fridge Found',
                'fridge'=>FridgeResource::collection($fridge)
            ],200);
        }
    }
    public function store(FridgeRequest $Request){
            $user_id=Auth::user()->id;
            $fridge=Fridge::create([
                'name'=> $Request->name,
                //'size'=> $Request->size,
                'user_id'=> $user_id,
            ]);
            if($fridge){
            return response()->json([
                'status'=>200,
                'message'=>"Fridge Created Successfully"
            ],200); 

        }else{
            return response()->json([
                'status'=>404,
                'message'=>"something went woring"
            ],404);
            }
        }
        public function update(UpdateFridgeRequest $Request , int $fridge){
            $user_id=Auth::user()->id;
            $frid=Fridge::where('id',$fridge)->where("user_id",$user_id)->first();    
          if($frid){
            $frid->update([
                'name'=> $Request->name,
                //'size'=> $Request->size,
                'user_id'=> $user_id,
            ]);
             return response()->json([
                  'status'=>200,
                  'message'=>"Fridge Updated Successfully"
              ],200); 
          }else{
             return response()->json([
             'status'=>422,
             'message'=>"No Such Found !"
              ],404);
          }
        }
        public function show($fridge){
            $user_id=Auth::user()->id;
            $frid=Fridge::select('*')->where('id',$fridge)->where('user_id',$user_id)->with('ambers')->first();
            if($frid){
             return response()->json([
                 'status'=>200,
                 //'fridge'=>$frid
                 'fridge'=>FridgeResource::make($frid)

            ],200);
            }else{
             return response()->json([
                 'status'=>404,
                 'message'=>"No Such fridge Found!"
             ],404);
         }
        }
        public function destroy($fridge){
            $user_id=Auth::user()->id;
            $frid=Fridge::where('id',$fridge)->where('user_id',$user_id)->first();
            if($frid){
                $frid->delete();
             return response()->json([
                 'status'=>200,
                 'message'=>"Fridge Deleted Successfully"
            ],200);
            }else{
             return response()->json([
                 'status'=>404,
                 'message'=>"No Such fridge Found!"
             ],404);
         }
     } 
}
