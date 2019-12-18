<?php

Route::get('/', function () {
    return redirect('/users');
});

Route::middleware('auth')->group(function () {
    Route::get('/users', 'UsersController@index');
    Route::get('/tickets', 'TicketsController@index');
    Route::get('/tickets/{ticket}', 'TicketsController@show');
});

Auth::routes();

Route::get('/home', function () {
    return redirect('/users');
})->name('home');
