<?php
use App\Http\Controllers\EventController;
use Illuminate\Support\Facades\Route;


Route::get('/', [EventController::class, 'index']);


// get /produst/3
Route::get('/product/{id}', [EventController::class, 'show']);