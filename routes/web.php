<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
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

Route::resource('products', ProductController::class);

Route::prefix('reports')->middleware('auth')->controller(ReportController::class)->group(function()
{
    Route::post('/{product}', 'store')->name('reports.store');
    Route::get('/', 'index')->name('reports.index'); 
    Route::post('/{product}/approve', 'approve')->name('reports.approve'); 
    Route::post('/{product}/delete', 'delete')->name('reports.delete');
});

require __DIR__.'/auth.php';
