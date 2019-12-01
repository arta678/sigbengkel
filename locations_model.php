<?php
require("db.php");

// Gets data from URL parameters.
if(isset($_GET['add_location'])) {
    add_location();
}
if(isset($_GET['addBengkel'])) {
    addBengkel();
}
function add_location(){
    global $conn;
    $lat = $_GET['lat'];
    $lng = $_GET['lng'];
    // Inserts new row with place data.
    $query = sprintf("INSERT INTO locations " .
        " (id, lat, lng) " .
        " VALUES (NULL, '%s', '%s');",
        mysqli_real_escape_string($conn,$lat),
        mysqli_real_escape_string($conn,$lng));

    $result = mysqli_query($conn,$query);
    echo json_encode("Berhasil Menambahkan Data");
    if (!$result) {
        die('Invalid query: ' . mysqli_error($conn));
    }
}
function addBengkel(){
    global $conn;
    $nama_bengkel = $_GET['nama_bengkel'];
    $pemilik = $_GET['pemilik'];
    $hp = $_GET['hp'];
    $lat = $_GET['lat'];
    $lng = $_GET['lng'];
    // Inserts new row with place data.
    // $query = sprintf("INSERT INTO locations " .
    //     " (id, lat, lng) " .
    //     " VALUES (NULL, '%s', '%s');",
    //     mysqli_real_escape_string($conn,$lat),
    //     mysqli_real_escape_string($conn,$lng));
    // $query = "INSERT INTO bengkel 
    // VALUES 
    // (NULL,'$nama_bengkel','$pemilik','$hp','$lat','$lng')";
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
function get_saved_locations(){
    global $conn;
    // update location with location_status if admin location_status.
    $sqldata = mysqli_query($conn,"select lng,lat from locations ");

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