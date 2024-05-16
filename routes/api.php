<?php

use App\Http\Controllers\API\Frontend\AuthController;
use App\Http\Controllers\API\Frontend\Chat\OpenAIController;
use App\Http\Controllers\API\Frontend\RealEstate\RealEstateController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Admin API
Route::group(['prefix' => 'admin'], function (){
    //
});

// Frontend API
Route::group(['prefix' => 'frontend/'], function (){
    // Auth
    Route::post('login', [AuthController::class, 'login']);
    Route::post('register', [AuthController::class, 'register']);

    // Real estates
    Route::get('/real-estates', [RealEstateController::class, 'readAll']);

    // OpenAI
    Route::post('/chat', [OpenAIController::class, 'chat']);
});


