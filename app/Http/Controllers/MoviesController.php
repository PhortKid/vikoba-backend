<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;

class MoviesController extends Controller
{
    //
  public function  index(){
        $movies=Movie::all();
        return response()->json($movies);
        }

public function store(Request $request){
    
   Movie::create([
    'title'=>$request->title,
     'url'=>$request->url,
      'description'=>$request->description,
       'image'=>$request->image
   ]);

   return response()->json([
    'status'=>'success',
    'message'=>'Data inserted Sucessiful'
   ],201);
}



}
