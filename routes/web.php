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

use Illuminate\Http\Request;


Route::get('/', 'View\FlatshareViewController@index')->name('dashboard');
Route::get('refreshcaptcha', 'Auth\RegisterController@refreshCaptcha');

Route::prefix('/flatshare')->group(function() {

    Route::middleware('checkNoFlatshareRequest')->get('choice', 'View\FlatshareChoiceViewController@index')->name('flatsharechoiceoptions');
    Route::middleware('checkNoFlatshareRequest')->get('join', 'View\FlatshareChoiceViewController@join')->name('flatsharechoicejoin');
    Route::middleware('checkNoFlatshareRequest')->get('create', 'View\FlatshareChoiceViewController@create')->name('flatsharechoicecreate');
    Route::middleware('checkFlatshareRequest')->get('request', 'View\FlatshareChoiceViewController@request')->name('flatsharerequest');

});

Route::prefix('/management')->group(function() {

    Route::get('profile', 'View\UserViewController@index')->name('profile');
    Route::get('flatshare', 'View\FlatshareViewController@flatsharemanagemeint')->name('flatsharemanagement');
    Route::get('profilepassword', 'View\UserViewController@password')->name('profilepassword');

});
Route::prefix('/modules')->group(function() {

    Route::get('purchase', 'View\PurchaseViewController@index')->name('purchaselist');

});

Auth::routes();

