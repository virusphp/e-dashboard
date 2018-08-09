<?php
namespace App\Entities\Simrs;

use DB;
use App\Entities\Koneksi;

class TarifKarcis extends Koneksi
{
    public function getData($request)
    {
        $data = DB::connection($this->conn)->table('Tarif_Karcis_RJ')
            ->select('Sub_Unit.nama_sub_unit','Tarif_Karcis_RJ.harga','Tarif_Karcis_RJ.nama_tarif','Sub_Unit.enabled')
            ->join('Sub_Unit', function($join){
                $join->on('Tarif_Karcis_RJ.kd_sub_unit', '=', 'Sub_Unit.kd_sub_unit')
                        ->where([
                            ['Sub_Unit.enabled','=', 1],
                            ['Sub_unit.kd_unit','=', 1]
                        ]);
            })
            ->where(function($query) use ($request) {
                if (($term = $request->get('search')) ) 
                {
                     $keywords = '%'. $term .'%';
                     $query->orWhere('Sub_Unit.nama_sub_unit','LIKE', $keywords);
                     $query->orWhere('Tarif_Karcis_RJ.kd_sub_unit', 'LIKE', $keywords);
                } 
            }) 

            ->paginate(10);
            // dd(var_dump($data[0]->harga));
        return $data;
    }

    public function getAll()
    {
        $dataTarifKarcis = DB::connection($this->conn)->table('Tarif_Karcis_RJ')
                    ->select('Tarif_Karcis_RJ.kd_sub_unit','Sub_Unit.nama_sub_unit')
                    ->join('Sub_Unit', function($join){
                        $join->on('Tarif_Karcis_RJ.kd_sub_unit', '=', 'Sub_Unit.kd_sub_unit')
                                ->where([
                                    ['Sub_Unit.enabled','=', 1],
                                    ['Sub_unit.kd_unit','=', 1]
                                ]);
                    })
                    ->get();
        return $dataTarifKarcis;
    }

    public function getTarif($kd_sub,$tgl)
    {
        // dd(tanggalNilai($tgl));
        $karcis = DB::connection($this->conn)->table('Tarif_Karcis_RJ as tk')
                ->select('tk.harga','p.nama_pegawai')
                ->join('Jadwal_Dokter_Poli_RJ as jd', function($join){
                    $join->on('tk.kd_sub_unit','=','jd.kd_sub_unit')
                        ->join('Pegawai as p', function($join){
                            $join->on('jd.Kd_Pegawai', '=', 'p.kd_pegawai');
                        });
                })
                ->where([['tk.kd_sub_unit','=',$kd_sub], ['jd.kd_hari', '=', tanggalNilai($tgl)]])
                ->get();
        // $karcis[0]->harga_klinik = rupiah($karcis[0]->harga);
        $data = [];
        foreach($karcis as $key => $val)
        {
            $data[] = $val;
            $data[$key]->harga_klinik = rupiah($val->harga);
            // $data[$key] = $val->harga;
            
        }
        return $data;
    }

    public function getCarabayar()
    {
        return DB::connection($this->conn)->table('Cara_Bayar')
                ->select('kd_cara_bayar','keterangan','Aktif')
                ->where('Aktif','=', 1)
                ->whereIn('klp_bayar', [2])
                ->orderBy('keterangan','desc')
                ->get();
    }
    
}