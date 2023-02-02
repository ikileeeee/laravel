<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RegionController;
use App\Http\Controllers\PrognozaController;
use App\Http\Controllers\UserPrognozaController;
use App\Http\Controllers\RegionPrognozaController;
use App\Http\Controllers\API\AuthController;

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

Route::post('/register',[AuthController::class, 'register']);
Route::post('/login',[AuthController::class, 'login']);
Route::get('users',[UserController::class,'index']);
Route::get('user/{id}',[UserController::class,'show']);
Route::get('regioni',[RegionController::class,'index']);
Route::get('region/{id}',[RegionController::class,'show']);
Route::get('prognoze',[PrognozaController::class,'index']);
Route::get('prognoza/{id}',[PrognozaController::class,'show']);
Route::get('/user/{id}/prognoze', [UserPrognozaController::class,'index'])->name('users.prognoze.index');

Route::get('/region/{id}/prognoze', [RegionPrognozaController::class,'index'])->name('regioni.prognoze.index');

Route::group(['middleware'=>['auth:sanctum']],function(){
    Route::get('/profile',function(Request $request){
        return auth()->user();
    });
    Route::resource('prog', PrognozaController::class)->only(['update','store','destroy']);
    Route::post('/logout',[AuthController::class, 'logout']);
});
