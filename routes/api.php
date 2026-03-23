<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UsersManagementController;
/*
Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});*/




Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

//users management
Route::middleware('auth:sanctum')->group(function () {
Route::post('/users', [UsersManagementController::class, 'index']);
Route::post('/save-user', [UsersManagementController::class, 'store']);
Route::post('/fetch-user', [UsersManagementController::class, 'fetch']);
Route::post('/update-user', [UsersManagementController::class, 'update']);
Route::post('/delete-user', [UsersManagementController::class, 'delete']);
});


Route::middleware('auth:sanctum')->group(function () {
   Route::get('/user', [AuthController::class, 'user']);
    Route::post('/logout', [AuthController::class, 'logout']);


    Route::post('/test',function(Request $request){

 

 return response()->json(
 
  
    [
        'user'  =>
         [
           [
            'name'=>'john'

         ],
         [
            'name'=>'juma'

         ],

         ]
           
        
    ]
  
);


});



});



//include auth.php for authentication routes
//require __DIR__.'/auth.php';