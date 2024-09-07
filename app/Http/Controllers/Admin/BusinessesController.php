<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Business;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BusinessesController extends Controller
{
    public function index()
    {
        $businesses = Business::all();
        return view('businesses' , compact('businesses'));
    }
    public function create()
    {
        return view('create_business');
    }
    public function edit($id)
    {
        $b=Business::findOrFail($id);
        return view('edit_business' , compact('b'));

    }
    public function show($id)
    {
        $businesses = Business::findOrFail($id);
        return response()->json($businesses);
    }
    public function store (Request $request)
    {
        $v=Validator::make($request->all() , ['name' => 'required' ,  'user_id' =>'required' , 'opening_hours' => 'required']);
        if($v->fails())
        return response()->json($v->errors()->first());
   // return $v->validated();
    Business::create(array_merge($v->validated()));
    return redirect()->back();
    //return response()->json(['message' => 'success'], 200);

    }
    public function update(Request $request , $id)
    {
        $b=Business::finOrFail($id);
        $v=Validator::make($request->all() , ['name' => 'required' ,
          'user_id' =>'required'
           , 'status' => 'required' , 'opening_hours' => 'required']);
        if($v->fails())
        return response()->json($v->errors()->first());
    $b->update(array_merge($v->validated()));
    return response()->json(['message' => 'success update'], 200);

    }

    public function destroy($id)
    {
        $b=Business::findOrFail($id);
        $b->delete();
        return response()->json(['message' => 'deleted'],200);

    }
}
