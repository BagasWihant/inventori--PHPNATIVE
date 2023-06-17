<?php

$servername = "localhost";
$database = "ta";
$username = "root";
$password = "";

session_start();

$con = mysqli_connect($servername, $username, $password, $database);

if (mysqli_connect_errno()) {
    echo  mysqli_connect_error();
}
date_default_timezone_set('Asia/Jakarta');

function query($query)
{
    global $con;
    $hasil = mysqli_query($con, $query);
    $data = [];
    while ($row = mysqli_fetch_assoc($hasil)) {
        $data[] = $row;
    }
    return $data;
};

function base_url($url = null)
{
    $base_url = "http://localhost/tugas-akhir";
    if ($url != null) {
        return $base_url . "/" . $url;
    } else {
        return $base_url;
    }
}


$uri_segments = $_SERVER['REQUEST_URI'];
// $uri_segments = $_SERVER['HTTP_HOST'];

