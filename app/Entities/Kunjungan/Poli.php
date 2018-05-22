<?php
namespace App\Entities\Kunjungan;

use DB;
use App\Entities\Koneksi;
use App\Charts\PoliChart;

class Poli extends Koneksi
{
    public function __constuct()
    {
       parent::__constuct();
    }

    public function getKlinikHarian($tanggal)
    {
        $poli = DB::connection($this->conn)
            ->table('Registrasi as R')
            ->join('Rawat_Jalan as RJ',function($join) {
                $join->on('R.no_reg', '=', 'RJ.no_reg')
                    ->join('Sub_Unit as S', function($join) {
                        $join->on('RJ.kd_poliklinik', '=', 'S.kd_sub_unit');
                    });
            })             
            ->select('S.nama_sub_unit as nama_klinik',DB::raw("count(RJ.kd_poliklinik) as total_klinik"))
            ->where('R.tgl_reg', '=', $tanggal)
            ->groupBy('S.nama_sub_unit', 'RJ.kd_poliklinik')
            ->orderBy('RJ.kd_poliklinik', 'asc')
            ->get();

        return $poli;
    }
    
    public function getKlinikbulanan($tanggal)
    {
        $poli = DB::connection($this->conn)
            ->table('Registrasi as R')
            ->join('Rawat_Jalan as RJ',function($join) {
                $join->on('R.no_reg', '=', 'RJ.no_reg')
                    ->join('Sub_Unit as S', function($join) {
                        $join->on('RJ.kd_poliklinik', '=', 'S.kd_sub_unit');
                    });
            })             
            ->select('S.nama_sub_unit as nama_klinik',DB::raw("count(RJ.kd_poliklinik) as total_klinik"))
            ->whereMonth('R.tgl_reg', $tanggal['bulan'])
            ->whereYear('R.tgl_reg', $tanggal['tahun'])
            ->groupBy('S.nama_sub_unit', 'RJ.kd_poliklinik')
            ->orderBy('RJ.kd_poliklinik', 'asc')
            ->get();

        return $poli;
    }

    public function getData()
    {
        return DB::connection($this->conn)
                ->table('Rawat_Jalan')
                ->select('no_reg','no_RM','kd_poliklinik','kd_dokter','waktu_anamnesa')
                ->limit(2000)
                ->get();
    }

    public function chartAll()
    {
        $poli = DB::connection($this->conn)
                ->table('Rawat_Jalan')
                ->select('no_reg','no_RM','kd_poliklinik','kd_dokter','waktu_anamnesa')
                ->where('no_reg', 'like', '%16%')
                // ->limit(10)
                ->get();
        return $poli;
    }

    public function getPengunjung($poli)
    {
        $pengunjung = array_column($poli, 'total_klinik');
        return $pengunjung;
    }

    public function getKlinik($poli)
    {
        $klinik = array_column($poli, "nama_klinik");
        return $klinik;
    }

    public function getChartHarian($tanggal)
    {
        $poli = DB::connection($this->conn)
        ->table('Registrasi as R')
        ->join('Rawat_Jalan as RJ',function($join) {
            $join->on('R.no_reg', '=', 'RJ.no_reg')
                ->join('Sub_Unit as S', function($join) {
                    $join->on('RJ.kd_poliklinik', '=', 'S.kd_sub_unit');
                });
        })             
        ->select('S.nama_sub_unit as nama_klinik',DB::raw("count(RJ.kd_poliklinik) as total_klinik"))
        ->where('R.tgl_reg', '=', $tanggal)
        ->groupBy('S.nama_sub_unit', 'RJ.kd_poliklinik')
        ->orderBy('RJ.kd_poliklinik', 'asc')
        ->get()->toArray();

        return $poli;
    } 

    public function getChartBulanan($tanggal)
    {
        $poli = DB::connection($this->conn)
            ->table('Registrasi as R')
            ->join('Rawat_Jalan as RJ',function($join) {
                $join->on('R.no_reg', '=', 'RJ.no_reg')
                    ->join('Sub_Unit as S', function($join) {
                        $join->on('RJ.kd_poliklinik', '=', 'S.kd_sub_unit');
                    });
            })             
            ->select('S.nama_sub_unit as nama_klinik',DB::raw("count(RJ.kd_poliklinik) as total_klinik"))
            ->whereMonth('R.tgl_reg', $tanggal['bulan'])
            ->whereYear('R.tgl_reg', $tanggal['tahun'])
            ->groupBy('S.nama_sub_unit', 'RJ.kd_poliklinik')
            ->orderBy('RJ.kd_poliklinik', 'asc')
            ->get()->toArray();

        return $poli;
    }

    public function chartByTanggal($tanggal)
    {
        // dd($tanggal);
        $poli = DB::connection($this->conn)
        ->table('Registrasi as R')
        ->join('Rawat_Jalan as RJ', 'R.no_reg', '=', 'RJ.no_reg')
        ->join('Sub_Unit as S', 'RJ.kd_poliklinik', '=', 'S.kd_sub_unit')
        ->select(DB::raw("count(RJ.kd_poliklinik) as total_klinik, RJ.kd_poliklinik"))
        // ->select('RJ.no_reg',DB::raw('count(RJ.kd_poliklinik) as total_klinik, RJ.kd_poliklinik'))
        ->where('R.tgl_reg', '=', $tanggal)
        ->groupBy('RJ.kd_poliklinik')
        ->orderBy('RJ.kd_poliklinik', 'asc')
        ->get();

        $data = [];
        foreach($poli as $val) {
            $jumlah[] = $val->total_klinik;
        }

        return $jumlah;
    }

    public function tahundb()
    {
        $tahun = DB::connection($this->conn)
            ->table('Rawat_Jalan')
            ->select('waktu_anamnesa')
            ->distinct()
            ->get();
        return $tahun;
    }
}