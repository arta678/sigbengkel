<?php
$title = "Data Bengkel";
include 'config.php';
$dataBengkel = query("SELECT * FROM bengkel");
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
          <h2 class="mt-3 mb-3"><?= $title ?></h2>
            <a href="tambahBengkel.php"><button type="button" class="btn btn-info">Tambah</button></a>
          <table class="table table-striped mt-3 table-sm">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Nama Bengkel</th>
                <th scope="col">Pemilik</th>
                <th scope="col">Nomor Hp</th>
                <th scope="col">Aksi</th>
              </tr>
            </thead>
            <tbody>
              
                <?php $i=1; ?>
                <tr>
                <?php foreach ($dataBengkel as $baris) {?>
                    <th scope="row"><?= $i ?></th>
                    <td><?= $baris["nama_bengkel"]; ?></td>
                    <td><?= $baris["pemilik"]; ?></td>
                    <td><?= $baris["hp"]; ?></td>
                    <td><a href="editBengkel.php?id=<?= $baris["id"]; ?>"><button class="btn btn-info" type="button">Edit</button></a></td>
                    <?php $i++ ?>
                    </tr>
              <?php   } ?>
                
             
            </tbody>
          </table>
          
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

      var saved_markers = <?= get_saved_locations() ?>;
        var user_location = [77.216721,28.644800];
        mapboxgl.accessToken = 'pk.eyJ1Ijoid2lndW5hIiwiYSI6ImNrMXg5MmhiNjBhNHEzYnM1b21yNDdjeTMifQ.2c3Vcum4fp-j83FLQt4asA';

        var map = new mapboxgl.Map({
            container: 'map',
            style: 'mapbox://styles/mapbox/streets-v9',
            center: user_location,
            zoom: 16
        });
        //  geocoder here
        var geocoder = new MapboxGeocoder({
            accessToken: mapboxgl.accessToken,
            // limit results to Australia
            //country: 'IN',
        });

        var marker ;

        // After the map style has loaded on the page, add a source layer and default
        // styling for a single point.
        map.on('load', function() {
            addMarker(user_location,'load');
            add_markers(saved_markers);

            // Listen for the `result` event from the MapboxGeocoder that is triggered when a user
            // makes a selection and add a symbol that matches the result.
            geocoder.on('result', function(ev) {
                // alert("aaaaa");
                console.log(ev.result.center);

            });
        });
        map.on('click', function (e) {
            marker.remove();
            addMarker(e.lngLat,'click');
            //console.log(e.lngLat.lat);
            document.getElementById("lat").value = e.lngLat.lat;
            document.getElementById("lng").value = e.lngLat.lng;

        });

        function addMarker(ltlng,event) {

            if(event === 'click'){
                user_location = ltlng;
            }
            marker = new mapboxgl.Marker({draggable: true,color:"#d02922"})
                .setLngLat(user_location)
                .addTo(map)
                .on('dragend', onDragEnd);
        }
        function add_markers(coordinates) {
            var geojson = (saved_markers == coordinates ? saved_markers : '');
            console.log(geojson);
            // add markers to map
            geojson.forEach(function (marker) {
                console.log(marker);
                // make a marker for each feature and add to the map
                new mapboxgl.Marker()
                    .setLngLat(marker)
                    .setPopup(popup)
                    .addTo(map);
            });

        }

        function onDragEnd() {
            var lngLat = marker.getLngLat();
            document.getElementById("lat").value = lngLat.lat;
            document.getElementById("lng").value = lngLat.lng;
            console.log('lng: ' + lngLat.lng + '<br />lat: ' + lngLat.lat);
        }
          $('#signupForm').submit(function(event){
            event.preventDefault();
            var nama_bengkel = $('#nama_bengkel').val();
            var pemilik = $('#pemilik').val();
            var hp = $('#hp').val();
            var lat = $('#lat').val();
            var lng = $('#lng').val();
            var url = 'locations_model.php?addBengkel&nama_bengkel='+ nama_bengkel +'&pemilik='+ pemilik +'&hp='+ hp +'&lat=' + lat + '&lng=' + lng;
            $.ajax({
                url: url,
                method: 'GET',
                dataType: 'json',
                success: function(data){
                    alert(data);
                    resetForms();
                    location.reload();
                    
                }
            });
        });
        function resetForms() {
            document.forms['tambahBengkel'].reset();
        }

        document.getElementById('geocoder').appendChild(geocoder.onAdd(map));
        map.addControl(new mapboxgl.NavigationControl());
      </script>
   </body>
</html>