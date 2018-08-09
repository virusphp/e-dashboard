<?php

namespace App\Http\Controllers\Simrs;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Entities\Simrs\Kamar;
use DB;

class KamarController extends Controller
{
    public function index(Request $request, Kamar $kamar)
    {
        $d_kamar = $kamar->getData();
        $route = Route('simrs.kamar');
        return view('simrs.kamar.index', compact('d_kamar', 'route'));
    }

}
