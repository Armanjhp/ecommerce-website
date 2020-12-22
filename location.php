<!DOCTYPE html> 
<head>
  <title>Chromerce | Location</title>
  <link rel="stylesheet" href="location.css">
  <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Roboto'>
  <link rel="stylesheet" type="text/css" href="template.css">
  <link rel="icon" type="image/png" href="images/favicon.png"/>




  <script
  src="https://code.jquery.com/jquery-3.1.1.js"
  integrity="sha256-16cdPddA6VdVInumRGo6IbivbERE8p7CQR3HzTBuELA="
  crossorigin="anonymous"></script>
<script src="js/main.js"> </script>

<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
   integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
   crossorigin=""/>

    <!-- Make sure you put this AFTER Leaflet's CSS -->
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
   integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
   crossorigin="">
  </script>





</head>

<body>




<?php
    include("navbar.php");
?>







<div class="location-form-Wrapper">
    <form action="#" method="post" class ="space">
    <div class="location-form-row">
        <fieldset class="field_set1">
            <legend class="legend1">Search Address</legend>
            <div class="location-form-space">
                    <input type="text"  placeholder="Address" id="addr">
                    <input type="button" value="Submit" class="location-form-btn" onclick="addySearch();">
                    <br /> <br />
                    <label class="latitude-space">Latitude </label>
                    <input type = "text" placeholder="Latitude" id="lat">

                    <br/> <br/>
                    <label class="longitude-space">Longitude </label>

                    <input type = "text" placeholder="Longitude" id="lon">
                    <br /> <br />
                    <div id="distance" class="distance">  </div>
            </div>
        </fieldset>


        <div id="distance" class="distance">  </div>
     </div>


    </form>


</div>

    <do</dov>

<div class="map-row">



    <div class="map-col">

      <div id="mapid"></div>
     </div>


</div>

















<script>


var ConcordiaLat = 45.495675;
var ConcordiaLong = -73.578667;
var mymap = L.map('mapid').setView([ConcordiaLat,ConcordiaLong],14);

L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
  attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' + '<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' + 'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
  maxZoom: 18,
  id: 'mapbox/streets-v11',
  tileSize: 512,
  zoomOffset: -1,
  accessToken: 'pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw'
}).addTo(mymap);









var marker = L.marker([ConcordiaLat, ConcordiaLong], {

}).addTo(mymap);


marker.bindPopup("Located at 1455 Boulevard de Maisonneuve O, Montréal, QC H3G 1M8").openPopup();

var x , y;


function addySearch()
{

	 //Creating the marker to a searched address
            //A sample address. You must get it from the input box
            var addr = document.getElementById("addr");


			
                var lat = document.getElementById("lat");
                var lon = document.getElementById("lon");



            //AJAX CODE to get Lat Long from the address
            //NO MODIFICATION REQUIRED
            var xmlhttp = new XMLHttpRequest();
            var url = "https://nominatim.openstreetmap.org/search?format=json&limit=3&q=" + addr.value;
            xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var myArr = JSON.parse(this.responseText);

                //myArr is an array of the matching addresses
                //You can extract the lat long attributes
                //Example: myArr[0].lat and myArr[0].lon;
				lat.value = myArr[0].lat;
				lon.value = myArr[0].lon;



                //Create markers from the info. Check library reference
               // var latlng = L.LatLng(ConcordiaLat, ConcordiaLong);
               // L.circleMarker(latlng, { color: "red", radius: 1000 });

                //Use Polyline to draw line on map
                //https://leafletjs.com/reference-1.7.1.html

                //Compute Distance using
                //(from.distanceTo(to)).toFixed(0)/1000;
                //from and to are latlong objects from the circleMarkers above


				x = lat;
				y = lon;




var marker2 = L.marker([x.value, y.value], {

}).addTo(mymap);




var latlngs = [
    [x.value , y.value],
    [45.495675 , -73.578667]

];

	var markerFrom = L.circle([x.value, y.value] );
	var markerTo =  L.circle([45.495675, -73.578667] );

	var from = markerFrom.getLatLng();
    var to = markerTo.getLatLng();



    document.getElementById('distance').innerHTML = ("Your distance from our store is " + (from.distanceTo(to)).toFixed(0)/1000) + 'km';



var polyline = L.polyline(latlngs, {color: 'red'}).addTo(mymap);

// zoom the map to the polyline
map.fitBounds(polyline.getBounds());






            }
            };
            xmlhttp.open("GET", url, true);
            xmlhttp.send();






}







</script>


















   
  <?php
    include("footer.php");
    ?>

 



</body>







</html


