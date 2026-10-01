<?php

use App\Http\Controllers\Api\ApiFilmController;
use App\Http\Controllers\Api\ApiPersonController;
use App\Http\Controllers\Api\ApiSpeciesController;
use App\Http\Controllers\Api\ApiPlanetController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('films', [ApiFilmController::class, 'index']);
Route::get('films/{id}', [ApiFilmController::class, 'show']);

Route::get('people', [ApiPersonController::class, 'index']);
Route::get('people/{id}', [ApiPersonController::class, 'show']);

Route::get('species', [ApiSpeciesController::class, 'index']);
Route::get('species/{id}', [ApiSpeciesController::class, 'show']);

Route::get('planets', [ApiPlanetController::class, 'index']);
Route::get('planets/{id}', [ApiPlanetController::class, 'show']);