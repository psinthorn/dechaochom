<?PHP
require_once("site.configs.php");
$todaydate = explode("/", date("d/m/Y"));
          $day = $todaydate[0];
          $month = $todaydate[1];
          $year = $todaydate[2];    
$today = mktime(0,0,0, intval($month), intval($day), intval($year));         
$mk_in = mktime(0,0,0, intval($month), intval($day), intval($year));
$mk_out = mktime(0,0,0, intval($month), intval($day)+1, intval($year));

if($_REQUEST["language_id"]){
  $language_id = $_REQUEST["language_id"];
}
else {
  $language_id = $language_id;
}

require_once 'Mobile_Detect.php';
$detect = new Mobile_Detect;
$deviceType = ($detect->isMobile() ? ($detect->isTablet() ? 'tablet' : 'phone') : 'computer');
$scriptVersion = $detect->getScriptVersion();
if($deviceType == 'phone'){
$img_height = "450px";
$margin_left = "margin-left:0px;";
$margin_right = "margin-right:0px;";
$margin = "margin:5px;";
$padding_top = "padding-top:0px;";
$padding_bottom = "padding-bottom:0px;";
$background = "";
$bg_check = "150px;";
$text_header = "bottom:50%;";
$margin_bottom = "margin-bottom:450px;";
$top = "top:30px;";
$img_width = "width:80px;";
$div_social = "margin-bottom:10px;text-align:center;";
$slide_font_size = "font-size:20px;";
$slide_font_size_small = "font-size:16px;";
}
else {
$img_height = "650px";
$margin_left = "";
$margin_right = "";
$margin = "";
$padding_top = "";
$padding_bottom = "";
$background = "background-attachment: fixed !important;";
$bg_check = "80px;";
$text_bottom = "";
$margin_bottom = "";
$top = "top:220px;";
$img_width = "width:420px;";
$text_header = "bottom:30%;";
$div_social = "margin-bottom:80px;text-align:left;margin-left:5%;";
$slide_font_size = "font-size:50px;";
$slide_font_size_small = "font-size:30px;";
}

$todaydate = explode("/", date("d/m/Y"));
          $day = $todaydate[0];
          $month = $todaydate[1];
          $year = $todaydate[2];
$today = mktime(0,0,0, intval($month), intval($day), intval($year));
$mk_in = mktime(0,0,0, intval($month), intval($day), intval($year));
$mk_out = mktime(0,0,0, intval($month), intval($day+1), intval($year));
$mk_out_deal = mktime(0,0,0, intval($month), intval($day), intval($year));
$nights = (($mk_out-$mk_in)/86400);
$lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
$sql  = "SELECT * FROM secret_deal WHERE hotel_sec = '".$thishotel["hotel_sec"]."' AND secret_deal_status = 'ON' AND secret_deal_group_id = '5' AND max_stay >= '".$nights."' AND from_date <= '".date("Y-m-d", $mk_in)."' AND to_date >= '".date("Y-m-d", $mk_out_deal)."'  ";
$resaultFalshDeal = mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error());
$thisflashdeal = mysql_fetch_array($resaultFalshDeal);
  if(($thisflashdeal["secret_deal_option"] == 'All') OR ($thisflashdeal["secret_deal_option"] == '')){
  $pass = "YES";
  }
  else {
    if (strpos($thisflashdeal["secret_deal_option"], ''.$lang.'') !== false) {
    $pass = "YES";
    }
    else {
    $pass = "NO";
    }
  }
