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

    return  $tanggal. ' ' . $bulan[ (int)$pecahkan[1] ]. ' ' . $pecahkan[0];
}

function tanggalNilai($tanggal)
{
    return date("N", strtotime($tanggal)) + 1;
}