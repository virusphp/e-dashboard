<?php
namespace App\Entities\Jadwal;

use DB;
use App\Entities\Koneksi;

class Dokter extends Koneksi
{
    public function __constuct()
    {
       parent::__constuct();
    }

    public function getAll()
    {
        $tgl = date('Y-m-d');
        $tanggal = date('Y-m-d', strtotime('+1 days',strtotime($tgl)));
        $dokterPengganti = DB::connection($this->conn)
            ->table('Jadwal_Dokter_Poli_RJ_Pengganti as DPP')
                ->where('DPP.tanggal','=', $tanggal)
                ->select('DPP.kd_pegawai','DPP.tanggal as tanggal', 'SU.nama_sub_unit','DPP.keterangan','P.gelar_depan','P.gelar_belakang','P.nama_pegawai','DPP.tanggal')
                ->join('Pegawai AS P',function($join){
                    $join->on('DPP.kd_pegawai','=','P.kd_pegawai');
                })
                ->join('Sub_Unit AS SU', function($join){
                    $join->on('DPP.kd_sub_unit', '=', 'SU.kd_sub_unit');
                })
                ->orderBy('DPP.kd_sub_unit', 'asc')
                ->get();
            
                if ($dokterPengganti->count() != 0) {
                    if ($dokterPengganti[0]->Status_Pergantian == 0){
        
                        $dokterPengganti[0]->nama_pegawai = $dokterPengganti[0]->gelar_depan.' '.$dokterPengganti[0]->nama_pegawai.' '.$dokterPengganti[0]->gelar_belakang;
                        unset($dokterPengganti[0]->gelar_depan,$dokterPengganti[0]->gelar_belakang);
                        $dokterPengganti[0]->tanggal = TanggalIndo($dokterPengganti[0]->tanggal);
                        $res = $dokterPengganti;
                        // dd($res);
                    } else {
                      $res['pesan'] = 'Dokter Sedang Cuti';
                    }
                } else {

                    $dokterPoli = DB::connection($this->conn)
                    ->table('Jadwal_Dokter_Poli_RJ AS DP')
                        ->where('DP.kd_hari','=', TanggalNilai($tanggal))
                        ->select('DP.Kd_Pegawai','DP.Kd_Sub_Unit','SU.nama_sub_unit', 'DP.Kd_Hari as tanggal','DP.Jumlah_Kunjungan',
                                'gelar_depan','gelar_belakang','nama_pegawai')
                        ->join('Pegawai AS P',function($join){
                            $join->on('DP.Kd_Pegawai','=','P.kd_pegawai');
                        })
                        ->join('Sub_Unit AS SU', function($join){
                            $join->on('DP.kd_sub_unit', '=', 'SU.kd_sub_unit');
                        })
                        ->orderBy('DP.kd_sub_unit', 'asc')
                        ->get();
        
        
                    if  ($dokterPoli->count() != 0) {
        
                        // $dokterPoli[0]->nama_pegawai= $dokterPoli[0]->gelar_depan.' '.$dokterPoli[0]->nama_pegawai.' '.$dokterPoli[0]->gelar_belakang;
                        // unset($dokterPoli[0]->gelar_depan,$dokterPoli[0]->gelar_belakang);
                        foreach($dokterPoli as $key => $val){
                               $val->tanggal = tanggalHari($val->tanggal);
                               $val->nama_pegawai = $val->gelar_depan.' '.$val->nama_pegawai.' '.$val->gelar_belakang;
                               unset($val->gelar_depan, $val->gelar_belakang);
                        }
                        // $dokterPoli[0]->tanggal = tanggalHari($dokterPoli[0]->tanggal);
                        $res = $dokterPoli;
                        // dd($res);
                    } else {
                        $res['pesan'] = 'Poli tidak tersedia di hari yang anda pilih';
                    }
        
                }
        
        return $res;
    }

    public function getData()
    {

    }
}