if($pass == 'YES'){

$falsh_deal_id = $thisflashdeal["secret_deal_id"];
$fromdate = explode("-", $thisflashdeal["from_date"]);
          $fday = $fromdate[2];
          $fmonth = $fromdate[1];
          $fyear = $fromdate[0];
$from_date = mktime(0,0,0, intval($fmonth), intval($fday), intval($fyear));

$todate = explode("-", $thisflashdeal["to_date"]);
          $tday = $todate[2];
          $tmonth = $todate[1];
          $tyear = $todate[0];
$to_date = mktime(0,0,0, intval($tmonth), intval($tday), intval($tyear));

$startdate = explode("-", $thisflashdeal["start_date"]);
          $sday = $startdate[2];
          $smonth = $startdate[1];
          $syear = $startdate[0];
$start_date = mktime(0,0,0, intval($smonth), intval($sday), intval($syear));

$enddate = explode("-", $thisflashdeal["end_date"]);
          $eday = $enddate[2];
          $emonth = $enddate[1];
          $eyear = $enddate[0];
$end_date = mktime(0,0,0, intval($emonth), intval($eday), intval($eyear));

if(($from_date <= $mk_in) AND ($to_date >= $mk_out) AND ($start_date <= $today) AND ($end_date >= $today)){
$day_left = ($end_date-$today);

$this_time = date("H:i:s");
$this_time = preg_replace("/^([\d]{1,2})\:([\d]{2})$/", "00:$1:$2", $this_time);
sscanf($this_time, "%d:%d:%d", $thours, $tminutes, $tseconds);
$this_seconds = $thours * 3600 + $tminutes * 60 + $tseconds;
$totalthistime = ($this_seconds);
//echo $totalthistime."<br>";

$start_time = $thisflashdeal["start_time"];
$start_time = preg_replace("/^([\d]{1,2})\:([\d]{2})$/", "00:$1:$2", $start_time);
sscanf($start_time, "%d:%d:%d", $shours, $sminutes, $sseconds);
$start_time = $shours * 3600 + $sminutes * 60 + $sseconds;
$totalstart_time = ($start_time);
//echo $totalstart_time."<br>";

$end_time = $thisflashdeal["end_time"];
$end_time = preg_replace("/^([\d]{1,2})\:([\d]{2})$/", "00:$1:$2", $end_time);
sscanf($end_time, "%d:%d:%d", $ehours, $eminutes, $eseconds);
$end_time = $ehours * 3600 + $eminutes * 60 + $eseconds;
$totalend_time = ($end_time);
//echo $totalend_time;

  if(($totalstart_time <= $totalthistime) AND ($totalend_time >= $totalthistime)){
  $time_left = ($end_time-$this_seconds);
  }
  else {
  $time_left = 0;
  }
}
//End else check condition
else {
$time_left = 0; 
}

}
//End else check pass
else {
$time_left = 0;
}
?>


		<div id="mega-slider" class="carousel slide carousel-fade" data-ride="carousel" style="font-family: 'Raleway';">
			

			<!-- Wrapper for slides -->
			<div class="carousel-inner" role="listbox">
<?php
$sql  = "SELECT * FROM img_header WHERE img_hotel_sec = '".$thishotel["hotel_sec"]."' ORDER BY img_id ";
$query = mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error());
$i=0;
while ($row = mysql_fetch_array($query)) { 
  $sql  = "SELECT * FROM img_header_language WHERE img_hotel_sec = '".$thishotel["hotel_sec"]."' AND img_id = '".$row["img_id"]."' AND img_language_id = '".$language_id."'  ";
  $querylang = mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error());
  $thisimg = mysql_fetch_array($querylang);
$text_lg[$i] = $thisimg["img_title"];
$text_sm[$i] = $thisimg["img_desc"];
if($i == '0'){
$active = "active beactive";
}
else {
$active = "";	
}
?>

				<div class="item <?=$active;?>" style="background: url('<?=$thiscomp["engine_path"];?>/img-server/hotels/<?=$thishotel["hotel_sec"];?>/header/<?=$row["img_id"];?>/<?=$row["img_name"];?>') no-repeat center center;background-size: cover;<?=$background;?>-webkit-background-size: cover!important;
  -moz-background-size: cover!important;
  -o-background-size: cover!important;
  background-size: cover!important;z-index:-1;width:100%;height:<?=$img_height;?>;" id="CheckInnerHeight<?=$i;?>">

          <?PHP if($text_lg[$i] <> ''){?>
          <div class="carousel-caption" style="<?=$text_header;?> background:none;padding:5px;margin-bottom:20px;font-weight:500;">
						<h2 align="center" class="text-color" style="color: #3BB3C2; font-weight: 500; margin-bottom:0px;text-shadow:0px -1px #fff;margin-top:5px;<?=$slide_font_size;?>"><?=$text_lg[$i];?></h2>
						<p align="center" style="color:#007CC2;text-shadow:0px -1px #fff;padding-bottom:0px;margin-bottom:0px;font-weight: 300;<?=$slide_font_size_small;?>"><?=$text_sm[$i];?></p>
          </div>
          <?PHP }?>	

			</div>

