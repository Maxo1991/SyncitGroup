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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/admin', 'AdminController@index')->name('admin')->middleware('admin');
Route::get('/user', 'UserController@index')->name('user')->middleware('user');
Route::get('/list', 'ListController@index')->name('list');
Route::post('/ajax', 'AjaxController@storeContact')->name('ajax');
Route::post('/deleteContact', 'ListController@deleteContact')->name('deleteContact');
Route::post('/deleteNumber', 'ListController@deleteNumber')->name('deleteNumber');
Route::post('/insertNumber', 'ListController@insertNumber')->name('insertNumber');
Route::post('/updateNumber', 'ListController@updateNumber')->name('updateNumber');

Route::get('/home', 'HomeController@index')->name('home');
