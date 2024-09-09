<?php

use App\Models\User;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;

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
Route::get('/login' , function(){
    return view ('login');
});

Route::get('not', function () {
    //return User::find(2)->businesses()->get();
    return User::with('businesses')->get();
    return response()->json(['message' => 'jehad']);
    return response()->json(['message' => 'this is master']);
    return response()->json(['message' => 'fuck']);
    return response()->json(['message' => 'this is feature']);
});

