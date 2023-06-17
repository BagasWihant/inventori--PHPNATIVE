<?php
require_once "config/config.php";
if (isset($_SESSION['user'])) {
    echo "<script>window.location='" . base_url('main') . "'</script>";
} else {
    echo "<script>window.location='" . base_url('sesi/login.php') . "'</script>";
}
