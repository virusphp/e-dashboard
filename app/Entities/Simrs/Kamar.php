<?php
namespace App\Entities\Simrs;

use DB;
use App\Entities\Koneksi;

class Kamar extends Koneksi
{
    public function getData()
    {
        $data = DB::connection($this->conn)->table('Kamar as k')
            ->select('k.kd_kelas','k.keterangan','k.jml_tmp_tidur','k.jml_terpakai',
                     'k.tarif_kamar','su.nama_sub_unit')
            ->join('Sub_Unit as su', function($join) {
                $join->on('k.kd_sub_unit', '=', 'su.kd_sub_unit');
            })
            ->paginate(10);
            // dd(var_dump($data[0]->no_RM));
        return $data;
    }
}