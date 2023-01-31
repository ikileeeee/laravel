<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RegionController;
use App\Http\Controllers\PrognozaController;
use App\Http\Controllers\UserPrognozaController;
use App\Http\Controllers\RegionPrognozaController;

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

Route::get('users',[UserController::class,'index']);
Route::get('user/{id}',[UserController::class,'show']);
Route::get('regioni',[RegionController::class,'index']);
Route::get('region/{id}',[RegionController::class,'show']);
Route::get('prognoze',[PrognozaController::class,'index']);
Route::get('prognoza/{id}',[PrognozaController::class,'show']);
//Route::get('/user/{id}/prognoze', [UserPrognozaController::class,'index'])->name('users.prognoze.index');
Route::resource('users.prognoze', UserPrognozaController::class);
Route::get('/region/{id}/prognoze', [RegionPrognozaController::class,'index'])->name('regioni.prognoze.index');