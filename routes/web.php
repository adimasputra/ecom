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
    return view('index');
})->name('home');
Route::get('/logout', 'HomeController@logout')->name('logout');
Route::get('/login','HomeController@login')->name('login');
Route::get('/daftar','HomeController@register')->name('register');
Route::post('/daftar-submit','HomeController@registersubmit')->name('register.submit');
Route::post('/login-submit','HomeController@loginsubmit')->name('login.submit');

Route::get('/admin/login','HomeController@loginadmin')->name('loginadmin');
Route::post('/admin/loginadmin-submit','HomeController@loginadminsubmit')->name('loginadmin.submit');

Route::get('/admin/dashboard','DashboardController@index')->name('dashboard');
Route::resource('/admin/nelayan','NelayanController');
Route::get('nelayandatatable','NelayanController@datatable')->name('nelayan.datatable');
