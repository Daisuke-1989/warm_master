<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('users', 'UsersController');

Route::resource('books', 'BooksController');

Route::resource('events', 'EventsController');

Route::resource('inst_users', 'Inst_usersController');

Route::resource('insts', 'InstsController');

Route::resource('levels', 'LevelsController');

Route::resource('nations', 'NationsController');

Route::resource('querys', 'QuerysController');

Route::resource('students', 'StudentsController');

Route::resource('subjects', 'SubjectsController');

Route::resource('terms', 'TermsController');
