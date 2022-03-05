<?php

use App\Http\Controllers\{AddQuoteController, ShowQuotesController};
use Illuminate\Support\Facades\Route;


Route::post('/add', [AddQuoteController::class, 'add']);
Route::get('/test', [ShowQuotesController::class, 'showQuotes']);