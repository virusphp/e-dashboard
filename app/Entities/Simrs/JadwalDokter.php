<?php
namespace App\Entities\Simrs;

use DB;
use App\Entities\Koneksi;

class JadwalDokter extends Koneksi
{
    public function getData($request)
    {
        $data = DB::connection($this->conn)->table('Jadwal_Dokter_Poli_RJ AS JD')
            ->select('P.nama_pegawai','SU.nama_sub_unit','JD.Kd_Hari','Jumlah_Kunjungan_SMS as Kuota')
            ->join('Pegawai AS P', function($join){
                $join->on('JD.kd_pegawai', '=', 'P.kd_pegawai');
            })
            ->join('Sub_Unit AS SU', function($join){
                $join->on('JD.kd_sub_unit', '=', 'SU.kd_sub_unit');
            })
            ->where(function($query) use ($request){
                if (($term = $request->get('search')) ) 
                {
                     $keywords = '%'. $term .'%';
                     $query->orWhere('P.nama_pegawai','LIKE', $keywords);
                     $query->orWhere('SU.nama_sub_unit', 'LIKE', $keywords);
                } 
            })
            ->orderBy('JD.kd_sub_unit', 'asc')
            ->paginate(10);
            // dd(var_dump($data[0]->harga));
            // dd($data);
        return $data;
    }

    public function getJadwal($kd_hari)
    {
        $data = DB::connection($this->conn)->table('Jadwal_Dokter_Poli_RJ as jd')
                ->select('p.nama_pegawai','su.nama_sub_unit', 'jd.Kd_Hari')
                ->join('Pegawai as p', function($join) {
                    $join->on('jd.kd_pegawai', '=', 'p.kd_pegawai');
                })
                ->join('Sub_Unit as su', function($join) {
                    $join->on('jd.kd_sub_unit', '=', 'su.kd_sub_unit');
                })
                ->where('jd.Kd_Hari', $kd_hari)
                ->get();
        return $data;
    }
}