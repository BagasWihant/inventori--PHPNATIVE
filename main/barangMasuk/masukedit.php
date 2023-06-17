<?php
require '../../config/config.php';

$idmasuk = $_POST['editidbrg_masuk'];
$jmlmasuk = $_POST['editjml_masuk'];
$ketmasuk = strtoupper($_POST['editketerangan_masuk']);
// $editMasuk = " UPDATE `tb_brgMasuk` SET `jml_beli` = '$jml', `diskripsi` = '$ket' WHERE `tb_brgMasuk`.`id_pembelian` = '$id' "; 
$edit = "UPDATE `tb_brgMasuk` SET `jml_beli` = '$jmlmasuk', `diskripsi` = '$ketmasuk' WHERE `tb_brgMasuk`.`id_pembelian` = '$idmasuk' ";
$sql =mysqli_query($con, $edit);
