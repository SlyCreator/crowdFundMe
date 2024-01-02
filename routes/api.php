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
        Route::group(['prefix'=>'donation'],function (){
            //    POST /api/donations/{id}/donate: Make a donation to a specific request.
            //    GET /api/donations/{id}/donors: Get a list of donors for a specific donation request.
            //    PUT /api/donations/{id}/complete: Mark a donation request as complete
        });
    });
    Route::post('auth/logout',[AuthController::class,'logout']);

    /** Auth User */
    Route::group(['prefix'=>'users'],function (){
        Route::get('',[UserController::class,'fetchAuthUser']);
        Route::patch('',[UserController::class,'updateAuthUser']);
    });
    Route::group(['prefix'=>'donations'],function (){
        Route::post('',[DonationController::class,'store']);
        Route::get('',[DonationController::class,'index']);
        Route::get('',[DonationController::class,'show']);
        Route::patch('',[DonationController::class,'update']);
        Route::delete('',[DonationController::class,'destroy']);
    });
});


