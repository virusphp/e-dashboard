<?php

function tahun()
{
    $now = date('Y');
    for($a=2014;$a<=$now;$a++)
    {
        $tahun[$a] = $a;
    }
    return $tahun;
}

function bulan()
{
    for($a=01;$a<=12;$a++)
    {
        if (strlen($a) == 1) {
           $bulan['0'.$a] = formatBulan($a);
        } else {
           $bulan[$a] = formatBulan($a);
        }
    }
    return $bulan;
}

function kecamatan()
{
    $kecamatan = DB::connection('sqlsrv')
        ->table('Pasien')
        ->join('Kelurahan',function($join) {
            $join->on('Pasien.kd_kelurahan', '=', 'Kelurahan.kd_kelurahan')
                ->join('Kecamatan', function($join) {
                    $join->on('Kelurahan.kd_kecamatan','=', 'Kecamatan.kd_kecamatan')
                        ->join('Kabupaten', function($join) {
                            $join->on('Kecamatan.kd_kabupaten', '=', 'Kabupaten.kd_kabupaten')
                                ->join('Propinsi', function($join) {
                                    $join->on('Kabupaten.kd_propinsi', '=', 'Propinsi.kd_propinsi');
                                });
                        });
                });
        })
        ->select('Kecamatan.nama_kecamatan','Kecamatan.kd_kecamatan')
        ->get();

    foreach($kecamatan as $val)
    {
        $data[$val->kd_kecamatan] = $val->nama_kecamatan;
    }

    return $data;
}


function tanggal()
{
    for($a=01;$a<=31;$a++) {
        if (strlen($a) == 1) {
           $tanggal['0'.$a] = $a;
        } else {
           $tanggal[$a] = $a;
        }
    }
    return $tanggal;
}

function formatBulan($a)
{
    $bulan = array (
		1 =>   'Januari',
		'Februari',
		'Maret',
		'April',
		'Mei',
		'Juni',
		'Juli',
		'Agustus',
		'September',
		'Oktober',
		'November',
		'Desember'
    );

    return $bulan[$a];
}


function tanggalFormat($tanggal)
{
    $bulan = array (
		1 =>   'Januari',
		'Februari',
		'Maret',
		'April',
		'Mei',
		'Juni',
		'Juli',
		'Agustus',
		'September',
		'Oktober',
		'November',
		'Desember'
	);
    $pecahkan = explode('-', $tanggal);
    $tanggal = isset($pecahkan[2]) ? $pecahkan[2] : 'Bulan';
    $bulan = isset($pecahkan[1]) ? (int)$pecahkan[1] : ' ';
    $tahun = isset($pecahkan[0]) ? $pecahkan[0] : ' ';

    return  $tanggal. ' ' .$bulan. ' ' . $tahun;
    // return  $tanggal. ' ' .$bulan[ (int)$pecahkan[1] ]. ' ' . $pecahkan[0];
}

function tanggalNilai($tanggal)
{
    return date("N", strtotime($tanggal)) + 1;
}

function tanggalIndo($tanggal)
{
    $day = date('D', strtotime($tanggal));
    $dayList = array(
        'Sun' => 'Minggu',
        'Mon' => 'Senin',
        'Tue' => 'Selasa',
        'Wed' => 'Rabu',
        'Thu' => 'Kamis',
        'Fri' => 'Jumat',
        'Sat' => 'Sabtu'
    );

    return $dayList[$day];
    // return $dayList[$day] . date('d-m-Y', strtotime($tanggal));
}

function tanggalHari($tanggal)
{
    $dayList = array(
        1 => 'Minggu',
        'Senin',
        'Selasa',
        'Rabu',
        'Kamis',
        'Jumat',
        'Sabtu'
    );
    // for($i=0;$i<8;$i++) $a[]=date("Y-m-d", time()+(3600*24*$i));
    // foreach($a as $val) {

    // }
    return $dayList[$tanggal];
}

function tanggalsaja($nilai)
{
    $tgl =  date('Y-m-d', strtotime($nilai));
    $day = date('D', strtotime($tgl));
    $mon = date('F', strtotime($tgl));
    $dayList = array(
        'Sun' => 'Minggu',
        'Mon' => 'Senin',
        'Tue' => 'Selasa',
        'Wed' => 'Rabu',
        'Thu' => 'Kamis',
        'Fri' => 'Jumat',
        'Sat' => 'Sabtu'
    );
    $bulan = array (
		1 =>   'Januari',
		'Februari',
		'Maret',
		'April',
		'Mei',
		'Juni',
		'Juli',
		'Agustus',
		'September',
		'Oktober',
		'November',
		'Desember'
    );
    $pecahkan = explode('-', $tgl);
    $hari = $dayList[$day];
    return $hari.' '.$pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
}

// <?php 
// for($i=0;$i<8;$i++) $a[]=date("Y-m-d H:i:s", time()+(3600*24*$i));

// print_r($a);