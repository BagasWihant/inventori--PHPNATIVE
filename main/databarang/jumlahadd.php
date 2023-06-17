<?php
require '../../_head.php';
if ($_POST['jmladdbrg'] == '') {
    echo "<script>alert('Silahkan Masukkan Jumlah Data Yang Ingin Ditambahkan');window.location='" . base_url('main/databarang/') . "'</script>";
} ?>
  <div class="zidx2 my-3">
    <h3 id="judul" class="text-primary" style="font-weight: 600; letter-spacing: 2px;">Data Barang / <small>Tambah data</small></h3>
    <a href="<?= base_url('main/databarang')?>" class="float-right mb-3 btn btn-warning btn-sm">Kembali</a>
  </div>
    <form method="post" action="proses.php">
        <input type="hidden" name="total" value="<?= $_POST['jmladdbrg'] ?>">
        <table class="table table-sm">
            <thead>
                <tr class="text-center table-active">
                    <th>Nama Barang</th>
                    <th class="w-25">Harga Beli</th>
                    <th class="w-25">Harga Jual</th>
                </tr>
            </thead>
            <tbody>
                <?php
                 for ($i = 1; $i <= $_POST['jmladdbrg']; $i++) { 
                    ?>
                    <tr>
                        <td>
                            <input type="text" name="namabrg-<?= $i ?>" class="form-control" required autofocus>
                        </td>
                        <td>
                            <input type="text" id="hrgbeli" name="hrgbelibrg-<?= $i ?>" class="form-control " required>
                        </td>
                        <td>
                            <input type="text" id="hrgjual" name="hrgjualbrg-<?= $i ?>" class="form-control " required>
                        </td>
                    </tr>

                <?php } ?>
            </tbody>
        </table>
        <button type="submit" name="tambahbrg" class="btn btn-primary btn-sm float-right">Tambah Semua Barang</button>
    </form>

<?php
include '../../_foot.php';
?>