<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

use App\Http\Controllers\QuotePdfController;

Route::get('/quotes/{quote}/pdf', QuotePdfController::class)
    ->middleware('auth')
    ->name('quotes.pdf');

use App\Http\Controllers\ReceiptPdfController;

Route::get('/receipts/{receipt}/pdf', ReceiptPdfController::class)
    ->middleware('auth')
    ->name('receipts.pdf');
