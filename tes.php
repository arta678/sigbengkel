<!DOCTYPE html>
<html>
<head>
<meta charset=utf-8 />
<title>Driving directions</title>
<meta name='viewport' content='initial-scale=1,maximum-scale=1,user-scalable=no' />
<script src='https://api.mapbox.com/mapbox.js/v3.2.1/mapbox.js'></script>
<link href='https://api.mapbox.com/mapbox.js/v3.2.1/mapbox.css' rel='stylesheet' />
<style>
  body { margin:0; padding:0; }
  #map { position:absolute; top:0; bottom:0; width:100%; }
</style>
</head>
<body>

<style>
#inputs,
#errors,
#directions {
    position: absolute;
    width: 33.3333%;
    max-width: 300px;
    min-width: 200px;
}

#inputs {
    z-index: 10;
    top: 10px;
    left: 10px;
}

#directions {
    z-index: 99;
    background: rgba(0,0,0,.8);
    top: 0;
    right: 0;
    bottom: 0;
    overflow: auto;
}

#errors {
    z-index: 8;
    opacity: 0;
    padding: 10px;
    border-radius: 0 0 3px 3px;
    background: rgba(0,0,0,.25);
    top: 90px;
    left: 10px;
}

</style>

<script src='https://api.mapbox.com/mapbox.js/plugins/mapbox-directions.js/v0.4.0/mapbox.directions.js'></script>
<link rel='stylesheet' href='https://api.mapbox.com/mapbox.js/plugins/mapbox-directions.js/v0.4.0/mapbox.directions.css' type='text/css' />

<div id='map'></div>
<div id='inputs'></div>
<div id='errors'></div>
<div id='directions'>
  <div id='routes'></div>
  <div id='instructions'></div>
</div>
<div><button>OKKKK</button></div>
<script>
L.mapbox.accessToken = 'pk.eyJ1Ijoid2lndW5hIiwiYSI6ImNrMXg5MmhiNjBhNHEzYnM1b21yNDdjeTMifQ.2c3Vcum4fp-j83FLQt4asA';
var map = L.mapbox.map('map', null, {
    zoomControl: false
})
  .setView([-8.693083,115.215523], 14)
  .addLayer(L.mapbox.styleLayer('mapbox://styles/mapbox/streets-v11'));

// move the attribution control out of the way
map.attributionControl.setPosition('bottomleft');

// create the initial directions object, from which the layer
// and inputs will pull data.
var directions = L.mapbox.directions();

var directionsLayer = L.mapbox.directions.layer(directions)
    .addTo(map);

var directionsInputControl = L.mapbox.directions.inputControl('inputs', directions)
    .addTo(map);

var directionsErrorsControl = L.mapbox.directions.errorsControl('errors', directions)
    .addTo(map);

var directionsRoutesControl = L.mapbox.directions.routesControl('routes', directions)
    .addTo(map);

var directionsInstructionsControl = L.mapbox.directions.instructionsControl('instructions', directions)
    .addTo(map);
</script>

</body>
</html>

