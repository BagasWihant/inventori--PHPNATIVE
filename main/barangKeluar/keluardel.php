<?php
include '../../config/config.php';

$id = $_POST['id_penjualan'];
$sql = mysqli_query($con, "DELETE FROM tb_brgKeluar WHERE id_penjualan='$id' ");

