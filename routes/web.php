<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\FilmController;
use App\Http\Controllers\Admin\PersonController;
use App\Http\Controllers\Admin\PlanetController;
use App\Http\Controllers\Admin\SpeciesController;




// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::resource('planets', PlanetController::class);
        Route::resource('species', SpeciesController::class);
        Route::resource('people', PersonController::class);
        Route::resource('films', FilmController::class);
    });


require __DIR__.'/auth.php';
