<?php

use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
//create Author
Route::post('authors', [AuthorController::class, 'store']);
//get authors
Route::get('authors', [AuthorController::class, 'index']);
//create Book
Route::post('books', [BookController::class, 'store']);
//get books
Route::get('books', [BookController::class, 'index']);
//get patronymic author
Route::get('books/search/{surname}', [BookController::class, 'searchByAuthor']);
//get book at id
Route::get('books/{id}', [BookController::class, 'show']);
//update book
Route::put('books/update/{id}', [BookController::class, 'update']);

