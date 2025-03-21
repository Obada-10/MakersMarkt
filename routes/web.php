<?php

use App\Http\Controllers\ReviewController;

use App\Http\Controllers\ProductController;

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::prefix('dashboard')
    ->middleware(['auth'])
    ->group(function() {
        // Profiel routes
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
        // Wachtwoord wijzigen routes
        Route::patch('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password.update');
        
        // Product routes
        Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
        Route::post('/products', [ProductController::class, 'store'])->name('products.store');
        Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
        Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update');
        Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');

        // Admin routes voor gebruikersbeheer
        Route::get('/admin/users', [AdminController::class, 'index'])->name('admin.users.index');
        Route::get('/admin/users/{user}', [AdminController::class, 'show'])->name('admin.users.show');
        Route::delete('/admin/users/{user}', [AdminController::class, 'destroy'])->name('admin.users.destroy');
        
        // Routes voor het bewerken van een gebruiker
        Route::get('/admin/users/{user}/edit', [AdminController::class, 'edit'])->name('admin.users.edit');
        Route::put('/admin/users/{user}', [AdminController::class, 'update'])->name('admin.users.update');
    });


Route::get('/products', [ProductController::class, 'index'])->name('products.index'); // Openbaar
Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');
Route::get('/orders/basket', [ProductController::class, 'basket'])->name('orders.basket');

Route::get('/orders/basket', [OrderController::class, 'basket_content'])->name('orders.basket');
Route::post('/orders/basket', [OrderController::class, 'store'])->name('baskets.store');


Route::get('/orders/checkout', [OrderController::class, 'checkout'])->name('orders.checkout');
Route::get('/orders/checkout', [OrderController::class, 'showCheckout'])->name('orders.checkout');  // Voor het tonen van de afrekenpagina

Route::post('/orders/checkout', [OrderController::class, 'processCheckout'])->name('orders.processCheckout');  // Voor het verwerken van de bestelling

Route::get('/orders/bestelling', [OrderController::class, 'bestelling'])->name('orders.bestelling');
Route::patch('/orders/{order}/update-status', [OrderController::class, 'updateStatus'])->name('orders.updateStatus');


Route::prefix('reports')->middleware('auth')->controller(ReportController::class)->group(function()
{
    Route::post('/{product}', 'store')->name('reports.store');
    Route::get('/', 'index')->name('reports.index'); 
    Route::post('/{product}/approve', 'approve')->name('reports.approve'); 
    Route::post('/{product}/delete', 'delete')->name('reports.delete');
});



Route::middleware(['auth'])->group(function() {
    Route::post('/products/{product}/reviews', [ReviewController::class, 'store'])->name('reviews.store');
    Route::get('/reviews/{review}/edit', [ReviewController::class, 'edit'])->name('reviews.edit');
    Route::put('/reviews/{review}', [ReviewController::class, 'update'])->name('reviews.update');
    Route::delete('/reviews/{review}', [ReviewController::class, 'destroy'])->name('reviews.destroy');
});


require __DIR__.'/auth.php';
