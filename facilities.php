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
$margin_top = "0px";
$max_logo = "max-width:70px;";
$padding = "padding:0px;";
}
else {
$margin_top = "80px";
$max_logo = "max-width:90px;";
$data_target = "";
$padding = "";
}


if($thishotel["skin_color"] == ''){
  $skin_color = 'orange';
}
else {
  $skin_color = $thishotel["skin_color"];
}

$fac_short = str_replace("apos","'",$thishotel["fac_short"]);
$fac_short = str_replace(" and "," & ",$fac_short);
$fac_short = str_replace(" plus "," + ",$fac_short);

$fac = str_replace("apos","'",$thishotel["fac"]);
$fac = str_replace(" and "," & ",$fac);
$fac = str_replace(" plus "," + ",$fac);

$fac_gallery = file_get_contents("https://www.bookingboxes.com/mega/fac_gallery.php?hotel_sec=".$thishotel["hotel_sec"]."&language_id=".$language_id."&device=".$deviceType);

$hotelimage  = "".$thiscomp["engine_path"]."/img-server/hotels/".$thishotel["hotel_sec"]."/gallery/".$thishotel["main_image"]."";
?>
<div class="mg-best-rooms" style="position: relative;z-index: 1; padding:0px; background: #eee; border-bottom: 1px solid #ddd;">
      <div class="container" align="center">
        <h2 style="margin: 10px; font-size:35px;" class="text-main"><?=$thismenu["facilities"];?></h2>
      </div>
</div>

		
		<div class="mg-about-features" style="padding-top:30px;margin-bottom:0px;padding-bottom:0px; background: #f5f5f5;">
			<div class="container">
				<div class="row">
					<div class="col-md-12" style="<?=$padding;?>">
						<h2 class="mg-sec-left-title"><?=$fac_short;?></h2>
							<p><?=$fac;?></p>
					</div>
				</div>

				
			
				<div class="row" style="margin-bottom:40px;">
					<div class="col-md-5" style="<?=$padding;?>">
						<?=$fac_gallery;?>
					</div>
					<div class="col-md-7">
						<div class="row" style="margin: 0px;">

<?PHP 
$sql  = "SELECT * FROM facilities_type WHERE facilities_type_id = '2'  ";
$queryfacilitiestype = mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error());
$thisfactype = mysql_fetch_array($queryfacilitiestype);
?>
<div class="col-sm-12" style="<?=$padding;?>"><h4 class="mg-avl-room-title" style="text-shadow: -1px -1px #fff;"><b><?=$thisfactype["facilities_type_name"];?></b></h4></div>					
<?PHP 
$sql  = "SELECT * FROM hotel_facilities LEFT JOIN facilities ON fac_id = facilities_id WHERE hotel_facilities_hotel_sec = '".$thishotel["hotel_sec"]."' AND hotel_facilities_type_id = '2' AND hotel_facilities_select = 'YES' AND hotel_facilities.language_id = '".$language_id."' ORDER BY icon DESC ";
$queryfacilities = mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error());

while ($allfac = mysql_fetch_array($queryfacilities)) {
	if($allfac["icon"] <> ''){
		$icon = $allfac["icon"];
	}
	else {
		$icon = "fa fa-check-circle-o";
	}
	?>
							<div class="col-md-4" style="<?=$padding;?>">
								<div class="mg-feature" style="margin:0px;">
									
										<i class="<?=$icon;?>" style="margin-right:10px;"></i>
										<span><?=$allfac["hotel_facilities_name"];?> <span class="pull-right" style="font-size:13px;font-weight:200;"><?=$allfac["hotel_facilities_value"];?></span></span>
									
								</div>
							</div>
<?PHP }?>

						</div>

<?PHP 
$sql  = "SELECT COUNT(hotel_facilities_id) AS total FROM hotel_facilities WHERE hotel_facilities_hotel_sec = '".$thishotel["hotel_sec"]."' AND ((hotel_facilities_type_id = '3') OR (hotel_facilities_type_id = '5')) AND hotel_facilities_select = 'YES' AND hotel_facilities.language_id = '".$language_id."' ORDER BY hotel_facilities_id ";
$querycount= mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error());
$countfac = mysql_fetch_array($querycount);
if($countfac["total"] > '0'){
?>
<?PHP 
$sql  = "SELECT * FROM facilities_type WHERE facilities_type_id = '3' ";
$queryfacilitiestype = mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error());
$thisfactype = mysql_fetch_array($queryfacilitiestype);
?>
<div class="col-sm-12" style="<?=$padding;?>"><h4 class="mg-avl-room-title"><b><?=$thisfactype["facilities_type_name"];?></b></h4></div>
						<div class="row" style="margin: 0px;">
<?PHP 
$sql  = "SELECT * FROM hotel_facilities WHERE hotel_facilities_hotel_sec = '".$thishotel["hotel_sec"]."' AND hotel_facilities_type_id = '3' AND hotel_facilities_select = 'YES' AND hotel_facilities.language_id = '".$language_id."' ORDER BY hotel_facilities_id ";
$queryfacilities = mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error());

while ($allfac = mysql_fetch_array($queryfacilities)) {
?>
							<div class="col-md-4" style="<?=$padding;?>">		
										<i class="fa fa-check-circle-o" style="margin-right:10px;"></i> 
										<?=$allfac["hotel_facilities_name"];?><br>
										<span><?=$allfac["hotel_facilities_value"];?></span>
							</div>
<?PHP }?>
						</div>
<?PHP }?>
<?PHP 
$sql  = "SELECT COUNT(hotel_facilities_id) AS Total FROM hotel_facilities WHERE hotel_facilities_hotel_sec = '".$thishotel["hotel_sec"]."' AND hotel_facilities_type_id = '5' AND hotel_facilities_select = 'YES' ";
$querycount5= mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error());
$count5 = mysql_fetch_array($querycount5);
if($count5["total"] > '0'){?>
<?PHP 
$sql  = "SELECT * FROM facilities_type WHERE facilities_type_id = '5' ";
$queryfacilitiestype = mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error());
$thisfactype = mysql_fetch_array($queryfacilitiestype);
	?>
<div class="col-sm-12" style="<?=$padding;?>"><h4 class="mg-avl-room-title"><b><?=$thisfactype["facilities_type_name"];?></b></h4></div>
						<div class="row" style="margin: 0px;">

<?PHP 
$sql  = "SELECT * FROM hotel_facilities WHERE hotel_facilities_hotel_sec = '".$thishotel["hotel_sec"]."' AND hotel_facilities_type_id = '5' AND hotel_facilities_select = 'YES' AND hotel_facilities.language_id = '".$language_id."' ORDER BY hotel_facilities_id ";
$queryfacilities = mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error());

while ($allfac = mysql_fetch_array($queryfacilities)) {
	?>
							<div class="col-sm-12" style="margin-bottom:0px;<?=$padding;?>">		
								<i class="fa fa-check-circle-o" style="margin-right:10px;"></i> 
								<?=$allfac["hotel_facilities_name"];?><small class="pull-right" style="margin-left:20px;"><?=$allfac["hotel_facilities_value"];?></small>
										
							</div>
<?PHP }?>
<?PHP }?>
						</div>

					</div>
				</div>

				</div>
			</div>
		</div>
		



<input type="hidden" id="page" value="facilities">
<script type="text/javascript">
$('#pleasewait').fadeOut('slow');   
</script>
<script src="js/owl.carousel.min.js"></script>
    <script src="js/starrr.min.js"></script>
    <script src="js/jquery.parallax-1.1.3.js"></script>
    <script src="js/script.js"></script>
