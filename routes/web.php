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
Route::get('photographer-edit/{id}', 'photographerCtrl@edit');
Route::get('ph-subscriber/{id}', 'photographerCtrl@single');

//Add & Edit Photographer
Route::post('step-one', 'photographerCtrl@stepOne');
Route::post('step-one-update', 'photographerCtrl@stepOneUpdate');
Route::post('step-two', 'photographerCtrl@stepTwo');
Route::post('step-three', 'photographerCtrl@stepThree');
Route::post('step-four', 'photographerCtrl@stepFour');
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

//Admin
Route::get('users', 'adminCtrl@index');
Route::post('user-cteate', 'adminCtrl@create');
Route::get('user-single/{id}', 'adminCtrl@single');
Route::get('user-status/{id}', 'adminCtrl@status');
Route::get('user-delete/{id}', 'adminCtrl@delete');