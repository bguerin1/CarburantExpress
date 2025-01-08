<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StationController;


Route::get('/',[StationController::class,'home'])->name('home');
Route::get('/map',[StationController::class,'map'])->name('map');
Route::get('/filter',[StationController::class,'filter'])->name('filter');
Route::get('/sort',[StationController::class,'sort'])->name('sort');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
