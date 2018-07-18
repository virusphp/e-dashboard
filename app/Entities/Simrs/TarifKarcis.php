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
    
}