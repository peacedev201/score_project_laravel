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
Route::get('score', 'Score_tableController@index');

Route::get('score_add', 'Score_tableController@create');
Route::get('data_update', 'Score_tableController@update');
Route::get('week_data_update', 'Score_tableController@week_update');
Route::get('month_data_update', 'Score_tableController@month_update');
Route::get('data_delete', 'Score_tableController@delete');

Route::get('home_view', 'HomeController@view');
Route::get('home_view_week', 'HomeController@view_week');
Route::get('home_view_month', 'HomeController@view_month');

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/week', 'HomeController@week')->name('week');
Route::get('/month', 'HomeController@month')->name('month');
