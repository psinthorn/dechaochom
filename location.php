<?PHP include("inc.slide.php"); ?>
<?PHP
require_once("site.configs.php");
$language_id = $_REQUEST["language_id"];

$sql  = "SELECT *, hotel_language.ISO639_1, hotel_language.Name, hotel_language.NativeName  FROM hotel_language LEFT JOIN icontrol_language ON hotel_language.hotel_sec = icontrol_language.hotel_sec AND hotel_language.ID = icontrol_language.ID WHERE hotel_language.hotel_sec = '".$thishotel["hotel_sec"]."' AND hotel_language.ID = '".$language_id."' ";
$query = mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error());
$thismenu = mysql_fetch_array($query);


$thishotel  = $hotel->getHotel($hotel_sec);
$thiscomp   = $company->getCompany($thishotel["hotel_chain_id"]);


require_once 'Mobile_Detect.php';
$detect = new Mobile_Detect;
$deviceType = ($detect->isMobile() ? ($detect->isTablet() ? 'tablet' : 'phone') : 'computer');
$scriptVersion = $detect->getScriptVersion();
if($deviceType == 'phone'){
$padding = "padding:0px;";
}
else {
$padding = "";	
}

if($thishotel["skin_color"] == ''){
  $skin_color = 'orange';
}
else {
  $skin_color = $thishotel["skin_color"];
}


$location_desc = str_replace("apos","'",$thishotel["location_desc"]);
$location_desc = str_replace(" and "," & ",$location_desc);
$location_desc = str_replace(" plus "," + ",$location_desc);


?>

<style type="text/css">
div.circle-avatar{
/* make it responsive */

width:40px;
height:40px;
display:block;
/* div height to be the same as width*/
/* make it a cirkle */
border-radius:50%;
/* Centering on image`s center*/
background-position-y: center;
background-position-x: center;
background-repeat: no-repeat;

/* it makes the clue thing, takes smaller dimention to fill div */
padding:3px;
}

.step_box {
    background:#eee;
}
.step_box:hover{
background: #FCC918;
}
.selected {
    background-color : #FCC918;
}
</style>
<input type="hidden" id="SelectMode" value="DRIVING">

<div class="mg-best-rooms" style="position: relative;z-index: 1; padding:0px; background: #eee; border-bottom: 1px solid #ddd;">
      <div class="container" align="center">
        <h2 style="margin: 10px; font-size:35px;" class="text-main"><?=$thismenu["map"];?></h2>
      </div>
</div>

<div class="mg-about-features" style="padding-top:30px;">
			<div class="container">
				<div class="row">
					<div class="col-md-12" style="<?=$padding;?>">
						<h2 class="mg-sec-left-title" style="margin-bottom:0px;"><?=$thishotel["hotel_address"];?> <?=$thishotel["hotel_city"];?> <?=$thishotel["hotel_country"];?></h2>
						<p>HuaHin is only 200 km. away from Bangkok. It is only two and a half hours drive.From Bangkok, take the highway 35 towards SamutSakhon direction. Switch onto the Rama II road and stay on the Phetchakasem road leading to HuaHin. Turn left inHuaHin 35 alleyand follow the sign of De ChaochomHuaHin.<br><br>Shuttle service from HuaHin Bus Station and Train Station at your request. Please kindly make a reservation for the pick-up.
</p>

