<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $reqest)
    {
        $validator= Validator::make($reqest->all(),['name' => 'required | string | between:2,100','email' => 
        'required|string|unique:users' , 'password => required |string |min:6]']);
        if($validator->fails())
        return response()->json($validator->errors()->first(),400);

        $user=User::create(array_merge($validator->validated(),['password' => bcrypt($reqest->password) ]));
        return response()->json(['message' => 'created successfuly' , 'user' => $user],201);

    }

    public function login(Request $reqest)
    {
        $validator = Validator::make($reqest->all() , ['email' => 'required' , 'password' =>'required | min:6' ]);
        
        if($validator->fails())
        return response()->json($validator->errors()->first(),400);
        if (! $token = auth()->attempt($validator->validated()))
            return response()->json(['error' => 'Unauthorized'], 401);

            $user=User::where('email',$reqest->email)->first();
            return $user->createToken('auth-token')->plainTextToken;

    }
    
}
