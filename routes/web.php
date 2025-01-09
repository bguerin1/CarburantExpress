<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StationController;

// Accueil 
Route::get('/',[StationController::class,'home'])->name('home');

// Route de filtrage 
Route::get('/filter',[StationController::class,'filter'])->name('filter');

// Route de tri
Route::get('/sort',[StationController::class,'sort'])->name('sort');

// Route pour la géolocalisation
Route::get('/geocaliser',[StationController::class, 'geolocaliser'])->name('geolocaliser');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
