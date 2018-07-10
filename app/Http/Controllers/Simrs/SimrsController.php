<?php
namespace App\Http\Controllers\Simrs;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SimrsController extends Controller
{
    public function index()
    {
        return view('simrs.welcome');
    }
}