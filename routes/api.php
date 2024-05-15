<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\AdminAuthController;
// use App\Http\Controllers\Auth\LoginController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::post('v1/admin/login', [AdminAuthController::class, 'login']);

Auth::routes();
Route::post('user/login',[LoginController::class,'login']);
Route::post('user/register',[UserController::class,'store']);

    

Route::group(['prefix' => 'v1','middleware' => 'auth:sanctum'], function () {
    Route::middleware(['admin_auth'])->group(function() {
        Route::prefix('admin')->group(function(){
            Route::get('admin',[AdminController::class,'index']);
        });
    });
    Route::get('userlist',[UserController::class,'index']);
    // Route::gourp(['prefix'=>'admin','middleware' => 'auth:admin'],function() {
    //     Route::get('admin',[AdminController::class,'index']);
    // });

    // Route::group(['prefix'=>'user','middleware' => 'auth:user'],function(){
    //     Route::get('home', function() {
    //         return "This is user home";
    //     });
    //     Route::get('welcome', function() {
    //         return "Welcome";
    //     });
    //     Route::get('testing',[UserController::class,'index']);
    // });
    Route::middleware(['user_auth'])->group(function() {
        Route::prefix('user')->group(function(){
            Route::get('home', function() {
                return "This is user home";
            });

            // Route::get('welcome', function() {
            //     return "Welcome";
            // });
            Route::get('testing',[UserController::class,'index']);
        });

    });

});

// Route::group(['prefix' => 'v1/user','middleware' => 'auth:sanctum','user_auth'], function () {

//     Route::middleware(['user_auth'])->group(function() {
//         Route::prefix(['user'])->group(function(){

//         });
//     });
// });

