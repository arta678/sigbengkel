<!DOCTYPE html>
<html>
<head>
<meta charset='utf-8' />
<title>Display driving directions</title>
<meta name='viewport' content='initial-scale=1,maximum-scale=1,user-scalable=no' />
<script src='https://api.tiles.mapbox.com/mapbox-gl-js/v1.6.0/mapbox-gl.js'></script>
<link href='https://api.tiles.mapbox.com/mapbox-gl-js/v1.6.0/mapbox-gl.css' rel='stylesheet' />
<style>
    body { margin: 0; padding: 0; }
        #map { position: absolute; top: 0; bottom: 0; width: 100%; };
</style>
</head>
<body>
<script src='https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-directions/v4.0.2/mapbox-gl-directions.js'></script>
<link rel='stylesheet' href='https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-directions/v4.0.2/mapbox-gl-directions.css' type='text/css' />
<div id='map'></div>

<script>
mapboxgl.accessToken = 'pk.eyJ1IjoiYndhZGFtc29uIiwiYSI6ImNqajZhNm1idDFzMjIza3A2Y3ZmdDV6YWYifQ.9NhptR7a9D0hzWXR51y_9w';
var map = new mapboxgl.Map({
  container: 'map',
  style: 'mapbox://styles/mapbox/streets-v9',
  center: [115.215523, -8.693083],
  zoom: 13
});

map.on('load', function() {
  var directions = new MapboxDirections({
    accessToken: mapboxgl.accessToken
  });
  map.addControl(directions, 'top-left');
  directions.setOrigin('115.20437,-8.69682');
  directions.setDestination('115.24428,-8.68960');
});

</script>

</body>
</html>