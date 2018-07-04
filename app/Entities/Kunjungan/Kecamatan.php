<?php
namespace App\Entities\Kunjungan;

use DB;
use App\Entities\Koneksi;
use App\Charts\PoliChart;

class Kecamatan extends Koneksi
{
    public function __constuct()
    {
       parent::__constuct();
    }
    public function getPengunjung($kecamatan)
    {
        $pengunjung = array_column($kecamatan, 'total_klinik');
        return $pengunjung;
    }

    public function getKecamatan($kecamatan)
    {
        $kecamatan = array_column($kecamatan, "nama_kecamatan");
        return $kecamatan;
    }

    public function getChartHarian($tanggal)
    {
        $poli = DB::connection($this->conn)
        ->table('Registrasi as R')
        ->join('Rawat_Jalan as RJ',function($join) {
            $join->on('R.no_reg', '=', 'RJ.no_reg')
                ->join('Pasien as P',function($join) {
                    $join->on('RJ.no_RM', '=', 'P.no_RM')
                        ->join('Kelurahan as Kel', function($join) {
                            $join->on('P.kd_kelurahan', '=', 'Kel.kd_kelurahan')
                                ->join('Kecamatan as Kec', function($join) {
                                    $join->on('Kel.kd_kecamatan', '=', 'Kec.kd_kecamatan');
                                });
                        });
                });            
        })
        ->select('Kec.nama_kecamatan as nama_kecamatan',DB::raw("count(Kec.kd_kecamatan) as total_klinik"))
        ->where('R.tgl_reg', '=', $tanggal)
        ->groupBy('Kec.nama_kecamatan', 'Kec.kd_kecamatan')
        ->orderBy('Kec.nama_kecamatan', 'asc')
        ->get()->toArray();
        return $poli;
    } 

    public function getChartBulanan($tanggal)
    {
        $poli = DB::connection($this->conn)
        ->table('Registrasi as R')
        ->join('Rawat_Jalan as RJ',function($join) {
            $join->on('R.no_reg', '=', 'RJ.no_reg')
                ->join('Pasien as P',function($join) {
                    $join->on('RJ.no_RM', '=', 'P.no_RM')
                        ->join('Kelurahan as Kel', function($join) {
                            $join->on('P.kd_kelurahan', '=', 'Kel.kd_kelurahan')
                                ->join('Kecamatan as Kec', function($join) {
                                    $join->on('Kel.kd_kecamatan', '=', 'Kec.kd_kecamatan');
                                });
                        });
                });            
        })      
        ->select('Kec.nama_kecamatan as nama_kecamatan',DB::raw("count(Kec.kd_kecamatan) as total_klinik"))
        ->whereMonth('R.tgl_reg', $tanggal['bulan'])
        ->whereYear('R.tgl_reg', $tanggal['tahun'])
        ->groupBy('Kec.nama_kecamatan', 'Kec.kd_kecamatan')
        ->orderBy('Kec.nama_kecamatan', 'asc')
        ->get()->toArray();

        return $poli;
    }

}