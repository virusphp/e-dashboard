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
        // dd($route);
        return view('simrs.tarif_karcis.index', compact('tarif_karcis','route'));
    }
}