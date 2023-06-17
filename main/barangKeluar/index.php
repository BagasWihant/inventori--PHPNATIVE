<?php
include_once "../../_head.php";
?>



<!---------------------------------START MODAL TAMBAH------------------------------------>
<div class="modal fade" id="modaltambah" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h3 class="modal-title w-100">Tambah Barang</h3>
      </div>

      <form id="formadd" action="keluartambah.php" method="POST">
        <div class="modal-body">

          <div class="form-group">
            <input type="hidden" name="id_penjualan">
            <label>Nama Barang</label>
            <select name="addnmbrg_keluar" id="addnmbrg_keluar" class="form-control" required>
              <option value="">--PILIH--</option>
              <?php
              $option = query("SELECT * FROM tb_barang");
              foreach ($option as $nama_barang) { ?>
                <option data-max="<?= $nama_barang['stok_brg']?>" value="<?= $nama_barang['id_brg'] ?>"><?= $nama_barang['nm_brg'].' | '. $nama_barang['stok_brg'] ?></option>
              <?php }
              ?>
            </select>
          </div>

          <div class="form-group">
            <label>Jumlah Barang Keluar</label>
            <input type="number" class="form-control" name="addjml_keluar" id="addjml_keluar" min="1" placeholder="Jumlah Barang" />
          </div>

          <div class="form-group">
            <label>Keterangan</label>
            <textarea type="text" class="form-control" name="addketerangan" id="addketerangan"></textarea>
          </div>
        </div>
        <div class="modal-footer d-flex justify-content-between flex-row-reverse">
          <button type-="submit" class="btn btn-success">Tambah</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!---------------------------------END MODAL TAMBAH------------------------------------>

<!---------------------------------START MODAL EDIT------------------------------------>
<div class="modal fade" id="modaledit" tabindex="-1" role="dialog" aria-hidden="true">

  <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h3 class="modal-title w-100">Edit Barang Keluar</h3>
      </div>
      <form id="formedit" action="keluaredit.php" method="POST">
        <div class="modal-body">
          <div class="form-group">
            <label class="text-danger text-center">Anda Hanya Dapat Edit Keterangan Saja!!</label>
            <input type="text" class="form-control" name="editidbrg_keluar" id="editidbrg_keluar" readonly>
          </div>
          <div class="form-group">
            <label>Nama Barang</label>
            <input type="text" class="form-control" name="editnmbrg_keluar" id="editnmbrg_keluar" readonly>
          </div>
          <div class="form-group">
            <label>Jumlah Barang Keluar</label>
            <input type="number" class="form-control" name="editjml_keluar" id="editjml_keluar" placeholder="Jumlah Barang" readonly />
          </div>
          <div class="form-group">
            <label>Keterangan</label>
            <textarea type="text" class="form-control" name="editketerangan_keluar" id="editketerangan_keluar"></textarea>
          </div>
        </div>
        <div class="modal-footer d-flex justify-content-between flex-row-reverse">
          <button type="submit" class="btn btn-success">Simpan Perubahan</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!---------------------------------END MODAL EDIT------------------------------------>

<!--------------------------------- MODAL HAPUS------------------------------------>
<div id="modalhapus" class="modal fade" role="dialog">
  <div class="modal-dialog modal-dialog-centered ">
    <div class="modal-content  text-center container">
      <h4 class="modal-title pt-2">Apakah anda yakin?</h4>
      <form id="formdel" action="keluardel.php" method="POST">
        <div class="modal-body mt-2">
          <input type="hidden" name="id_penjualan" id="id_penjualan">
          <p>Menghapus data <span class="text-danger" id="nmbrg"></span> dengan id <span class="text-danger" id="idbrg"></span></p>
          <div class="d-flex justify-content-between mt-4">
            <button type="button" class="btn btn-primary" data-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-danger">Ya, hapus!</button>
          </div>
        </div>

      </form>
    </div>
  </div>
</div>
<!---------------------------------END MODAL HAPUS------------------------------------>

<div class="zidx2">
  <div id="judul" class="d-flex justify-content-between">
    <h3 class="text-primary" style="font-weight: 600; letter-spacing: 2px;">Barang Keluar</h3>
    <div class="align-items-center d-flex">
      <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modaltambah"> Tambah Barang Keluar</button>
    </div>
  </div>

  <div id="tabelajax">

  </div>
</div>
<script>
  $(document).ready(function() {
    loadtabel();

    $('#formadd').on('submit', function(e) {
      e.preventDefault();
      $.ajax({
        type: $(this).attr('method'),
        url: $(this).attr('action'),
        data: $(this).serialize(),
        success: function() {
          loadtabel();
          $('#modaltambah').modal('hide');
          swal({
            title: 'Berhasil',
            icon: 'success',
            button: false,
            text: 'Menambah Data',
            timer: 1300
          })

          $('[type=text]').val('');
          $('#addnmbrg_keluar').val('');
        }
      })
    })

    $('#formdel').on('submit', function(e) {
      e.preventDefault();
      $.ajax({
        type: $(this).attr('method'),
        url: $(this).attr('action'),
        data: $(this).serialize(),
        success: function() {
          $('#modalhapus').modal('hide')
          swal({

            title: 'Berhasil',
            icon: 'success',
            button: false,
            timer: 1300
          })
          loadtabel()
        }

      })
    })

    $('#addnmbrg_keluar').on('change', function() {
      max = $('option:selected',this).attr('data-max')
      $('#addjml_keluar').attr('max',max)
    })
    $('#formedit').on('submit', function(e) {
      e.preventDefault();
      $.ajax({
        type: $(this).attr('method'),
        url: $(this).attr('action'),
        data: $(this).serialize(),
        success: function() {
          $('#modaledit').modal('hide')
          swal('Berhasil Update Data', '', 'success')
          loadtabel()
        }
      })
    })


    // MASUKKAN DATA KE MODAL DI BARANG KELUAR
    $(document).on("click", "#editbtn_brgkeluar", function() {
      $("#modaledit #editidbrg_keluar").val($(this).data('id'));
      $("#modaledit #editnmbrg_keluar").val($(this).data('nm'));
      $("#modaledit #editjml_keluar").val($(this).data('jml'));
      $("#modaledit #editketerangan_keluar").val($(this).data('ket'));
    });
    $(document).on('click', '#hapusbtn_brgkeluar', function() {
      $('#modalhapus #id_penjualan').val($(this).data('id'));
      $('#modalhapus #idbrg').html($(this).data('id'));
      $('#modalhapus #nmbrg').html($(this).data('nm'));
    });
  })

  function loadtabel() {
    jQuery.get('tampil.php', function(data) {
      $('#tabelajax').html(data)
    })
  }
</script>
<?php
include_once "../../_foot.php";
?>