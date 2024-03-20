<?php

use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

auth()->loginUsingId(1);

Route::get('/', function () {
    return view('welcome');
});

Route::get('/permissions-admin', PermissionController::class)->name('permission-admin')->middleware(['auth', 'can:admin']);
Route::get('/permissions-default', function() {
    return 'You are not an admin';
})->name('permission-default')->middleware(['auth', 'can:default']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
