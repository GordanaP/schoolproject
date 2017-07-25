<?php

// Auth
Auth::routes();

// Page
Route::as('pages.')->group(function(){
    Route::name('welcome')->get('/', 'PageController@welcome');
    Route::name('home')->get('/home', 'PageController@home');
    Route::name('settings')->get('/settings/{user}', 'PageController@settings');
    Route::name('dashboard')->get('/dashboard', 'PageController@dashboard');
});

// Account
Route::resource('accounts', 'AccountController', [
    'parameters' => ['accounts' => 'user']
]);
Route::name('accounts.update.password')->patch('/accounts/{user}/password', 'AccountController@updatePassword');

// Profile
Route::name('profiles.teachers.index')->get('profiles/teachers', 'ProfileController@teachersIndex');
Route::name('profiles.students.index')->get('profiles/students', 'ProfileController@studentsIndex');
Route::resource('profiles', 'ProfileController', [
    'except' => ['create','store'],
    'parameters' => ['profiles' => 'user'],
    'names' => ['destroy' => 'profiles.destroy.file'],
]);
Route::name('profiles.show.file')->get('profiles/avatar/{user}', 'ProfileController@showFile');
