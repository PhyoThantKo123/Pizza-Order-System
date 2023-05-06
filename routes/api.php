<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\RouteController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});



Route::get('apiTesting',function(){

    $data = [
        'message' => 'this is api testing message'
    ];

    return response()->json($data,200);

});


// Read
Route::get('data/list',[RouteController::class,'list']);
Route::get('pizza/list',[RouteController::class,'product']);


// create
Route::post('category/create',[RouteController::class,'cc']);
Route::post('contact/create',[RouteController::class,'cc1']);


// delete
// Route::post('category/delete',[RouteController::class,'cd']);
Route::get('category/delete/{id}',[RouteController::class,'cd']);


// update
Route::get('category/details/{id}',[RouteController::class,'c_details']);
Route::post('category/update',[RouteController::class,'c_update']);