<?PHP $i++;}
echo "<input type=\"hidden\" id=\"countBG\" value=\"".$i."\">";
?>

<div align="center" style="<?=$top;?>position: absolute;left: 0;right: 0;margin-left: auto;margin-right: auto;" align="center"><img src="<?=$thiscomp["engine_path"]."/img-server/hotels/".$thishotel["hotel_sec"];?>/logo/logo-white.png" style="<?=$img_width;?>" align="center"></div>

<div align="center" style="position: absolute;right: 0;margin: auto; bottom: 0px; padding: 20px; z-index: 10001;" class="hidden-xs">
<table align="center">
<?PHP
$sql  = "SELECT * FROM hotel_social WHERE hotel_sec = '".$thishotel["hotel_sec"]."' AND social_status = 'YES' ";
$resault = mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error());
while ($allsocial = mysql_fetch_array($resault)) {?>
<tr>
  <td style="padding:5px;" align="right">
    <a href="<?=$allsocial["social_link"];?>" target="blank">
    <div style="width: auto; padding: 5px; padding-left: 10px; padding-right: 10px;border-radius: 50em;  display: none;" class="<?=$allsocial["social_class"];?>" id="Social<?=$allsocial["id"];?>">
      <?=$allsocial["text_title"];?>
    </div>  
    </a>
  </td>
  <td style="padding:5px;" onmouseover="ShowSocial('Social<?=$allsocial["id"];?>');" onmouseout="HideSocial('Social<?=$allsocial["id"];?>');" align="right">
  <a href="<?=$allsocial["social_link"];?>" target="blank">
  <div style="padding:5px; padding-top:8px; width: 50px; height: 50px; border-radius: 50em;" class="<?=$allsocial["social_class"];?>" align="center">
  <i class="<?=$allsocial["social_icon"];?>" style="position:relative; font-size:35px;"></i>
  </div>
  </a>
  </td>
</tr>
<?PHP }?>
<tr>
  <td style="padding:5px;"  align="right">
    <a href="tel:<?=$thishotel["hotel_tel"];?>" target="blank">
    <div style="width: auto; padding: 5px; padding-left: 10px; padding-right: 10px;border-radius: 50em;background: rgba(255,255,255,0.9);  display: none;" class="<?=$allsocial["social_class"];?>"  id="Social0">
      <?=$thishotel["hotel_tel"];?>
    </div>
    </a>
  </td>
  <td style="padding:5px;" onmouseover="ShowSocial('Social0');" onmouseout="HideSocial('Social0');" align="right">
  <a href="tel:<?=$thishotel["hotel_tel"];?>" target="blank">
  <div style="padding:5px; padding-top:8px; width: 50px; height: 50px; border-radius: 50em; background: rgba(255,255,255,0.9);" align="center"><i class="fa fa-phone" style="position:relative; font-size:35px;"></i></div>
  </a>
  </td>
</tr>
</table>
<script>
  function ShowSocial(ID){
    document.getElementById(ID).style.display = 'inline-block';
  }
  function HideSocial(ID){
    document.getElementById(ID).style.display = 'none';
  }
</script>
</div>

<?PHP if(($time_left > 0) AND ($deviceType <> 'phone')){?>
<div style="position: absolute; left: 0px; right: 0px; margin:auto; bottom:0px;" align="center">
<input type="hidden" id="time_left" value="<?=$time_left;?>">
  <script src="js/jquery.plugin.min.js"></script>
  <script src="js/jquery.countdown.min.js"></script>
  <script>
   $(function () {
      var time_left = document.getElementById('time_left').value
        var austDay = new Date();
        austDay = new Date(austDay.getFullYear() + 1, 1 - 1, -0);
        $('#countdown').countdown({until: time_left});
       // $('#year').text(austDay.getFullYear());
       //alert(austDay);

    });
  
    </script>
  <div class="mg-best-rooms parallax" id="bodyhome" style="padding-top:10px;padding-bottom:10px;background:none;border-bottom:1px solid #e5e5e5;">
    <div class="container" style="margin-bottom:0px;<?=$padding;?>">
      <div align="center">
        <h4 style="margin:0px;margin-bottom:10px;font-size:22px;"><?=$thisflashdeal["secret_deal_name"];?></h4>
        <div id="countdown"></div>
        <div id="year"></div>
        <div style="font-size:22px; color:#fff;">Get more disc. <?=$thisflashdeal["discount"];?>% off.</div>
      </div>  <!-- / .row -->   
    </div>
  </div>
</div>
<?PHP }?>
<div class="mg-book-now" style="background:none;position:absolute;bottom:0px;margin:0px;width:100%;margin:auto;right:0;">
<div class="panel" style="background:none;border:none;width:100%;padding:0px;margin-bottom:0px;margin:0px;width:100%;">
<!-- available class for header: .sticky .center-content .transp -->

