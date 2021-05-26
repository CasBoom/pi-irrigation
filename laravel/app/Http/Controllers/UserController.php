<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    public function index()
    {
        return view('login');
    }

    public static function check(Request $request)
    {
        $user = $request->user;
        $pass = $request->password;
        $login = User::where(['name'=>$user,'pass'=>$pass])->first();
        if(!empty($login))
        {
            $request->session()->put(['id' => $login->id]);
            return view('dashboard');
        }
        else
        {
            session()->flash('error', 'Invalid Credentials');
            return redirect()->route('login');
        }
    }
}
