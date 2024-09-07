<?php

namespace App\Http\Controllers\Business;

use App\Http\Controllers\Controller;
use App\Models\Business;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ServicesController extends Controller
{
    public function index()
    {
        $b=Business::where('user_id', Auth::id())->first();
        if(!$b)
        return response()->json(['error' => ' not found']); 
        $service=Service::where('business_id' , $b->id)->paginate(10);
        return response()->json($service);

    }

    public function store (Request $request)
    {
        $v=Validator::make($request->all() , ['name' => 'string|between:2,100' , 'price' => 'required']);
        if ($v->fails())
        return response()->json($v->errors()->first() , 400);
    $b=Business::where('user_id' ,Auth()->id)->first();
        $service=new Service(['name' => $request->name , 'description' => $request->description , 'price' => $request->price , 'business_id' => $b->id]);
        $service->save();
        return response()->json(['message' =>'service added' ],200);

    }
    public function destroy($id)
    {
        $s=Service::findOrFail($id);
        $s->delete();
        return response()->json(['message' => 'success delete']);

    }
}
