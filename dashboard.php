<?php
session_start();
$title = "Dashboard";
include 'config.php';
$sql = mysqli_query($conn, "SELECT * FROM bengkel");
$hasil = mysqli_num_rows($sql);
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title><?= $title ?></title>
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/simple-sidebar.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
  </head>
  <body>
    <div class="d-flex" id="wrapper">
      <?php include 'sidebar.php'; ?>
      <div id="page-content-wrapper">
        <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
          <button class="btn btn-light" id="menu-toggle"><span class="navbar-toggler-icon"></span></button>
        </nav>
        <div class="container-fluid">
          <!-- <h2 class="mt-3 mb-3"><?= $title ?></h2> -->
          <h1 class="text-secondary py-5">Selamat Datang <u class="text-uppercase"><?=$_SESSION['username'] ?></u></h1>
            <div class="">
                <div class="card col-md-4 no-padding border-0 mb-2 bg-secondary ml-lg-1 rounded shadow-sm dash-card trans">
                <div class="card-body">
                  <div class="h1 text-light text-right mb-4">
                    <i class="fas fa-cash-register"></i>
                  </div>
                  <div>
                    <div class="h4 mb-0 text-light">
                      <h2><span class=""><?=$hasil ?></span></h2>
                    </div>
                    <small class="text-light text-uppercase font-weight-bold">Total Bengkel saat ini</small>
                  </div>
                  <div class="progress progress-xs mt-3 mb-0" style="width: 40%; height: 5px;"></div>
                </div>
              </div>
            </div>
          
        </div>
      </div>
    </div>
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src='https://api.tiles.mapbox.com/mapbox-gl-js/v0.48.0/mapbox-gl.js'></script>
    <link href='https://api.tiles.mapbox.com/mapbox-gl-js/v0.48.0/mapbox-gl.css' rel='stylesheet' />
    <script src='https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v2.3.0/mapbox-gl-geocoder.min.js'></script>
    <link rel='stylesheet' href='https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v2.3.0/mapbox-gl-geocoder.css' type='text/css' />
      <script>
      $("#menu-toggle").click(function(e) {
      e.preventDefault();
      $("#wrapper").toggleClass("toggled");
      });

      </script>
   </body>
</html>