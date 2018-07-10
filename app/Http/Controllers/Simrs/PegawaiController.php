<?php

namespace App\Http\Controllers\Simrs;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Entities\Simrs\Pegawai;

class PegawaiController extends Controller
{
    //
    public function index(Request $request, Pegawai $pegawai)
    {
        $data_pegawai = $pegawai->getData($request);
        $route = Route('simrs.pegawai');
        // dd($route);
        return view('simrs.pegawai.index', compact('data_pegawai','route'));
    }
}
