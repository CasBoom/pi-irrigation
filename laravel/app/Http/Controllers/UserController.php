<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\User;

class UserController extends Controller
{
    // log user in, if succesful send user to dashboard
    public function login(Request $request)
    {
        $request->session()->flush();
        if($this->check($request)){
            return redirect('/');
        }else{
            return redirect('/login');
        }
    }

    public function logout(Request $request){
        $request->session()->flush();
        return redirect('/login');
    }

    public function check(Request $request)
    {
        if(Auth::id()){
            return true;
        }
        if (Auth::attempt($request->only('name', 'password'))) {
            $request->session()->regenerate();
            return true;
        }
        else
        {
            session()->flash('error', 'Invalid Credentials');
            return false;
        }
    }

    public function resetPassword(Request $request)
    {
        // check if login credentials are valid
        $validation = ['success'=>0, 'errors'=>'Invalid credentials'];
        if(Auth::attempt($request->only('name', 'password'))){
            $validation = $this->validatePassword($request->new_password,$request->confirm);
            if($validation['success']){
                // select an user where the ID and username is equal to the one given
                $user = Auth::user();
                if($user==null){
                    // if wrong, log user out
                    $request->session()->flush();
                    return redirect('login');
                }
                // if successful write new password to the user and save
                User::where('id', Auth::id())->update(['password' => Hash::make($request->new_password)]);
                return redirect('/');
            }
        }else{
            $validation['error']="invalid credentials";
        }
        return redirect("profile?error=".$validation['error']);

    }

    public function validatePassword($password, $conf){
        $success = 1;
        $error = '';
        if(strlen($password)<6){
            $success = 0;
            $error = "Password must be at least 6 characters long";
        }
        else if(!preg_match('/[0-9]/', $password)){
            $success = 0;
            $error = "Password must contain a number";
        }
        else if($conf != $password){
            $success = 0;
            $error = "Your passwords don't match";
        }
        return ['success'=>$success, 'error'=>$error];
    }
}
