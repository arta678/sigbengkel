<?php
$title = "Peta Bengkel";
include 'config.php';
// $bengkel = mysqli_fetch_assoc(mysqli_query($conn,"select * from bengkel "));
$bengkel = query("select * from bengkel ");
// echo $bengkel;
// foreach ($bengkel as $baris) {
//     echo $baris["nama_bengkel"];
// }
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
      <style type="text/css">
        .sidebar {
          position:absolute;
          width:20%;
          height:100%;
          top:0;left:0;
          overflow:hidden;
          border-right:1px solid rgba(0,0,0,0.25);
        }
        .pad2 {
          padding:20px;
        }

        .map {
          position:absolute;
          left:20%;
          width:66.6666%;
          top:0;bottom:0;
        }

        h1 {
          font-size:22px;
          margin:0;
          font-weight:400;
          line-height: 20px;
          padding: 20px 2px;
        }

        a {
          color:#404040;
          text-decoration:none;
        }

        a:hover {
          color:#101010;
        }

        .heading {
          background:#fff;
          border-bottom:1px solid #eee;
          min-height:60px;
          line-height:60px;
          padding:0 10px;
          background-color: #00853e;
          color: #fff;
        }

        .listings {
          height:100%;
          overflow:auto;
          padding-bottom:60px;
        }

        .listings .item {
          display:block;
          border-bottom:1px solid #eee;
          padding:10px;
          text-decoration:none;
        }

        .listings .item:last-child { border-bottom:none; }
        .listings .item .title {
          display:block;
          color:#00853e;
          font-weight:700;
        }

        .listings .item .title small { font-weight:400; }
        .listings .item.active .title,
        .listings .item .title:hover { color:#8cc63f; }
        .listings .item.active {
          background-color:#f8f8f8;
        }
        ::-webkit-scrollbar {
          width:3px;
          height:3px;
          border-left:0;
          background:rgba(0,0,0,0.1);
        }
        ::-webkit-scrollbar-track {
          background:none;
        }
        ::-webkit-scrollbar-thumb {
          background:#00853e;
          border-radius:0;
        }

        .marker {
          border: none;
          cursor: pointer;
          height: 56px;
          width: 56px;
          background-image: url(marker.png);
          background-color: rgba(0, 0, 0, 0);
        }

        .clearfix { display:block; }
        .clearfix:after {
          content:'.';
          display:block;
          height:0;
          clear:both;
          visibility:hidden;
        }

        /* Marker tweaks */
        .mapboxgl-popup {
          padding-bottom: 50px;
        }

        .mapboxgl-popup-close-button {
          display:none;
        }
        .mapboxgl-popup-content {
          font:400 15px/22px 'Source Sans Pro', 'Helvetica Neue', Sans-serif;
          padding:0;
          width:180px;
        }
        .mapboxgl-popup-content-wrapper {
          padding:1%;
        }
        .mapboxgl-popup-content h3 {
          background:#91c949;
          color:#fff;
          margin:0;
          display:block;
          padding:10px;
          border-radius:3px 3px 0 0;
          font-weight:700;
          margin-top:-15px;
        }

        .mapboxgl-popup-content h4 {
          margin:0;
          display:block;
          padding: 10px 10px 10px 10px;
          font-weight:400;
        }

        .mapboxgl-popup-content div {
          padding:10px;
        }

        .mapboxgl-container .leaflet-marker-icon {
          cursor:pointer;
        }

        .mapboxgl-popup-anchor-top > .mapboxgl-popup-content {
          margin-top: 15px;
        }

        .mapboxgl-popup-anchor-top > .mapboxgl-popup-tip {
          border-bottom-color: #91c949;
        }

        .mapboxgl-ctrl-geocoder {
          border: 2px solid #00853e;
          border-radius: 0;
          position: relative;
          top: 0;
          width: 800px;
          margin-top: 0;
          border: 0;
        }

        .mapboxgl-ctrl-geocoder > div {
          min-width:100%;
          margin-left:0;
        }
      </style>
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
                              <div class='sidebar'>
                                <div class='heading'>
                                  <h1>Bengkel</h1>
                                </div>
                              <div id='listings' class='listings'></div>
                              </div>
                              <div id="map" class='map'></div>
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


      var lokasiBengkel = <?= get_saved_locations() ?>;
        var user_location = [115.1622363,-8.6512212];
        mapboxgl.accessToken = 'pk.eyJ1Ijoid2lndW5hIiwiYSI6ImNrMXg5MmhiNjBhNHEzYnM1b21yNDdjeTMifQ.2c3Vcum4fp-j83FLQt4asA';
        var map = new mapboxgl.Map({
            container: 'map',
            style: 'mapbox://styles/mapbox/streets-v9',
            center: user_location,
            zoom: 14
        });

        //  geocoder here
        var geocoder = new MapboxGeocoder({
            accessToken: mapboxgl.accessToken,
        });

        var marker ;
        map.on('load', function() {
            // addMarker(user_location,'load');
            // tampilkanLokasi(lokasiBengkel);
            geocoder.on('result', function(ev) {
                console.log(ev.result.center);
            });
            map.addLayer({
                "id": "places",
                "type": "symbol",
                "source": {
                    "type": "geojson",
                    "data": {
                        "type": "FeatureCollection",
                        "features": [
                        <?php foreach ($bengkel as $baris) {?>
                            {
                            "type": "Feature",
                            "properties": {
                                "description": "<h4><strong><?php echo $baris['nama_bengkel'] ?></strong></h4>",
                                "icon": "car"
                            },
                            "geometry": {
                                "type": "Point",
                                "coordinates": [<?php echo $baris['lng'] ?>,<?php echo $baris['lat'] ?>]
                            }
                        },
                        <?php  } ?>
                        
                        ]
                    }
                    },
                "layout": {
                "icon-image": "{icon}-15",
                "icon-allow-overlap": true
                }
                });
              
              // Saat marker diclick
              map.on('click', 'places', function (e) {
              var coordinates = e.features[0].geometry.coordinates.slice();
              var description = e.features[0].properties.description;
               
              // Ensure that if the map is zoomed out such that multiple
              // copies of the feature are visible, the popup appears
              // over the copy being pointed to.
              while (Math.abs(e.lngLat.lng - coordinates[0]) > 180) {
              coordinates[0] += e.lngLat.lng > coordinates[0] ? 360 : -360;
              }
               
              new mapboxgl.Popup()
              .setLngLat(coordinates)
              .setHTML(description)
              .addTo(map);
              });

              // menganti kursor jika diarahkan ke marker
              map.on('mouseenter', 'places', function () {
                  map.getCanvas().style.cursor = 'pointer';
              });
               
              // menganti kursor jika meninggalkan ke marker
              map.on('mouseleave', 'places', function () {
                  map.getCanvas().style.cursor = '';
              });



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

        function tampilkanLokasi(coordinates) {
            var geojson = (lokasiBengkel == coordinates ? lokasiBengkel : '');
            console.log(geojson);
            // add markers to map
            geojson.forEach(function (marker) {
                console.log(marker);
                // make a marker for each feature and add to the map
                new mapboxgl.Marker()
                    .setLngLat(marker)
                    .addTo(map);
            });

        }

        // membuat control navigasi
        map.addControl(new mapboxgl.NavigationControl());

        // membuat lokasi saya
        map.addControl(new mapboxgl.GeolocateControl({
          positionOptions: {
          enableHighAccuracy: true
          },
          trackUserLocation: true
          }));

        // membuat direction
        // map.addControl(new MapboxDirections({
        // accessToken: mapboxgl.accessToken
        // }), 'top-left');
      </script>
   </body>
</html>