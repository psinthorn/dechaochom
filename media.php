<?PHP
require_once("site.configs.php");
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


$media_text = str_replace("apos","'",$thismenu["tmedia_text"]);
$media_text = str_replace(" and "," & ",$media_text);
$media_text = str_replace(" plus "," + ",$media_text);

$media_download = file_get_contents("http://www.rezeazy.com/mega/media_download.php?hotel_sec=".$thishotel["hotel_sec"]."&language_id=".$language_id."&device=".$deviceType);
?>

<div class="mg-about-features" style="padding-top:30px;">
			<div class="container">
				<div class="row">
					<div class="col-md-12" style="<?=$padding;?>">


		
				<div class="row">
					<div class="col-md-1" style="<?=$padding;?>"></div>					
					<div class="col-md-10" style="<?=$padding;?>">
						
						<div class="list-group">
						<div class="list-group-item">
						<h3 class="mg-sec-left-title" style="margin-bottom:0px;">Media Contacts</h3>
						<p>For information related to specific items or topics. The contact centre below is your fast track to our respective communication associates.</p>
						<hr>
						<h5>Contact Person</h5>
							<div style="padding-top:5px;padding-bottom:5px;"><?=$thishotel["contact_name"];?></div>
							<div style="padding-top:5px;padding-bottom:5px;"><?=$thishotel["contact_position"];?></div>
							<div style="padding-top:5px;padding-bottom:5px;"><?=$thishotel["contact_email"];?></div>
						</div>
						<div class="list-group-item">
						<h5><i class="fa fa-download"></i> Media Download</h5>
						<?=$media_download;?>
						</div>
						</div>

					</div>
					<div class="col-md-1" style="<?=$padding;?>"></div>
				</div>

					</div>
				</div>
			</div>
		

</div>	
<input type="hidden" id="page" value="contact-us">
<script type="text/javascript">
$('#pleasewait').fadeOut('slow'); 

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



<script src="http://maps.google.com/maps/api/js?sensor=true"></script>
<script src="js/gmaps.min.js"></script>
<script src="js/owl.carousel.min.js"></script>
    <script src="js/script.js"></script>
