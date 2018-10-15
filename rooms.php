<?PHP include("inc.slide.php"); ?>
<?PHP
require_once("site.configs.php");
$thishotel  = $hotel->getHotel($hotel_sec);
$thiscomp   = $company->getCompany($thishotel["hotel_chain_id"]);

if (!$_REQUEST["currency_id"]){
$currency_abb = $thishotel["currency_id"];
}
else {
$currency_abb = $_REQUEST["currency_id"];
}
$thiscur 	= $hotel->getCurrency($currency_abb);

$sql  = "SELECT * FROM hotel_currency WHERE currency = '".$thishotel["currency_id"]."' ";
	$query= mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error());
	$thishotelcurrency = mysql_fetch_array($query);

	if($thiscur["currency_abb"] == $thishotel["currency_id"]){
		$currency_rate = 1;
	}
	else {
	$sql  = "SELECT * FROM hotel_currency WHERE currency = '".$thiscur["currency_abb"]."' ";
	$query= mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error());
	$selectcurrency = mysql_fetch_array($query);
	//$currency_convert = (1/$selectcurrency["rate"]);

	
		$currency_rate = ($selectcurrency["rate"]*$thishotelcurrency["rate"]);
	}


require_once 'Mobile_Detect.php';
$detect = new Mobile_Detect;
$deviceType = ($detect->isMobile() ? ($detect->isTablet() ? 'tablet' : 'phone') : 'computer');
$scriptVersion = $detect->getScriptVersion();
if($deviceType == 'phone'){
$margin_top = "0px";
$max_logo = "max-width:70px;";
$padding = "padding:0px;";
$padding_bottom = "padding-bottom:0px;margin-bottom:20px;";
$font_size = "font-size:16px;";
$padding_top = "padding-top:0px;";
$button_book = "align=\"center\"";
}
else {
$margin_top = "80px";
$max_logo = "max-width:90px;";
$data_target = "";
$padding= "";
$padding_bottom = "";
$font_size = "font-size:18px;";
$padding_top = "padding-top:30px;";
$button_book = "align=\"right\"";
}


if($thishotel["skin_color"] == ''){
  $skin_color = 'orange';
}
else {
  $skin_color = $thishotel["skin_color"];
}

$accom_short = str_replace("apos","'",$thishotel["accom_short"]);
$accom_short = str_replace(" and "," & ",$accom_short);
$accom_short = str_replace(" plus "," + ",$accom_short);


?>
<div style="background: #f5f5f5; padding-bottom:40px;">
<div class="mg-best-rooms" style="position: relative;z-index: 1; padding:0px; background: #eee; border-bottom: 1px solid #ddd;">
      <div class="container" align="center">
        <h2 style="margin: 10px; font-size:35px;" class="text-main"><?=$thismenu["menu_room"];?></h2>
      </div>
</div>
		

		<div class="mg-page mg-available-rooms" style="padding-bottom:0px;padding-top:30px;">
			<div class="container">
				<div class="row">
					<div class="col-md-12" style="<?=$padding;?>">
						<h5 class="mg-sec-left-title" style="margin-bottom:0px;"><?=$accom_short;?></h5>
					</div>
				</div>
			</div>
		</div>
						
					
<?php
if($_REQUEST["room_id"] > '0'){
$room_id = "AND room.room_id <> '".$_REQUEST["room_id"]."' ";
$sql  = "SELECT *, room_language.room_type, room_language.room_details FROM room LEFT JOIN room_language ON room.room_id = room_language.room_id AND room_language.language_id = '".$language_id."' WHERE room.hotel_sec = '".$thishotel["hotel_sec"]."' AND room.room_id = '".$_REQUEST["room_id"]."'  ";
$query = mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error());
$thisroom = mysql_fetch_array($query);
$image  = "".$thiscomp["engine_path"]."/img-server/rooms/".$thishotel["hotel_sec"]."_".$thisroom["room_id"]."/".$thisroom["main_image"].""; 

