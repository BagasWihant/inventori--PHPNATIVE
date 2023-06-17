<?php
include '../../config/config.php';

if (isset($_POST['tambahbrg'])) {

    $total = $_POST['total'];
    for ($i = 1; $i <= $total; $i++) {
        $nmbrg = strtoupper($_POST['namabrg-' . $i]);
        $hbeli = $_POST['hrgbelibrg-' . $i];
        $hjual = $_POST['hrgjualbrg-' . $i];
        $tambah =  "INSERT INTO tb_barang VALUES ( NULL , '$nmbrg' , 0 , '$hbeli' , '$hjual')";
        $sql = mysqli_query($con, $tambah);
    }
    if ($sql) {
        $_SESSION['databrg']= 'tambah';
        echo "<script>window.location='" . base_url('main/databarang/') . "'</script>";
    } else {
        echo mysqli_error($con);
    }
} else if (isset($_POST['editbtnbrg'])) {
    for ($i = 0; $i < count($_POST['idbrg']); $i++) {
        $id = $_POST['idbrg'][$i];
        $nmbrg = strtoupper($_POST['namabrg'][$i]);
        $stok = $_POST['stokbrg'][$i];
        $hbeli = $_POST['hrgbelibrg'][$i];
        $hjual = $_POST['hrgjualbrg'][$i];
        $edit = "UPDATE tb_barang SET nm_brg='$nmbrg', stok_brg='$stok', hbeli='$hbeli', hjual='$hjual' WHERE id_brg='$id'";
        $sql = mysqli_query($con, $edit);
    }
    if ($sql) {
        $_SESSION['databrg']= 'edit';
        echo "<script>window.location='" . base_url('main/databarang/') . "'</script>";

    } else {
        echo mysqli_error($con);
    }
}
