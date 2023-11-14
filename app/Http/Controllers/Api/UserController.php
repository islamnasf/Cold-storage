<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    public function show(){
        $user_id=Auth::user()->id;
        $user=User::select('name','phone','active',)->where('id',$user_id)->first();    
      if($user){
         return response()->json([
              'status'=>200,
              'user'=>$user
          ],200); 
      }else{
         return response()->json([
         'status'=>404,
         'message'=>"No Such Data Found !"
          ],404);
      }
    }
    public function active(){
        $user_id=Auth::user()->id;
        $user=User::select('name','phone','active',)->where('id', '!=', $user_id)->get();    
      if($user ){
         return response()->json([
              'status'=>200,
              'user'=>$user
          ],200); 
      }else{
         return response()->json([
         'status'=>404,
         'message'=>"No Such Data Found !"
          ],404);
      }
    }
    
    public function toggleActivation($userId)
    {
        try {
            $user = User::findOrFail($userId);

            $user->update(['active' => !$user->active]);

            return response()->json(['message' => 'User activation status toggled successfully', 'user' => $user]);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Unable to toggle user activation status', 'error' => $e->getMessage()], 500);
        }
    }

}

