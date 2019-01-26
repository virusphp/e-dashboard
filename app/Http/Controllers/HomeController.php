<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return redirect()->route('daftar.chartjs');
    }
    
    public function welcome()
    {
        return view('welcome');
    }

    public function getVclaim()
    {
        return view('vclaim.index');
    }

    public function getSisrute()
    {
        return view('sisrute.index');
    }

    public function getSiranap()
    {
        return view('siranap.index');
    }

    public function getCtki()
    {
        return view('ctki.index');
    }

    public function getKatalog()
    {
        return view('katalog.index');
    }

    public function getSijarimas()
    {
        return view('sijarimas.index');
    }
    
    public function getGmail()
    {
        return view('gmail.index');
    }
}
