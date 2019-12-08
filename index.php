<?php
session_start();
$title = "Peta Bengkel";
include 'config.php';
$bengkel = query("select * from bengkel order by id desc");
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
      <!-- <link rel="stylesheet" href="style.css"> -->
      <link href='https://api.tiles.mapbox.com/mapbox-gl-js/v1.5.0/mapbox-gl.css' rel='stylesheet' />
      <style type="text/css">
          html, body {
        height: 100%;
        margin: 0;
        padding: 0;
    }
 #map {
        width: 80%;
    }


canvas.mapboxgl-canvas {
    position: initial !important;
    height: 415px !important;
    min-width: 100% !important;
}      

        * {
          -webkit-box-sizing:border-box;
          -moz-box-sizing:border-box;
          box-sizing:border-box;
        }

        .bungkus{
          padding: 20px;
        }
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
          margin-left: 20%;
        }

        h1 {
          font-size:18px;
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
          font-size: 20px;
        }
        .listings .item  strong {
          color: #FF0000;
          font-size: 18px;
        }
        .listings .item .title small { font-weight:400; }
        .listings .item.active .title,
        .listings .item .title:hover { color:#00853e; }
        .listings .item.active {
          background-color:#BCBCBC;
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
          font:400 15px 22px 'Source Sans Pro', 'Helvetica Neue', Sans-serif;
          padding:0;
          width:300px;
        }
        .mapboxgl-popup-content-wrapper {
          padding:1%;
        }
        .mapboxgl-popup-content h3 {
          background:#00853e;
          color:#fff;
          margin:0;
          display:block;
          padding:10px;
          font-weight:700;
          margin-top:-15px;
          font-size: 24px;

        }
        .mapboxgl-popup-content a {
          background:#00853e;
          /*padding: 10px;*/
          padding-top: 5px;
          padding-bottom: 5px;
          /*margin: 10px;*/
          border-radius: 15px;
          padding-left: 20px;
          padding-right: 20px;
          color: #FFFFFF;
        }

        .mapboxgl-popup-content h4 {
          margin:0;
          display:block;
          padding: 10px 10px 10px 10px;
          font-weight:400;
          font-size: 20px;
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
                        <div class="form-group row bungkus">
                           <div class="col-md-12">
                              <div class='sidebar'>
                                <div class='heading'>
                                  <h1>Daftar Bengkel</h1>
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
<script src='https://npmcdn.com/@turf/turf/turf.min.js'></script>

      <!-- Menu Toggle Script -->
      <script>
      $("#menu-toggle").click(function(e) {
      e.preventDefault();
      $("#wrapper").toggleClass("toggled");
      });


        if (!('remove' in Element.prototype)) {
    Element.prototype.remove = function() {
      if (this.parentNode) {
          this.parentNode.removeChild(this);
      }
    };
  }

  mapboxgl.accessToken = 'pk.eyJ1Ijoid2lndW5hIiwiYSI6ImNrMXg5MmhiNjBhNHEzYnM1b21yNDdjeTMifQ.2c3Vcum4fp-j83FLQt4asA';

  // This adds the map
  var map = new mapboxgl.Map({
    // container id specified in the HTML
    container: 'map',
    // style URL
    style: 'mapbox://styles/mapbox/light-v10',
    // initial position in [long, lat] format
    center: [115.22609, -8.684581],
    // 115.238075,-8.677249
    // initial zoom
    zoom: 14
  });

var stores = {
    "type": "FeatureCollection",

    "features": [
    <?php foreach ($bengkel as $baris) {?>
      {

         "type": "Feature",
        "geometry": {
          "type": "Point",
          "coordinates": [<?php echo $baris['lng'] ?>,<?php echo $baris['lat'] ?>]
        },
         
        "properties": {
          "id":"<?php echo $baris['id'] ?>",
          "hp": "<?php echo $baris['hp'] ?>",
          "phone": "2022347336",
          "nama_bengkel": "<?php echo $baris['nama_bengkel'] ?>",
          "pemilik": "<?php echo $baris['pemilik'] ?>"
        }
      },
         
      <?php  } ?>
         ]
    };
  // This adds the data to the map
  map.on('load', function (e) {
    // This is where your '.addLayer()' used to be, instead add only the source without styling a layer
    map.addSource("places", {
      "type": "geojson",
      "data": stores
    });
    // Initialize the list
    buildLocationList(stores);

    geocoder = new MapboxGeocoder({
        accessToken: mapboxgl.accessToken,
        mapboxgl: mapboxgl,
        marker: true,
        bbox: [115.215523, -8.693083, 115.238075,-8.677249]
       
    });

    map.addControl(geocoder, 'top-left');
    map.addSource('single-point', {
      "type": "geojson",
      "data": {
        "type": "FeatureCollection",
        "features": [] // Notice that initially there are no features
      }
    });

    map.addLayer({
      "id": "point",
      "source": "single-point",
      "type": "circle",
      "paint": {
        "circle-radius": 10,
        "circle-color": "#007cbf",
        "circle-stroke-width": 3,
        "circle-stroke-color": "#fff"
      }
    });

    geocoder.on('result', function(ev) {
      var searchResult = ev.result.geometry;
      map.getSource('single-point').setData(searchResult);

      var options = {units: 'miles'};
      stores.features.forEach(function(store){
        Object.defineProperty(store.properties, 'distance', {
          value: turf.distance(searchResult, store.geometry, options),
          writable: true,
          enumerable: true,
          configurable: true
        });
      });

      stores.features.sort(function(a,b){
        if (a.properties.distance > b.properties.distance) {
          return 1;
        }
        if (a.properties.distance < b.properties.distance) {
          return -1;
        }
        // a must be equal to b
        return 0;
      });

      var listings = document.getElementById('listings');
      while (listings.firstChild) {
        listings.removeChild(listings.firstChild);
      }

      buildLocationList(stores);

      function sortLonLat(storeIdentifier) {
        var lats = [stores.features[storeIdentifier].geometry.coordinates[1], searchResult.coordinates[1]]
        var lons = [stores.features[storeIdentifier].geometry.coordinates[0], searchResult.coordinates[0]]

        var sortedLons = lons.sort(function(a,b){
            if (a > b) { return 1; }
            if (a.distance < b.distance) { return -1; }
            return 0;
          });
        var sortedLats = lats.sort(function(a,b){
            if (a > b) { return 1; }
            if (a.distance < b.distance) { return -1; }
            return 0;
          });

        map.fitBounds([
          [sortedLons[0], sortedLats[0]],
          [sortedLons[1], sortedLats[1]]
        ], {
          padding: 100
        });
      };

      sortLonLat(0);
      createPopUp(stores.features[0]);

    });
  });

  // This is where your interactions with the symbol layer used to be
  // Now you have interactions with DOM markers instead
  stores.features.forEach(function(marker, i) {
    // Create an img element for the marker
    var el = document.createElement('div');
    el.id = "marker-" + i;
    el.className = 'marker';
    // Add markers to the map at all points
    new mapboxgl.Marker(el, {offset: [0, -23]})
        .setLngLat(marker.geometry.coordinates)
        .addTo(map);

    el.addEventListener('click', function(e){
        // 1. Fly to the point
        flyToStore(marker);

        // 2. Close all other popups and display popup for clicked store
        createPopUp(marker);

        // 3. Highlight listing in sidebar (and remove highlight for all other listings)
        var activeItem = document.getElementsByClassName('active');

        e.stopPropagation();
        if (activeItem[0]) {
           activeItem[0].classList.remove('active');
        }

        var listing = document.getElementById('listing-' + i);
        listing.classList.add('active');

    });
  });


  function flyToStore(currentFeature) {
    map.flyTo({
        center: currentFeature.geometry.coordinates,
        zoom: 16
      });
  }

  function createPopUp(currentFeature) {
    var popUps = document.getElementsByClassName('mapboxgl-popup');
    if (popUps[0]) popUps[0].remove();


    var popup = new mapboxgl.Popup({closeOnClick: false})
          .setLngLat(currentFeature.geometry.coordinates)
          .setHTML('<h3 class="text-nowrap">'+ currentFeature.properties.nama_bengkel +'</h3>' +
            '<h4> <strong>Pemilik</strong> : ' + currentFeature.properties.pemilik + '</h4>'+
            '<h4><strong>Hp</strong>: ' + currentFeature.properties.hp + '</h4>'+
            '<h4><a href="arah.php?tujuan='+currentFeature.geometry.coordinates+'">Arahkan</a></h4>')
          .addTo(map);
  }


  function buildLocationList(data) {
    for (i = 0; i < data.features.length; i++) {
      var currentFeature = data.features[i];
      var prop = currentFeature.properties;

      var listings = document.getElementById('listings');
      var listing = listings.appendChild(document.createElement('div'));
      listing.className = 'item';
      listing.id = "listing-" + i;

      var link = listing.appendChild(document.createElement('a'));
      link.href = '#';
      link.className = 'title';
      link.dataPosition = i;
      link.innerHTML = prop.nama_bengkel;

      var details = listing.appendChild(document.createElement('div'));
      details.innerHTML = prop.pemilik;
      if (prop.phone) {
        details.innerHTML += ' - ' + prop.hp;
      }

      if (prop.distance) {
        var roundedDistance = Math.round(prop.distance*100)/100;
        details.innerHTML += '<p><strong>' + roundedDistance + ' Km</strong></p>';
      }


      link.addEventListener('click', function(e){
        // Update the currentFeature to the store associated with the clicked link
        var clickedListing = data.features[this.dataPosition];

        // 1. Fly to the point
        flyToStore(clickedListing);

        // 2. Close all other popups and display popup for clicked store
        createPopUp(clickedListing);

        // 3. Highlight listing in sidebar (and remove highlight for all other listings)
        var activeItem = document.getElementsByClassName('active');

        if (activeItem[0]) {
           activeItem[0].classList.remove('active');
        }
        this.parentNode.classList.add('active');
      });
    }
  }
    map.addControl(new mapboxgl.NavigationControl());
    map.addControl(new mapboxgl.GeolocateControl({
          positionOptions: {
          enableHighAccuracy: true
          },
          trackUserLocation: true
          }));
      </script>
   </body>
</html>