$sql  = "SELECT rate, master_allotment.master_rate_id FROM master_allotment LEFT JOIN master_rate ON master_allotment.master_rate_id = master_rate.master_rate_id WHERE master_rate_status = '1' AND master_allotment.room_id = '".$thisroom["room_id"]."' AND fix_date = '".date("Y-m-d")."' ORDER BY rate ASC LIMIT 1 ";
$resultmaster = mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error());
$thismaster = mysql_fetch_array($resultmaster);

$sql  = "SELECT rate FROM rate_plan_allotment LEFT JOIN rate_plan ON rate_plan_allotment.rate_plan_id = rate_plan.rate_plan_id WHERE rate_plan_status = '1'  AND rate_plan_allotment.master_rate_id = '".$thismaster["master_rate_id"]."' AND fix_date = '".date("Y-m-d")."' ORDER BY rate ASC LIMIT 1 ";
$resultrateplan = mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error());
$thisrateplan = mysql_fetch_array($resultrateplan);
if($thisrateplan["rate"] > '0'){
if($thisrateplan["rate"] <= $thismaster["rate"]){
	$thisrate = ($thisrateplan["rate"]*$currency_rate);
}
else {
	$thisrate = ($thismaster["rate"]*$currency_rate);
}
}
else {
	$thisrate = ($thismaster["rate"]*$currency_rate);
}
$thisrateA = number_format(($thisrate),2);
$thisrate = substr($thisrateA, 0,-3);
$thissubrate = substr($thisrateA, -3);

$room_gallery = file_get_contents("http://www.bookingboxes.com/mega/room_gallery_page.php?hotel_sec=".$thishotel["hotel_sec"]."&language_id=".$language_id."&device=".$deviceType."&room_id=".$thisroom["room_id"]);

if($thisroom["free_wifi"] == 'YES'){
	$free_wifi = "<span class=\"text-success\">Free WIFI</span> <i class=\"fa fa-wifi text-success\"></i>";
}
else {
	$free_wifi = "";
}

if($thisroom["extra_adult"] > '0'){
$extra = $thisroom["extra_adult"];	
for($xn=0;
$xn<$extra;
$xn++){
$thisextrashow .= "<i class=\"fa fa-male text-muted\"></i>";
}
$plus = "<i class=\"fa fa-plus text-muted\"></i>";
}
else {
$thisextrashow = "";
$plus = "";	
}


for($n=0;
$n<$thisroom["max_people"];
$n++){
$thispeopleshow .= "<i class=\"fa fa-male text-green\"></i>";
}

if($thisroom["extra_children"] > '0'){
	for($xn=0;
	$xn<$thisroom["extra_children"];
	$xn++){
	$thisextra_childrenshow .= "<i class=\"fa fa-child text-muted\"></i>";
	}
$thisplus_children = "<i class=\"fa fa-plus text-muted\"></i>";
}
else {
$thisextra_childrenshow = "";
$thisplus_children = "";		
}
?>	
<div class="mg-page mg-available-rooms" style="margin:0px;padding:0px; margin-top: 20px;">
	<div class="container" style="<?=$padding;?>">
		<div class="row">
			<div class="col-md-12" style="<?=$padding;?>">
			
			<div class="mg-avl-room" style="margin:0px;margin-bottom:0px;padding-bottom:0px;">
				<div class="row" style="margin:0px; border:1px solid #ddd;background: #fff;">
					<div class="col-sm-5" style="padding:0px;">
						<div class="mg-gallery-container" style="padding:0px;">
							<?=$room_gallery;?>
						</div>
					</div>
					<div class="col-sm-7" style="">

									
									<?PHP if($deviceType == 'phone'){?>
									<h4 class="mg-avl-room-title"><?=$thisroom["room_type"];?>
									<span class="hidden-md hidden-lg pull-right" style="font-size:17px;margin-top:3px;color:#3BB3C2;"><?=$thisrateA;?><font style="font-size:12px;">/<?=$thismenu["night"];?></font></span></span>
									</h4>
									<?PHP }else {?>
									<h3 class="mg-avl-room-title" style="margin-top:15px;"><?=$thisroom["room_type"];?>
									 <span class="hidden-xs" style="color:#3BB3C2"><?=$thisrate;?><sup><?=$thissubrate;?><small style="color:#3BB3C2">/<?=$thismenu["night"];?></small></sup></span></h3>
									<?PHP }?>
									

									
									<div>
										<span><b><?=$thismenu["troom_size"];?> <?=$thisroom["room_size"];?> <?=$thismenu["tsqm"];?></b> <?=$thispeopleshow;?><small><small><?=$thisplus;?></small></small><?=$thisextrashow;?><small><small><?=$thisplus_children;?></small></small><?=$thisextra_childrenshow;?></span><span class="pull-right text-success"><?=$free_wifi;?></span>

									</div>
									
