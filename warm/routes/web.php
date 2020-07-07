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

Route::get('instsUserRegister', 'Auth\RegisterController@showInstUserRegistrationForm');

Route::post('instsUserRegister', 'Auth\RegisterController@instUserRegister')->name('instsUserRegister');

Route::get('instsUserLoginForm', 'Auth\LoginController@instUserShowLoginForm')->name('instsUserLoginForm');

Route::post('instsUserLogin', 'Auth\LoginController@instUserLogin')->name('instsUserLogin');

Route::post('instsUserLogout', 'Auth\LoginController@instUserLogout')->name('instsUserLogout');


Route::get('studentsRegister', 'Auth\RegisterController@showStudentRegistrationForm');

Route::post('studentsRegister', 'Auth\RegisterController@studentRegister')->name('studentsRegister');

Route::get('studentsLoginForm', 'Auth\LoginController@studentShowLoginForm')->name('studentsLoginForm');

Route::post('studentsLogin', 'Auth\LoginController@studentLogin')->name('studentsLogin');

Route::post('studentsLogout', 'Auth\LoginController@studentLogout')->name('studentsLogout');

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

Route::resource('e_sbj_maps', 'E_sbj_mapsController');

Route::resource('e_r_maps', 'E_r_mapsController');

Route::resource('e_l_maps', 'E_l_mapsController');

Route::resource('s_n_maps', 'S_n_mapsController');

Route::resource('s_l_maps', 'S_l_mapsController');

Route::resource('s_sbj_maps', 'S_sbj_mapsController');

Route::get('querys/{id}/create','QuerysController@info');