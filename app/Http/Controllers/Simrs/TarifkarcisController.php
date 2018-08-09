<?php
namespace App\Http\Controllers\Simrs;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Entities\Simrs\TarifKarcis;

class TarifkarcisController extends Controller
{
    public function index(Request $request, TarifKarcis $tarif)
    {
        $tarif_karcis = $tarif->getData($request);
        $route = Route('simrs.tarifkarcis');
        return view('simrs.tarif_karcis.index', compact('tarif_karcis','route'));
    }

    public function getTarif(Request $request, TarifKarcis $tarif)
    {
        if ($request->ajax()) {
            // dd($request->kd_sub, $request->tgl);
            $tarif = $tarif->getTarif($request->kd_sub, $request->tgl);
        }

        return $tarif;
        
    }
}