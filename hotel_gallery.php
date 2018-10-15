<?PHP include("inc.slide.php"); ?>
<?PHP
require_once("site.configs.php");
$todaydate = explode("/", date("d/m/Y"));
          $day = $todaydate[0];
          $month = $todaydate[1];
          $year = $todaydate[2];    
$today = mktime(0,0,0, intval($month), intval($day), intval($year));
$arrival = explode("/", date("d/m/Y"));
          $day = $arrival[0];
          $month = $arrival[1];
          $year = $arrival[2];          
$mk_in = mktime(0,0,0, intval($month), intval($day), intval($year));
$mk_out = mktime(0,0,0, intval($month), intval($day)+1, intval($year));



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


$hotel_gallery = file_get_contents("http://www.bookingboxes.com/mega/hotel_gallery.php?hotel_sec=".$thishotel["hotel_sec"]."&language_id=".$language_id."&device=".$deviceType);
?>

<div class="mg-best-rooms" style="position: relative;z-index: 1; padding:0px; background: #eee; border-bottom: 1px solid #ddd;">
      <div class="container" align="center">
        <h2 style="margin: 10px; font-size:35px;" class="text-main"><?=$thismenu["gallery"];?></h2>
      </div>
</div>

<div class="mg-about-features" style="padding-top:30px;">
			<div class="container">
				<div class="row">
					<div class="col-md-12" style="<?=$padding;?>">
<?=$hotel_gallery;?>
          </div>
        </div>
      </div>
</div>
<input type="hidden" id="page" value="hotel_gallery">
<script type="text/javascript">
$('#pleasewait').fadeOut('slow');   
</script>
<script src="js/owl.carousel.min.js"></script>
    <script src="js/starrr.min.js"></script>
    <script src="js/jquery.parallax-1.1.3.js"></script>
    <script src="js/script.js"></script>