<div class="row" style="margin:0px;">
<div class="col-md-6 col-xs-12" style="padding:0px;">+<i class="fa fa-male"></i> <?=$thismenu["extra_adult_charge"];?> <?=$thisroom["extra_adult_rate"]." ".$thiscur["currency_abb"];?></div>
<div class="col-md-6 col-xs-12" style="padding:0px;">+<i class="fa fa-child"></i> <?=$thismenu["extra_children_charge"];?> <?=$thisroom["extra_children_rate"]." ".$thiscur["currency_abb"];?> (<?=$thisroom["infant_age"]."-".$thisroom["max_childage"]." ".$thismenu["year_old"];?>)</div>
</div>

									<div class="row mg-room-fecilities" style="margin:0px;">
									<p style="margin-bottom:10px;">
									<?=$thisroom["room_details"];?>
									<a class="collapsed moredetails" role="button" data-toggle="collapse" data-parent="#accordion" href="#Room<?=$thisroom["room_id"];?>" aria-expanded="false" aria-controls="Room<?=$thisroom["room_id"];?>" style="padding:0px;"><small class="pull-right" style="min-width:150px;text-align:right;"><i class="fa fa-info-circle"></i> <?=$thismenu["tmore_details"];?></small></a>
									</p>								
<?PHP 
$sql  = "SELECT *, (amenity.icon) AS icon FROM room_amenity LEFT JOIN amenity ON room_amenity_id = amenity_id WHERE room_amenity_hotel_sec = '".$thishotel["hotel_sec"]."' AND room_amenity_room_id = '".$thisroom["room_id"]."' AND room_amenity.language_id = '".$language_id."' AND status = 'YES' AND icon <> '' LIMIT 6 ";
$resultamenity = mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error());
while ($allamenity = mysql_fetch_array($resultamenity)) {
$room_amenity_id .= "AND room_amenity_id <> '".$allamenity["room_amenity_id"]."' ";
	if($allamenity["icon"] <> ''){
		$icon = "<i class=\"".$allamenity["icon"]."\"></i>";
	}
	else {
		$icon = "<i class=\"fa fa-circle-o\"></i>";
	}
?>									
										<div class="col-sm-6 text-dark" style="padding:0px;padding-top:2px;padding-bottom:2px;">
											<span style="<?=$font_size;?>line-height: 30px;padding-bottom: 20px;font-weight: 300;"><?=$icon;?> <?=$allamenity["room_amenity_name"];?></span>
										</div>
<?PHP }?>
<div id="Room<?=$thisroom["room_id"];?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
<?PHP
	$filter = '6';
