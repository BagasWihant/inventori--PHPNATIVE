<?php
include_once "../../_head.php";

?>




<!---------------------------------START MODAL TAMBAH------------------------------------>
<div class="modal fade" id="modaltambah" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h3 class="modal-title w-100">Tambah Barang Masuk</h3>
      </div>
      <form id="formadd" action="masuktambah.php" method="POST">
        <div class="modal-body">
          <div class="form-group">
            <input type="hidden" name="id_pembelian">
            <label>Nama Barang</label>
            <select name="nmbrg_masuk" id="nmbrg_masuk" class="form-control">
              <option value="">--PILIH--</option>
              <?php
              $option = query("SELECT * FROM tb_barang");
              foreach ($option as $nama_barang) { ?>
                <option value="<?= $nama_barang['id_brg'] ?>"><?= $nama_barang['nm_brg'] ?> | <p class="mr-auto"><?= $nama_barang['stok_brg'] ?></p>
                </option>
              <?php }
              ?>
            </select>
          </div>
          <div class="form-group">
            <label>Jumlah Barang Masuk</label>
            <input type="text" class="form-control" name="jml_masuk" id="jml_masuk" placeholder="Jumlah Barang" />
          </div>
          <div class="form-group">
            <label>Keterangan</label>
            <input type="text" class="form-control" name="keterangan" id="keterangan" placeholder="Diskripsi" />
          </div>
        </div>
        <div class="modal-footer d-flex justify-content-between flex-row-reverse">
          <button type="submit" id="btntambah" class="btn btn-success">Tambah</button>
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
        <h3 class="modal-title w-100">Edit Barang Masuk</h3>
      </div>
      <form id="formedit" action="masukedit.php" method="POST">
        <div class="modal-body">
          <div class="form-group">
            <label class="text-danger text-center">Anda Hanya Dapat Edit Keterangan Saja!!</label>
            <input type="text" class="form-control" name="editidbrg_masuk" id="editidbrg_masuk" readonly>
          </div>
          <div class="form-group">
            <label>Nama Barang</label>
            <input type="text" class="form-control" name="editnmbrg_masuk" id="editnmbrg_masuk" readonly>
          </div>
          <div class="form-group">
            <label>Jumlah Barang Keluar</label>
            <input type="text" class="form-control" name="editjml_masuk" id="editjml_masuk" placeholder="Jumlah Barang" readonly />
          </div>
          <div class="form-group">
            <label>Keterangan</label>
            <textarea type="text" class="form-control" name="editketerangan_masuk" id="editketerangan_masuk"></textarea>
          </div>
        </div>
        <div class="modal-footer d-flex justify-content-between flex-row-reverse">
          <button type="submit" id="btnedit" class="btn btn-success">Simpan Perubahan</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!---------------------------------END MODAL EDIT------------------------------------>

<!--------------------------------- MODAL HAPUS------------------------------------>
<div id="modalhapus" class="modal fade" role="dialog">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content  text-center container">
      <h4 class="modal-title pt-2">Apakah anda yakin?</h4>
      <form id="formdel" action="masukdel.php" method="POST">
        <div class="modal-body mt-2">
          <input type="hidden" name="id_pembelian" id="id_pembelian">
          <p>Menghapus data <span class="text-danger" id="nmbrghapus"></span> dengan id <span class="text-danger" id="idbrghapus"></span></p>
          <div class="d-flex justify-content-between mt-4">
            <button id="nosave" type="button" class="btn btn-primary" data-dismiss="modal">Batal</button>
            <button type="submit" id="btnhapus" class="btn btn-danger">Ya, hapus!</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
<!---------------------------------END MODAL HAPUS------------------------------------>

<div class="zidx2">
  <div class="d-flex justify-content-between" id="judul">
    <h3 class="text-primary" style="font-weight: 600; letter-spacing: 2px;">Barang Masuk</h3>
    <div class="d-flex align-items-center">
      <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modaltambah"> Tambah Barang Masuk</button>
    </div>
  </div>
  <div id="tabelajax">

  </div>
</div>

<script type="text/javascript">
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
          $('[type=text]').val('');
          $('#nmbrg_masuk').val('');
          swal({
            title: "Berhasil Menambah Data",
            icon: "success",
            button: false,
            timer: 1200
          });
        }
      })
    });

    $('#formedit').on('submit', function(e) {
      e.preventDefault();
      $.ajax({
        type: $(this).attr('method'),
        url: $(this).attr('action'),
        data: $(this).serialize(),
        success: function() {
          loadtabel();
          $('#modaledit').modal('hide');
          swal({
            title: 'Berhasil Update Data',
            icon: 'success',
            timer: 1200,
            button: false
          })
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
          loadtabel();
          swal({
            title: 'Berhasil Menghapus Data',
            icon: 'success',
            button: false,
            timer: 1200
          })
          $('#modalhapus').modal('hide')
        }
      })
    })

    // $('#btntambah').on('click', function() {
    //   var data = $('#formadd').serialize();
    //   $.ajax({
    //     type: 'POST',
    //     url: "masuktambah.php",
    //     data: data,
    //     success: function() {
    //       $('#tabelajax').load('tampil.php');
    //     }
    //   });
    // });
    // $('#btnedit').on('click', function() {
    //   var data = $('#formedit').serialize();
    //   $.ajax({
    //     type: 'POST',
    //     url: "masukedit.php",
    //     data: data,
    //     success: function() {
    //       $('#tabelajax').load('tampil.php');
    //     }
    //   });
    // });
    // $('#btnhapus').on('click', function() {
    //   var data = $('#formdel').serialize();
    //   $.ajax({
    //     type: 'POST',
    //     url: "masukdel.php",
    //     data: data,
    //     success: function() {
    //       $('#tabelajax').load('tampil.php');
    //     }
    //   });
    // });
    // MASUKKAN DATA KE MODAL DI BARANG MASUK
    $(document).on("click", "#editbtn_brgmasuk", function() {
      $("#modaledit #editidbrg_masuk").val($(this).data('id'));
      $("#modaledit #editnmbrg_masuk").val($(this).data('nm'));
      $("#modaledit #editjml_masuk").val($(this).data('jml'));
      $("#modaledit #editketerangan_masuk").val($(this).data('ket'));
    });
    $(document).on('click', '#hapusbtn_brgmasuk', function() {
      $("#modalhapus #id_pembelian").val($(this).data('id'));
      $("#modalhapus #nmbrghapus").html($(this).data('nm'));
      $("#modalhapus #idbrghapus").html($(this).data('id'));
    });
  });

  function loadtabel() {
    jQuery.get('tampil.php', function(data) {
      $('#tabelajax').html(data)
    })
  }
</script>

<?php
include_once "../../_foot.php";
?>