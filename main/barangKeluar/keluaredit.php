<?php
require '../../config/config.php';
$id = $_POST['editidbrg_keluar'];
    $jml = $_POST['editjml_keluar'];
    $ket = strtoupper($_POST['editketerangan_keluar']);
    $editkeluar = "UPDATE `tb_brgKeluar` SET `jml_jual` = '$jml', `diskripsi` = '$ket' WHERE `tb_brgKeluar`.`id_penjualan` = '$id' "; 
    $sql = mysqli_query($con, $editkeluar);
  