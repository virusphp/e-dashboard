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
Route::get('konsx', function(){
    $idCos = 11895;
    $strval = strval(time());
    $tamps = strval(time()-strtotime('1970-01-01 00:00:00'));
    $data = $idCos."&".$tamps;

    return $tamps;
});

Route::get('xsigna', function(){
   $idCos = 11895;
   $secKey = "rs19krtn99pkl";
   $strval = strval(time());
   $tamps = strval(time()-strtotime('1970-01-01 00:00:00'));

   $data = $idCos."&".$tamps;

   $startSig = hash_hmac('sha256', $idCos."&".$tamps, $secKey, true);
   $signature = base64_encode($startSig);

   return [$idCos, $tamps, $signature];

});

Route::get('/', 'HomeController@welcome')->name('welcome');
// Route::get('/', function(){
//     return "okebos";
// });
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('satuan', 'SatuansController');
Route::resource('sep', 'SepController');
Route::post('sep/carisep', 'SepController@cariSep')->name('sep.cariSep');
Route::delete('sep/deletesep/{no_sep}', 'SepController@deleteSep')->name('delete.sep');

Route::get('kunjungan/klinik', 'Kunjungan\PoliklinikController@index')->name('daftar.poli');
Route::get('kunjungan/klinik/print', 'Kunjungan\PoliklinikController@getPrintTabel')->name('daftar.poli.print');
Route::get('kunjungan/chart', 'Kunjungan\PoliklinikController@coba')->name('daftar.chart');
Route::get('kunjungan/klinik/chartjs', 'Kunjungan\PoliklinikController@indexChart')->name('daftar.chartjs');
Route::get('kunjungan/klinik/chartjs/print', 'Kunjungan\PoliklinikController@getPrintChart')->name('daftar.chartjs.print');
Route::get('kunjungan/kecamatan/chartjs', 'Kunjungan\PoliklinikController@indexKecamatanChart')->name('daftar.kec.chartjs');
Route::get('kunjungan/provinsi/chartjs', 'Kunjungan\PoliklinikController@indexProvinsiChart')->name('daftar.pro.chartjs');
Route::get('kunjungan/datatable', 'Kunjungan\PoliklinikController@getObject')->name('daftar.datatable');

Route::get('jadwal/dokter', 'JadwalController@index')->name('daftar.dokter');