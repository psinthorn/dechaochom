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
$padding_bottom = "padding-bottom:20px";
}
else {
$margin_top = "80px";
$max_logo = "max-width:90px;";
$data_target = "";
$padding = "";
$padding_bottom = "";
}


if($thishotel["skin_color"] == ''){
  $skin_color = 'orange';
}
else {
  $skin_color = $thishotel["skin_color"];
}


$dining_short = str_replace("apos","'",$thishotel["dining_short"]);
$dining_short = str_replace(" and "," & ",$dining_short);
$dining_short = str_replace(" plus "," + ",$dining_short);
?>
<div class="mg-best-rooms" style="position: relative;z-index: 1; padding:0px; background: #eee; border-bottom: 1px solid #ddd;">
      <div class="container" align="center">
        <h2 style="margin: 10px; font-size:35px;" class="text-main"><?=$thismenu["dining"];?></h2>
      </div>
</div>

<div class="mg-page mg-available-rooms" style="padding-top:30px;margin-bottom:0px;padding-bottom:0px;">
      <div class="container">
        <div class="row">
          <div class="col-md-12" style="<?=$padding;?>">
						<h2 class="mg-sec-left-title" style="margin-bottom:0px;"><?=$dining_short;?></h2>
          </div>
        </div>
      </div>
</div>          



   


<?PHP $sql  = "SELECT * FROM dining LEFT JOIN dining_language ON id = dining_id WHERE dining.hotel_sec = '".$thishotel["hotel_sec"]."' AND language_id = '".$language_id."' AND dining_status = 'ON' ORDER BY id ";
$querydining = mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error());
while ($alldining = mysql_fetch_array($querydining)) {
$dining_name = str_replace("apos","'",$alldining["dining_name"]);
$dining_name = str_replace(" and "," & ",$dining_name);
$dining_name = str_replace(" plus "," + ",$dining_name);

$dining_title = str_replace("apos","'",$alldining["dining_title"]);
$dining_title = str_replace(" and "," & ",$dining_title);
$dining_title = str_replace(" plus "," + ",$dining_title);

$dining_description = str_replace("apos","'",$alldining["dining_description"]);
$dining_description = str_replace(" and "," & ",$dining_description);
$dining_description = str_replace(" plus "," + ",$dining_description);

//$dining_gallery = file_get_contents($thishotel["engine_path"]."/dining_gallery.php?hotel_sec=".$thishotel["hotel_sec"]."&device=".$deviceType."&dining_id=".$alldining["id"]);
$dining_gallery = file_get_contents("http://www.bookingboxes.com/mega/dining_gallery.php?hotel_sec=".$thishotel["hotel_sec"]."&language_id=".$language_id."&device=".$deviceType."&id=".$alldining["id"]);
?> 
            

		<div class="mg-page mg-available-rooms" style="padding-top:0px;margin-top:0px;<?=$padding_bottom;?>margin-bottom:0px;">
      <div class="container">
        <div class="row">
          
          <div class="col-md-7" style="<?=$padding;?>">
            <div class="mg-about-us-txt" style="<?=$padding;?>" align="right">
              <h3 class="mg-avl-room-title"  align="right"><?=$dining_name;?></h3>
                <p  align="right"><?=$dining_title;?></p>
              <p align="right"><?=$dining_description;?></p>
            </div>
          </div>

          <div class="col-md-5" style="<?=$padding;?>">
            <div class="mg-gallery-container" style="<?=$padding;?>">
<?=$dining_gallery;?>            
            </div>
          </div>
          
        </div>
      </div>
    </div>


<?PHP }?>


<input type="hidden" id="page" value="dining">  
<script type="text/javascript">
$('#pleasewait').fadeOut('slow');   
</script>

<script src="js/owl.carousel.min.js"></script>

    <script src="js/jquery.parallax-1.1.3.js"></script>
    <script src="js/script.js"></script>

