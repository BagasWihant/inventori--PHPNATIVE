<?php
require '../../config/config.php';
$tgl=date("dmNysiG");
$id_brgmasuk = 'M'.$tgl;
$nmbrgmasuk = $_POST['nmbrg_masuk'];
$jmlbeli = $_POST['jml_masuk'];
$ket = strtoupper($_POST['keterangan']);
$tambahbrgMasuk =  "INSERT INTO tb_brgMasuk VALUES ( '$id_brgmasuk' , '$nmbrgmasuk'  , '$jmlbeli' , null , '$ket')";
$sql = mysqli_query($con, $tambahbrgMasuk);