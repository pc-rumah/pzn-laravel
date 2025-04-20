<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/pzn', function () {
    return ('pzn');
});

Route::redirect('/youtube', '/pzn');

Route::fallback(function () {
    return "404 by pzn";
});
