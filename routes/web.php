<?php

use App\Http\Controllers\EventController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\ItemController as AdminItemController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
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
    ->name('register.index');

Route::post('/question', [QuestionController::class, 'submit'])
    ->name('register.submit');

// Route to display all products
Route::get('/products', [EventController::class, 'products'])
    ->name('products.index');

// Cart routes
Route::prefix('cart')->group(function () {
    Route::get('/', [CartController::class, 'index'])->name('cart.index');
    Route::post('/add/{id}', [CartController::class, 'add'])->name('cart.add');
    Route::post('/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
});

// Legacy saved route alias
Route::get('/products/saved', [CartController::class, 'index'])->name('saved.show');

// Checkout routes
Route::get('/checkout', [CheckoutController::class, 'show'])->name('items.checkout_form');
Route::post('/checkout', [CheckoutController::class, 'store'])->name('items.checkout');

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
