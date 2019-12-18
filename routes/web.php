<?php

Route::get('/', function () {
    return redirect('/users');
});

Route::middleware('auth')->group(function () {
    Route::get('/users', 'UsersController@index');
    Route::get('/tickets', 'TicketsController@index');
});

Auth::routes();

Route::get('/home', function () {
    return redirect('/users');
})->name('home');
