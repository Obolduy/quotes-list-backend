<?php

use App\Http\Controllers\{AddQuoteController, ShowQuotesController, ShowTagsController};
use Illuminate\Support\Facades\Route;


Route::post('/add-quote', [AddQuoteController::class, 'add']);
Route::post('/check-author', [AddQuoteController::class, 'checkAuthor']);
Route::get('/show-quotes', [ShowQuotesController::class, 'showQuotes']);
Route::get('/show-quote/{id}', [ShowQuotesController::class, 'showQuote']);
Route::get('/get-tags', [ShowTagsController::class, 'getTags']);