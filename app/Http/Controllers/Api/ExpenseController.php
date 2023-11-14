<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ExpenseRequest;
use App\Http\Requests\ExpenseUpdateRequest;
use App\Models\Expense;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ExpenseController extends Controller
{
    public function index(){
        $user_id=Auth::user()->id;
        $exp=Expense::select('id','amount','description',DB::raw("DATE_FORMAT(created_at, '%d/ %m/ 20%y') as date"))
        ->where('user_id',$user_id)->orderby("id","desc")->get();
        $sum = Expense::where('user_id',$user_id)->sum('amount');
        if($exp ->count() > 0){
            return response()->json([
                'status'=>200,
                'expense'=> $exp,
                'sum'=>$sum
            ],200);
        }else{
            return response()->json([
                'status'=>200,
                'message'=> 'No Expense Found',
                'expense'=> $exp
            ],200);
        }
    }
    public function store(ExpenseRequest $Request){
            $user_id=Auth::user()->id;
            $exp=Expense::create([
                'amount'=> $Request->amount,
                'description'=> $Request->description,
                'user_id'=> $user_id,
            ]);
            if($exp){
            return response()->json([
                'status'=>200,
                'message'=>"Expense Created Successfully",
            ],200); 
        }else{
            return response()->json([
                'status'=>404,
                'message'=>"something went woring"
            ],404);
            }
        }
        public function update(ExpenseUpdateRequest $Request , int $expense){
            $user_id=Auth::user()->id;
            $exp=Expense::select('*')->where('id',$expense)->where('user_id',$user_id)->first();    
          if($exp){
            $exp->update([
                'amount'=> $Request->amount,
                'description'=> $Request->description,
            ]);
             return response()->json([
                  'status'=>200,
                  'message'=>"Expense Updated Successfully"
              ],200); 
          }else{
             return response()->json([
             'status'=>404,
             'message'=>"No Such Expense Found !"
              ],404);
          }
        }
        public function show($expense){
            $user_id=Auth::user()->id;
            $exp=Expense::select('id','amount','description',DB::raw("DATE_FORMAT(created_at, '%d/ %m/ 20%y') as date"))
            ->where('id',$expense)->where('user_id',$user_id)->first();
            if($exp){
             return response()->json([
                 'status'=>200,
                 'expense'=>$exp
            ],200);
            }else{
             return response()->json([
                 'status'=>404,
                 'message'=>"No Such expense Found!"
           ],404);
         }
        }
        public function destroy($expense){
            $user_id=Auth::user()->id;
            $exp=Expense::where('id',$expense)->where('user_id',$user_id)->first();
            if($exp){
                $exp->delete();
             return response()->json([
                 'status'=>200,
                 'message'=>"Expense Deleted Successfully"
            ],200);
            }else{
             return response()->json([
                 'status'=>200,
                 'message'=>"No Such Expense Found!"
             ],200);
         }
     } 
}
