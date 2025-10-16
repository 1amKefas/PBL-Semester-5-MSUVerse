<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('register');
});

// Tambahkan route ini
Route::get('/register', function () {
    return view('register');
});