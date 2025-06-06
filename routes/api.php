<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Gender;
use App\Models\Book;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\GenderController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\UserController;


Route::controller(AuthorController::class)->group(function () {
    Route::get('/authors', 'get');
    Route::get('/authors/{id}', 'details');
    Route::post('/authors', 'store');
    Route::patch('/authors/{id}', 'update');
    Route::delete('/authors/{id}', 'delete');

    Route::get('/authors/books/{id}', 'findBooks');
    Route::get('/authors/books', 'getWithBook');
    
});


Route::controller(BookController::class)->group(function () {
    Route::get('/books', 'get');
    Route::get('/books/{id}', 'details');
    Route::post('/books', 'store');
    Route::patch('/books/{id}', 'update');
    Route::delete('/books/{id}', 'delete');

    Route::get('/books/reviews/{id}', 'findReview'); 
    Route::get('/books/info', 'getWithAllInfo'); 
});


Route::controller(GenderController::class)->group(function () {
    Route::get('/genders', 'get');
    Route::get('/genders/{id}', 'details');
    Route::post('/genders', 'store');
    Route::patch('/genders/{id}', 'update');
    Route::delete('/genders/{id}', 'delete');

    Route::get('/genders/books/{id}', 'findBooks');
    Route::get('/genders/books', 'getWithBook');
});


Route::controller(ReviewController::class)->group(function () {
    Route::get('/reviews', 'get');
    Route::get('/reviews/{id}', 'details');
    Route::post('/reviews', 'store');
    Route::patch('/reviews/{id}', 'update');
    Route::delete('/reviews/{id}', 'delete');
});


Route::controller(UserController::class)->group(function () {
    Route::get('/users', 'get');
    Route::get('/users/{id}', 'details');
    Route::post('/users', 'store');
    Route::patch('/users/{id}', 'update');
    Route::delete('/users/{id}', 'delete');
});