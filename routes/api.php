<?php

use App\Http\Controllers\Api\AmberController;
use App\Http\Controllers\Api\ClientController;
use App\Http\Controllers\Api\ExpenseController;
use App\Http\Controllers\Api\FridgeController;
use App\Http\Controllers\api\PricesController;
use App\Http\Controllers\Api\TermController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::group(['middleware'=>'api','prefix'=>'auth'],function($router){
    Route::post('/register',[AuthController::class,'register']);
    Route::post('/login',[AuthController::class,'login']);
    Route::put('/update',[AuthController::class,'update']);
    Route::get('/profile',[AuthController::class,'profile']);
    Route::post('/logout',[AuthController::class,'logout']);
});
//users
Route::group(['middleware'=>'auth:api'],function($router){
    Route::get('/user',[UserController::class,'show']); //yourdata
    Route::get('/users',[UserController::class,'active']);  // all user
    Route::put('/active_user/{id}',[UserController::class,'toggleActivation']);  
});
// fridge
Route::group(['middleware'=>'auth:api'],function($router){
    Route::get('/fridge',[FridgeController::class,'index']);
    Route::post('/fridge',[FridgeController::class,'store']);
    Route::put('/fridge/{id}/edit',[FridgeController::class,'update']);
    Route::get('/fridge/{id}/show',[FridgeController::class,'show']);
    Route::delete('/fridge/{id}/delete',[FridgeController::class,'destroy']);
});
//amber
Route::group(['middleware'=>'auth:api'],function($router){
    Route::get('/amber/{fridge}',[AmberController::class,'index']);
    Route::post('/amber/{fridge}',[AmberController::class,'store']);
    Route::put('/amber/{id}/edit',[AmberController::class,'update']);
    Route::get('/amber/{id}/show',[AmberController::class,'show']);
    Route::delete('/amber/{id}/delete',[AmberController::class,'destroy']);
});
//price
Route::group(['middleware'=>'auth:api'],function($router){
    Route::get('/price',[PricesController::class,'index']);
    Route::post('/price',[PricesController::class,'store']);
    Route::put('/price/{id}/edit',[PricesController::class,'update']);
    Route::get('/price/{id}/show',[PricesController::class,'show']);
    Route::delete('/price/{id}/delete',[PricesController::class,'destroy']);
});
//client
Route::group(['middleware'=>'auth:api'],function($router){
    Route::get('/client',[ClientController::class,'index']);
    Route::post('/client/{amber}/{fridge}/{price}/{term}',[ClientController::class,'store']);
    Route::put('/client/{id}/edit/{amber}/{fridge}/{price}/{term}',[ClientController::class,'update']);
    Route::get('/client/{id}/show',[ClientController::class,'show']);
    Route::delete('/client/{id}/delete',[ClientController::class,'destroy']);
    Route::post('/client/search',[ClientController::class,'search']);
    Route::post('/client/newterm/{client}/{amber}/{fridge}/{price}',[ClientController::class,'newterm']); //لتجديد الاشتراك مع مد الفترة 
    Route::post('/client/newterm/newprice/{amber}/{fridge}/{price}/{term}',[ClientController::class,'clientWithNewTermOrNewPrice']);
});
//expense
Route::group(['middleware'=>'auth:api'],function($router){
    Route::get('/expense',[ExpenseController::class,'index']);
    Route::post('/expense',[ExpenseController::class,'store']);
    Route::put('/expense/{id}/edit',[ExpenseController::class,'update']);
    Route::get('/expense/{id}/show',[ExpenseController::class,'show']);
    Route::delete('/expense/{id}/delete',[ExpenseController::class,'destroy']);
});
//term
Route::group(['middleware'=>'auth:api'],function($router){
    Route::get('/term',[TermController::class,'index']);
    Route::post('/term',[TermController::class,'store']);
    Route::put('/term/{id}/edit',[TermController::class,'update']);
    Route::get('/term/{id}/show',[TermController::class,'show']);
    Route::delete('/term/{id}/delete',[TermController::class,'destroy']);
});

