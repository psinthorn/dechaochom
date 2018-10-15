<?PHP
require_once("site.configs.php");
$thishotel  = $hotel->getHotel($hotel_sec);
$thiscomp   = $company->getCompany($thishotel["hotel_chain_id"]);
$language_id = $_REQUEST["language_id"];
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

?>
   


<?PHP 
$sql  = "SELECT *, (event_language.event_name) AS event_name, (event_language.event_title) AS event_title, (event_language.event_description) AS event_description FROM event LEFT JOIN event_language ON event.id = event_language.event_id AND language_id = '".$language_id."' WHERE event.hotel_sec = '".$thishotel["hotel_sec"]."' AND id = '".$_REQUEST["id"]."' ";
$resaultevent = mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error());
$thisevent = mysql_fetch_array($resaultevent);
$event_name = str_replace("apos","'",$thisevent["event_name"]);
$event_name = str_replace(" and "," & ",$event_name);

$event_title = str_replace("apos","'",$thisevent["event_title"]);
$event_title = str_replace(" and "," & ",$event_title);

$event_description = str_replace("apos","'",$thisevent["event_description"]);
$event_description = str_replace(" and "," & ",$event_description);

//$dining_gallery = file_get_contents($thishotel["engine_path"]."/dining_gallery.php?hotel_sec=".$thishotel["hotel_sec"]."&device=".$deviceType."&dining_id=".$alldining["id"]);
$dining_gallery = file_get_contents("http://www.rezeazy.com/mega/event-details.php?hotel_sec=".$thishotel["hotel_sec"]."&language_id=".$language_id."&device=".$deviceType."&id=".$_REQUEST["id"]);
?> 

        <div class="row">
          
          <div class="col-md-12" style="<?=$padding;?>">
            <div style="position:absolute;top:0px;right:10px;z-index:100001;">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true" style="font-size:30px;">&times;</span><span class="sr-only">Close</span></button>
            </div>
            <div><?=$dining_gallery;?></div>
          </div>

          <div class="col-md-12" style="<?=$padding;?>">
            <div class="mg-about-us-txt" style="<?=$padding;?>">
              <h4 class="mg-avl-room-title"><?=$event_name;?></h4>
                <p><?=$event_title;?></p>
              <p align="center"><?=$event_description;?></p>
            </div>
          </div>
          
        </div>




<input type="hidden" id="page" value="dining">  
<script type="text/javascript">
$('#pleasewait').fadeOut('slow');   
</script>

<script src="js/owl.carousel.min.js"></script>

    <script src="js/jquery.parallax-1.1.3.js"></script>
    <script src="js/script.js"></script>

