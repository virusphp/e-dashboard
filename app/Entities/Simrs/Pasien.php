<?php
namespace App\Entities\Simrs;

use DB;
use App\Entities\Koneksi;

class Pasien extends Koneksi
{
    public function getData($request)
    {
        $data = DB::connection($this->conn)->table('Pasien')
            ->select('no_RM','nama_pasien','jns_kel','tgl_lahir','nama_orang_tua')
            ->where(function($query) use ($request) {
                if (($term = $request->get('search')) ) 
                {
                     $keywords = '%'. $term .'%';
                     $query->orWhere('no_RM','LIKE', $keywords);
                     $query->orWhere('nama_pasien', 'LIKE', $keywords);
                     $query->orWhere('tgl_lahir', 'LIKE', $keywords);
                } 
            })
            ->paginate(10);
            // dd(var_dump($data[0]->no_RM));
        return $data;
    }
}