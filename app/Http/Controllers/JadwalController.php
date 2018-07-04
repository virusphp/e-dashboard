<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Entities\Jadwal\Dokter;
use Datatables;

class JadwalController extends Controller
{
    //
    public function index(Request $request, Dokter $dokter)
    {
        $jadwal = $dokter->getAll();

        if ($request->ajax()) {
            return DataTables::of($jadwal)->make(true);
        }

        return view('report.jadwal.dokter.index', compact('jadwal'));
    }
}
