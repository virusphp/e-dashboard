<?php
namespace App\Entities\Simrs;

use DB;
use App\Entities\Koneksi;

class JadwalDokter extends Koneksi
{
    public function getData($request)
    {
        $data = DB::connection($this->conn)->table('Jadwal_Dokter_Poli_RJ AS JD')
        // $dokterPengganti = DB::table('Jadwal_Dokter_Poli_RJ_Pengganti AS DPP')
        //     ->where('DPP.tanggal','=', $tgl_register)
        //     ->select('DPP.kd_pegawai', 'SU.nama_sub_unit','DPP.keterangan','P.gelar_depan','P.gelar_belakang','P.nama_pegawai','DPP.tanggal')
        //     ->join('Pegawai AS P',function($join){
        //         $join->on('DPP.kd_pegawai','=','P.kd_pegawai');
        //     })
        //     ->join('Sub_Unit AS SU', function($join){
        //         $join->on('DPP.kd_sub_unit', '=', 'SU.kd_sub_unit');
        //     })
        //     ->orderBy('DPP.kd_sub_unit', 'asc')
        //     ->get();
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
}