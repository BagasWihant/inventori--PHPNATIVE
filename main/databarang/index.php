<?php
include_once "../../_head.php";
?>


<!-- +++++++++++++++++++=================================== -->
<div class="modal fade" id="modaladdbrg" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
    <div class="modal-content">
      <h4 class="text-center modal-title w-100">Jumlah Barang yang ditambahkan</h4>
      <form action="jumlahadd.php" method="POST">
        <div class="d-flex flex-column align-items-center">
          <input type="text" class="form-control w-75 my-1" pattern="[0-9]+" maxlength="2" name="jmladdbrg" id="jmladdbrg" required />
          <button type="submit" name="submit" class="btn btn-primary my-2">Tambah</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- +++++++++++++++++++=================================== -->

  <div class="zidx2 container">
    <div >
      <div id="judul" class="d-flex justify-content-between">
        <h3 class="text-primary" style="font-weight: 600; letter-spacing: 2px;">Data Barang</h3>
        <div class="d-flex align-items-center">
          <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#modaladdbrg"> Barang Baru</button>
        </div>
      </div>
    </div>


  <div class="float-right">
    <button class="btn btn-sm btn-warning" onclick="edit()">Edit</button>
    <button class="btn btn-sm btn-danger" onclick="hapus()">Hapus</button>
  </div>
  <!---------------------------------TABEL------------------------------------>
  <div id="tabelajax">

  </div>

</div>


<script>
  $(document).ready(function() {

    loadtabel();

    $('#modaladdbrg').on('shown.bs.modal', function() {
      $('input:text:visible:first').focus();
    });

  })

  function loadtabel() {
    jQuery.get('tampil.php', function(data) {
      $('#tabelajax').html(data)
    })
  }

  function hapus() {
    if ($('.pilih:checked').length == 0) {
      swal({
        icon: 'warning',
        title: 'Mohon pilih salah satu data',
      });
    } else {
      swal({
          title: "Apakah Yakin Menghapus ?",
          text: "Kamu tidak bisa mengembalikan data jika sudah terhapus!!!",
          icon: "warning",

          buttons: ["Tidak Batalkan", "Ya Hapus Data ! !"],
          dangerMode: true,
        })
        .then((willDelete) => {
          if (willDelete) {
            $.ajax({
              type: 'post',
              url: 'del.php',
              data: $('#databrg').serialize(),
              success: function() {
                swal({
                  title: "Berhasil menghapus Data!",
                  text: "Mohon tunggu!",
                  icon: "success",
                  timer: 1000,
                  buttons: false
                })
                loadtabel()
              }
            })
            // swal({
            //     title: "Berhasil menghapus Data!",
            //     text: "Mohon tunggu!",
            //     icon: "success",
            //     timer: 1800,
            //     buttons: false
            //   })
            //   .then(function() {
            //     document.databrg.action = "del.php";
            //     $('#databrg').submit();
            //   })
          } else {
            swal({
              text: "Tidak Jadi Menghapus Data",
              buttons: false,
              icon: "info"
            });
          }
        });
    }

  }

  function edit() {
    if ($('.pilih:checked').length == 0) {
      swal({
        icon: 'warning',
        title: 'Mohon pilih salah satu data',
      });
    } else {
      document.getElementById("databrg").action = "edit.php";
      $('#databrg').submit();
    }
  }
</script>
<?php

include_once "../../_foot.php";
?>