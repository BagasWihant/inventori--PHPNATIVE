<?php
require '../../config/config.php';

$id = $_POST['id_pembelian'];
$sql = mysqli_query($con, "DELETE FROM tb_brgMasuk WHERE id_pembelian='$id' ");
