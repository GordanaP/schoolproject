<?php

//Auth
Auth::routes();

//Page
Route::as('pages.')->group(function(){
    Route::name('welcome')->get('/', 'PageController@welcome');
    Route::name('home')->get('/home', 'PageController@home');
});
