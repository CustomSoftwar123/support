<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\server;
use App\Http\Controllers\ticketcontroller;
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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
// //     return $request->user();
// Route::get('/tickets',function(){
//     return Ticket:: all();
//     }) ;
// });
Route::middleware('auth:sanctum')->get('/user', function () {
    return $request->user();
});

Route::get('/tickets',[ticketcontroller::class,'show']);
Route::post('/tickets',[ticketcontroller::class,'store']);

Route::get('/ticketsattachments',[ticketcontroller::class,'getattachments']);
Route::post('/ticketsattachments',[ticketcontroller::class,'insertattachments']);

Route::get('/ticketsmessages',[ticketcontroller::class,'getmessages']);
Route::post('/ticketsmessages',[ticketcontroller::class,'insertmessages']);


Route::get('/ticketsall/{id}',[ticketcontroller::class,'getall']);

Route::post('/attached',[ticketcontroller::class,'saveimages']);

Route::post('/uploadimage',[ticketcontroller::class,'uploadimages']);

Route::post('/upload',[ticketcontroller::class,'upload']);

Route::middleware('auth:api')->post('AddWards', [server::class, 'AddWards']);





// Route::middleware('auth:api')->post('AddPatients', [server::class, 'AddPatients']);
// Route::middleware('auth:api')->post('AddClinics', [server::class, 'AddClinics']);
