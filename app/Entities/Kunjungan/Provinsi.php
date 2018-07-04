<?php
namespace App\Entities\Kunjungan;

use DB;
use App\Entities\Koneksi;
use App\Charts\PoliChart;

class Provinsi extends Koneksi
{
    public function __constuct()
    {
       parent::__constuct();
    }
    public function getPengunjung($provinsi)
    {
        $pengunjung = array_column($provinsi, 'total_klinik');
        return $pengunjung;
    }

    public function getProvinsi($provinsi)
    {
        $provinsi = array_column($provinsi, "nama_propinsi");
        return $provinsi;
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
                                    $join->on('Kel.kd_kecamatan', '=', 'Kec.kd_kecamatan')
                                        ->join('Kabupaten as Kab', function($join) {
                                            $join->on('Kec.kd_kabupaten', '=', 'Kab.kd_kabupaten')
                                                ->join('Propinsi as Pro', function($join) {
                                                    $join->on('Kab.kd_propinsi','=', 'Pro.kd_propinsi');
                                                });
                                        });
                                });
                        });
                });            
        })      
        ->select('Pro.nama_propinsi as nama_propinsi',DB::raw("count(Pro.kd_propinsi) as total_klinik"))
        ->where('R.tgl_reg', '=', $tanggal)
        ->groupBy('Pro.nama_propinsi', 'Pro.kd_propinsi')
        ->orderBy('Pro.nama_propinsi', 'asc')
        ->get()->toArray();
        // dd($poli);
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
                                    $join->on('Kel.kd_kecamatan', '=', 'Kec.kd_kecamatan')
                                        ->join('Kabupaten as Kab', function($join) {
                                            $join->on('Kec.kd_kabupaten', '=', 'Kab.kd_kabupaten')
                                                ->join('Propinsi as Pro', function($join) {
                                                    $join->on('Kab.kd_propinsi','=', 'Pro.kd_propinsi');
                                                });
                                        });
                                });
                        });
                });            
        })      
        ->select('Pro.nama_propinsi as nama_propinsi',DB::raw("count(Pro.kd_propinsi) as total_klinik"))
        ->whereMonth('R.tgl_reg', $tanggal['bulan'])
        ->whereYear('R.tgl_reg', $tanggal['tahun'])
        ->groupBy('Pro.nama_propinsi', 'Pro.kd_propinsi')
        ->orderBy('Pro.nama_propinsi', 'asc')
        ->get()->toArray();
        return $poli;
    }

}