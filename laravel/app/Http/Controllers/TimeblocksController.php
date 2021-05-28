<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Timeblock;

class TimeblocksController extends Controller
{
    const MODEL = "App\Timeblocks";

    public function insert(Request $request){
        // var_dump($request);
        if(isset($request->day,$request->hour,$request->litre)){
            TimeBlock::insert(['day'=>$request->day,'time'=>$request->hour,'litre'=>$request->litre]);
        }
        return redirect('/');
    }

    public function remove(Request $request){
        if($request->id){
            Timeblock::find($request->id)->delete();
        };
        return redirect('/');
    }
}
