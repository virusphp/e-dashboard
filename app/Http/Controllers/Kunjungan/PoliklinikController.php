<?php

namespace App\Http\Controllers\Kunjungan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Entities\Kunjungan\Poli;
use Yajra\DataTables\Html\Builder;
use Datatables;
use Khill\Lavacharts\Lavacharts as Lava;
use App\Satuan;

class PoliklinikController extends Controller
{
    protected $htmlbuilder;

    public function __construct(Builder $htmlbuilder)
    {
        $this->htmlbuilder = $htmlbuilder;
    }

    public function index(Poli $poli)
    {
        // dd(tanggal());
        $poliklinik = $poli->getAll();
        return view('kunjungan.poli.index', compact('poliklinik'));
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

    public function getObject(Request $request, Poli $poli)
    {
        $poliklinik = $poli->getData();
        if ($request->ajax()) {
            return DataTables::of($poliklinik)->make(true);
        }

        $html = $this->htmlbuilder
        ->addColumn(['data' => 'no_reg', 'name' => 'no_reg', 'title' => 'No Registrasi'])
        ->addColumn(['data' => 'no_RM', 'name' => 'no_RM', 'title' => 'Rekamedis']);
        // ->addColumn(['data' => 'created_at', 'name' => 'created_at', 'title' => 'Created At'])
        // ->addColumn(['data' => 'updated_at', 'name' => 'updated_at', 'title' => 'Updated At']);

        return view('kunjungan.poli.datatable', compact('html'));
    }

    public function getChartJs(Request $request, Poli $poli)
    {
        // dd($request->all());
        if ($request->hari == NULL && $request->bulan == NULL && $request->tahun == NULL) {
            $tanggal = date('Y-m-d');
            $pengunjung = $poli->chartharian($tanggal);
            $klinik = $poli->chartklinikharian($tanggal);
            // $klinik = $poli->chartjsall();
        } elseif (!$request->bulan || !$request->tahun) {
            // $tanggal = $request->tahun.'-'.$request->bulan.'-'.$request->tanggal;
            $tanggal = $request->hari;
            $pengunjung = $poli->chartharian($tanggal);
            $klinik = $poli->chartklinikharian($tanggal);
        } else {
            $bulan = $request->only('bulan','tahun');
            $tanggal = $request->tahun.'-'.$request->bulan;
            $pengunjung = $poli->chartbulanan($bulan);
            $klinik = $poli->chartklinikbulanan($bulan);
            // dd($tanggal);
        }

        $tanggal = [tanggalFormat($tanggal)];

        return view('kunjungan.poli.chartjs')
                ->with('klinik',json_encode($klinik, JSON_NUMERIC_CHECK))
                ->with('tanggal', json_encode($tanggal, JSON_NUMERIC_CHECK))
                ->with('pengunjung',json_encode($pengunjung, JSON_NUMERIC_CHECK));
    }
    
    public function getChartJsBulanan(Request $request, Poli $poli)
    {
        // dd($request->tgl);
        if (!$request->tgl) {
            $tanggal = date('Y-m-d');
            $pengunjung = $poli->chartpengunjung($tanggal);
            $klinik = $poli->chartklinik($tanggal);
            // $klinik = $poli->chartjsall();
        } else {
            // $tanggal = $request->tahun.'-'.$request->bulan.'-'.$request->tanggal;
            $tanggal = $request->tgl;
            $pengunjung = $poli->chartpengunjung($tanggal);
            $klinik = $poli->chartklinik($tanggal);
        }
        $tanggal = [tanggalFormat($tanggal)];
        // dd($tanggal);
        return view('kunjungan.poli.chartjs')
                ->with('klinik',json_encode($klinik, JSON_NUMERIC_CHECK))
                ->with('tanggal', json_encode($tanggal, JSON_NUMERIC_CHECK))
                ->with('pengunjung',json_encode($pengunjung, JSON_NUMERIC_CHECK));
    }

}
