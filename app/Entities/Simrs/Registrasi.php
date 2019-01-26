<?php
namespace App\Entities\Simrs;

use DB;
use App\Entities\Koneksi;

class Registrasi extends Koneksi
{
    public function regPasien($request)
    {
        $data = $request->only('no_rm','tgl_reg','klinik','tarif_klinik','kd_dokter');
        dd($data);
        $registrasi = $this->saveRegister($request);
        $rawatjalan = $this->saveRawatJalan($request);
        $tagihan = $this->saveTagihan($request);
    }

    public function saveRegister($req)
    {
        return DB::connection($this->conn)->table('Registrasi')
            ->insert([
                
            ]);
    }

    public function saveRawatJalan($req)
    {
        return DB::connection($this->conn)->table('Rawat_Jalan')
            ->insert([

            ]);
    }

    public function saveTagihan($req)
    {
        return DB::connection($this->conn)->table('Tagihan_Pasien')
            ->insert([

            ]);
    }
}