<?php
require '../../config/config.php';
$tgl=date("dmNysiG");
$id_brgkeluar = 'K'.$tgl;
$nmbrgkeluar = $_POST['addnmbrg_keluar'];
$jmlkeluar = $_POST['addjml_keluar'];
$ket = strtoupper($_POST['addketerangan']);

$tambahbrgKeluar =  "INSERT INTO tb_brgKeluar VALUES ( '$id_brgkeluar' , '$nmbrgkeluar'  , '$jmlkeluar' , null , '$ket')";
mysqli_query($con, $tambahbrgKeluar);
