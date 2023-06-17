<?php
include_once "../../_head.php";
?>

<div class="zidx2">
  <h3 id="judul" class="text-primary" style="font-weight: 600; letter-spacing: 2px;">Dashboard</h3>
</div>
<div class="container-fluid">
  <div class="row m-1 d-flex justify-content-center">
    <div class="card m-3">
      <div class="m-2 d-flex flex-row">
        <h4 class="card-icon bg-warning text-white "><i class="fas fa-user"></i></h4>
        <medium class="card-title text-secondary mx-3">
          Total Semua User
          <h3 class="text-dark"><?= count(query("SELECT * FROM tbuser")); ?></h3>
        </medium>
      </div>
      <div class="card-footer text-center bg-warning">
        <a class="text-white" href="<?= base_url('main/users/') ?>">LIHAT <i class="fas fa-eye"></i></a>
      </div>
    </div>
    <div class="card m-3">
      <div class="m-2 d-flex flex-row">
        <h4 class="card-icon bg-danger text-white "><i class="fas fa-user"></i></h4>
        <medium class="card-title text-secondary mx-3">
          Total Semua Barang
          <h3 class="text-dark"><?= count(query("SELECT * FROM tb_barang")) ?></h3>
        </medium>
      </div>
      <div class="card-footer text-center bg-danger">
        <a class="text-white" href="<?= base_url('main/databarang/') ?>">LIHAT <i class="fas fa-eye"></i></a>
      </div>
    </div>
    <div class="card m-3">
      <div class="m-2 d-flex flex-row">
        <h4 class="card-icon bg-success text-white "><i class="fas fa-user"></i></h4>
        <medium class="card-title text-secondary mx-3">
          Transaksi Masuk
          <h3 class="text-dark"><?= count(query("SELECT * FROM tb_brgMasuk")) ?></h3>
        </medium>
      </div>
      <div class="card-footer text-center bg-success">
        <a class="text-white" href="<?= base_url('main/barangMasuk/') ?>">LIHAT <i class="fas fa-eye"></i></a>
      </div>
    </div>
    <div class="card m-3">
      <div class="m-2 d-flex flex-row">
        <h4 class="card-icon bg-info text-white "><i class="fas fa-user"></i></h4>
        <medium class="card-title text-secondary mx-3">
          Transaksi Keluar
          <h3 class="text-dark"><?= count(query("SELECT * FROM tb_brgKeluar")) ?></h3>
        </medium>
      </div>
      <div class="card-footer text-center bg-info">
        <a class="text-white" href="<?= base_url('main/barangKeluar/') ?>">LIHAT <i class="fas fa-eye"></i></a>
      </div>
    </div>
  </div>


  <div class="row">

    <div class="col-md-6">
      <div class="alert alert-warning d-block" role="alert">
        Grafik Barang Keluar Harian Dalam 7 Hari
      </div>
      <div class="w-100">
        <canvas id="chartHarianKeluar"></canvas>
      </div>
    </div>
    <div class="col-md-6">
      <div class="alert alert-info d-block" role="alert">
        Grafik Barang Masuk Harian Dalam 7 Hari
      </div>
      <div class="w-100">
        <canvas id="chartHarianMasuk"></canvas>
      </div>
    </div>
  </div>
  <hr>
  <div class="row">
    <div class="col-md-12">
      <div class="alert alert-danger d-block" role="alert">
        BARANG HAMPIR HABIS ATAU SUDAH HABIS
      </div>

      <table class="table table-sm table-striped tbl-masuk">
        <thead>
          <tr>
            <th scope="col" width="2px">#</th>
            <th scope="col" width="100px">Nama Barang</th>
            <th scope="col" width="10px">Stock</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $no = 1;
          $sql = query("SELECT * FROM tb_barang WHERE stok_brg < 5");
          foreach ($sql as $data) {
            if ($data['stok_brg'] > 0 && $data['stok_brg'] < 5) {
              echo "<tr class='table-warning'>";
            } else {
              echo "<tr class='table-danger'>";
            } ?>
            <td><?= $no++ ?></td>
            <td><?= $data['nm_brg'] ?></td>
            <td><?= $data['stok_brg'] ?></td>
            </tr>
          <?php
          }
          ?>
        </tbody>
      </table>
    </div>
  </div>


</div>


<script>
  $(function() {
    today = new Date();
    var dd = String(today.getDate()).padStart(2, '0');
    var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
    var yyyy = today.getFullYear();

    today = dd + '-' + mm + '-' + yyyy;
    $.ajax({
      type: 'post',
      url: 'dataCharts.php',
      success: function(data) {
        data = JSON.parse(data);
        // DATA MASUK
        new Chart(
          document.getElementById('chartHarianMasuk'), {
            type: 'bar',
            data: {
              labels: data.masuk.map(row => row.tgl),
              datasets: [{
                label: 'Data Masuk harian',
                data: data.masuk.map(row => row.total),
                backgroundColor: [
                  'rgba(75, 192, 192, 0.2)'
                ],
                borderColor: [
                  'rgb(75, 192, 192)'
                ],
                borderWidth: 1
              }]
            }
          }
        );
        new Chart(
          document.getElementById('chartHarianKeluar'), {
            type: 'bar',
            data: {
              labels: data.keluar.map(row => row.tgl),
              datasets: [{
                label: 'Data Keluar harian',
                data: data.keluar.map(row => row.total),
                backgroundColor: [
                  'rgba(255, 205, 86, 0.2)',
                ],
                borderColor: [
                  'rgb(255, 205, 86)',
                ],
                borderWidth: 1
              }]
            }
          }
        );

      }
    })
  });
</script>
<?php
include_once "../../_foot.php";
?>