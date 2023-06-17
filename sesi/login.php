<?php
require_once "../config/config.php";
if (isset($_SESSION['user'])) {
   echo "<script>window.location='" . base_url() . "'</script>";
} else {
?>

   <!DOCTYPE html>
   <html lang="en">

   <head>
      <title>Login</title>
      <link rel="stylesheet" href="<?= base_url('bootstrap/css/bootstrap.min.css') ?>" type="text/css">
      <link rel="stylesheet" href="<?= base_url('fa/css/all.min.css') ?>">
      <link rel="stylesheet" href="login.css">
   </head>

   <body class="text-center">
      <div class="form-signin">
         <h1 class="mb-2 text-light"><i class="fas fa-user"></i></h1>
         <h1 class="h3 mb-3 font-weight-normal text-light">Login Dahulu</h1>
         <input type="text" id="user" class="form-control" placeholder="Username" required autofocus>
         <input type="password" id="pass" class="form-control" placeholder="Password" required>
         
         <button class="mt-5 btn btn-lg btn-primary btn-block" id="submit" type="submit">Sign in</button>
         <p class="mt-5 mb-3 text-muted">&copy; Bagas Wihant</p>
      </div>

      <script src="<?= base_url('bootstrap/jquery.js') ?>"></script>
      <script src="<?= base_url('bootstrap/js/bootstrap.min.js') ?>"></script>
      <script src="<?= base_url('aset/sweetalert.min.js') ?>"></script>
      <script>
         $('#submit').on('click', function() {
            var user = $("#user").val();
            var pass = $("#pass").val();
            if (user.length == "") {
               swal({
                  icon: 'warning',
                  title: 'Oops...',
                  text: 'Username Wajib Diisi !'
               });
            } else if (pass.length == "") {
               swal({
                  icon: 'warning',
                  title: 'Oops...',
                  text: 'Password Wajib Diisi !'
               });
            } else {
               $.ajax({
                  url: "loginaksi.php",
                  type: "POST",
                  data: {
                     "user": user,
                     "pass": pass,
                  },
                  success: function(response) {

                     if (response == "success") {

                        swal({
                              timer: 1200,
                              icon: 'success',
                              title: 'Login Berhasil !',
                              text: 'Tunggu beberapa saat anda sedang dialihkan..',
                              button:false
                           })
                           .then(function() {
                              window.location.href = '<?= base_url() ?>';
                           });

                     } else {

                        swal({
                           icon: 'error',
                           title: 'Oops...',
                           text: 'Mohon Periksa Kembali !!'
                        });

                     }
                  },
               });
            }
         });
      </script>

   </body>

   </html>
<?php
} ?>