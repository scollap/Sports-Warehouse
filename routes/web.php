<?php
use App\Http\Controllers\EventController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use App\Models\Item;

Route::get('/', [EventController::class, 'index'])
    ->name('home');

Route::get('/category/{id}', [EventController::class, 'show'])
    ->name('category.show');

Route::get('/product/{id}', [EventController::class, 'item'])
    ->name('product.show');

Route::get('/search', [EventController::class, 'search'])
    ->name('search');

use App\Http\Controllers\QuestionController;

Route::get('/question', [QuestionController::class, 'index'])
    ->name('register.index');

Route::post('/question', [QuestionController::class, 'submit'])
    ->name('register.submit');

    //products.index to display all products using the product_category page
Route::get('/products', [EventController::class, 'products'])
    ->name('products.index');

//route to add to cart
Route::post('/cart/add/{id}', [EventController::class, 'save'])
     ->name('cart.add');

Route::get('/products/saved', [EventController::class, 'showSaved'])
    ->name('saved.show');

Route::post('/cart/remove/{id}', [EventController::class, 'deleteSaved'])
    ->name('cart.remove');

Route::get('/checkout', function () {
        $category = "Featured Products";
        $savedItemsIds = Session::get('saved_items', []);
        $items = Item::whereIn('itemId', $savedItemsIds)->get();
        return view('registration.checkout', [
            'items' => $items, 
            'category' => $category,
        ],);
    })->name('items.checkout_form');

Route::post('/checkout', [EventController::class, 'checkout'])
    ->name('items.checkout');