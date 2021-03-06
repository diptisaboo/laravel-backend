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
    return Redirect::to('/dashboard');
});
Route::get('/login', 'Auth\LoginController@index');
Route::post('/logincheck', 'Auth\LoginController@authenticate');
Route::get('/logout', 'DashboardController@getLogout');
Route::get('/dashboard', 'DashboardController@index');

/*Films Routes*/
Route::get('/films', 'FilmController@index');
Route::get('/addfilm', 'FilmController@add');
Route::post('/savefilm', 'FilmController@save');
Route::get('/editfilm/{id}', 'FilmController@edit');
Route::get('/deletefilm/{id}', 'FilmController@delete');