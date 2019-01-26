<?php

namespace App\Http\Controllers\Simrs;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Entities\Simrs\Pasien;
use App\Entities\Simrs\Periksa;
use App\Entities\Simrs\TarifKarcis;
use App\Entities\Simrs\Registrasi;

class RegistrasiController extends Controller
{
    //
    protected $periksa;
    protected $klinik;

    public function __construct()
    {
        $this->periksa = new Periksa();
        $this->klinik = new TarifKarcis();
    }

    public function index()
    {
        $tgl_periksa = $this->periksa->tanggalPeriksa();
        $klinik = $this->klinik->getAll();
        $cara_bayar = $this->klinik->getCarabayar();
        // dd($cara_bayar);
        return view('simrs.registrasi.index', compact('tgl_periksa', 'klinik', 'cara_bayar'));
    }

    public function regPasien(Request $request, Registrasi $reg)
    {
        // dd($request->all());
        $register =  $reg->regPasien($request);
        return $register;
    }

    public function getPasien(Request $request, Pasien $pasien)
    {
        if ($request->ajax()) {
           $res = $pasien->getPasien($request->no_rm);
        } 
        
        return $res;
    }
}
