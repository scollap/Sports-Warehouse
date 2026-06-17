<?php

use App\Http\Controllers\EventController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\ItemController as AdminItemController;
use App\Http\Controllers\QuestionController;
use Illuminate\Support\Facades\Route;
use App\Models\Category;
use App\Models\Item;

Route::get('/', [EventController::class, 'index'])
    ->name('home');

Route::get('/category/{id}', [EventController::class, 'show'])
    ->name('category.show');

Route::get('/product/{id}', [EventController::class, 'item'])
    ->name('product.show');

Route::get('/search', [EventController::class, 'search'])
    ->name('search');

Route::get('/question', [QuestionController::class, 'index'])
    ->name('contact.index');

Route::post('/question', [QuestionController::class, 'submit'])
    ->name('contact.submit');

// Route to display all products
Route::get('/products', [EventController::class, 'products'])
    ->name('products.index');

// Cart routes
Route::prefix('cart')->group(function () {
    Route::get('/', [EventController::class, 'showCart'])->name('cart.index');
    Route::post('/add/{id}', [EventController::class, 'addToCart'])->name('cart.add');
    Route::post('/remove/{id}', [EventController::class, 'removeFromCart'])->name('cart.remove');
});

// Legacy saved route alias
Route::get('/products/saved', [EventController::class, 'showCart'])->name('cart.index');

// Checkout routes
Route::get('/checkout', [EventController::class, 'showCheckout'])->name('items.checkout_form');
Route::post('/checkout', [EventController::class, 'processCheckout'])->name('items.checkout');
Route::get('/checkout/confirmation/{id}', [EventController::class, 'orderConfirmation'])->name('checkout.confirmation');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

/*
    Admin routes
*/
// Resource group that defines all of the CRUD actions/endpoints
Route::resource('admin/categories', AdminCategoryController::class)
    ->middleware('auth')
    ->names("admin.categories");

Route::resource('admin/items', AdminItemController::class)
    ->middleware('auth')
    ->names("admin.items");
