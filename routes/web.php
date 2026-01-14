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

require __DIR__.'/auth.php';


Route::resource('kategorijes', App\Http\Controllers\KategorijeController::class);

Route::resource('proizvodis', App\Http\Controllers\ProizvodiController::class);

Route::resource('kupcis', App\Http\Controllers\KupciController::class);

Route::resource('porudzbines', App\Http\Controllers\PorudzbineController::class);

Route::resource('stavke_porudzbines', App\Http\Controllers\Stavke_porudzbineController::class);
