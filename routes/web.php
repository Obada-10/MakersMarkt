<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ReportController;
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

Route::prefix('admin')->name('admin.')->group(function () {
    // Huidige admin routes
    Route::get('/users', [AdminController::class, 'index'])->name('users.index');
    Route::get('/users/{user}', [AdminController::class, 'show'])->name('users.show');
    Route::delete('/users/{user}', [AdminController::class, 'destroy'])->name('users.destroy');

    // Nieuwe routes voor bewerken en updaten van gebruikers
    Route::get('/users/{user}/edit', [AdminController::class, 'edit'])->name('users.edit');
    Route::put('/users/{user}', [AdminController::class, 'update'])->name('users.update');
});


Route::prefix('reports')->middleware('auth')->controller(ReportController::class)->group(function()
{
    Route::post('/{product}', 'store')->name('reports.store');
    Route::get('/', 'index')->name('reports.index'); 
    Route::post('/{product}/approve', 'approve')->name('reports.approve'); 
    Route::post('/{product}/delete', 'delete')->name('reports.delete');
});

require __DIR__.'/auth.php';
