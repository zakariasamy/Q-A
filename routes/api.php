<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AnswerController;
use App\Http\Controllers\QuestionController;

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

Route::prefix('questions')->group(function(){
    Route::get('', [QuestionController::class, 'all']);
    Route::post('create', [QuestionController::class, 'create']);
    Route::post('delete/{id}', [QuestionController::class, 'delete']);
    Route::post('rateup/{id}', [QuestionController::class, 'rateup']);
    Route::post('ratedown/{id}', [QuestionController::class, 'ratedown']);

    Route::prefix('answers')->group(function(){
        Route::get('{id}', [AnswerController::class, 'all']);
        Route::post('/create', [AnswerController::class, 'create']);
        Route::post('delete/{id}', [AnswerController::class, 'delete']);
        Route::post('rateup/{id}', [AnswerController::class, 'rateup']);
        Route::post('ratedown/{id}', [AnswerController::class, 'ratedown']);
    });
});
