<?PHP include("inc.slide.php"); ?>
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


$contact_short = str_replace("apos","'",$thishotel["contact_short"]);
$contact_short = str_replace(" and "," & ",$contact_short);
$contact_short = str_replace(" plus "," + ",$contact_short);
?>

<div class="mg-best-rooms" style="position: relative;z-index: 1; padding:0px; background: #eee; border-bottom: 1px solid #ddd;">
      <div class="container" align="center">
        <h2 style="margin: 10px; font-size:35px;" class="text-main"><?=$thismenu["contact"];?></h2>
      </div>
</div>

<div class="mg-about-features" style="padding-top:30px;">
			<div class="container">
				<div class="row">
					<div class="col-md-12" style="<?=$padding;?>">
						<h2 class="mg-sec-left-title" style="margin-bottom:0px;"><?=$contact_short;?></h2>

		
				<div class="row">
					
					<div class="col-md-5" style="<?=$padding;?>">
						<h3 class="mg-avl-room-title"  style="font-family: 'Muli', sans-serif;"><?=$thismenu["send_an_email"];?></h3>

						
            	<!-- Please carefully read the README.txt file in order to setup
                 the PHP contact form properly -->
						<div id="contact_form">
						<form role="form" id="form_sendemail" class="clearfix">

							<div class="mg-contact-form-input">
								<label for="full-name"><?=$thismenu["full_name"];?></label>
								<input type="text" name="name" class="form-control" id="name" placeholder="..." data-original-title="" title="">
							</div>
							<div class="mg-contact-form-input">
								<label for="email"><?=$thismenu["email"];?></label>
								<input type="email" name="email" class="form-control" id="email" placeholder="..." data-original-title="" title="">
							</div>
							<div class="mg-contact-form-input">
								<label for="tel"><?=$thismenu["ttelephone"];?></label>
								<input type="text" name="tel" class="form-control" id="tel" placeholder="..." data-original-title="" title="">
							</div>
							<div class="mg-contact-form-input">
								<label for="subject"><?=$thismenu["subject"];?></label>
								<input type="text" name="subject" class="form-control" id="subject" placeholder="..." data-original-title="" title="">
							</div>
							<div class="mg-contact-form-input">
								<label for="subject"><?=$thismenu["message"];?></label>
								<textarea name="message" class="form-control" rows="3" id="message" placeholder="<?=$thismenu["please_write"];?>"></textarea>
							</div>
							<input type="hidden" name="language_id" id="language_id" value="<?=$language_id;?>">
							<input type="hidden" name="hotel_sec" id="hotel_sec" value="<?=$hotel_sec;?>">
							
							<!-- reCAPTCHA -->
              <div class="form-group" id="form-captcha">
                
                <div class="g-recaptcha" data-sitekey="6LcIbgoTAAAAAIUJV3E6Qf5gMHM2hDk8d9DKmlpU" style="width:100%;"></div>
                <span class="help-block"></span>
              </div>
              <!-- /reCAPTCHA -->
							<button type="submit" class="btn btn-dark-main btn-sm pull-right"><?=$thismenu["send_message"];?></button>
						</form>
						<!-- Alert message -->
    <div class="alert" id="form_message" role="alert" style="padding:5px;position:absolute;bottom:0px;"></div>
						
    <script src='https://www.google.com/recaptcha/api.js'></script>
    <script src="js/contact.js"></script>
						</div>

					</div>
					<div class="col-md-1 hidden-xs"></div>
					<div class="col-md-6" style="<?=$padding;?>">
						<h3 class="mg-avl-room-title"  style="font-family: 'Muli', sans-serif;"><?=$thismenu["taddress"];?></h3>
						<ul class="mg-contact-info">
							<li style="margin:5px;"><i class="fa fa-map-marker"></i> <?=$thishotel["hotel_address"];?> <?=$thishotel["hotel_city"];?> <?=$thishotel["hotel_province"];?> <?=$thishotel["hotel_country"];?> <?=$thishotel["hotel_postalcode"];?></li>
							<li style="margin:5px;"><i class="fa fa-phone"></i> <?=$thishotel["hotel_tel"];?></li>
							<li style="margin:5px;"><i class="fa fa-fax"></i> <?=$thishotel["hotel_fax"];?></li>
							<li style="margin:5px;"><i class="fa fa-envelope"></i> <a href="mailto:<?=$thishotel["hotel_email"];?>"><?=$thishotel["hotel_email"];?></a></li>
						</ul>
						<div id="mg-map" class="mg-map"></div>
					</div>
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
			zoom: 19
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

<script src="//maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&key=AIzaSyBxH8TyCWxN5OiD5nnWI22kHEMnyGdr5XE" async="" defer="defer" type="text/javascript"></script>
<script src="js/gmaps.min.js"></script>
<script src="js/owl.carousel.min.js"></script>
    <script src="js/script.js"></script>