<?PHP if($deviceType == 'phone'){?>

  <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne" style="background:none;border:none;margin:0px;">
      <div align="left" style="padding:10px;padding-top:0px;background:none;padding-bottom:0px;">
            <div class="mg-bn-forms" style="padding-top:0px;padding-bottom:0px;margin-top:0px;margin-bottom:0px;">
            
              <form id="BookNow" class="no-margin" method="post" action="https://www.bookingboxes.com/mega/">
                <div class="row" style="margin:0px;">
                  <table style="width:100%" style="margin:0px;"><tr>
                  <td style="padding-right:5px;" align="center">
                  <label style="margin-top:0px;color:#fff;"><?=$thismenu["arrival_date"];?></label>
                      <input type="text" class="form-control" id="arrival_date" name="arrival_date" value="<?=date("d/m/Y", $mk_in);?>" readonly style="cursor:pointer;background:url('images/bg_black30.png');padding-left:30px;position:relative;z-index:3;" placeholder="<?=$thismenu["arrival_date"];?>" onmouseover="Selectdate('arrival_date', 'departure_date');">
                      <span class="fa fa-calendar" style="float: right;margin-right: 8px;margin-top: -25px;position: relative;z-index:2;cursor:pointer;color:#fff;"></span>
                  </td>
                  <td style="padding-left:5px;" align="center">
                  <label style="margin-top:0px;color:#fff;"><?=$thismenu["departure_date"];?></label>
                      <input type="text" class="form-control" id="departure_date" name="departure_date" placeholder="" value="<?=date("d/m/Y", $mk_out);?>" readonly style="cursor:pointer;background:url('images/bg_black30.png');padding-left:30px;position:relative;z-index:3;" onmouseover="Selectdate('arrival_date', 'departure_date');">
                      <span class="fa fa-calendar" style="float: right;margin-right: 8px;margin-top: -25px;position: relative;z-index:2;cursor:pointer;color:#fff;"></span>
                  </td>
                  </tr>
                  </table>
<?PHP
$sql  = "SELECT * FROM secret_deal WHERE hotel_sec = '".$thishotel["hotel_sec"]."' AND secret_deal_status = 'ON' AND secret_deal_group_id = '3' ";
$resault = mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error());
$thisdealpromotioncode = mysql_fetch_array($resault);
if($thisdealpromotioncode["secret_deal_id"] > 0){
$fromdate = explode("-", $thisdealpromotioncode["from_date"]);
          $fday = $fromdate[2];
          $fmonth = $fromdate[1];
          $fyear = $fromdate[0];
$from_date = mktime(0,0,0, intval($fmonth), intval($fday), intval($fyear));

$todate = explode("-", $thisdealpromotioncode["to_date"]);
          $tday = $todate[2];
          $tmonth = $todate[1];
          $tyear = $todate[0];
$to_date = mktime(0,0,0, intval($tmonth), intval($tday), intval($tyear));

if(($from_date <= $mk_in) AND ($to_date >= $mk_out)){  
?>
                <div style="margin-top:5px;">
                <table style="width:100%" style="margin:0px;"><tr>
                  <td style="padding-right:5px;width:50%;">
                    <div class="input-group">
                      <div class="input-group-addon" style="background:url('images/bg_black30.png');border-right:none;"><i class="fp-ht-key"></i></div>
                      <input type="text" class="form-control" id="promotion_code" placeholder="<?=$thismenu["tpromotion_code"];?>" style="background:url('images/bg_black30.png');border-left:none;" name="promotion_code">
                      <input type="hidden" id="secret_deal_id_promotion_code" name="secret_deal_id_promotion_code" value="<?=$thisdealpromotioncode["secret_deal_id"];?>">
                    </div>
                  </td>
                  <td style="padding-left:5px;">
                    <div><button type="submit" class="btn btn-main btn-block" style="border:1px solid #fff;padding: 8px 20px;margin-bottom:0px;"><?=$thismenu["check_now"];?></button></div>
                  </td>

                </tr></table>
                </div>
<?PHP } else {?>
                <div style="margin-top:10px;"><button type="submit" class="btn btn-main btn-block" style="border:1px solid #fff;padding: 8px 20px;margin-bottom:0px;"><?=$thismenu["check_now"];?></button></div>
<?PHP } } else {?>
               
          <div style="margin-top:10px;"><button type="submit" class="btn btn-main btn-block" style="border:1px solid #fff;padding: 8px 20px;margin-bottom:0px;"><?=$thismenu["check_now"];?></button></div>
<?PHP }?>
                
                </div>
                <input type="hidden" name="hotel_sec" value="<?=$thishotel["hotel_sec"];?>">
                <input type="hidden" name="language_id" value="<?=$_REQUEST["language_id"];?>">
                <input type="hidden" name="currency_id" id="currency_id" value="<?=$thiscur["currency_abb"];?>">
                <input type="hidden" name="page" value="<?=$page;?>">
                <input type="hidden" name="ID" id="Member" value="<?=$ID;?>">
              </form>
            </div>
          </div>
        </div>

