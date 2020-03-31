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


Route::get('/', 'HomeController@index')->name('home');
Route::get('/detail-ikan/{id}', 'HomeController@detail')->name('detail-ikan');
Route::get('/keluar', 'HomeController@logout')->name('keluar');
Route::get('/profil', 'HomeController@profil')->name('profil');
Route::get('/masuk','HomeController@login')->name('masuk');
Route::get('/daftar','HomeController@register')->name('daftar');
Route::post('/daftar-submit','HomeController@registersubmit')->name('register.submit');
Route::post('/login-submit','HomeController@loginsubmit')->name('login.submit');

Route::get('/insert/cart/{id}', 'HomeController@insertcart')->name('insertcart');
Route::get('/delete/cart/{id}', 'HomeController@deletecart')->name('deletecart');
Route::get('/update/cart/{id}', 'HomeController@updatecart')->name('updatecart');
Route::get('/cart', 'HomeController@cart')->name('cart');
Route::prefix('admin')->group(function () {
    Auth::routes();
});

Route::middleware('auth')->group(function(){
    Route::get('/admin/dashboard','DashboardController@index')->name('dashboard');
    Route::middleware('admin-only')->group(function(){
        Route::resource('/admin/nelayan','NelayanController');
        Route::get('nelayandatatable','NelayanController@datatable')->name('nelayan.datatable');
    });

    Route::resource('admin/ikan', 'IkanController');
    Route::get('ikandatatable','IkanController@datatable')->name('ikan.datatable');
    Route::resource('admin/tambak', 'TambakController');
    Route::get('tambakdatatable','TambakController@datatable')->name('tambak.datatable');
});
