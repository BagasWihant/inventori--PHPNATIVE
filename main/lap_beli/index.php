<?php
include_once "../../_head.php";
?>

<div class="zidx2">
  <h3 id="judul" class="text-primary" style="font-weight: 600; letter-spacing: 2px;">Laporan Pembelian</h3>
  <table id="tabellap" class="table table-sm table-striped">
    <thead>
      <tr class="">
        <th style="width: 40px;" scope="col">No</th>
        <th style="width: 150px;" scope="col">Tanggal Masuk</th>
        <th style="width: 200px;" scope="col">Keterangan</th>
        <th style="width: 200px;" scope="col">Nama Barang</th>
        <th style="width: 70px;" scope="col">Qty</th>
        <th style="width: 100px;" scope="col">Harga Beli</th>
        <th style="width: 100px;" scope="col">TOTAL</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $lap_masuk = query("SELECT * FROM tb_brgMasuk INNER JOIN tb_barang on tb_brgMasuk.id_brg = tb_barang.id_brg");
      $no =  1;
      foreach ($lap_masuk as $data) {
      ?>
        <tr>
          <th scope="row"><?= $no++; ?></th>
          <td><?= $data['tgl_beli']; ?></td>
          <td><?= $data['diskripsi']; ?></td>
          <td><?= $data['nm_brg']; ?></td>
          <td><?= $data['jml_beli']; ?></td>
          <td>Rp. <?= number_format($data['hbeli'], 0, '.', '.'); ?></td>
          <td>Rp. <?= number_format($data['hbeli']*$data['jml_beli'], 0, '.', '.'); ?></td>
        </tr>
      <?php
      }
      ?>
    </tbody>
  </table>
</div>
<script type="text/javascript">
  $(document).ready(function() {
    $('#tabellap').DataTable({
      // matikan sorting 
      "columnDefs": [{
        "targets": [0,2],
        "orderable": false
      }],
      "lengthMenu": [
        [10,15,25],
        [10,15,25]
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
      scrollY: '350px',

      buttons:[
        {
          extend:'print',
          text: '<i class="fas fa-print"><i>',
          className: 'btn btn-info'
        },
        {
          extend:'pdfHtml5',
          text: '<i class="fas fa-file-pdf"><i>',
          className: 'btn btn-danger'
        },
        {
          extend:'excel',
          text: '<i class="fas fa-file-excel"><i>',
          className: 'btn btn-success'
        }
      ],

      dom: '<"float-right"B>l<rtp>'

    });
  });
  </script>

<?php
include_once "../../_foot.php";
?>