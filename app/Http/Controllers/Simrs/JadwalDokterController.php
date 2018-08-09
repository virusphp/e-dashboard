<?php
namespace App\Http\Controllers\Simrs;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Entities\Simrs\JadwalDokter;

class JadwalDokterController extends Controller
{
    protected $hari = ['senin' => 2, 'selasa' => 3, 'rabu' => 4, 'kamis' => 5, 'jumat' => 6, 'sabtu' => 7];

    public function index(Request $request, JadwalDokter $jadwal)
    {
        $jadwal_dokter = $jadwal->getData($request);
        $route = Route('simrs.jadwaldokter');
        return view('simrs.jadwal_dokter.index', compact('jadwal_dokter','route'));
    }

    public function getdokter(JadwalDokter $jadwal)
    {
        $senin = $jadwal->getJadwal($this->setHari('senin'));
        $selasa = $jadwal->getJadwal($this->setHari('selasa'));
        $rabu = $jadwal->getJadwal($this->setHari('rabu'));
        $kamis = $jadwal->getJadwal($this->setHari('kamis'));
        $jumat = $jadwal->getJadwal($this->setHari('jumat'));
        $sabtu = $jadwal->getJadwal($this->setHari('sabtu'));
        // dd(tanggalHari($jadwal[0]->Kd_Hari));
        return view('simrs.jadwal_dokter.dokter', compact('senin','selasa','rabu','kamis','jumat','sabtu'));
    }

    public function setHari($hari)
    {
        $data = [
            'senin' => 2,
            'selasa' => 3,
            'rabu' => 4,
            'kamis' => 5,
            'jumat' => 6,
            'sabtu' => 7
        ];

        return $data[$hari];
    }
}