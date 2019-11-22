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

Route::get('/', 'FlatshareMainController@index')->name('dashboard');

Route::prefix('/flatshare')->group(function() {

    Route::get('choice', 'FlatshareChoiceController@index')->name('flatsharechoiceoptions');
    Route::get('join', 'FlatshareChoiceController@join')->name('flatsharechoicejoin');
    Route::get('create', 'FlatshareChoiceController@create')->name('flatsharechoicecreate');

});

Route::get('/profile', 'ProfileController@index')->name('profile');

Auth::routes();

