<?php

//Auth
Auth::routes();

//Page
Route::as('pages.')->group(function(){
    Route::name('welcome')->get('/', 'PageController@welcome');
    Route::name('home')->get('/home', 'PageController@home');
    Route::name('settings')->get('/settings/{user}', 'PageController@settings');
});

//Account
Route::resource('accounts', 'AccountController', [
    'parameters' => ['accounts' => 'user']
]);