$sql  = "SELECT *, (amenity.icon) AS icon FROM room_amenity LEFT JOIN amenity ON room_amenity_id = amenity_id WHERE room_amenity_hotel_sec = '".$thishotel["hotel_sec"]."' AND room_amenity_room_id = '".$thisroom["room_id"]."' AND room_amenity.language_id = '".$language_id."' AND status = 'YES' ".$room_amenity_id." ";
$fquery = mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error());
$q=0;
while ($frow = mysql_fetch_array($fquery)) {


if ($frow["room_amenity_value"] == "") {
$value = "";
}
else {
$value = "(".$frow["room_amenity_value"].")";
}

if ($frow["icon"] <> "") {
$icon = "<i class=\"".$allamenity["icon"]."\"></i>";
}
else {
$icon = "<i class=\"fa fa-circle-o\"></i>";
}
?>							
								
											<div class="col-sm-6 text-dark" style="padding:0px;padding-top:2px;padding-bottom:2px;">
											<span style="<?=$font_size;?>line-height: 30px;padding-bottom: 20px;font-weight: 300;"><?=$icon;?> <?=$frow["room_amenity_name"]." ".$value;?></span>
											</div>
<?PHP $q++;}?>

							</div>
</div>



<div style="width:100%; padding: 10px;" <?=$button_book;?>>
	<button type="submit" class="btn btn-main btn-block" style="border:1px solid #fff;padding: 8px 20px;margin-bottom:0px;width:100px; background: #3BB3C2;" onclick="BookNow();"><?=$thismenu["book_now"];?></button>
</div>						
			</div>
		</div>

		</div>
		</div>
	</div>
</div>
<?PHP ?>


<?PHP }else {
$room_id = "";
}

$sql  = "SELECT *, room_language.room_type, room_language.room_details FROM room LEFT JOIN room_language ON room.room_id = room_language.room_id AND room_language.language_id = '".$language_id."' WHERE room.hotel_sec = '".$thishotel["hotel_sec"]."' AND room_status = '1' ".$room_id." ";
$roomquery = mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error());
$i = 0;
while ($allroom = mysql_fetch_array($roomquery)) {

$image[$i]  = "".$thiscomp["engine_path"]."/img-server/rooms/".$thishotel["hotel_sec"]."_".$allroom["room_id"]."/".$allroom["main_image"].""; 

$sql  = "SELECT rate, master_allotment.master_rate_id FROM master_allotment LEFT JOIN master_rate ON master_allotment.master_rate_id = master_rate.master_rate_id WHERE master_rate_status = '1' AND master_allotment.room_id = '".$allroom["room_id"]."' AND fix_date = '".date("Y-m-d")."' ORDER BY rate ASC LIMIT 1 ";
$resultmaster = mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error());
$thismaster = mysql_fetch_array($resultmaster);

$sql  = "SELECT rate FROM rate_plan_allotment LEFT JOIN rate_plan ON rate_plan_allotment.rate_plan_id = rate_plan.rate_plan_id WHERE rate_plan_status = '1' AND rate_plan_allotment.master_rate_id = '".$thismaster["master_rate_id"]."' AND fix_date = '".date("Y-m-d")."' ORDER BY rate ASC LIMIT 1 ";
$resultrateplan = mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error());
$thisrateplan = mysql_fetch_array($resultrateplan);
if($thisrateplan["rate"] > '0'){
if($thisrateplan["rate"] <= $thismaster["rate"]){
	$rate[$i] = ($thisrateplan["rate"]*$currency_rate);
}
else {
	$rate[$i] = ($thismaster["rate"]*$currency_rate);
}
}
else {
	$rate[$i] = ($thismaster["rate"]*$currency_rate);
}
$rateA[$i] = number_format(($rate[$i]),2);
$rate[$i] = substr($rateA[$i], 0,-3);
$subrate[$i] = substr($rateA[$i], -3);

$room_gallery = file_get_contents("http://www.bookingboxes.com/mega/room_gallery_page.php?hotel_sec=".$thishotel["hotel_sec"]."&language_id=".$language_id."&device=".$deviceType."&room_id=".$allroom["room_id"]);

if($allroom["free_wifi"] == 'YES'){
	$free_wifi = "<span class=\"text-success\">Free WIFI</span> <i class=\"fa fa-wifi text-success\"></i>";
}
else {
	$free_wifi = "";
}

