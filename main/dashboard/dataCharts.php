<?php
include "../../config/config.php";

$hariini = date('Y-m-d');
$strharini = strtotime($hariini);
$strseminggu = $strharini - (6*86400);
$hariini = date('Y-m-d',$strharini);
$seminggu = date('Y-m-d',$strseminggu);
$dataMasuk = array();
$datakeluar = array();
for ($i=$strseminggu; $i <= $strharini; $i=$i+86400) { 
    // $masuk = query("SELECT sum(jml_beli) as total, date(tgl_beli) as tgl FROM tb_brgMasuk WHERE Date(tgl_beli) <= '$hariini' and Date(tgl_beli) >= '$seminggu' group by date(tgl_beli)");
    $tgl = date('Y-m-d',$i);
    $msk = $con->query("SELECT sum(jml_beli) as total, date(tgl_beli) as tgl FROM tb_brgMasuk WHERE Date(tgl_beli) = '$tgl'");
    $klr = $con->query("SELECT sum(jml_jual) as total, date(tgl_jual) as tgl FROM tb_brgKeluar WHERE Date(tgl_jual) = '$tgl'");
    $masuk = $msk->fetch_assoc();
    $keluar = $klr->fetch_assoc();
    if(!isset($masuk['total'])){
        $masuk['total'] = 0;
        $masuk['tgl'] = $tgl;
    }
    array_push($dataMasuk,$masuk);
    if(!isset($keluar['total'])){
        $keluar['total'] = 0;
        $keluar['tgl'] = $tgl;
    }
    array_push($datakeluar,$keluar);
    // $keluar = query("SELECT sum(jml_jual) as total, date(tgl_jual) as tgl  FROM tb_brgKeluar WHERE Date(tgl_jual) <= '$hariini' and Date(tgl_jual) >= '$seminggu' group by date(tgl_jual)");
}

$res['masuk'] = $dataMasuk;
$res['keluar'] = $datakeluar;

echo json_encode($res);