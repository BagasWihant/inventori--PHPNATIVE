<?php
include_once "../../_head.php";
?>
<div class="zidx2">
    <h3 id="judul" class="text-primary" style="font-weight: 600; letter-spacing: 2px;">Laporan Penjualan</h3>
<table class="table table-sm" id="tabellap">
        <thead>
            <tr>
                <th>NO</th>
                <th>TANGGAL MASUK</th>
                <th>KETERANGAN</th>
                <th>NAMA BARANG</th>
                <th>QTY</th>
                <th>HARGA BELI</th>
                <th>TOTAL</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $lapjual = query('SELECT * FROM tb_brgKeluar INNER JOIN tb_barang on tb_brgKeluar.id_brg = tb_barang.id_brg');
            $no = 1;
            foreach ($lapjual as $data) { ?>
            <tr>
                <th><?= $no++?></th>
                <td><?= $data['tgl_jual']?></td>
                <td><?= $data['diskripsi']?></td>
                <td><?= $data['nm_brg']?></td>
                <td><?= $data['jml_jual']?></td>
                <td>Rp. <?= number_format($data['hjual'], 0,'.','.')?></td>
                <td>Rp. <?= number_format($data['hjual']*$data['jml_jual'], 0, '.', '.'); ?></td>
            </tr>
            <?php }
            ?>

        </tbody>
    </table>
</div>
<script type="text/javascript">
  $(document).ready(function() {
    $('#tabellap').DataTable({
      // matikan sorting kolom 5
      "columnDefs": [{
        "targets": [2],
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