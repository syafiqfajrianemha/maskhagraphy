<?php

use App\Http\Controllers\BerandaController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\RoleCheck;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// })->name('welcome');
Route::redirect('/', '/beranda', 301);

Route::get('/beranda', [BerandaController::class, 'index'])->name('beranda.index');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified', RoleCheck::class.':admin'])->name('dashboard');

Route::middleware(['auth', RoleCheck::class.':admin'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
