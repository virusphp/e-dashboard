<?php

function rupiah($nilai){
    return "Rp.". number_format(ceil($nilai), "0",",",".");
}

function kelamin($nilai){
    return $nilai == 0 ? 'Perempuan' : 'Laki-laki';
}

function hide($nilai){
    $a = substr($nilai, -3);
    $b = substr($nilai, 3);
    // $c = str_replace(,$b, $)
    return str_replace(substr($nilai, 3), "***", $nilai);
}