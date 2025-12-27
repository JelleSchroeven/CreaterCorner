<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
//Controllers
use App\Http\Controllers\NewsPostController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ShopController;

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

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('events/create', [EventController::class, 'create'])->name('events.createEvent');
    Route::post('events', [EventController::class, 'store'])->name('events.store');
});

Route::middleware(['auth', \App\Http\Middleware\SellerMiddleware::class])->group(function () {
    Route::get('/shop/create', [ShopController::class, 'create'])->name('shop.create');
    Route::post('/shop', [ShopController::class, 'store'])->name('shop.store');
    Route::get('/shop/{shop}/edit', [ShopController::class, 'edit'])->name('shop.edit');
    Route::patch('/shop/{shop}', [ShopController::class, 'update'])->name('shop.update');
});

// Dynamische shop pagina per seller
Route::get('/shop/{shop}', [ShopController::class, 'show'])->name('seller.shop');


Route::resource('news-posts', NewsPostController::class)->middleware('auth');
Route::resource('events', EventController::class)->middleware('auth');
Route::resource('products', ProductController::class)->middleware('auth');

require __DIR__.'/auth.php';
