<?php
require_once '../../config/config.php' ;

$pilihan = $_POST['pilih'];
foreach($pilihan as $id){
    $sql = mysqli_query($con, "DELETE FROM tb_barang WHERE id_brg='$id' ");
}
