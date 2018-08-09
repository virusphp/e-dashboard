<?php
namespace App\Http\Controllers\Simrs;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Entities\Simrs\JadwalDokter;

class SimrsController extends Controller
{
    public function index(JadwalDokter $jadwal)
    {
        $senin = $jadwal->getJadwal($this->setHari('senin'));
        $selasa = $jadwal->getJadwal($this->setHari('selasa'));
        $rabu = $jadwal->getJadwal($this->setHari('rabu'));
        $kamis = $jadwal->getJadwal($this->setHari('kamis'));
        $jumat = $jadwal->getJadwal($this->setHari('jumat'));
        $sabtu = $jadwal->getJadwal($this->setHari('sabtu'));

        return view('simrs.welcome', compact('senin','selasa','rabu','kamis','jumat','sabtu'));
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