if($allroom["extra_adult"] > '0'){
	for($xn=0;
	$xn<$allroom["extra_adult"];
	$xn++){
	$extrashow[$i] .= "<i class=\"fa fa-male text-muted\"></i>";
	}
	$plus = "<i class=\"fa fa-plus text-muted\"></i>";
}
else {
$extrashow[$i] = "";
$plus = "";	
}

$maxpeople = $allroom["max_people"];
for($n=0;
$n<$maxpeople;
$n++){
$peopleshow[$i] .= "<i class=\"fa fa-male text-green\"></i>";
}
if($allroom["extra_children"] > '0'){
$extra_children = $allroom["extra_children"];	
for($xn=0;
$xn<$extra_children;
$xn++){
$extra_childrenshow[$i] .= "<i class=\"fa fa-child text-muted\"></i>";
}
$plus_children = "<i class=\"fa fa-plus text-muted\"></i>";
}
else {
$extra_childrenshow[$i] = "";
$plus_children = "";		
}

?>

<div class="mg-page mg-available-rooms" style="margin:0px;padding:0px; margin-top: 20px;">
	<div class="container" style="<?=$padding;?>">
		<div class="row">
			<div class="col-md-12" style="<?=$padding;?>">
			
			<div class="mg-avl-room" style="margin:0px;margin-bottom:0px;padding-bottom:0px;">
				<div class="row" style="margin:0px;background: #fff; border: 1px solid #ddd;">
					<div class="col-md-5" style="padding:0px;">
						<div class="mg-gallery-container" style="padding:0px;<?PHP if($allroom["room_id"] == $_REQUEST["room_id"]){echo $room_select;}else {echo "";};?>">
							<?=$room_gallery;?>
						</div>
					</div>
					<div class="col-md-7">

									
									<?PHP if($deviceType == 'phone'){?>
									<h4 class="mg-avl-room-title"><?=$allroom["room_type"];?>
									<span class="hidden-md hidden-lg pull-right" style="font-size:17px;margin-top:3px;color:#3BB3C2;"><?=$rateA[$i];?><font style="font-size:12px;">/<?=$thismenu["night"];?></font></span></span>
									</h4>
									<?PHP }else {?>
									<h3 class="mg-avl-room-title" style="margin-top:15px;"><?=$allroom["room_type"];?>
									 <span class="hidden-xs" style="color:#3BB3C2"><?=$rate[$i];?><sup><?=$subrate[$i];?><small style="color:#3BB3C2">/<?=$thismenu["night"];?></small></sup></span></h3>
									<?PHP }?>
									

									
									<div>
										<span><b><?=$thismenu["troom_size"];?> <?=$allroom["room_size"];?> <?=$thismenu["tsqm"];?></b> <?=$peopleshow[$i];?><small><small><?=$plus;?></small></small><?=$extrashow[$i];?><small><small><?=$plus_children;?></small></small><?=$extra_childrenshow[$i];?></span><span class="pull-right text-success"><?=$free_wifi;?></span>

									</div>
									
<div class="row" style="margin:0px;">
<?PHP if($allroom["extra_adult"] > '0'){?>
<div class="col-md-6 col-xs-12" style="padding:0px;">+<i class="fa fa-male"></i> <?=$thismenu["extra_adult_charge"];?> <?=$allroom["extra_adult_rate"]." ".$thiscur["currency_abb"];?></div>
<?PHP }?>
<?PHP if($allroom["extra_children"] > '0'){?>
<div class="col-md-6 col-xs-12" style="padding:0px;">+<i class="fa fa-child"></i> <?=$thismenu["extra_children_charge"];?> <?=$allroom["extra_children_rate"]." ".$thiscur["currency_abb"];?> (<?=$allroom["infant_age"]."-".$allroom["max_childage"]." ".$thismenu["year_old"];?>)</div>
<?PHP }?>
</div>

									<div class="row mg-room-fecilities" style="margin:0px;">
									<p style="margin-bottom:10px;">
									<?=$allroom["room_details"];?><a class="collapsed moredetails" role="button" data-toggle="collapse" data-parent="#accordion" href="#Room<?=$allroom["room_id"];?>" aria-expanded="false" aria-controls="Room<?=$allroom["room_id"];?>" style="padding:0px;"><small class="pull-right" style="min-width:150px;text-align:right;"><i class="fa fa-info-circle"></i> <?=$thismenu["tmore_details"];?></small></a>
									</p>								
