<?php
include '../../config/config.php';?>
<form method="post" name="databrg" id="databrg">
      <table id="tabeldata" class="table table-sm table-striped">
        <thead>
          <tr class="">
            <th scope="col">No</th>
            <th scope="col">Nama Barang</th>
            <th scope="col">Stock Barang</th>
            <th scope="col">Harga Beli</th>
            <th scope="col">Harga Jual</th>
            <th class="text-center">
              <input type="checkbox" id="pilih_all">
            </th>
          </tr>
        </thead>
        <tbody>
          <?php
          $barang = query("SELECT * FROM tb_barang");
          $no =  1;
          foreach ($barang as $data) {
          ?>
            <tr>
              <th scope="row"><?= $no++; ?></td>
              <td><?= $data['nm_brg']; ?></td>
              <td><?= $data['stok_brg']; ?></td>
              <td>Rp. <?= number_format($data['hbeli'], 0, '.', '.'); ?></td>
              <td>Rp. <?= number_format($data['hjual'], 0, '.', '.'); ?></td>
              <td class="text-center">
                <input type="checkbox" name="pilih[]" class="pilih" value="<?= $data['id_brg'] ?>">
              </td>
            </tr>
          <?php
          }
          ?>
        </tbody>
      </table>
    </form>
    <script>
       // SETTING DATA TABLE
    $('#tabeldata').DataTable({
      // matikan sorting kolom 5
      "columnDefs": [{
        "targets": 5,
        "orderable": false
      }],
      "bLengthChange": false,
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
      scrollY: '310px',
      dom: 'Pfrtip'
    });
    //SETTING CHECKBOX
    $('.pilih').on('click', function() {
      if ($('.pilih:checked').length == $('.pilih').length) {
        $('#pilih_all').prop('checked', true)
      } else {
        $('#pilih_all').prop('checked', false)
      }
    });

    $('#pilih_all').on('click', function() {
      if (this.checked) {
        $('.pilih').each(function() {
          this.checked = true;
        })
      } else {
        $('.pilih').each(function() {
          this.checked = false;
        })
      }
    });
    </script>