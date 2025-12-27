<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
//Controllers
use App\Http\Controllers\NewsPostController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\PublicProfileController;

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

// Publiek profiel
Route::get('/users/{user:username}', [PublicProfileController::class, 'show'])->name('users.show');

// Eigen profiel aanpassen (auth nodig)
Route::middleware('auth')->group(function () {
    Route::get('/profile/edit', [PublicProfileController::class, 'edit'])->name('profile.edit.public');
    Route::patch('/profile/update', [PublicProfileController::class, 'update'])->name('profile.update.public');
});


Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('events/create', [EventController::class, 'create'])->name('events.createEvent');
    Route::post('events', [EventController::class, 'store'])->name('events.store');
});

Route::middleware(['auth', \App\Http\Middleware\SellerMiddleware::class])->group(function () {
    Route::get('/shop/create', [ShopController::class, 'create'])->name('shop.create');
    Route::post('/shop', [ShopController::class, 'store'])->name('shop.store');
    Route::get('/shop/{slug}/edit', [ShopController::class, 'edit'])->name('shop.edit');
    Route::patch('/shop/{slug}', [ShopController::class, 'update'])->name('shop.update');
});

// Dynamische shop pagina per seller
Route::get('/shop/{slug}', [ShopController::class, 'show'])->name('shop.show');

// Alle shops overzicht
Route::get('/shops', [ShopController::class, 'index'])->name('shops.index');

//producten
Route::middleware(['auth', \App\Http\Middleware\SellerMiddleware::class])->group(function () {
    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('/products', [ProductController::class, 'store'])->name('products.store');
    Route::get('/my-products', [App\Http\Controllers\ProductController::class, 'editIndex'])->name('products.my');
    Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::patch('/products/{product}', [ProductController::class, 'update'])->name('products.update');
});

//winkelcar
Route::middleware('auth')->group(function () {
    Route::post('/cart/add/{product}', [CartController::class, 'add'])->name('cart.add');
    
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
  
    Route::patch('/cart/{id}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/{id}', [CartController::class, 'remove'])->name('cart.remove');
});

Route::middleware('auth')->group(function () {
    Route::post('/follow/{user}', [FollowController::class, 'toggle'])->name('follow.toggle');
});




Route::resource('news-posts', NewsPostController::class)->middleware('auth');
Route::resource('events', EventController::class)->middleware('auth');
Route::resource('products', ProductController::class)->middleware('auth');

require __DIR__.'/auth.php';
