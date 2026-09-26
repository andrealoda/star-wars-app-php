<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth'])->prefix('admin')->name('admin')->group(function (){
    Route::resource('planets', Admin\PlanetController::class)->name('planets');
    Route::resource('species', Admin\SpeciesController::class)->name('species');
    Route::resource('people', Admin\PersonController::class)->name('persons');
    Route::resource('films', Admin\FilmController::class)->name('films');
});

require __DIR__.'/auth.php';
