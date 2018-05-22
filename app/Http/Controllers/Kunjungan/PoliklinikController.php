<?php

namespace App\Http\Controllers\Kunjungan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Entities\Kunjungan\Poli;
use Datatables;
use Khill\Lavacharts\Lavacharts as Lava;
use App\Satuan;

class PoliklinikController extends Controller
{

    public function index(Request $request, Poli $poli)
    {
        $klinik = $this->getTabel($request, $poli);
        return view('kunjungan.poli.tabel', compact('klinik'));
    }

    public function getPrintTabel(Request $request, Poli $poli)
    {
        $klinik = $this->getTabel($request, $poli);
        $data = [];
        foreach($klinik as $val){
            $data[] .= $val->total_klinik;
        }
        $total = array_sum($data);
        return view('kunjungan.poli.tabel_print', compact('klinik', 'total'));
    }

    public function getTabel($request, $poli)
    {
        if ($request->hari == NULL && $request->bulan == NULL && $request->tahun == NULL) {
            $tanggal = date('Y-m-d');
            $klinik = $poli->getKlinikHarian($tanggal);
        } elseif (!$request->bulan || !$request->tahun) {
            $tanggal = $request->hari;
            $klinik = $poli->getKlinikHarian($tanggal);
        } else {
            $bulan = $request->only('bulan','tahun');
            $klinik = $poli->getKlinikBulanan($bulan);
        }

        return $klinik;
    }

    public function indexChart(Request $request, Poli $poli)
    {
        $data = $this->getChart($request, $poli); 
        $klinik = $poli->getKlinik($data[0]);
        $pengunjung = $poli->getPengunjung($data[0]);
        $tanggal = $data[1]; 

        return view('kunjungan.poli.chart')
                ->with('klinik',json_encode($klinik, JSON_NUMERIC_CHECK))
                ->with('tanggal', json_encode($tanggal, JSON_NUMERIC_CHECK))
                ->with('pengunjung',json_encode($pengunjung, JSON_NUMERIC_CHECK));
    }

    public function getPrintChart(Request $request, Poli $poli)
    {
        $data = $this->getChart($request, $poli); 
        $klinik = $poli->getKlinik($data[0]);
        $pengunjung = $poli->getPengunjung($data[0]);
        $tanggal = $data[1]; 

        return view('kunjungan.poli.chart_print')
                ->with('klinik',json_encode($klinik, JSON_NUMERIC_CHECK))
                ->with('tanggal', json_encode($tanggal, JSON_NUMERIC_CHECK))
                ->with('pengunjung',json_encode($pengunjung, JSON_NUMERIC_CHECK));
    }
   
    public function getChart($request,$poli)
    {
        if ($request->hari == NULL && $request->bulan == NULL && $request->tahun == NULL) {
            $tanggal = date('Y-m-d');
            $klinik = $poli->getChartHarian($tanggal);
        } elseif (!$request->bulan || !$request->tahun) {
            $tanggal = $request->hari;
            $klinik = $poli->getChartHarian($tanggal);
        } else {
            $bulan = $request->only('bulan','tahun');
            $tanggal = $request->tahun.'-'.$request->bulan;
            $klinik = $poli->getChartBulanan($bulan);
        }

        $tanggal = [tanggalFormat($tanggal)];

        return [$klinik, $tanggal];
    }
   
    public function coba(Request $request, Poli $poli)
    {
        // $poliku = $poli->tahundb();
        // $tanggal = $request->tahun.'-'.$request->bulan.'-'.$request->tanggal;

        if (!$request->tanggal || !$request->bulan || !$request->tahun) {
            $poliklinik = $poli->chartall();
        } else {
            $tanggal = $request->tahun.'-'.$request->bulan.'-'.$request->tanggal;
            $poliklinik = $poli->chartByTanggal($tanggal); 
            // dd($poliklinik);
        }
        // dd($poliklinik);
        foreach ($poliklinik as $val) {
            $no_rm[] = $val->no_RM;
            $no_reg[] = $val->no_reg;
            $klinik[] = $val->kd_poliklinik;
            $dokter[] = $val->kd_dokter;
            $tahun[] = $val->waktu_anamnesa;
        }
        // dd($klinik)
        // dd($tahun[0]);
        $lava = new Lava();
        $alasan = $lava->DataTable();
        $finances = $lava->DataTable();

        // Bentuk Silinder
        $alasan->addStringColumn('Reasons')
            ->addNumberColumn('Percent')
            ->addRow(['No RM', count($no_rm)])
            ->addRow(['No Reg', count($no_reg)])
            ->addRow(['Poliklinik', count($poliklinik)])
            ->addRow(['Dokter', count($dokter)]);

        $lava->PieChart('IMDB', $alasan, [
            'title'  => 'Daftar Kunjungan Klinik',
            'is3D'   => true,
            'slices' => [
                ['offset' => 0.2],
                ['offset' => 0.25],
                ['offset' => 0.3]
            ]
        ]);

        $finances->addDateColumn('Year')
         ->addNumberColumn('Poliklinik')
         ->addNumberColumn('No Rm')
         ->addRow([ $tahun[0], count($poliklinik), count($dokter)])
         ->addRow(['2010-1-1', count($poliklinik), count($dokter)])
         ->addRow(['2011-1-1', count($poliklinik), count($dokter)])
         ->addRow(['2012-1-1', count($poliklinik), count($dokter)])
         ->addRow(['2013-1-1', count($poliklinik), count($dokter)])
         ->addRow(['2014-1-1', count($poliklinik), count($dokter)]);

        $lava->ComboChart('Finances', $finances, [
            'title' => 'Pertumbuhan Kunjungan Pasien',
            'titleTextStyle' => [
                'color'    => 'rgb(123, 65, 89)',
                'fontSize' => 16
            ],
            'legend' => [
                'position' => 'in'
            ],
            'seriesType' => 'bars',
            'series' => [
                2 => ['type' => 'line']
            ]
        ]); 

        return view('kunjungan.poli.chart',['lava' => $lava]);
    }
}