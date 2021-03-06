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
Route::name('accounts.reset.password')->patch('password/{user}', 'AccountController@resetPassword');

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

// Subject
Route::resource('subjects', 'Subjectcontroller', [
    'except' => ['show']
]);

// Event
Route::name('events.index')->get('calendar/{user}', 'EventController@index');
Route::name('events.store')->post('calendar/{user}', 'EventController@store');
Route::get('classrooms/{subject}/{user}', 'EventController@ajaxClassrooms');

Route::name('events.create')->get('events/create/{user}', 'EventController@create');
Route::name('events.store.event')->post('events/create/{user}', 'EventController@storeEvent');

// Lecture
Route::name('lectures.index')->get('lectures/{user}', 'LectureController@index');
Route::name('lectures.store')->post('lectures/{user}', 'LectureController@store');
Route::name('lectures.create')->get('lectures/{user}/create', 'LectureController@create');