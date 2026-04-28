<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UsersManagementController;
use App\Http\Controllers\MoviesController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\GuarantorController;
/*
Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});*/



Route::get('/movies', [MoviesController::class, 'index']);
Route::post('/store_movies', [MoviesController::class, 'store']);

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

//users management
Route::middleware('auth:sanctum')->group(function () {

Route::post('/save-user', [UsersManagementController::class, 'store']);
Route::post('/fetch-user', [UsersManagementController::class, 'fetch']);
Route::post('/update-user', [UsersManagementController::class, 'update']);
Route::post('/delete-user', [UsersManagementController::class, 'delete']);
});
Route::post('/users', [UsersManagementController::class, 'index']);
Route::get('/users', [UsersManagementController::class, 'index']);


//customer management
Route::get('/customers', [CustomerController::class, 'index']);
Route::get('/view_customer/{id}', [CustomerController::class, 'view']);
Route::post('/add_customer', [CustomerController::class, 'save']);
Route::post('/update_customer/{id}', [CustomerController::class, 'update']);
Route::post('/delete_customer/{id}', [CustomerController::class, 'delete']);

//guarantors
Route::get('/guarantors', [GuarantorController::class, 'index']);
Route::get('/view_guarantor/{id}', [GuarantorController::class, 'view']);
Route::post('/add_guarantor', [GuarantorController::class, 'save']);
Route::post('/update_guarantor/{id}', [GuarantorController::class, 'update']);
Route::post('/delete_guarantor/{id}', [GuarantorController::class, 'delete']);

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