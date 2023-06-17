<?php
require '../../_head.php';
$pilihan = $_POST['pilih'];
if ($pilihan == '') {
    echo "<script>alert('Silahkan Masukkan Jumlah Data Yang Ingin Ditambahkan');window.location='" . base_url('main/databarang/') . "'</script>";
} ?>
  <div class="zidx2 my-3">
    <h3 id="judul"class="text-primary" style="font-weight: 600; letter-spacing: 2px;">Data Barang / <small>Edit data</small></h3>
    <a href="<?= base_url('main/barang')?>" class="float-right mb-3 btn btn-sm btn-warning">Kembali</a>
  </div>
  <div class="container">
    <form method="post" action="proses.php">
        <input type="hidden" name="total" value='<?= $_POST['jmladdbrg'] ?>'>
        <table class="table table-sm">
            <thead>
                <tr class="text-center table-active">
                    <th>Nama Barang</th>
                    <th style="width: 150px;">stok</th>
                    <th style="width: 150px;">Harga Beli</th>
                    <th style="width: 150px;">Harga Jual</th>
                </tr>
            </thead>
            <tbody>
                <?php
                
                foreach($pilihan as $sql) { 
                     $query = mysqli_query($con,"SELECT * FROM tb_barang WHERE id_brg = '$sql'");
                     while ($data = mysqli_fetch_assoc($query)) {
                         # code...
                     
                    ?>
                    <tr>
                        <td>
                            <input type="hidden" name="idbrg[]" value="<?= $data['id_brg'] ?>" >
                            <input type="text" name="namabrg[]" value="<?= $data['nm_brg'] ?>" class="form-control" required>
                        </td>
                        <td>
                            <input type="text" name="stokbrg[]" value="<?= $data['stok_brg'] ?>" class="form-control " readonly>
                        </td>
                        <td>
                            <input type="text" name="hrgbelibrg[]" value="<?= $data['hbeli'] ?>" class="form-control " required>
                        </td>
                        <td>
                            <input type="text" name="hrgjualbrg[]" value="<?= $data['hjual'] ?>" class="form-control " required>
                        </td>
                    </tr>

                <?php } } ?>
            </tbody>
        </table>
        <button type="submit" name="editbtnbrg" class="btn btn-primary btn-sm">Edit Barang</button>

    </form>
  </div>
<?php
include '../../_foot.php';
?>