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

// Route::view('/hello', 'hello', ['name' => 'ahmad']);
Route::get('/hello', function () {
    return view('hello', ['name' => 'ahmad']);
});

Route::get('/helloworld', function () {
    return view('hello.world', ['name' => 'ahmad']);
});

// route parameter
Route::get('/product/{id}', function ($productId) {
    return "Product $productId";
})->name('product.detail');

Route::get('/product/{product}/items/{items}', function ($product, $items) {
    return "Product $product, Item $items";
})->name('product.item.detail');

// route regular expression contraint
Route::get('category/{id}', function (string $category) {
    return "category : " . $category;
})->where('id', '[0-9]+')->name('category.detail');

// optional route parameter
Route::get('/users/{id?}', function (string $userId = '299') {
    return "User ID: " . $userId;
})->name('user.detail');

// route conflict
Route::get('/conflict/ahmad', function () {
    return "Conflict ahmad";
});
Route::get('/conflict/{name}', function ($name) {
    return "Conflict $name";
});

Route::get('/product/{id}', function ($id) {
    $link = route('product.detail', [
        'id' => $id
    ]);
    return "Link $link";
});

Route::get('/product-redirect/{id}', function ($id) {
    return redirect()->route('product.detail', ['id' => $id]);
});
