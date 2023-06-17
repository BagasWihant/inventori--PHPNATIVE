<?php
require_once "config/config.php";
if (!isset($_SESSION['user'])) {
    echo "<script>window.location='" . base_url('sesi') . "'</script>";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv='cache-control' content='no-cache'>
    <meta http-equiv='expires' content='0'>
    <meta http-equiv='pragma' content='no-cache'>
    <title>APL</title>

    <script src="<?= base_url('bootstrap/jquery.js') ?>"></script>
    <script src="<?= base_url('aset/sweetalert.min.js') ?>"></script>
    <link rel="stylesheet" href="<?= base_url('bootstrap/css/bootstrap.min.css') ?>">
    <!-- online -->
    <!-- <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" /> -->
    <!-- offline -->
    <link rel="stylesheet" href="<?= base_url('fa/css/all.min.css') ?>">

    <link rel="stylesheet" href="<?= base_url('bootstrap/style.css') ?>">
    <link rel="stylesheet" href="<?= base_url('datatabel/dataTables.bootstrap4.min.css') ?>">

</head>

<body>

    <div class="wrapper fixed-left">

        <nav id="navbar" class="navbar navbar-expand-lg fixed-top">
            <button id="sidebarCollapse" class="btn navbar-btn">
                <i class="fas fa-lg fa-bars"></i>
            </button>
            <a class="navbar-brand py-0 text-white" href="">
                <h3 id="logo">Wihant</h3>
            </a>
            <div class="ml-auto">
                <div class="dropdown">
                    <button class="text-white btn dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-user "></i> <?= $_SESSION['nama']; ?>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right animate slideIn" aria-labelledby=" dropdownMenu2">
                        <a href="#" class="dropdown-item" type="button">Profile</a>
                        <div class="dropdown-divider"></div>
                        <a href="<?= base_url('sesi/logout.php') ?>" class="btn btn-danger btn-block" type="button">Logout</a>
                    </div>
                </div>
            </div>
        </nav>
        <nav id="sidebar">
            <div class="sidebar-header mt-1 mb-2 text-center">
                <h4 style="letter-spacing: 10px; font-weight: 700;"><strong><?= $_SESSION['level'] == '1' ? 'ADMIN' : 'Karyawan'; ?></strong></h4>
                <span style="letter-spacing: 2px; "><?= $_SESSION['nama']; ?></span>
            </div>

            <ul class="navbar-nav">
                <li <?= $uri_segments == '/ta/main/dashboard/' ? 'class="activepage"' : '' ?>><a href="<?= base_url('main/dashboard') ?>"><i class="fas fa-clipboard"></i>Dashboard</a></li>
                <li <?= $uri_segments == '/ta/main/databarang/' ? 'class="activepage"' : '' ?>><a href="<?= base_url('main/databarang') ?>"><i class="fas fa-user-cog"></i>Data Barang</a></li>

                <li class="tomboldrop"> <a id="updown">
                        <i class="fas fa-money-check-alt"></i>
                        Transaksi
                        <i class="float-right mt-1 mr-2 fas fa-chevron-down"></i></a>
                    <ul class="navbar-nav ml-2">
                        <li <?= $uri_segments == '/ta/main/barangMasuk/' ? 'class="activepage"' : '' ?>><a href="<?= base_url('main/barangMasuk') ?>"><i class="fas fa-cart-plus"></i>Barang Masuk</a></li>
                        <li <?= $uri_segments == '/ta/main/barangKeluar/' ? 'class="activepage"' : '' ?>><a href="<?= base_url('main/barangKeluar') ?>"><i class="fas fa-store-alt"></i>Barang Keluar</a></li>
                    </ul>
                </li>
                <li class="tomboldrop"> <a id="updown">
                        <i class="fas fa-money-check-alt"></i>
                        LAPORAN
                        <i class="float-right mt-1 mr-2 fas fa-chevron-down"></i></a>
                    <ul class="navbar-nav ml-2">
                        <li <?= $uri_segments == '/ta/main/lap_beli/' ? 'class="activepage"' : '' ?>><a href="<?= base_url('main/lap_beli') ?>"><i class="fas fa-cart-plus"></i>Laporan Pembelian</a></li>
                        <li <?= $uri_segments == '/ta/main/lap_jual/' ? 'class="activepage"' : '' ?>><a href="<?= base_url('main/lap_jual') ?>"><i class="fas fa-store-alt"></i>Laporan Penjualan</a></li>
                    </ul>
                </li>

                <?php
                if ($_SESSION['level'] == 1) { ?>
                    <li><a href="<?= base_url('#') ?>"><i class="fas fa-info"></i>Tentang Aplikasi</a></li>
                <?php
                }
                ?>
            </ul>
        </nav>

        <script>
            $(window).on("load", function() {
                setTimeout($('#isikonten').fadeIn("slow"), 5000)
                setTimeout($('.loader').fadeOut("slow"), 5000)
            })
            $(document).ready(function() {
                $('.tomboldrop').each(function() {
                    $('#updown', this).on('click', function() {
                        $(this).next().slideToggle();
                        console.log($(this).next())

                        $('.fa-chevron-down', this).toggleClass('fa-chevron-up');
                    });

                });
                $('#sidebarCollapse').on('click', function() {
                    $('#sidebar, #content').toggleClass('sideoff');
                    $('#navbar').toggleClass('navoff')
                });

            });
        </script>
        <div id="allcontent">

            <div class="loader row justify-content-center h-100">
                <img class="align-middle" src="<?= base_url('aset/Spinner-1s-200px.svg') ?>" alt="">
            </div>
            <div class="custom-shape-divider-top-1628258194">
                <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 120" preserveAspectRatio="none">
                    <path d="M0,0V46.29c47.79,22.2,103.59,32.17,158,28,70.36-5.37,136.33-33.31,206.8-37.5C438.64,32.43,512.34,53.67,583,72.05c69.27,18,138.3,24.88,209.4,13.08,36.15-6,69.85-17.84,104.45-29.34C989.49,25,1113-14.29,1200,52.47V0Z" opacity=".25" class="shape-fill"></path>
                    <path d="M0,0V15.81C13,36.92,27.64,56.86,47.69,72.05,99.41,111.27,165,111,224.58,91.58c31.15-10.15,60.09-26.07,89.67-39.8,40.92-19,84.73-46,130.83-49.67,36.26-2.85,70.9,9.42,98.6,31.56,31.77,25.39,62.32,62,103.63,73,40.44,10.79,81.35-6.69,119.13-24.28s75.16-39,116.92-43.05c59.73-5.85,113.28,22.88,168.9,38.84,30.2,8.66,59,6.17,87.09-7.5,22.43-10.89,48-26.93,60.65-49.24V0Z" opacity=".5" class="shape-fill"></path>
                    <path d="M0,0V5.63C149.93,59,314.09,71.32,475.83,42.57c43-7.64,84.23-20.12,127.61-26.46,59-8.63,112.48,12.24,165.56,35.4C827.93,77.22,886,95.24,951.2,90c86.53-7,172.46-45.71,248.8-84.81V0Z" class="shape-fill"></path>
                </svg>
            </div>
            <div id="isikonten" style="display: none;">