<?PHP 
$sql  = "SELECT *, (amenity.icon) AS icon FROM room_amenity LEFT JOIN amenity ON room_amenity_id = amenity_id WHERE room_amenity_hotel_sec = '".$thishotel["hotel_sec"]."' AND room_amenity_room_id = '".$allroom["room_id"]."' AND room_amenity.language_id = '".$language_id."' AND status = 'YES' AND icon <> '' LIMIT 6 ";
$resultamenity = mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error());
while ($allamenity = mysql_fetch_array($resultamenity)) {
$room_amenity_id .= "AND room_amenity_id <> '".$allamenity["room_amenity_id"]."' ";
	if($allamenity["icon"] <> ''){
		$icon = "<i class=\"".$allamenity["icon"]."\"></i>";
	}
	else {
		$icon = "<i class=\"fa fa-circle-o\"></i>";
	}
?>									
										<div class="col-sm-6 text-dark" style="padding:0px;padding-top:2px;padding-bottom:2px;">
											<span style="<?=$font_size;?>line-height: 30px;padding-bottom: 20px;font-weight: 300;"><?=$icon;?> <?=$allamenity["room_amenity_name"];?></span>
										</div>
<?PHP }?>
<div id="Room<?=$allroom["room_id"];?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
<?PHP
	$filter = '6';
$sql  = "SELECT *, (amenity.icon) AS icon FROM room_amenity LEFT JOIN amenity ON room_amenity_id = amenity_id WHERE room_amenity_hotel_sec = '".$thishotel["hotel_sec"]."' AND room_amenity_room_id = '".$allroom["room_id"]."' AND room_amenity.language_id = '".$language_id."' AND status = 'YES' ".$room_amenity_id." ";
$fquery = mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error());
$q=0;
while ($frow = mysql_fetch_array($fquery)) {


if ($frow["room_amenity_value"] == "") {
$value = "";
}
else {
$value = "(".$frow["room_amenity_value"].")";
}

if ($frow["icon"] <> "") {
$icon = "<i class=\"".$allamenity["icon"]."\"></i>";
}
else {
$icon = "<i class=\"fa fa-circle-o\"></i>";
}
?>							
								
											<div class="col-sm-6 text-dark" style="padding:0px;padding-top:2px;padding-bottom:2px;">
											<span style="<?=$font_size;?>line-height: 30px;padding-bottom: 20px;font-weight: 300;"><?=$icon;?> <?=$frow["room_amenity_name"]." ".$value;?></span>
											</div>
<?PHP $q++;}?>

							</div>
</div>



<div style="width:100%; padding:10px;" <?=$button_book;?>>
	<button type="submit" class="btn btn-main btn-block" style="border:1px solid #fff;padding: 8px 20px;width:100px; background: #3BB3C2;" onclick="BookNow();"><?=$thismenu["book_now"];?></button>
</div>						
			</div>
		</div>

		</div>
		</div>
	</div>
</div>
	
<?PHP $i++;}?>

</div>


<input type="hidden" id="page" value="rooms">
<script type="text/javascript">
$('#pleasewait').fadeOut('slow'); 
</script>
<script src="js/owl.carousel.min.js"></script>
    <script src="js/starrr.min.js"></script>
    <script src="js/jquery.parallax-1.1.3.js"></script>
    <script src="js/script.js"></script>

