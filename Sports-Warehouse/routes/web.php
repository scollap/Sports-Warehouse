<?php
use App\Http\Controllers\EventController;
use Illuminate\Support\Facades\Route;


Route::get('/', [EventController::class, 'index'])->name('home');



Route::get('/category/{id}', [EventController::class, 'show'])->name('category.show');

Route::get('/search', [EventController::class, 'search'])->name('search');

use App\Http\Controllers\QuestionController;

Route::get('/question', [QuestionController::class, 'index'])
    ->name('register.index');

Route::post('/question', [QuestionController::class, 'submit'])
    ->name('register.submit');

