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

Route::get('/', 'HomeController@index');
Route::get('ongkir/index','HomeController@ongkir');
Route::get('resi/index','ResiController@resi');
Route::get('keranjang/remove','HomeController@remove');
Route::get('resi/remove','ResiController@remove');
Route::get('ongkir/kota/{id}','HomeController@kota');
Route::get('ongkir/kecamatan/{id}','HomeController@kecamatan');
Route::get('ongkir/cek','HomeController@cek');
Route::get('resi/cek','ResiController@cek');
Route::post('/projects', 'HomeController@store');
Route::get('bayar','HomeController@bayar');
Route::get('getprovince','HomeController@getprovince');
Route::get('getcity','HomeController@getcity');
Route::get('getdistrik','HomeController@getdistrik');