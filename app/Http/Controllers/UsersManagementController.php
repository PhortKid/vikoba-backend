<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\user;
use Illuminate\Support\Facades\Validator;
class UsersManagementController extends Controller
{
    //
    public function index(){
       $users=\App\Models\User::all();
      return response()->json($users);
    }

    public function store(Request $request){
    $validator=Validator::make($request->all(),[
        'name'=>'required',
        'email'=>'required'
    ]);

    if($validator->fails()){
        return response()->json($validator->errors(),422);
    }


     /*User::create([
        "name"=>$request->name,
        "email"=>$request->email,
        "password"=>"Mpya@2026"
        ]);*/


        return response()->json(["status"=>true,"message"=>"data insterted success"],200);
      
    }

    public function fetch(Request $request){
       $user=User::findOrFail($request->user_id);

       return $user;
    }

    public function update(Request $request){
       $user=User::findOrFail($request->user_id);
       $validator=Validator::make($request->all(),[
        'name'=>'required',
        'email'=>'required',
        'phone_number'=>'required'
       ]);

       if($validator->fails()){
        return response()->json($validator->errors(),422);
       }

       $user->name=$request->name;
       $user->email=$request->email;
       $user->phone_number=$request->phone_number;
       $user->save();

       return response()->json(["status"=>true,"message"=>"data updated success"],200);
    }

    public function delete(Request $request){
       $user=User::findOrFail($request->user_id);
       $user->delete();
       return response()->json(["status"=>true,"message"=>"mtumiaji amefutwa"],200);
    }

}
