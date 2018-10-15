<?PHP
require_once("site.configs.php");
require_once 'Mobile_Detect.php';
$detect = new Mobile_Detect;
$deviceType = ($detect->isMobile() ? ($detect->isTablet() ? 'tablet' : 'phone') : 'computer');
$scriptVersion = $detect->getScriptVersion();

if($deviceType == 'phone'){
$padding_footer = "padding:0px;";
$align = "text-align:center;";
}
else {
$padding_footer = "";
$align = "";
}

?>

<?PHP if($deviceType == 'phone'){?>
<div style="height:10px;border-top:1px solid #e5e5e5;border-bottom:1px solid #e5e5e5;background:#eee;"></div>
<?PHP }?>
  <div class="mg-best-rooms" style="text-align:left;margin-top:0px;padding-top:30px; background: #f5f5f5;">
    <div class="container">
      <div class="row">
<!--Start Facebook Plugin-->
<?PHP
$sql  = "SELECT * FROM hotel_social WHERE hotel_sec = '".$thishotel["hotel_sec"]."' AND social_code = 'FB' AND social_link <> '' ";
$resault = mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error());
$thisfacebook = mysql_fetch_array($resault);
?>

<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.5";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
</script>
<div class="col-md-3" style="<?=$padding;?>" align="right">
<div class="fb-page" data-href="<?=$thisfacebook["social_link"];?>" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="false" data-show-posts="false" style="margin-left:0px;">
<div class="fb-xfbml-parse-ignore"><blockquote cite="<?=$thisfacebook["social_link"];?>"><a href="https://www.facebook.com/facebook">Facebook</a></blockquote></div>
</div>
</div>
<!--Facebook Plugin-->

<!--TripAdvisor Plugin Joe-->
<?PHP
$sql  = "SELECT * FROM trip_advisor WHERE hotel_sec = '".$thishotel["hotel_sec"]."' AND name = 'Review' AND status = 'ON' ";
$query = mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error());
$thistrip = mysql_fetch_array($query);
if($thistrip["descripts"] <> ''){?>
<div class="col-md-3" style="<?=$padding;?>margin-top:-15px;">
<!--Trip Advisor-->
<div style="padding-left:0px;">
<?=$thistrip["descripts"];?>
</div>
</div>
<?PHP }?>



      </div>
    </div>
  </div>

<?PHP if($deviceType <> 'phone'){?>
     <div style="position:absolute;text-align:right;top:55%;right:7%;z-index:10000;">     
<div class="col-md-3" style="<?=$padding;?>margin-top:-15px;">
<!--Trip Advisor-->
<div style="padding-left:0px;">
<?=$thistrip["descripts"];?>
</div>
</div>

    </div>
<?PHP }?>	