<?php
require("db.php");

if(isset($_GET['add_location'])) {
    add_location();
}
if(isset($_GET['addBengkel'])) {
    addBengkel();
}
if(isset($_GET['editBengkel'])) {
    editBengkel();
}
function query($query) {
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while( $row = mysqli_fetch_assoc($result) ) {
        $rows[] = $row;
    }
    return $rows;
}

function addBengkel(){
    global $conn;
    $nama_bengkel = $_GET['nama_bengkel'];
    $pemilik = $_GET['pemilik'];
    $hp = $_GET['hp'];
    $lat = $_GET['lat'];
    $lng = $_GET['lng'];
    $query = "INSERT INTO bengkel
                VALUES 
              (null,'$nama_bengkel','$pemilik','$hp','$lat','$lng')
            ";  
    $result = mysqli_query($conn,$query);
    echo json_encode("Berhasil Menambahkan Data");
    if (!$result) {
        die('Invalid query: ' . mysqli_error($conn));
    }
}
function editBengkel(){
    global $conn;
    $id = $_GET['id'];
    $nama_bengkel = $_GET['nama_bengkel'];
    $pemilik = $_GET['pemilik'];
    $hp = $_GET['hp'];
    $lat = $_GET['lat'];
    $lng = $_GET['lng'];
    
    $query = "UPDATE bengkel SET
            nama_bengkel = '$nama_bengkel',
            pemilik = '$pemilik',
            hp = '$hp',
            $lat = '$lat',
            $lng = '$lng'
            WHERE id = '".$id."'
            ";  
    $result = mysqli_query($conn,$query);
    echo json_encode("Berhasil Mengubah Data");
    if (!$result) {
        die('Invalid query: ' . mysqli_error($conn));
    }
}

function get_saved_locations(){
    global $conn;
    // update location with location_status if admin location_status.
    $sqldata = mysqli_query($conn,"select lng,lat from bengkel ");

    $rows = array();
    while($r = mysqli_fetch_assoc($sqldata)) {
        $rows[] = $r;

    }
    $indexed = array_map('array_values', $rows);

    //  $array = array_filter($indexed);

    echo json_encode($indexed);
    if (!$rows) {
        return null;
    }
}

?>