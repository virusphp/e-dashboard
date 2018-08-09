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

Route::group(['namespace' => 'Simrs'], function() {
    //Home
    Route::get('/simrs', 'SimrsController@index')->name('simrs.index');

    // master 
    Route::get('/simrs/pegawai', 'PegawaiController@index')->name('simrs.pegawai');
    Route::get('/simrs/pasien', 'PasienController@index')->name('simrs.pasien');
    Route::get('/simrs/kamar', 'KamarController@index')->name('simrs.kamar');
    Route::get('/simrs/tarifkaric', 'TarifkarcisController@index')->name('simrs.tarifkarcis');
    Route::post('/api/simrs/poliklinik', 'JadwalDokterPenggantiController@getPoliklinik')->name('api.simrs.poli');

    // Jadwal Dokter
    Route::get('/simrs/jadwaldokter', 'JadwalDokterController@index')->name('simrs.jadwaldokter');
    Route::get('/simrs/jadwaldokterpengganti', 'JadwalDokterPenggantiController@index')->name('simrs.jadwaldokterpengganti');
    Route::get('/simrs/jadwaldokterpengganti/create', 'JadwalDokterPenggantiController@create')->name('simrs.dokterpengganti.create');

    // History
    Route::get('/simrs/rawatjalan', 'RawatJalanController@index')->name('simrs.rawatjalan');
    Route::get('/simrs/rawatjalan/tagihan/{no_reg}', 'RawatJalanController@getTagihan')->name('simrs.tagihan.rawatjalan');
    Route::get('/simrs/rawatinap', 'RawatInapController@index')->name('simrs.rawatinap');
    Route::get('/simrs/rawatinap/tagihan/{no_reg}', 'RawatInapController@getTagihan')->name('simrs.tagihan.rawatinap');

    // Registrasi
    Route::get('/simrs/registrasi', 'RegistrasiController@index')->name('simrs.reg.rjalan');
    Route::post('/simrs/registrasi', 'RegistrasiController@regPasien')->name('simrs.reg.pasien');

    // Pasien JSON
    Route::post('/simrs/getpasien', 'RegistrasiController@getPasien')->name('simrs.getpasien');

    // Tarif
    Route::post('/simrs/tarif', 'TarifkarcisController@getTarif')->name('simrs.tarif');
});


// Route::get('/simrs/jadwalsemuadokter', 'Simrs\JadwalDokterController@getdokter')->name('simrs.jadwalsemuadokter');
// Route::get('/simrs/rawatjalan/tagihan', 'Simrs\RawatJalanController@getTagihan')->name('simrs.tagihan');
