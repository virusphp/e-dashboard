<?php

namespace App\Http\Controllers\Simrs;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Entities\Simrs\Pasien;

class PasienController extends Controller
{
    //
    public function index(Request $request, Pasien $pasien)
    {
        $data_pasien = $pasien->getData($request);
        $route = Route('simrs.pasien');
        return view('simrs.pasien.index', compact('data_pasien','route'));
    }
}
