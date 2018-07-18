<?php
namespace App\Entities\Simrs;

use DB;
use App\Entities\Koneksi;

class JadwalDokterPengganti extends Koneksi
{
    public function getData($request)
    {
        $data = DB::connection($this->conn)->table('Jadwal_Dokter_Poli_RJ_Pengganti AS DPP')
        ->select('DPP.kd_izin','DPP.kd_pegawai','SU.nama_sub_unit', 'DPP.status_pergantian',
                'P.gelar_depan','P.gelar_belakang','P.nama_pegawai','DPP.tanggal','DPP.keterangan')
        ->join('Pegawai AS P',function($join){
            $join->on('DPP.kd_pegawai','=','P.kd_pegawai');
        })
        ->join('Sub_Unit AS SU', function($join){
            $join->on('DPP.kd_sub_unit', '=', 'SU.kd_sub_unit');
        })
        ->where(function($query) use ($request){
            if (($term = $request->get('search')) ) 
            {
                 $keywords = '%'. $term .'%';
                 $query->orWhere('P.nama_pegawai','LIKE', $keywords);
                 $query->orWhere('SU.nama_sub_unit', 'LIKE', $keywords);
            } 
        })
        ->paginate(10);
        return $data;
    }

    public function getNamaDokter()
    {
        $data = DB::connection($this->conn)->table('Jadwal_Dokter_Poli_RJ AS jdp')
            ->where('jdp.kd_pegawai', '<>', '0')
            ->join('Pegawai AS p', 'jdp.kd_pegawai', '=', 'p.kd_pegawai')
            ->pluck('p.nama_pegawai', 'jdp.kd_pegawai');
        return $data;
    }

    public function getPoliklinik($kd_sub)
    {
        // dd($kd_sub);
        $data = DB::connection($this->conn)->table('Jadwal_Dokter_Poli_RJ AS jdp')
            ->where('jdp.kd_pegawai', '=', $kd_sub)
            ->join('Sub_Unit AS su', 'jdp.kd_sub_unit', '=', 'su.kd_sub_unit')
            ->select('jdp.kd_sub_unit','su.nama_sub_unit')
            ->groupBy('su.nama_sub_unit','jdp.kd_sub_unit')
            ->get();

        return $data;
    }
}