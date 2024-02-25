<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\TermRequest;
use App\Http\Requests\TermUpdateRequest;
use App\Http\Resources\TermResource;
use App\Models\Term;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TermController extends Controller
{
    public function index(){
        $user_id=Auth::user()->id;
        $term=Term::Select("*")->where("user_id",$user_id)->orderby("id","ASC")->get();
        if($term ->count() > 0){
            return response()->json([
                'status'=>200,
                //'terms'=> $term
                'terms'=>TermResource::collection($term)
            ],200);
        }else{
            return response()->json([
                'status'=>200,
                'message'=> 'No Term Found',
                'terms'=>TermResource::collection($term)
            ],200);
        }
    }
    public function store(TermRequest $Request){
            $user_id=Auth::user()->id;
            $term=Term::create([
                'name'=> $Request->name,
                'start'=> $Request->start,
                'end'=> $Request->end,
                'user_id'=> $user_id,
            ]);
            if($term){
            return response()->json([
                'status'=>200,
                'message'=>"Term Created Successfully"
            ],200); 
        }else{
            return response()->json([
                'status'=>404,
                'message'=>"something went woring"
            ],404);
            }
        }
        public function update(TermUpdateRequest $Request , int $term){
            $user_id=Auth::user()->id;
            $ter=Term::where('id',$term)->where("user_id",$user_id)->first();    
          if($ter){
            $ter->update([
                'name'=> $Request->name,
                'start'=> $Request->start,
                'end'=> $Request->end,
            ]);
             return response()->json([
                  'status'=>200,
                  'message'=>"Term Updated Successfully"
              ],200); 
          }else{
             return response()->json([
             'status'=>422,
             'message'=>"No Such Term Found !"
              ],404);
          }
        }
        public function show($term){
            $user_id=Auth::user()->id;
            $ter=Term::select('*')->where('id',$term)->where('user_id',$user_id)->first();
            if($ter){
             return response()->json([
                 'status'=>200,
                 //'term'=>$ter
                 'term'=>TermResource::make($ter)

            ],200);
            }else{
             return response()->json([
                 'status'=>404,
                 'message'=>"No Such Term Found!"
             ],404);
         }
        }
        public function destroy($term){
            $user_id=Auth::user()->id;
            $ter=Term::where('id',$term)->where('user_id',$user_id)->first();
            if($ter){
                $ter->delete();
             return response()->json([
                 'status'=>200,
                 'message'=>"Term Deleted Successfully"
            ],200);
            }else{
             return response()->json([
                 'status'=>404,
                 'message'=>"No Such Term Found!"
             ],404);
         }
     } 
    public function search(Request $request)
   {
     $user_id=Auth::user()->id;
     $keyword = $request->input('keyword');
         $term = Term::select('id','name','start','end')
         ->where('user_id', $user_id)
         ->where(function ($query) use ($keyword) {
             $query->where('name', 'LIKE', '%' . $keyword . '%')
                ->orWhere('start', 'LIKE', '%' . $keyword . '%')
                ->orWhere('end', 'LIKE', '%' . $keyword . '%');
          })->get();
     return response()->json(
         [
             'status'=>200,
             'term'=>$term
        ],200
     );
 }
}
