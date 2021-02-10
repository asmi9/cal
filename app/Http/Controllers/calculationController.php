<?php

namespace App\Http\Controllers;
use App\sim;
use App\reload;
use App\rd;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\Auth;
class calculationController extends Controller
{
    public function index(Request $request){
        

        $validator = Validator::make($request->all(), [
            'target' => 'required',
            'achievements' => 'required',
            'days' => 'required',
        ]);


         if ($validator->passes()) {
            $target=$request->target;
            $days=$request->days;
            $achievements=$request->achievements;
            $percentage = number_format($achievements/$target*100,2);
            $balance=$target-$achievements;
            $daytarget=$balance/$days;
            $create_dt = date("Y-m-d H:i:s A");




            $values = [
                'target'=> $target,
                'user_id'=> Auth::user()->id,
                'achivement'=>$achievements,
                'days'=> $days,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ];
            rd::updateOrCreate([
                'user_id' => Auth::user()->id,
            ], $values);
            $data=["percentage"=>$percentage,"balance"=>$balance,"daytarget" => $daytarget];
            return response()->json(['data' => $data]);
        }


        return response()->json(['error' => $validator->errors()->all()]);
    
    
    }
     public function reload(Request $request){


        $validator = Validator::make($request->all(), [
            'target' => 'required',
            'achievements' => 'required',
            'days' => 'required',
        ]);


        if ($validator->passes()) {
            $target=$request->target;
            $days=$request->days;
            $achievements=$request->achievements;
            $percentage = number_format($achievements/$target*100,2);
            $balance=$target-$achievements;
            $daytarget=$balance/$days;
            $values = [
                'target'=> $target,
                'user_id'=> Auth::user()->id,
                'achivement'=>$achievements,
                'days'=> $days,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ];
            reload::updateOrCreate([
                'user_id' => Auth::user()->id,
            ], $values);
            $data=["percentage"=>$percentage,"balance"=>$balance,"daytarget" => $daytarget];
            return response()->json(['data' => $data]);
        }


        return response()->json(['error' => $validator->errors()->all()]);
    
    }
     public function sim(Request $request){
        $validator = Validator::make($request->all(), [
            'target' => 'required',
            'achievements' => 'required',
            'days' => 'required',
        ]);


        if ($validator->passes()) {
            $target=$request->target;
            $days=$request->days;
            $achievements=$request->achievements;
            $percentage = number_format($achievements/$target*100,2);
            $balance=$target-$achievements;
            $daytarget=$balance/$days;
             $values = [
                'target'=> $target,
                'user_id'=> Auth::user()->id,
                'achivement'=>$achievements,
                'days'=> $days,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ];
            sim::updateOrCreate([
                'user_id' => Auth::user()->id,
            ], $values);
            
            $data=["percentage"=>$percentage,"balance"=>$balance,"daytarget" => $daytarget];
            return response()->json(['data' => $data]);
        }


        return response()->json(['error' => $validator->errors()->all()]);
       
    
    }
}
