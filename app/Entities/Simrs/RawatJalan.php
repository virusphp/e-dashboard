<?php
namespace App\Entities\Simrs;

use DB;
use App\Entities\Koneksi;
use Illuminate\Http\Request;

class RawatJalan extends Koneksi
{
    public function getData($request)
    {
        // $tgl = date('Y-m-d', strtotime($request->tgl));
        // dd($request->tgl1);
        // $tgl_satu = date('Y-m-d', strtotime($request->tgl1));
        // $tgl_dua = date('Y-m-d', strtotime($request->tgl2));
        $data = DB::connection($this->conn)->table('Registrasi AS reg')
            ->where(function($query) use ($request) {
                if ($request->only('tgl1','tgl2')) 
                {
                    $tgl_satu = date('Y-m-d', strtotime($request->tgl1));
                    $tgl_dua = date('Y-m-d', strtotime($request->tgl2));
                    $query->orWhereBetween('reg.tgl_reg',[$tgl_satu, $tgl_dua]);
                } elseif($request->only('search')) {
                    $keywords = isset($request->search) ? '%'. $request->search . '%' : '';
                    $query->orWhere('p.nama_pasien', 'LIKE', $keywords); 
                } elseif ($request->only('tgl')) {
                    $tanggal =  date('Y-m-d', strtotime($request->tgl));
                    $query->orWhere('reg.tgl_reg', '=', $tanggal); 
                } else {
                    $query->orWhere('reg.tgl_reg', date('Y-m-d'));
                }
            }) 
            ->join('Rawat_Jalan AS rj', function($join) {
                $join->on('reg.no_reg','=','rj.no_reg')
                ->join('Sub_Unit AS su', 'rj.kd_poliklinik','=','su.kd_sub_unit')
                ->join('Pegawai AS pg', 'rj.kd_dokter','=','pg.kd_pegawai');
            })
            ->join('Pasien AS p', function($join) {
                $join->on('reg.no_RM','=','p.no_RM');
            })
            ->select('reg.no_reg','reg.kd_cara_bayar','rj.no_RM','su.nama_sub_unit','pg.nama_pegawai','p.nama_pasien','p.jns_kel')
            // ->where('reg.tgl_reg', date('Y-m-d'))
            ->paginate(10);
            // dd($data);
        return $data;
    }

    public function getTagihan($no_reg)
    {
        $data = DB::connection($this->conn)->table('Tagihan_Pasien AS tp')
            ->select('tp.no_tagihan','tp.no_bukti','tp.no_RM','tp.no_Reg',
                'tp.tgl_tagihan','tp.kd_klp_biaya','tp.tagihan',
                'tp.status_bayar','p.nama_pasien','p.alamat','p.jns_kel',
                'p.no_telp','pg.nama_pegawai','su.nama_sub_unit','kel.nama_kelurahan',
                'kec.nama_kecamatan')
            ->join('Pasien AS p', function($join) {
                $join->on('tp.no_RM', '=', 'p.no_RM')
                    ->join('Kelurahan AS kel', function($join){
                        $join->on('p.kd_kelurahan','=','kel.kd_kelurahan')
                            ->join('Kecamatan AS kec', function($join) {
                                $join->on('kel.kd_kecamatan','=','kec.kd_kecamatan');
                            });
                    });
            })
            // ->join('Pegawai AS pg', 'tp.user_id','pg.kd_pegawai')
            ->join('Pegawai AS pg', 'tp.kd_dokter','pg.kd_pegawai')
            ->join('Sub_Unit as su', 'tp.kd_sub_unit', '=', 'su.kd_sub_unit')
            ->where('no_reg', $no_reg)
            ->first();
        return $data;
    }
}