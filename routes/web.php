<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PublicProfileController;
use App\Http\Controllers\NewsPostController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\Admin\FaqCategoryController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\FollowController;

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\EventController as AdminEventController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\FaqController as AdminFaqController;


/*
| Public Routes (No Login Required)
*/
Route::get('/', function () { return view('dashboard'); })->name('home');

Route::get('/shops', [ShopController::class, 'index'])->name('shops.index');
Route::get('/shop/{slug}', [ShopController::class, 'show'])->name('shop.show');

Route::get('/users/{user:username}', [PublicProfileController::class, 'show'])->name('users.show');

Route::get('/faq', [FaqController::class, 'index'])->name('faq.index');

Route::get('/contact', [ContactController::class, 'show'])->name('contact.show');
Route::post('/contact', [ContactController::class, 'send'])->name('contact.send');

// Public events listing
Route::get('/events', [EventController::class, 'index'])->name('events.index');
Route::get('/events/{event}', [EventController::class, 'show'])->name('events.show');

/*-
| Cart Routes (Guests & Auth Users)
*/
Route::prefix('cart')->group(function () {
    Route::get('/', [CartController::class, 'index'])->name('cart.index');
    Route::post('/add/{product}', [CartController::class, 'add'])->name('cart.add');
    Route::patch('/{id}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/{id}', [CartController::class, 'remove'])->name('cart.remove');
});

/*
| Authenticated Routes (Login Required)
*/
Route::middleware('auth')->group(function () {

    // User profile management
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //public profile management
    Route::get('/profile/edit', [PublicProfileController::class, 'edit'])->name('profile.edit.public');
    Route::patch('/profile/update', [PublicProfileController::class, 'update'])->name('profile.update.public'); 

    // Follow/unfollow users
    Route::post('/follow/{user}', [FollowController::class, 'toggle'])->name('follow.toggle');
});

/*
| Seller Routes
*/
Route::middleware(['auth', \App\Http\Middleware\SellerMiddleware::class])->group(function() {

    // Shop management
    Route::get('/shop/create', [ShopController::class, 'create'])->name('shop.create');
    Route::post('/shop', [ShopController::class, 'store'])->name('shop.store');
    Route::get('/shop/{slug}/edit', [ShopController::class, 'edit'])->name('shop.edit');
    Route::patch('/shop/{slug}', [ShopController::class, 'update'])->name('shop.update');

    // Product management
    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('/products', [ProductController::class, 'store'])->name('products.store');
    Route::get('/my-products', [ProductController::class, 'editIndex'])->name('products.my');
    Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::patch('/products/{product}', [ProductController::class, 'update'])->name('products.update');
});

/*
| Resource Routes (Auth Protected)
*/
Route::middleware('auth')->group(function () {
    Route::resource('news-posts', NewsPostController::class);
    Route::resource('products', ProductController::class);
});

/*
| Admin Routes
*/
Route::prefix('admin')->middleware(['auth',\App\Http\Middleware\IsAdmin::class])->name('admin.')->group(function(){
    Route::resource('events', AdminEventController::class);
    Route::resource('userManagement', AdminUserController::class);
    Route::resource('faq-categories', FaqCategoryController::class);
    Route::resource('faqs', AdminFaqController::class);
    
    Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::get('/userManagement', [AdminUserController::class, 'index'])->name('userManagement.index');
    Route::patch('/userManagement/update', [AdminUserController::class, 'update'])->name('userManagement.update');
    Route::delete('userManagement/delete', [AdminUserController::class, 'destroy'])->name('userManagement.delete');
    

    // tijdelijke placeholder routes
        Route::get('/faq', fn() => 'FAQ Management coming soon')->name('faq.index');
        Route::get('/events', fn() => redirect()->route('admin.events.index'))->name('events.index');
});


require __DIR__.'/auth.php';
