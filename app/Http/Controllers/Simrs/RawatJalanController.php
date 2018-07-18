<?php

namespace App\Http\Controllers\Simrs;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Entities\Simrs\RawatJalan;
use Validator;

class RawatJalanController extends Controller
{
    public function index(Request $request, RawatJalan $rw_jalan)
    {
        // dd($request->all() == null);
        if ($request->only('tgl1','tgl2') != null) {
            $rules = [
                'tgl1' => 'required',
                'tgl2' => 'required',
            ];
                
            $costumMessage = [
                'tgl1.required' => 'Tanggal pertama harus di isi',
                'tgl2.required' => 'Tanggal kedua harus di isi'
            ];
            $this->validate($request,$rules, $costumMessage);
        } elseif($request->only('tgl') != null) {
            $rules = [
                'tgl' => 'required',
            ];
            $costumMessage = [
                'tgl.required' => 'Tanggal harus di isi',
            ];
            $this->validate($request,$rules, $costumMessage);
        }
        $rawat_jalan = $rw_jalan->getData($request);
        // dd($rawat_jalan);
        return view('simrs.rawat_jalan.index', compact('rawat_jalan'));
    }

    public function getTagihan(RawatJalan $rw_jalan, $no_reg)
    {
        $tagihan_pasien = $rw_jalan->getTagihan($no_reg);
        // dd($tagihan_pasien);   
        return view('simrs.rawat_jalan.tagihan.tagihan',compact('tagihan_pasien'));
    }
}
