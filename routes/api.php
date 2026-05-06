<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UsersManagementController;
use App\Http\Controllers\MoviesController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\GuarantorController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\LoanProductController;
use App\Http\Controllers\LoanProductFeeController;
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
Route::get('/customers/{id}', [CustomerController::class, 'view']);
Route::post('/customers', [CustomerController::class, 'save']);
Route::put('/customers/{id}', [CustomerController::class, 'update']);
Route::delete('/customers/{id}', [CustomerController::class, 'delete']);

//guarantors
Route::get('/guarantors', [GuarantorController::class, 'index']);
Route::get('/view_guarantor/{id}', [GuarantorController::class, 'view']);
Route::post('/add_guarantor', [GuarantorController::class, 'save']);
Route::post('/update_guarantor/{id}', [GuarantorController::class, 'update']);
Route::post('/delete_guarantor/{id}', [GuarantorController::class, 'delete']);




Route::middleware('auth:sanctum')->group(function () {
   Route::get('/user', [AuthController::class, 'user']);
   Route::post('/logout', [AuthController::class, 'logout']);
});







/*
|--------------------------------------------------------------------------
| Company (Single Settings - NO LIST)
|--------------------------------------------------------------------------
*/
Route::get('/company-info', [CompanyController::class, 'show']);
Route::put('/company-info', [CompanyController::class, 'update']);

/*
|--------------------------------------------------------------------------
| Branches (CRUD API)
|--------------------------------------------------------------------------
*/
Route::get('/branches', [BranchController::class, 'index']);
Route::post('/save-branch', [BranchController::class, 'store']);
Route::get('/fetch-branch/{id}', [BranchController::class, 'show']);
Route::post('/update-branch/{id}', [BranchController::class, 'update']);
Route::post('/delete-branch/{id}', [BranchController::class, 'destroy']);

/*
|--------------------------------------------------------------------------
| Loan Products (CRUD API)
|--------------------------------------------------------------------------
*/
Route::middleware('auth:sanctum')->group(function () {
Route::get('/loan-products', [LoanProductController::class, 'index']);
Route::post('/save-loan-product', [LoanProductController::class, 'store']);
Route::get('/fetch-loan-product/{id}', [LoanProductController::class, 'show']);
Route::put('/update-loan-product/{id}', [LoanProductController::class, 'update']);
Route::delete('/delete-loan-product/{id}', [LoanProductController::class, 'destroy']);
});

/*
|--------------------------------------------------------------------------
| Loan Product Fees (CRUD API)
|--------------------------------------------------------------------------
*/
Route::get('/loan-product-fees', [LoanProductFeeController::class, 'index']);
Route::post('/loan-product-fees', [LoanProductFeeController::class, 'store']);
Route::get('/loan-product-fees/{id}', [LoanProductFeeController::class, 'show']);
Route::put('/loan-product-fees/{id}', [LoanProductFeeController::class, 'update']);
Route::delete('/loan-product-fees/{id}', [LoanProductFeeController::class, 'destroy']);


