<?php

namespace App\Http\Controllers;

use App\Models\Business;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ReviewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $result = Review::paginate(10);
        return response()->json($result);
    }

    public function business_review($id)
    {
        $r=Review::where('business_id' , $id)->paginate(10);
        return response()->json($r);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $v=Validator::make($request->all() , ['business_id' => 'required' ,  'reviews' =>'required' , 'stars' => 'required']);
        if($v->fails())
        return response()->json($v->errors()->first());

        if(! Auth()->id())
        return response()->json(['message' => 'unautharized']);
        $r=Review::create(array_merge($v->validated(), ['user_id' => Auth::id() ]));
        return response()->json(['message'  => 'created successfuly'] , 201);



    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $r= Review::findOrFail($id);
        return response()->json($r);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $r= Review::findOrFail($id);
        $r->delete();
        return response()->json(['message' => 'deleted succesfuly']);

    }
}
