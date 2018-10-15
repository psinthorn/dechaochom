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

		

		<div class="mg-page mg-available-rooms" style="padding-bottom:0px;padding-top:30px;">
			<div class="container">
				<div class="row">
					<div class="col-md-12" style="<?=$padding;?>">
						<h2 class="mg-sec-left-title" style="margin-bottom:0px;"><?=$thismenu["social_responsibility"];?></h2>
						<p style="padding-bottom:20px;font-size:16px;"></p>
					</div>
				</div>
			</div>
		</div>
						
					
<div class="mg-best-rooms parallax" id="bodyhome" style="padding:0px;padding-top:0px;<?=$padding_bottom;?>padding-bottom:20px;border-bottom:1px solid #e5e5e5;background:#fff;">
      <div class="container" style="margin-bottom:0px;padding:0px;">
                       

<?PHP
$sql  = "SELECT *, (social_res_language.social_res_name) AS social_res_name, (social_res_language.social_res_title) AS social_res_title, (social_res_language.social_res_desc) AS social_res_desc FROM social_res LEFT JOIN social_res_language ON social_res.id = social_res_language.social_res_id AND language_id = '".$language_id."' WHERE social_res.hotel_sec = '".$thishotel["hotel_sec"]."' AND social_res_status = 'ON' ";
$resaultevent = mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error());
$i=0;
while ($allsocial = mysql_fetch_array($resaultevent)) {

$url = "".$thiscomp["engine_path"]."/img-server/hotels/".$thishotel["hotel_sec"]."/social-res/".$allsocial["id"]."/".$allsocial["main_image"]."";
$header_response = get_headers($url, 1);

    echo "<div class=\"col-md-12\" style=\"padding:0px;\">
    <div class=\"row\" style=\"margin:0px;margin-bottom:15px;\">";
    if ( strpos( $header_response[0], "404" ) !== false ) {
      $img = "";
      echo "<div class=\"col-md-12\" style=\"background:none;\">";
    
    }
    else {
      $img = "<img src=\"".$url."\" style=\"width:100%\">";
      echo "<div class=\"col-md-4\">".$img."</div>";
      echo "<div class=\"col-md-8\" style=\"background:none;\">";
    }

    echo " <h4 class=\"mg-bn-title\" style=\"<?=$margin_top_event;?>padding-bottom:0px;font-size:16px;font-weight:400;\"><b>".$allsocial["social_res_name"]."</b></h4>
    <div style=\"font-size:14px;font-weight:200;\"><b>".$allsocial["social_res_title"]."</b></div>
    <div style=\"font-size:13px;font-weight:200;\">".$allsocial["social_res_desc"]."</div>
    </div>
    </div>
    </div>
";
$i++;}
?>
    
</div>




<input type="hidden" id="page" value="rooms">
<script type="text/javascript">
function EventDetails(id){
$( '#formModalEvent' ).modal( 'toggle' );
$( '#loadModalEvent' ).load('social-details.php?hotel_sec=<?=$thishotel["hotel_sec"];?>&id='+id+'&language_id=<?=$language_id;?>');
}
$('#pleasewait').fadeOut('slow'); 
</script>
<script src="js/owl.carousel.min.js"></script>
    <script src="js/starrr.min.js"></script>
    <script src="js/jquery.parallax-1.1.3.js"></script>
    <script src="js/script.js"></script>
<div class="modal fade" id="formModalEvent" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" style="<?=$width;?>margin-top:<?=$margin_top_event_image;?>;">
          <div class="modal-content">

            <div class="modal-body" id="loadModalEvent">
            </div>

          </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
</div><!-- /.modal --> 