<?PHP if($deviceType == 'phone'){?>

<div align="center">
<h5 class="mg-avl-room-title"><i class="fa fa-map-marker text-success"></i><span class="text-success">A</span> <span><?=$thishotel["hotel_name"];?></span><br><small><?=$thismenu["tlat"];?> <?=$thishotel["lat"];?> <?=$thismenu["tlng"];?> <?=$thishotel["lng"];?></small></h5>
</div>

<div class="row">
<div id="FormLocation">
<script>
	if ($('#mg-map').length) {

	    var map = new GMaps({
			el: '#mg-map',
			lat: <?=$thishotel["lat"];?>,
			lng: <?=$thishotel["lng"];?>,
			zoom: 17
		});

		map.addMarker({
			lat: <?=$thishotel["lat"];?>,
			lng: <?=$thishotel["lng"];?>,
			title: 'Map',
			infoWindow: {
				content: ''
			}
		});
	}
</script>
<div id="mg-map" class="mg-map" style="height:400px;"></div>
</div>
</div>

<div align="center">
	<h5 class="mg-avl-room-title"><i class="fa fa-map-marker text-danger"></i><span class="text-danger">B</span> <span id="GettingName">Where you from</span><br><small id="GettingDesc">Please select grtting here listing</small></h5>
</div>

<div align="center">
					<table style="margin:0px;" class="step_wrapper"><tr>
					<td align="center" style="padding:5px;"><div class="circle-avatar step_box selected" onclick="ChangeMode('DRIVING');"><i class="fa fa-car fa-2x" style="color:#fff;"></i></div></td>
					<td align="center" style="padding:5px;"><div  class="circle-avatar step_box" onclick="ChangeMode('TRANSIT');" style="padding-top:5px;"><i class="fa fa-subway fa-2x" style="color:#fff;"></i></div></td>
					<td align="center" style="padding:5px;"><div  class="circle-avatar step_box" onclick="ChangeMode('WALKING');" style="padding-top:5px;"><i class="fa fa-bicycle fa-2x" style="color:#fff;"></i></div></td>
					</tr></table>
</div>





<div>
	<h4 class="mg-avl-room-title" style="margin-top:10px;"><i class="fa fa-map-marker text-danger"></i><span class="text-danger">B</span> Getting Here</h4>
						<ul class="mg-contact-info">
<?PHP 
$sql  = "SELECT * FROM getting_here_language WHERE hotel_sec = '".$thishotel["hotel_sec"]."' AND language_id = '".$language_id."' ";
$query = mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error());
while ($allgetting = mysql_fetch_array($query)) {
$getting_name = str_replace("apos", "'", $allgetting["getting_name"]);	
$getting_desc = str_replace("apos", "'", $allgetting["getting_desc"]);	
?>
							<li style="margin:5px;padding:5px;padding-left:0px;margin-left:0px;border-bottom:1px solid #ddd;cursor:pointer;" onclick="ChangeLocation('<?=$allgetting["getting_id"];?>', '<?=$allgetting["getting_name"];?>', '<?=$allgetting["getting_desc"];?>');"><a><?=$getting_name;?></a><br><?=$getting_desc;?></li>
<?PHP }?>
						</ul>
</div>

