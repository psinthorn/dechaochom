<?PHP
require_once("site.configs.php");
$hotel_sec = $_REQUEST["hotel_sec"];

$language_id = $_REQUEST["language_id"];
$sql  = "SELECT *, hotel_language.ISO639_1, hotel_language.Name, hotel_language.NativeName  FROM hotel_language LEFT JOIN icontrol_language ON hotel_language.hotel_sec = icontrol_language.hotel_sec AND hotel_language.ID = icontrol_language.ID WHERE hotel_language.hotel_sec = '".$thishotel["hotel_sec"]."' AND hotel_language.ID = '".$language_id."' ";
$query = mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error());
$thismenu = mysql_fetch_array($query);

$thishotel  = $hotel->getHotel($hotel_sec);
$thiscomp   = $company->getCompany($thishotel["hotel_chain_id"]);

$sql  = "SELECT * FROM getting_here WHERE hotel_sec = '".$_REQUEST["hotel_sec"]."' AND id = '".$_REQUEST["getting_id"]."' ";
$query = mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error());
$thisgetting = mysql_fetch_array($query);

if($_REQUEST["SelectMode"] == 'TRANSIT'){
	$SelectMode = "TRANSIT";
}
else if($_REQUEST["SelectMode"] == 'DRIVING'){
	$SelectMode = "DRIVING";
}
else {
	$SelectMode = "WALKING";
}
?>

<input type="hidden" id="getting_id" value="<?=$_REQUEST["getting_id"];?>">

<script>

  var pointB = {lat: <?=$thisgetting["lat"];?>, lng: <?=$thisgetting["lng"];?>};
  var pointA = {lat: <?=$thishotel["lat"];?>, lng: <?=$thishotel["lng"];?>};
  var SelectMode = document.getElementById('SelectMode').value;

  var map = new google.maps.Map(document.getElementById('mg-map'), {
    center: pointA,
    scrollwheel: false,
    zoom: 7
  });

  var directionsDisplay = new google.maps.DirectionsRenderer({
    map: map
  });


// Set destination, origin and travel mode.
if(SelectMode == 'DRIVING'){ 
  var request = {
    destination: pointB,
    origin: pointA,
    travelMode: google.maps.TravelMode.DRIVING
  };
}
else if(SelectMode == 'TRANSIT'){ 
	var request = {
    destination: pointB,
    origin: pointA,
    travelMode: google.maps.TravelMode.TRANSIT
  };
}
else {
	var request = {
    destination: pointB,
    origin: pointA,
    travelMode: google.maps.TravelMode.WALKING
  };
}

  // Pass the directions request to the directions service.
  var directionsService = new google.maps.DirectionsService();
  directionsService.route(request, function(response, status) {
    if (status == google.maps.DirectionsStatus.OK) {
      // Display the route on the map.
      directionsDisplay.setDirections(response);
    }
  });

  map.addMarker({
			lat: <?=$thishotel["lat"];?>,
			lng: <?=$thishotel["lng"];?>,
			title: 'Map',
			infoWindow: {
				content: ''
			}
		});

</script>
				<div id="mg-map" class="mg-map" style="height:400px;"></div>


