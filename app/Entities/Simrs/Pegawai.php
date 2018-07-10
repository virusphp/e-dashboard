<?php
namespace App\Entities\Simrs;

use DB;
use App\Entities\Koneksi;
use Illuminate\Http\Request;

class Pegawai extends Koneksi
{
    public function getData($request)
    {
        $data = DB::connection($this->conn)->table('Pegawai')
            ->select('kd_pegawai','nama_pegawai','gelar_depan','gelar_belakang')
            ->where(function($query) use ($request) {
               if (($term = $request->get('search')) ) 
               {
                    $keywords = '%'. $term .'%';
                    $query->orWhere('nama_pegawai','LIKE', $keywords);
                    $query->orWhere('kd_pegawai', 'LIKE', $keywords);
               } 
            })
            ->whereNotIn('kd_pegawai', [0,00,00000001])
            ->paginate(10);
            // dd(var_dump($data[0]->harga));
        return $data;
    }
}