<?PHP } else {?>

<div id="FormAvailable" class="mg-book-now" style="position:fixed; left:0px; right:0px; margin:auto;top:48px;height:70px;width:100%;padding:0px; z-index: 90002;-webkit-box-shadow: 0px 3px 5px 0px rgba(0,0,0,0.7);
-moz-box-shadow: 0px 3px 5px 0px rgba(0,0,0,0.7);
box-shadow: 0px 3px 5px 0px rgba(0,0,0,0.7);">
        
        <div class="row" style="margin:0px;">
          <div class="col-md-1 bg-dark" style="height:70px;"></div>
        <div class="col-md-3 bg-dark" style="padding:0px;height:70px;">
          <table style="width: 100%;"><tr>
            <td>
            <span style="font-size:22px;margin-bottom:10px;margin-top:0px;font-family: 'Raleway'; color:#fff;">
              <?=str_replace('and', '&', $thismenu["availability_check"]);?><br><span style="font-size: 18px;"><?=$thismenu["online_reservation"];?></span>
            </span>
          </td>
          <td align="right">
            <span class="pull-right" style="width: 0; height: 0; border-top: 35px solid #3BB3C2;border-bottom: 35px solid #3BB3C2;border-left: 20px solid #007CC2;"></span>
          </td>
        </tr></table>
            </div>
          
            <div class="col-md-7 bg-default" align="left" style="padding-top:10px;padding-bottom:0px;height:70px;">
            <div class="mg-bn-forms" style="padding-top:0px;padding-bottom:0px;margin-top:0px;">
            
              <form id="BookNow" class="no-margin" method="post" action="https://www.bookingboxes.com/mega/">
                <div class="row" style="margin:0px;font-size:16px;">
                  <div class="col-md-3">
                  <div style="margin:0px; color:#fff;"><?=$thismenu["arrival_date"];?></div>
                    
                      <input type="text" class="form-control" id="arrival_date" name="arrival_date" value="<?=date("d/m/Y",$mk_in);?>" readonly style="cursor:pointer;background:none;font-size:16px;padding-left:30px;position:relative;z-index:3;border:none;padding:0px;padding-top:8px; border-top:1px solid #fff;" placeholder="<?=$thismenu["arrival_date"];?>" onmouseover="Selectdate('arrival_date', 'departure_date');">
                      <span class="fa fa-calendar" style="float: right;margin-right: 8px;margin-top: -20px;position: relative;z-index:2;cursor:pointer;color:#fff;"></span>
                    
                  </div>
                  <div class="col-md-3">
                  <div style="margin:0px;color:#fff;"><?=$thismenu["departure_date"];?></div>
                      <input type="text" class="form-control" id="departure_date" name="departure_date" placeholder="<?=$thismenu["departure_date"];?>" value="<?=date("d/m/Y",$mk_out);?>" readonly style="cursor:pointer;background:none;font-size:16px;padding-left:30px;position:relative;z-index:3;border:none;padding:0px;padding-top:8px; border-top:1px solid #fff;" onmouseover="Selectdate('arrival_date', 'departure_date');">
                      <span class="fa fa-calendar" style="float: right;margin-right: 8px;margin-top: -20px;position: relative;z-index:2;cursor:pointer;color:#fff;"></span>
                  </div>
<?PHP
$sql  = "SELECT * FROM secret_deal WHERE hotel_sec = '".$thishotel["hotel_sec"]."' AND secret_deal_status = 'ON' AND secret_deal_group_id = '3' ";
$resault = mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error());
$thisdealpromotioncode = mysql_fetch_array($resault);
if($thisdealpromotioncode["secret_deal_id"] > 0){
$fromdate = explode("-", $thisdealpromotioncode["from_date"]);
          $fday = $fromdate[2];
          $fmonth = $fromdate[1];
          $fyear = $fromdate[0];
$from_date = mktime(0,0,0, intval($fmonth), intval($fday), intval($fyear));

$todate = explode("-", $thisdealpromotioncode["to_date"]);
          $tday = $todate[2];
          $tmonth = $todate[1];
          $tyear = $todate[0];
$to_date = mktime(0,0,0, intval($tmonth), intval($tday), intval($tyear));

if(($from_date <= $mk_in) AND ($to_date >= $mk_out)){  
?>
                  <div class="col-md-3">
                    <div style="margin:0px;color:#fff;"><?=$thismenu["tpromotion_code"];?></div>
                      <input type="text" class="form-control" id="promotion_code" placeholder="..." style="cursor:pointer;background:none;font-size:16px;padding-left:30px;position:relative;z-index:3;border:none;padding:0px;padding-top:8px; border-top:1px solid #fff;" name="promotion_code">
                      <span class="fp-ht-key" style="float: right;margin-right: 8px;margin-top: -20px;position: relative;z-index:2;cursor:pointer;color:#fff;"></span>
                      <input type="hidden" id="secret_deal_id_promotion_code" name="secret_deal_id_promotion_code" value="<?=$thisdealpromotioncode["secret_deal_id"];?>">
                  </div>
<?PHP } }?>
                  <div class="col-md-3">
                    <button type="button" class="btn btn-main btn-block bg-dark" style="border:1px solid #fff;padding: 8px 35px;margin-top:6px;font-family: 'Raleway'; border-radius: 50em;" onclick="AvailabilityCheck();"><?=$thismenu["check_now"];?></button>
                  </div>


                </div>
                
                <input type="hidden" name="hotel_sec" value="<?=$thishotel["hotel_sec"];?>">
                <input type="hidden" name="language_id" value="<?=$_REQUEST["language_id"];?>">
                <input type="hidden" name="currency_id" id="currency_id" value="<?=$thiscur["currency_abb"];?>">
                <input type="hidden" name="page" value="<?=$page;?>">
                <input type="hidden" name="ID" id="Member"  value="<?=$ID;?>">
              </form>
            </div>
            
          </div>
          <div class="col-md-1 bg-default" style="height:70px;"></div>

    </div><!-- /.row-fluid -->  
</div>
<?PHP }?>
</div>
</div>
<?PHP if($deviceType <> 'phone'){?>
      <!-- Controls -->
      <a class="left carousel-control" href="#mega-slider" role="button" data-slide="prev">
      </a>
      <a class="right carousel-control" href="#mega-slider" role="button" data-slide="next">
      </a>
<?PHP }?>
			</div>

		

<script>
 $('#mg-part-promotion-full').click();

function AvailabilityCheck(){
var arrival_date = document.getElementById("arrival_date").value;
var departure_date = document.getElementById("departure_date").value;
  if(arrival_date == ''){
    document.getElementById("arrival_date").focus();
    return false;
  }
  else if(departure_date == ''){
    document.getElementById("departure_date").focus();
    return false;
  }
  else {
    $('#BookNow').submit();
  }

}


</script>


<script>
var winHeightX = window.innerHeight;
winHeight = (winHeightX);
var countBG = document.getElementById('countBG').value;
for (i = 0; i < countBG; i++){
    document.getElementById('CheckInnerHeight'+i).style.height = winHeight+'px';
}
</script>