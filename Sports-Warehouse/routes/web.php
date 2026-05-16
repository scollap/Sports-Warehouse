<?php
use App\Http\Controllers\EventController;
use Illuminate\Support\Facades\Route;


Route::get('/', [EventController::class, 'index']);



Route::get('/product/{id}', [EventController::class, 'show']);


use App\Http\Controllers\QuestionController;

Route::get('/question', [QuestionController::class, 'index'])
    ->name('register.index');

Route::post('/question', [QuestionController::class, 'submit'])
    ->name('register.submit');