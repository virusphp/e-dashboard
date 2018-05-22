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

Route::get('/', 'HomeController@welcome')->name('welcome');
// Route::get('/', function(){
//     return "okebos";
// });
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('satuan', 'SatuansController');

Route::get('kunjungan/klinik', 'Kunjungan\PoliklinikController@index')->name('daftar.poli');
Route::get('kunjungan/klinik/print', 'Kunjungan\PoliklinikController@getPrintTabel')->name('daftar.poli.print');
Route::get('kunjungan/chart', 'Kunjungan\PoliklinikController@coba')->name('daftar.chart');
Route::get('kunjungan/chartjs', 'Kunjungan\PoliklinikController@indexChart')->name('daftar.chartjs');
Route::get('kunjungan/chartjs/print', 'Kunjungan\PoliklinikController@getPrintChart')->name('daftar.chartjs.print');
Route::get('kunjungan/datatable', 'Kunjungan\PoliklinikController@getObject')->name('daftar.datatable');

Route::get('jadwal/dokter', 'JadwalController@index')->name('daftar.dokter');