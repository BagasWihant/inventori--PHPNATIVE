<?php
require '../../config/config.php'; ?>
<table id="tabletransaksimasuk" class="table table-sm table-striped tbl-masuk">
  <thead>
    <tr>
      <th style="width: 1px;" scope="col">No</th>
      <th style="width: 120px;" scope="col">ID</th>
      <th style="width: 180px;" scope="col">Nama Barang</th>
      <th style="width: 50px;" scope="col">Jumlah</th>
      <th style="width: 200px;" scope="col">Keterangan</th>
      <th style="width: 150px;" scope="col">Tanggal Keluar</th>
      <th style="width: 10px;" class="text-center" scope="col"><i class="fas fa-cog"></i></th>
    </tr>
  </thead>
  <tbody>
    <?php
    $pembelian = query("SELECT * FROM tb_brgMasuk INNER JOIN tb_barang ON tb_brgMasuk.id_brg = tb_barang.id_brg ORDER BY tb_brgMasuk.tgl_beli DESC");
    $no =  1;
    foreach ($pembelian as $data) {
    ?>
      <tr>
        <th><?= $no++; ?></th>
        <td><?= $data['id_pembelian']; ?></td>
        <td><?= $data['nm_brg']; ?></td>
        <td><?= $data['jml_beli']; ?></td>
        <td><?= $data['diskripsi']; ?></td>
        <td><?= $data['tgl_beli']; ?></td>
        <td class="d-flex justify-content-around ">
          <a id="editbtn_brgmasuk" data-toggle="modal" data-target="#modaledit" data-id="<?= $data['id_pembelian'] ?>" ; data-nm="<?= $data['nm_brg'] ?>" ; data-jml="<?= $data['jml_beli'] ?>" ; data-ket="<?= $data['diskripsi'] ?>" ;>
            <i class="text-warning fas fa-edit"></i>
          </a>
          <a id="hapusbtn_brgmasuk" data-toggle="modal" data-target="#modalhapus" data-id="<?= $data['id_pembelian']; ?>" ; data-nm="<?= $data['nm_brg'] ?>"> <i class="ml-3 text-danger fas fa-trash"></i></a>

        </td>
      </tr>
    <?php
    }
    ?>
  </tbody>
</table>

<script>
  $('#tabletransaksimasuk').DataTable({
    // matikan sorting kolom 5
    "columnDefs": [{
      "targets": [1, 4, 6],
      "orderable": false
    }],
    "lengthMenu": [
      [10],
      [10]
    ],
    language: {
      search: "",
      searchPlaceholder: 'Temukan Barang'
    },
    "oLanguage": {
      "lengthMenu": "_MENU_ Data",
      "sInfo": "Menampilkan _START_-_END_ dari _TOTAL_ Data",
      "infoFiltered": "",
      "infoEmpty": "",
      "sZeroRecords": "Tidak Ditemukan"
    },
    scrollY: '400px',

    dom: 'frtp'

  });
</script>