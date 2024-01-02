<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DonationController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware(['auth:api',])->group(function () {
    Route::withoutMiddleware('auth:api')
        ->group(function (){
        Route::group(['prefix'=>'auth'],function (){
            Route::post('/register',[AuthController::class,'registerUser']);
            Route::post('/login',[AuthController::class,'login']);
        });
        Route::group(['prefix'=>'guests'],function (){
            Route::get('donations/{slug}',[DonationController::class,'guestFetchOne']);
            Route::post('donations/{slug}',[DonationController::class,'donate']);
        });
    });
    Route::post('auth/logout',[AuthController::class,'logout']);

    /** Auth User */
    Route::group(['prefix'=>'users'],function (){
        Route::get('',[UserController::class,'fetchAuthUser']);
        Route::patch('',[UserController::class,'updateAuthUser']);
    });
    Route::group(['prefix'=>'donations'],function (){
        Route::get('',[DonationController::class,'index']);
        Route::post('',[DonationController::class,'store']);
        Route::group(['prefix'=>'{id}'],function (){
            Route::get('',[DonationController::class,'show']);
            Route::patch('',[DonationController::class,'update']);
            Route::patch('/mark-closed',[DonationController::class,'updateStatus']);
            Route::delete('',[DonationController::class,'destroy']);
        });
    });
});


