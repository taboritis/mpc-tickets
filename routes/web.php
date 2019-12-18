<?php

Route::middleware('auth')->group(function () {
    Route::get('/users', 'UsersController@index');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
