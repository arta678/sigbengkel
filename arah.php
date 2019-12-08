<?php
session_start();
$title = "Peta Bengkel";
include 'config.php';
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
      <link href='https://api.tiles.mapbox.com/mapbox-gl-js/v1.5.0/mapbox-gl.css' rel='stylesheet' />
   </head>
   <body>
      <div class="d-flex" id="wrapper">
         <?php include 'sidebar.php'; ?>
         <div id="page-content-wrapper">
            <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
               <button class="btn btn-light" id="menu-toggle"><span class="navbar-toggler-icon"></span></button>
            </nav>
            <div class="container-fluid">
               <h2 class="mt-3 mb-3"><?= $title ?></h2>
               <div class="row">
                  
                  <div class="col-md-12">
                     <!-- <form action="" id="signupForm" name="tambahBengkel"> -->
                        <div class="form-group row">
                           <div class="col-md-12">
                              <div class="geocoder mb-2 mt-3">
                                 <div id="geocoder" ></div>
                              </div>
                              <div id="map"></div>
                           </div>
                        </div>
                     <!-- </form> -->
                  </div>
               </div>
            </div>
         </div>
      </div>

      <script src="vendor/jquery/jquery.min.js"></script>
      <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
      <script src='https://api.tiles.mapbox.com/mapbox-gl-js/v0.48.0/mapbox-gl.js'></script>
      <!-- <script src="js/mapbox.js"></script> -->
      <link href='https://api.tiles.mapbox.com/mapbox-gl-js/v0.48.0/mapbox-gl.css' rel='stylesheet' />
      <script src='https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v2.3.0/mapbox-gl-geocoder.min.js'></script>
      <link rel='stylesheet' href='https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v2.3.0/mapbox-gl-geocoder.css' type='text/css' />
      <script src='https://api.tiles.mapbox.com/mapbox-gl-js/v1.5.0/mapbox-gl.js'></script>
      <script src='https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-directions/v4.0.2/mapbox-gl-directions.js'></script>
<link rel='stylesheet' href='https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-directions/v4.0.2/mapbox-gl-directions.css' type='text/css' />

      <!-- Menu Toggle Script -->
      <script>
      $("#menu-toggle").click(function(e) {
      e.preventDefault();
      $("#wrapper").toggleClass("toggled");
      });
      var tujuan = '<?php echo $_GET["tujuan"] ?>';
        mapboxgl.accessToken = 'pk.eyJ1Ijoid2lndW5hIiwiYSI6ImNrMXg5MmhiNjBhNHEzYnM1b21yNDdjeTMifQ.2c3Vcum4fp-j83FLQt4asA';
        var map = new mapboxgl.Map({
            container: 'map',
            style: 'mapbox://styles/mapbox/streets-v9',
            center: [115.1622363,-8.6512212],
            zoom: 14
        });
        map.on('load', function() {
          var directions = new MapboxDirections({
            accessToken: mapboxgl.accessToken
          });
          map.addControl(directions, 'top-left');
          directions.setOrigin('115.20437,-8.69682');
          directions.setDestination(tujuan);
        });

        map.addControl(new mapboxgl.NavigationControl());
        // map.addControl(new mapboxgl.GeolocateControl({
        //   positionOptions: {
        //   enableHighAccuracy: true
        //   },
        //   trackUserLocation: true
        //   }));
      </script>
   </body>
</html>