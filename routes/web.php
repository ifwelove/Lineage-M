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

Route::get('/search', 'SearchController@index');
//Route::get('/import', 'SearchController@import');
//Route::get('/boss', 'BossController@index');
Route::post('/callback', 'LineController@webhook');
Route::post('/callback2', 'LineController@webhook2');
//Route::get('/boss/clear', 'BossController@clear');
//Route::get('/boss/reload', 'BossController@reload');
//Route::get('/boss/kill', 'BossController@kill');
