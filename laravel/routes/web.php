<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TimeblocksController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('dashboard');
})->middleware('auth');

Route::get('/profile', function() {
    return view('profile');
})->middleware('auth');

Route::get('/login', ['as' => 'login','uses'=> function () {
    return view('login');
}]);

//functions
Route::get('/logout', 'UserController@logout');
Route::post('/login', 'UserController@login');
Route::post('/reset_password', 'UserController@resetPassword');
Route::post('/timeblock', 'TimeblocksController@insert');
Route::get('/delete_timeblock/{id}', 'TimeblocksController@remove');
