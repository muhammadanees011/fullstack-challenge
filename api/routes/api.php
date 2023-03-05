<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\WeatherController;

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

// Route::get('/', function () {
//     return response()->json([
//         'message' => 'all systems are a go',
//         'users' => \App\Models\User::with('Weather')->all(),
//     ]);
// });

Route::get('/',[UserController::class,'usersList']);
Route::post('/store/{userid}',[WeatherController::class,'store']);
Route::post('/update/{userid}',[WeatherController::class,'update']);