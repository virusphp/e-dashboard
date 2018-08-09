<?php

namespace App\Http\Controllers\Simrs;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Entities\Simrs\RawatInap;
use Validator;

class RawatInapController extends Controller
{
    public function index(Request $request, RawatInap $rw_inap)
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
        $rawat_inap = $rw_inap->getData($request);
        $route = Route('simrs.rawatinap');
        // dd($rawat_inap);
        return view('simrs.rawat_inap.index', compact('rawat_inap','route'));
    }

    public function getTagihan(RawatInap $rw_inap, $no_reg)
    {
        $tagihan_pasien = $rw_inap->getTagihan($no_reg);
        // dd($tagihan_pasien);   
        return view('simrs.rawat_inap.tagihan.tagihan',compact('tagihan_pasien'));
    }
}
