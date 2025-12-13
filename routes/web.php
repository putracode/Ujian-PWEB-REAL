<?php

use App\Http\Controllers\BukuController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('layout');
});

Route::get('/buku/list', [BukuController::class, 'card']);
Route::resource('buku',BukuController::class);