<?PHP }else {?>
		
				<div class="row">

					<div class="col-md-8">
					<div class="row">
					<div class="col-md-5">
					<h4 class="mg-avl-room-title" style="font-family: 'Raleway', sans-serif;"><i class="fa fa-map-marker text-success"></i><span class="text-success">A</span> <span><?=$thishotel["hotel_name"];?></span><br><small><?=$thismenu["tlat"];?> <?=$thishotel["lat"];?> <?=$thismenu["tlng"];?> <?=$thishotel["lng"];?></small></h4>

					</div>
					<div class="col-md-1" align="center"><i class="fa fa-arrow-left fa-2x text-muted" style="margin-top:20px;"></i></div>
					<div class="col-md-6" align="right">
					<h4 class="mg-avl-room-title" style="font-family: 'Raleway', sans-serif;"><i class="fa fa-map-marker text-danger"></i><span class="text-danger">B</span> <span id="GettingName">Where you from</span><br><small id="GettingDesc">Please select grtting here listing</small></h4>
					</div>					
					</div>
					</div>

					<div class="col-md-4" align="left" style="padding-top:10px;">
					<table style="margin:0px;" class="step_wrapper"><tr>
					<td align="center" style="padding:5px;"><div class="circle-avatar step_box selected" onclick="ChangeMode('DRIVING');"><i class="fa fa-car fa-2x" style="color:#fff;"></i></div></td>
					<td align="center" style="padding:5px;"><div  class="circle-avatar step_box" onclick="ChangeMode('TRANSIT');" style="padding-top:5px;"><i class="fa fa-subway fa-2x" style="color:#fff;"></i></div></td>
					<td align="center" style="padding:5px;"><div  class="circle-avatar step_box" onclick="ChangeMode('WALKING');" style="padding-top:5px;"><i class="fa fa-bicycle fa-2x" style="color:#fff;"></i></div></td>
					</tr></table>
					 
					</div>

					<div class="col-md-8">
						<div id="FormLocation" style="font-family: 'Raleway', sans-serif;">
							<div id="mg-map" class="mg-map" style="height:400px;"></div>


						

						</div>

					</div>
					<div class="col-md-4" style="position: relative;overflow-x: hidden;overflow-y: auto;height:400px;">
						<h4 class="mg-avl-room-title" style="margin-top:0px;"><i class="fa fa-map-marker text-danger"></i><span class="text-danger">B</span> Getting Here</h4>
						<ul class="mg-contact-info">
<?PHP 
$sql  = "SELECT * FROM getting_here_language WHERE hotel_sec = '".$thishotel["hotel_sec"]."' AND language_id = '".$language_id."' ";
$query = mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error());
while ($allgetting = mysql_fetch_array($query)) {
$getting_name = str_replace("apos", "'", $allgetting["getting_name"]);	
$getting_desc = str_replace("apos", "'", $allgetting["getting_desc"]);	
?>
							<li style="margin:5px;padding:5px;padding-left:0px;margin-left:0px;border-bottom:1px solid #ddd;cursor:pointer;" onclick="ChangeLocation('<?=$allgetting["getting_id"];?>', '<?=$allgetting["getting_name"];?>', '<?=$allgetting["getting_desc"];?>');"><a><i class="fa fa-map-pin"></i> <?=$getting_name;?></a><br><?=$getting_desc;?></li>
<?PHP }?>
						</ul>
						
					</div>
				</div>

<?PHP }?>
</div>		
</div>
</div>
</div>	
<input type="hidden" id="page" value="location">
<script type="text/javascript">
$('#pleasewait').fadeOut();
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBxH8TyCWxN5OiD5nnWI22kHEMnyGdr5XE" async="" defer="defer" type="text/javascript"></script>
<script src="js/gmaps.min.js"></script>
<script src="js/owl.carousel.min.js"></script>
<script src="js/script.js"></script>
<script type="text/javascript">

function ChangeLocation(getting_id, getting_name, getting_desc){
var SelectMode = document.getElementById('SelectMode').value;
$('#FormLocation').load('getting_here.php?hotel_sec=<?=$thishotel["hotel_sec"];?>&language_id=<?=$language_id;?>&getting_id='+getting_id+'&SelectMode='+SelectMode);
document.getElementById('GettingName').innerHTML=getting_name;
document.getElementById('GettingDesc').innerHTML=getting_desc;

document.getElementById('getting_id').value=getting_id;
} ;

function ChangeMode(SelectMode){
document.getElementById('SelectMode').value = SelectMode;
var getting_id = document.getElementById('getting_id').value;
$('#FormLocation').load('getting_here.php?hotel_sec=<?=$thishotel["hotel_sec"];?>&language_id=<?=$language_id;?>&ID=<?=$ID;?>&getting_id='+getting_id+'&SelectMode='+SelectMode);

}; 

$('.step_wrapper').on('click','.step_box',function () {
         $('.step_box').removeClass('selected');
         $(this).addClass('selected')
});
</script>

<?PHP if($deviceType <> 'phone'){?>
<script>
	if ($('#mg-map').length) {

	    var map = new GMaps({
			el: '#mg-map',
			lat: <?=$thishotel["lat"];?>,
			lng: <?=$thishotel["lng"];?>,
			zoom: 17
		});

		map.addMarker({
			lat: <?=$thishotel["lat"];?>,
			lng: <?=$thishotel["lng"];?>,
			title: 'Map',
			infoWindow: {
				content: ''
			}
		});
	}
</script>
<?PHP }?>

