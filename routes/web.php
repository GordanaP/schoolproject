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
    'parameters' => ['accounts' => 'user'],
    'only' => ['create', 'store', 'destroy'],
]);
Route::name('accounts.update.password')->patch('accounts/{user}/password', 'AccountController@updatePassword');

// Profile
Route::name('profiles.teachers.index')->get('profiles/teachers', 'ProfileController@teachersIndex');
Route::name('profiles.students.index')->get('profiles/students', 'ProfileController@studentsIndex');
Route::resource('profiles', 'ProfileController', [
    'only' => ['show', 'edit','update'],
    'parameters' => ['profiles' => 'user'],
]);
Route::name('profiles.update.profile')->patch('profiles/{user}/profile', 'ProfileController@updateProfile');

// Avatar
Route::resource('avatars', 'AvatarController', [
    'parameters' => ['avatars' => 'user'],
    'only' => ['show', 'destroy']
]);
Route::name('avatars.store')->post('avatars/{user}', 'AvatarController@store');

// Role
Route::resource('roles', 'RoleController', [
    'except' => 'show'
]);

// Classroom
Route::resource('classrooms', 'ClassroomController', [
    'except' => ['show']
]);

Route::resource('subjects', 'Subjectcontroller', [
    'except' => ['show']
]);

Route::name('accounts.reset.password')->patch('password/{user}', 'AccountController@resetPassword');
