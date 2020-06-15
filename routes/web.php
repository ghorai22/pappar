<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', 'dashCtrl@index');

Route::get('login', 'loginCtrl@index');
Route::post('login-check', 'loginCtrl@login');
Route::get('logout', 'loginCtrl@logout');

Route::get('photographer', 'photographerCtrl@index');
Route::get('photographer-add', 'photographerCtrl@add');
Route::get('ph-subscriber/{id}', 'photographerCtrl@single');

//Add Photographer
Route::post('step-one', 'photographerCtrl@stepOne');
Route::post('upload-img', 'photographerCtrl@upload');

Route::get('delete-ph/{id}', 'photographerCtrl@delete');
Route::get('status-ph/{id}', 'photographerCtrl@status');

Route::get('subscribers', 'subscriberCtrl@index');
Route::get('single-subscriber/{id}', 'subscriberCtrl@single');
Route::post('update-subscriber', 'subscriberCtrl@update');
Route::get('delete-subscriber/{id}', 'subscriberCtrl@delete');
Route::get('status-subscriber/{id}', 'subscriberCtrl@status');

Route::get('single-booking/{id}', 'bookingCtrl@singleBooking');
Route::get('booking', 'bookingCtrl@index');

