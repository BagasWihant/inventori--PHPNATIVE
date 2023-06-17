<?php
if (isset($_POST['tomboltambah'])) {
  $nmbrg = strtoupper($_POST['nmbrg']);
  $hbeli = $_POST['hbeli'];
  $hjual = $_POST['hjual'];

  $tambah =  "INSERT INTO databrg VALUES('', '$nmbrg' , '$hbeli' , '$hjual')";
  mysqli_query($con, $tambah);
}
