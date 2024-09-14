<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\SocialMediaController;
use App\Jobs\EchoOutput;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

Route::get('login/{provider}', [SocialMediaController::class, 'redirectToProvider']);
Route::get('login/{provider}/callback', [SocialMediaController::class, 'handleProviderCallback']);

Route::get('test', fn () => response()->json(['message' => 'hello world']));

Route::get('queue', function () {
    EchoOutput::dispatch(Carbon::now());

    return response()->json(['message' => 'Job dispatched']);
});
