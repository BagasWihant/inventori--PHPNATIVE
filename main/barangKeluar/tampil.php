<?php
require '../../config/config.php'; ?>
<table id="tabletransaksikeluar" class="table table-sm table-striped tbl-keluar">
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
      $barang = query("SELECT * FROM tb_brgKeluar INNER JOIN tb_barang ON tb_brgKeluar.id_brg = tb_barang.id_brg ORDER BY tb_brgKeluar.tgl_jual DESC");
      $no =  1;
      foreach ($barang as $data) {
      ?>
        <tr>
          <td><?= $no++; ?></td>
          <td><?= $data['id_penjualan']; ?></td>
          <td><?= $data['nm_brg']; ?></td>
          <td><?= $data['jml_jual']; ?></td>
          <td><?= $data['diskripsi']; ?></td>
          <td><?= $data['tgl_jual']; ?></td>
          <td class="d-flex justify-content-around ">
            <a id="editbtn_brgkeluar" data-toggle="modal" data-target="#modaledit" data-id="<?= $data['id_penjualan'] ?>" ; data-nm="<?= $data['nm_brg'] ?>" ; data-jml="<?= $data['jml_jual'] ?>" ; data-ket="<?= $data['diskripsi']; ?>" ;>
              <i class=" text-warning fas fa-edit"></i>
            </a>
            <a id="hapusbtn_brgkeluar" data-toggle="modal" data-target="#modalhapus" data-id="<?= $data['id_penjualan']; ?>" ; data-nm="<?= $data['nm_brg'] ?>"> <i class="ml-3 text-danger fas fa-trash"></i></a>
          </td>
        </tr>
      <?php
      }
      ?>
    </tbody>
  </table>
  <script>
     $('#tabletransaksikeluar').DataTable({
      // matikan sorting 
      "columnDefs": [{
        "targets": [1, 4, 6],
        "orderable": false
      }],
      "lengthMenu": [
        [6],
        [6]
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