<?php
namespace App\Http\Controllers\Simrs;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Entities\Simrs\JadwalDokter;

class JadwalDokterController extends Controller
{
    public function index(Request $request, JadwalDokter $jadwal)
    {
        $jadwal_dokter = $jadwal->getData($request);
        $route = Route('simrs.jadwaldokter');
        return view('simrs.jadwal_dokter.index', compact('jadwal_dokter','route'));
    }
}