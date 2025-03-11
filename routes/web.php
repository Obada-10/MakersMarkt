<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

// Zorg ervoor dat ingelogde gebruikers niet naar de login- en registratiepagina kunnen gaan
Route::middleware(['guest'])->group(function () {
    Route::get('register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('register', [AuthController::class, 'register']);
    
    Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('login', [AuthController::class, 'login']);
});

// Route voor uitloggen
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

// Beveiligde route voor het dashboard
Route::get('dashboard', function () {
    return view('dashboards.dashboard'); // Zorg ervoor dat je een dashboardpagina hebt
})->middleware('auth'); // Alleen toegankelijk voor ingelogde gebruikers

