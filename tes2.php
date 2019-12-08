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
<html>
  <head>
      <meta charset='utf-8' />
      <title><?php echo $title; ?></title>
      <meta name='robots' content='noindex, nofollow'>
      <meta name='viewport' content='initial-scale=1,maximum-scale=1,user-scalable=no' />
      <link href='https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,700' rel='stylesheet'>
      <!-- Mapbox GL JS -->
      <script src='https://api.tiles.mapbox.com/mapbox-gl-js/v1.6.0/mapbox-gl.js'></script>
      <link href='https://api.tiles.mapbox.com/mapbox-gl-js/v1.6.0/mapbox-gl.css' rel='stylesheet' />
      <!-- Geocoder plugin -->
      <script src='https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v4.2.0/mapbox-gl-geocoder.min.js'></script>
      <link rel='stylesheet' href='https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v4.2.0/mapbox-gl-geocoder.css' type='text/css' />
      <!-- Turf.js plugin -->
      <script src='https://npmcdn.com/@turf/turf/turf.min.js'></script>
      <style>

        body {
          color:#404040;
          font:400 15px/22px 'Source Sans Pro', 'Helvetica Neue', Sans-serif;
          margin:0;
          padding:0;
          -webkit-font-smoothing:antialiased;
        }

        * {
          -webkit-box-sizing:border-box;
          -moz-box-sizing:border-box;
          box-sizing:border-box;
        }

        .sidebar {
          position:absolute;
          width:33.3333%;
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
          left:33.3333%;
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
    <div class='sidebar'>
      <div class='heading'>
        <h1>Our locations</h1>
      </div>
    <div id='listings' class='listings'></div>
    </div>
    <div id='map' class='map'> </div>

  <script>
  // This will let you use the .remove() function later on
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
    center: [115.1622363,-8.6512212],
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
        bbox: [-77.210763, 38.803367, -76.853675, 39.052643]
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
        zoom: 15
      });
  }

  function createPopUp(currentFeature) {
    var popUps = document.getElementsByClassName('mapboxgl-popup');
    if (popUps[0]) popUps[0].remove();


    var popup = new mapboxgl.Popup({closeOnClick: false})
          .setLngLat(currentFeature.geometry.coordinates)
          .setHTML('<h3 class="text-nowrap">'+ currentFeature.properties.nama_bengkel +'</h3>' +
            '<h4> <strong>Pemilik</strong> : ' + currentFeature.properties.pemilik + '</h4>'+
            '<h4><strong>Hp</strong>: ' + currentFeature.properties.hp + '</h4>')
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
        details.innerHTML += ' &middot; ' + prop.hp;
      }

      if (prop.distance) {
        var roundedDistance = Math.round(prop.distance*100)/100;
        details.innerHTML += '<p><strong>' + roundedDistance + ' miles away</strong></p>';
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
