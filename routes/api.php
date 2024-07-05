<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RiderController;
use App\Http\Controllers\ClubController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/riders/{rider}', [RiderController::class, 'getRiderInfo']);
Route::get('/clubs/{club}', [ClubController::class, 'getClubInfo']);
