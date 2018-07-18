<?php
namespace App\Http\Controllers\Simrs;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Entities\Simrs\JadwalDokterPengganti;
use App\Entities\Simrs\TarifKarcis;
use DB;

class JadwalDokterPenggantiController extends Controller
{
    public function index(Request $request, JadwalDokterPengganti $jadwal)
    {
        $jadwal_dokter_pengganti = $jadwal->getData($request);
        // dd($jadwal_dokter_pengganti);
        $route = Route('simrs.jadwaldokterpengganti');
        return view('simrs.jadwal_dokter_pengganti.index', compact('jadwal_dokter_pengganti','route'));
    }

    public function create(JadwalDokterPengganti $dokter)
    {
        $dokter = $dokter->getNamaDokter();
        return view('simrs.jadwal_dokter_pengganti.create', compact('dokter'));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        dd($data);
        $dok_pengganti = $dokter->simpan($data);
        return redirect()->route('simrs.jadwaldokterpengganti');
    }

    public function getPoliklinik(Request $request, JadwalDokterPengganti $dokter)
    {
        $data = $request->get('kd_pegawai');
        $dokter = $dokter->getPoliklinik($data);
        return $dokter;
    }
}