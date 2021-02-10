<?php

namespace App\Http\Controllers;
use App\sim;
use App\reload;
use App\rd;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if(Auth::user()->admin == 0 & Auth::user()->status == 1) {
            $rd=rd::where('user_id',Auth::user()->id)->first();
            $reload=reload::where('user_id',Auth::user()->id)->first();
            $sim=sim::where('user_id',Auth::user()->id)->first();
            $balancedate = date('t') - date('j');
         
            return view('home')->with(['rd' => $rd,'reload'=>$reload,'sim'=>$sim,'balancedate'=>$balancedate]);
        }
        elseif(Auth::user()->admin == 0 & Auth::user()->status == 0){
            Auth::logout();
            return view('verify');
        }
        else {
            return redirect('/admin-panel');
        }
    }
}
