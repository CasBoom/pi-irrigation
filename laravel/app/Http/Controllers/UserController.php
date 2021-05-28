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
        if($this->check($request)){
            return redirect('/');
        }else{
            return redirect('/login');
        }
    }

    public function logout(Request $request){
        Session::forget('key');
        return redirect('/login');
    }

    public function check(Request $request)
    {
        if($request->session()->get('id')){
            return true;
        }
        $credentials = $request->only('name', 'password');
        if (Auth::attempt($credentials)) {
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
        if($this->check($request)){
            $validation = $this->validatePassword($request->new_password);
            if($validation['success']){
                // select an user where the ID and username is equal to the one given
                $user = User::where(['id'=>$request->session()->get('id'),'username'=>$request->username])->first();
                if($user!=false){
                    // if wrong, log user out
                    $request->session()->flush();
                    echo view('login');
                }
                // if write new password to the user and save
                $user->password = Hash::make($request->new_password);
                $user->save();
            }
            // return to account and show whether succesful
            echo view('account', $validation);
        }else{
            echo view('login');
        }

    }

    public function validatePassword($password){
        $success = 1;
        $errors = [];
        if(count($password)<6){
            $success = 0;
            $errors[] = "Password must be at least 6 characters long";
        }
        if(preg_match('/[0-9]/', $password)){
            $success = 0;
            $errors[] = "Password must contain a letter";
        }
        return ['success'=>$success, 'errors'=>$errors];
    }
}
