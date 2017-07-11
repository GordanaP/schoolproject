<?php

//Auth
Auth::routes();

//Page
Route::as('pages.')->group(function(){
    Route::name('welcome')->get('/', 'PageController@welcome');
    Route::name('home')->get('/home', 'PageController@home');
    Route::name('settings')->get('/settings/{user}', 'PageController@settings');
    Route::name('dashboard')->get('/dashboard', 'PageController@dashboard');
});

//Account
Route::resource('accounts', 'AccountController', [
    'parameters' => ['accounts' => 'user']
]);
Route::name('accounts.update.password')->patch('/accounts/{user}/password', 'AccountController@updatePassword');
