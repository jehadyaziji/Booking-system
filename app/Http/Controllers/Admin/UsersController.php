<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UsersController extends Controller
{
    public function index()
    {
        $users= User::all();
        return view('users' , compact($users));
        //return response()->json($users);

    }

    public function create()
    {
        return view('create_user');

    }
    public function store (Request $request)
    {
        $v=Validator::make($request->all() , ['name' => 'required' ,  'role' =>'required' , 'email' => 'required' , 'password' => 'required']);
        if($v->fails())
        return response()->json($v->errors()->first());
    User::create(array_merge($v->validated() , ['password' => bcrypt($request->password)]));
    return redirect()->back();

    //return response()->json(['message' => 'success'], 200);

    }
    public function destory($id)
    {
        $user=User::finOrFail($id);
        $user->delete();
        return redirect()->back();
        //return response()->json(['message' => 'success delete'], 200);
    }



}
