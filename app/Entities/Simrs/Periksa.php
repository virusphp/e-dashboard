<?php
namespace App\Entities\Simrs;

use DB;
use App\Entities\Koneksi;

class Periksa extends Koneksi
{
    public function tanggalPeriksa()
    {
        $date = date('Y-m-d');
        $libur = json_decode(self::AllLibur(),true);
        // var_dump($libur);
        $q = [];
        array_walk($libur, function($a) use (&$q) { $q[] = $a["tgl_libur"]; });
        do {
            $date = date("Y-m-d", strtotime($date)+86400);
        } 
        while(in_array($date, $q) || date("D", strtotime($date)) === "Sun");

        return $date;
    }

    public function AllLibur()
    {
        return DB::connection($this->conn)->table('hari_libur')
            ->select('tgl_libur','keterangan')
            ->orderBy('tgl_libur', 'asc')
            ->get();
    }
}