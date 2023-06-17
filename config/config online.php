<?php
$servername = "localhost";
$database = "id16618151_ta";
$username = "id16618151_bagas";
$password = "w)DcXPMu{j&v3F(b";

session_start();

$con = mysqli_connect($servername, $username, $password, $database);

if (mysqli_connect_errno()) {
    echo  mysqli_connect_error();
}
function base_url($url = null)
{
    $base_url = "http://bagaawihant.000webhostapp.com";
    if ($url != null) {
        return $base_url . "/" . $url;
    } else {
        return $base_url;
    }
}


$uri_path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri_segments = explode('/', $uri_path);

function tambahbrg($data)
{
    global $con;
    $nmbrg = $_POST['nmbrg'];
    $hbeli = $_POST['hbeli'];
    $hjual = $_POST['hjual'];

    $tambah =  "INSERT INTO tbdatabrg 
                      VALUES 
                      ( NULL , '$nmbrg' , '$hbeli' , '$hjual')
                      ";
    mysqli_query($con, $tambah);
    return mysqli_affected_rows($con);
}
function hapusbrg($data){
    global $con;
$idbrg = $_POST['idbrg'];

$query = mysqli_query($con, "DELETE FROM tbdatabrg WHERE idbrg='$idbrg' ");

return mysqli_affected_rows($con);

}
