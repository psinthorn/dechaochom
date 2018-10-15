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

$thishotel  = $hotel->getHotel($hotel_sec);
$thiscomp   = $company->getCompany($thishotel["hotel_chain_id"]);
require_once("iclass/class.member.php");
$member = new Member();
$thisproject = $member->getMemberProject($hotel_sec);



if($_REQUEST["ID"] <> ''){
$ID = $_REQUEST["ID"];
$thismember = $member->getMember($ID);  
}
else if ($_POST["actionlogin"] == "Login") {
  $hotel_sec = $thishotel["hotel_sec"];
  $email = $_POST['loginemail'];
  $password = $_POST['loginpassword'];
  $members = $member->getMemberLogin($email, $password, $hotel_sec);
  if($members["ID"] > 0){
  $thismember = $member->getMember($members["ID"]);
  $ID = $members["ID"];
  }
}
else {
  $ID = '';
}

require_once 'Mobile_Detect.php';
$detect = new Mobile_Detect;
$deviceType = ($detect->isMobile() ? ($detect->isTablet() ? 'tablet' : 'phone') : 'computer');
$scriptVersion = $detect->getScriptVersion();
if($deviceType == 'phone'){
$margin_top = "0px";
$max_logo = "max-width:70px;";
$padding = "padding:0px;";
$padding_body = "padding-left:10px;padding-right:10px;";
$margin_top = "margin-top:10px;";
$font_size = "font-size:16px;";
$padding_bottom = "padding-bottom:0px;";
$padding_top = "padding-top:10px;background:#fff;border-top:1px solid #e5e5e5;";

}
else {
$margin_top = "80px";
$max_logo = "max-width:90px;";
$data_target = "";
$padding = "";
$padding_body = "";
$margin_top = ";";
$padding_bottom = "padding-bottom:20px;";
$padding_top = "padding-top:20px;";

}

if($deviceType == 'computer'){
  $data_target = "";
}
else {
  $data_target = "data-toggle=\"collapse\" data-target=\".navbar-collapse\"";
}

if($thishotel["skin_color"] == ''){
  $skin_color = 'orange';
}
else {
  $skin_color = $thishotel["skin_color"];
}

if((!$_REQUEST["currency_id"]) OR ($_REQUEST["currency_id"] == '')){
$currency_abb = $thishotel["currency_id"];
}
else {
$currency_abb = $_REQUEST["currency_id"];
}
$thiscur  = $hotel->getCurrency($currency_abb);

$sql  = "SELECT * FROM currency WHERE currency_abb = '".$thishotel["currency_id"]."' ";
$query= mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error());
$thishotelcurrency = mysql_fetch_array($query);
if($thishotel["currency_id"] == 'EUR'){
  if($thiscur["currency_abb"] == $thishotel["currency_id"]){
    $currency_rate = 1;
  }
  else {
    $currency_rate = $thiscur["currency_rate_invert"];
  }
}
else {
  if($thiscur["currency_abb"] == $thishotel["currency_id"]){
    $currency_rate = ($thishotelcurrency["currency_rate_invert"]/$thiscur["currency_rate_invert"]);
  }
  else if($thiscur["currency_abb"] == 'EUR'){
    $currency_rate = ($thishotelcurrency["currency_rate_convert"]/$thiscur["currency_rate_convert"]);
  }
  else {
    $currency_rate = ($thiscur["currency_rate_invert"]/$thishotelcurrency["currency_rate_invert"]);
  }

}

$hotelimage  = "".$thiscomp["engine_path"]."/img-server/hotels/".$thishotel["hotel_sec"]."/gallery/".$thishotel["main_image"]."";

?>


<?PHP if($deviceType == 'phone'){?>
<?PHP
$sql  = "SELECT * FROM secret_deal WHERE hotel_sec = '".$thishotel["hotel_sec"]."' AND secret_deal_status = 'ON' AND secret_deal_group_id = '4' ";
$resault = mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error());
$thisdeal = mysql_fetch_array($resault);
$fromdate = explode("-", $thisdeal["from_date"]);
          $fday = $fromdate[2];
          $fmonth = $fromdate[1];
          $fyear = $fromdate[0];
$from_date = mktime(0,0,0, intval($fmonth), intval($fday), intval($fyear));

$todate = explode("-", $thisdeal["to_date"]);
          $tday = $todate[2];
          $tmonth = $todate[1];
          $tyear = $todate[0];
$to_date = mktime(0,0,0, intval($tmonth), intval($tday), intval($tyear));

if(($from_date <= $mk_in) AND ($to_date >= $mk_out)){
$sql  = "SELECT * FROM secret_deal_benefits WHERE hotel_sec = '".$thishotel["hotel_sec"]."' AND secret_deal_id = '".$thisdeal["secret_deal_id"]."' ";
$querybenefits = mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error());
?>
		<div class="mg-best-rooms parallax" id="bodyhome" style="padding-top:10px;padding-bottom:10px;background-color:#CCCDD0;">
			<div class="container" style="margin-bottom:0px;">
				<div class="row">
						<div class="col-md-12"style="<?=$padding;?>" align="right">

<h5 style="font-size:14px;margin-top:0px;color:#1D2F43;"><i class="fa fa-user"></i> <?=$thismenu["treturning_guest"];?> <?=$thismenu["discount"];?> <?=$thisdeal["discount"];?>%.</h5>
<div class="input-group">
<div class="input-group-addon" style="background:#fff;border:1px solid #ddd;border-right:none;padding-right:0px;  border: none !important;"><i class="fa fa-envelope-o"></i></div>
<input id="guest_email" type="email" class="form-control" placeholder="<?=$thismenu["email"];?>" style="background:#fff;border:1px solid #ddd;border-left:none;outline: none;
  border: none !important;
  -webkit-box-shadow: none !important;
  -moz-box-shadow: none !important;
  box-shadow: none !important;">
<div class="input-group-addon btn-dark-main" style="border:#ddd;cursor:pointer;  border: none !important;" onclick="CheckEmail('<?=$thisdeal["secret_deal_id"];?>');">Submit</div>
</div>

					</div>
				</div>
			</div>
		</div>	
<?PHP }?>


<?PHP if($deviceType == 'phone'){
if((str_replace("#", "", $thishotel["bg_color"]) == '') OR (str_replace("#", "", $thishotel["bg_color"]) == 'fff')){
	$text_color = "#333";
}
else {
	$text_color = "#fff";
}
?>
<div class="mg-best-rooms parallax" id="bodyhome" style="padding-top:0px;<?=$padding_bottom;?>padding-bottom:0px;border-bottom:1px solid #e5e5e5;background:<?=$thishotel["bg_color"];?>;">
			<div class="container" style="margin-bottom:0px;<?=$padding;?>">
<?PHP
$sql  = "SELECT COUNT(rate_plan_id) AS promotion FROM rate_plan WHERE hotel_sec = '".$thishotel["hotel_sec"]."'  AND booking_from <= '".date("Y-m-d",$today)."' AND booking_to >= '".date("Y-m-d",$today)."' AND rate_plan_status = '1' GROUP BY rate_plan_name_id ";
$prorcount= mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error());
$total = mysql_fetch_array($prorcount);
if($total["promotion"] > 0){
  
?>

<div class="mg-about-clients" style="padding:0px;background:none;margin:0px;" id="promotion">
      <div class="container" style="padding:0px;">
        <div class="row" style="">
          <div class="col-md-12" style="padding:0px;">
            <ul class="mg-part-logos-full" id="mg-part-promotion-full">
              

<?PHP
$sql  = "SELECT *, (rate_plan_name_language.rate_plan_name) AS rate_plan_name FROM rate_plan LEFT JOIN rate_plan_name_language ON rate_plan.rate_plan_name_id = rate_plan_name_language.rate_plan_name_id AND language_id = '".$language_id."' WHERE rate_plan.hotel_sec = '".$thishotel["hotel_sec"]."'  AND booking_from <= '".date("Y-m-d",$today)."' AND booking_to >= '".date("Y-m-d",$today)."' AND rate_plan_status = '1' GROUP BY rate_plan.rate_plan_name ";
$proresault2 = mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error());
while ($allpro = mysql_fetch_array($proresault2)) {
//Booking day Condition
$bookingfrom = explode("-", $allpro["booking_from"]);
          $bfday = $bookingfrom[2];
          $bfmonth = $bookingfrom[1];
          $bfyear = $bookingfrom[0];
$booking_from = mktime(0,0,0, intval($bfmonth), intval($bfday), intval($bfyear));

$bookingto = explode("-", $allpro["booking_to"]);
          $btday = $bookingto[2];
          $btmonth = $bookingto[1];
          $btyear = $bookingto[0];
$booking_to = mktime(0,0,0, intval($btmonth), intval($btday), intval($btyear));

$travelfrom = explode("-", $allpro["stay_from"]);
          $fday = $travelfrom[2];
          $fmonth = $travelfrom[1];
          $fyear = $travelfrom[0];
$travel_from = mktime(0,0,0, intval($fmonth), intval($fday+$allpro["early_book"]), intval($fyear));
if($travel_from <= $today){
$travel_from =  mktime(0,0,0, intval($month), intval($day+$allpro["early_book"]), intval($year));
$submit_travel_to =   mktime(0,0,0, intval($month), intval($day+$allpro["early_book"]+1), intval($year));
}
else {
$travel_from =  mktime(0,0,0, intval($fmonth), intval($fday+$allpro["early_book"]), intval($fyear));
$submit_travel_to =   mktime(0,0,0, intval($fmonth), intval($fday+$allpro["early_book"]+1), intval($fyear));
}

$travelto = explode("-", $allpro["stay_to"]);
          $tday = $travelto[2];
          $tmonth = $travelto[1];
          $tyear = $travelto[0];
$travel_to = mktime(0,0,0, intval($tmonth), intval($tday), intval($tyear));
    
    if($allpro["discount_type"] == 'PERCENT'){
    $discount[$i] = "".$allpro["discount"]."%";  
    }
    else {
    $discount[$i] = "<small>".$thishotel["currency_id"]."</small>".$allpro["discount"]."";
    }


if(($booking_from <= $today) AND ($booking_to >= $today)){    
    echo "
    <li>
    <div style=\"padding:0px;background:none;\">
    <h4 class=\"mg-bn-title\" style=\"padding-bottom:0px;color:#fff;font-size:16px;font-weight:400;\"><b><i class=\"fa fa-tag\" style=\"color:<?=$text_color;?>;\"></i> ".$allpro["rate_plan_name"]." ".$thismenu["discount"]." ".$discount[$i]."</b></h4>
    <h5 style=\"color:#fff;font-size:14px;font-weight:200;\">".$thismenu["period_of_stay"]."<br>".date("d",$travel_from)." ".$thismenu["".strtolower(date("F",$travel_from)).""]." ".date("Y",$travel_from)." - ".date("d",$travel_to)." ".$thismenu["".strtolower(date("F",$travel_to)).""]." ".date("Y",$travel_to)."</h5>
    <div style=\"color:#fff;font-size:13px;font-weight:200;\">".$allpro["more_description"]."</div>
    </div>
    </li>
";
}
}
?>
            </ul>
          </div>
        </div>
      </div>
    </div>
<?PHP }?>
	</div>
</div>
<?PHP }?>

		
<?PHP 
if($deviceType == 'phone'){
//Flash Deal
$todaydate = explode("/", date("d/m/Y"));
          $day = $todaydate[0];
          $month = $todaydate[1];
          $year = $todaydate[2];
$today = mktime(0,0,0, intval($month), intval($day), intval($year));
$mk_in = mktime(0,0,0, intval($month), intval($day), intval($year));
$mk_out = mktime(0,0,0, intval($month), intval($day+1), intval($year));
$nights = (($mk_out-$mk_in)/86400);
$lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
$sql  = "SELECT * FROM secret_deal WHERE hotel_sec = '".$thishotel["hotel_sec"]."' AND secret_deal_status = 'ON' AND secret_deal_group_id = '5' ";
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
<?PHP if($time_left > 0){?>
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

    });
  
    </script>
<div class="mg-best-rooms parallax" id="bodyhome" style="padding-top:10px;padding-bottom:10px;background:#f2f2f2;border-bottom:1px solid #e5e5e5;">
  <div class="container" style="margin-bottom:0px;<?=$padding;?>">
    <div align="center">
      <h4 style="margin:0px;margin-bottom:10px;">Flash Deal</h4>
      <div id="countdown"></div>
      <div id="year"></div>
      <div style="font-size:16px;">Get more disc. <?=$thisflashdeal["discount"];?>% off.</div>
    </div>  <!-- / .row -->   
  </div>
</div>

<?PHP } }?>
   
   <div class="mg-best-rooms parallax" id="bodyhome" style="padding-top:20px;<?=$padding_bottom;?>">
      <div class="container" style="margin-bottom:0px;<?=$padding;?>">
				<div class="row">
						<div class="col-md-12" align="left" style="<?=$padding;?>">
						<div style="<?=$padding_body;?>">
						<h2 class="mg-sec-left-title" style="<?=$font_size;?>"><?=$thishotel["hotel_name"];?></h2>
						</div>
						</div>
				</div>

				<div class="row">
					<div class="col-md-7" align="left" style="<?=$padding;?>">
						<div style="font-weight:400;<?=$padding_body;?>"><?=$thishotel["hotel_shot"];?></div>					
						<div style="font-weight:200;<?=$padding_body;?>"><?=$thishotel["info"];?></div>					
					</div>
					<div class="col-md-5" style="<?=$padding;?>">
						<img src="<?=$thiscomp["engine_path"];?>/img-server/hotels/<?=$thishotel["hotel_sec"];?>/gallery/<?=$thishotel["main_image"];?>" style="width:100%;">
					</div>
				</div>
			</div>
		</div>							
<?PHP }else {?>
			<div class="mg-best-rooms parallax" id="bodyhome" style="padding-top:30px;padding-bottom:30px;">
				<div class="container" style="margin-bottom:0px;">
					<div class="row">
						<div class="col-md-7" align="left" style="<?=$padding;?>">
						<h2 class="mg-sec-left-title" style=""><?=$thishotel["hotel_name"];?></h2>
						</div>
						<div class="col-md-5" align="right" style="<?=$padding;?>">
<?PHP 
if($deviceType <> 'phone'){
//Flash Deal
$todaydate = explode("/", date("d/m/Y"));
          $day = $todaydate[0];
          $month = $todaydate[1];
          $year = $todaydate[2];
$today = mktime(0,0,0, intval($month), intval($day), intval($year));
$mk_in = mktime(0,0,0, intval($month), intval($day), intval($year));
$mk_out = mktime(0,0,0, intval($month), intval($day+1), intval($year));
$nights = (($mk_out-$mk_in)/86400);
$lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
$sql  = "SELECT * FROM secret_deal WHERE hotel_sec = '".$thishotel["hotel_sec"]."' AND secret_deal_status = 'ON' AND secret_deal_group_id = '5' ";
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
<?PHP if($time_left > 0){?>
<input type="hidden" id="time_left" value="<?=$time_left;?>">

  <script src="js/jquery.plugin.min.js"></script>
  <script src="js/jquery.countdown.min.js"></script>
  <script>
   $(function () {
      var time_left = document.getElementById('time_left').value
        var austDay = new Date();
        austDay = new Date(austDay.getFullYear() + 1, 1 - 1, -0);
        $('#countdown').countdown({until: time_left});
        //$('#year').text(austDay.getFullYear());

    });
  
    </script>
    <div align="left" style="margin-bottom:10px;">
      <table><tr>
      <td style="padding-right:10px;">
        <div id="countdown"></div>
        <div id="year"></div>
      </td>
      <td>
      <h4 style="margin:0px;"><?=$thisflashdeal["secret_deal_name"];?></h4>
      <div style="font-size:16px;">Get more disc. <?=$thisflashdeal["discount"];?>% off.</div>
      </td>
      </tr></table>
    </div>  <!-- / .row -->   
<?PHP } }?>

<?PHP
$sql  = "SELECT * FROM secret_deal WHERE hotel_sec = '".$thishotel["hotel_sec"]."' AND secret_deal_status = 'ON' AND secret_deal_name = 'Returning Guest' ";
$resault = mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error());
$thisdeal = mysql_fetch_array($resault);
$fromdate = explode("-", $thisdeal["from_date"]);
          $fday = $fromdate[2];
          $fmonth = $fromdate[1];
          $fyear = $fromdate[0];
$from_date = mktime(0,0,0, intval($fmonth), intval($fday), intval($fyear));

$todate = explode("-", $thisdeal["to_date"]);
          $tday = $todate[2];
          $tmonth = $todate[1];
          $tyear = $todate[0];
$to_date = mktime(0,0,0, intval($tmonth), intval($tday), intval($tyear));

if(($from_date <= $mk_in) AND ($to_date >= $mk_out)){
$sql  = "SELECT * FROM secret_deal_benefits WHERE hotel_sec = '".$thishotel["hotel_sec"]."' AND secret_deal_id = '".$thisdeal["secret_deal_id"]."' ";
$querybenefits = mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error());
?>

<h5 style="font-size:14px;margin-top:0px;color:#1D2F43;"><i class="fa fa-user"></i> <?=$thismenu["treturning_guest"];?> <?=$thismenu["discount"];?> <?=$thisdeal["discount"];?>%.</h5>
<div style="width:250px">
<div class="input-group">
<div class="input-group-addon" style="background:#fff;border:1px solid #ddd;border-right:none;padding-right:0px;"><i class="fa fa-envelope-o"></i></div>
<input id="guest_email" type="text" class="form-control input-sm" placeholder="<?=$thismenu["email"];?>" style="background:#fff;border:1px solid #ddd;border-left:none;">
<div class="input-group-addon btn-dark-main" style="border:#ddd;cursor:pointer;" onclick="CheckEmail('<?=$thisdeal["secret_deal_id"];?>');">Submit</div>
</div>
</div>

<?PHP }?>
					</div>

					</div>
					<div class="row">
					<div class="col-md-7" align="left" style="<?=$padding;?>">
						<?=$thishotel["hotel_shot"];?>						
						<div align="justify"><?=$thishotel["info"];?></div>

<?PHP if($deviceType <> 'phone'){?>

<?PHP
$sql  = "SELECT COUNT(rate_plan_id) AS promotion FROM rate_plan WHERE hotel_sec = '".$thishotel["hotel_sec"]."'  AND booking_from <= '".date("Y-m-d",$today)."' AND booking_to >= '".date("Y-m-d",$today)."' AND rate_plan_status = '1' GROUP BY rate_plan_name_id ";
$prorcount= mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error());
$total = mysql_fetch_array($prorcount);
if($total["promotion"] > 0){ 
?>
<div class="row" style="margin:0px;border-top:1px solid #eee;margin-top:10px;padding-top:10px;">
<h4 class="mg-sec-left-title" style="font-size:16px;"><?=$thismenu["tpromotion"];?></h4>
<?PHP
$sql  = "SELECT *, (rate_plan_name_language.rate_plan_name) AS rate_plan_name FROM rate_plan LEFT JOIN rate_plan_name_language ON rate_plan.rate_plan_name_id = rate_plan_name_language.rate_plan_name_id AND language_id = '".$language_id."' WHERE rate_plan.hotel_sec = '".$thishotel["hotel_sec"]."'  AND booking_from <= '".date("Y-m-d",$today)."' AND booking_to >= '".date("Y-m-d",$today)."' AND rate_plan_status = '1' GROUP BY rate_plan.rate_plan_name ";
$proresault2 = mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error());
while ($allpro = mysql_fetch_array($proresault2)) {
//Booking day Condition
$bookingfrom = explode("-", $allpro["booking_from"]);
          $bfday = $bookingfrom[2];
          $bfmonth = $bookingfrom[1];
          $bfyear = $bookingfrom[0];
$booking_from = mktime(0,0,0, intval($bfmonth), intval($bfday), intval($bfyear));

$bookingto = explode("-", $allpro["booking_to"]);
          $btday = $bookingto[2];
          $btmonth = $bookingto[1];
          $btyear = $bookingto[0];
$booking_to = mktime(0,0,0, intval($btmonth), intval($btday), intval($btyear));

$travelfrom = explode("-", $allpro["stay_from"]);
          $fday = $travelfrom[2];
          $fmonth = $travelfrom[1];
          $fyear = $travelfrom[0];
$travel_from = mktime(0,0,0, intval($fmonth), intval($fday+$allpro["early_book"]), intval($fyear));
if($travel_from <= $today){
$travel_from =  mktime(0,0,0, intval($month), intval($day+$allpro["early_book"]), intval($year));
$submit_travel_to =   mktime(0,0,0, intval($month), intval($day+$allpro["early_book"]+1), intval($year));
}
else {
$travel_from =  mktime(0,0,0, intval($fmonth), intval($fday+$allpro["early_book"]), intval($fyear));
$submit_travel_to =   mktime(0,0,0, intval($fmonth), intval($fday+$allpro["early_book"]+1), intval($fyear));
}

$travelto = explode("-", $allpro["stay_to"]);
          $tday = $travelto[2];
          $tmonth = $travelto[1];
          $tyear = $travelto[0];
$travel_to = mktime(0,0,0, intval($tmonth), intval($tday), intval($tyear));
    
    if($allpro["discount_type"] == 'PERCENT'){
    $discount[$i] = "".$allpro["discount"]."%";  
    }
    else {
    $discount[$i] = "<small>".$thishotel["currency_id"]."</small>".$allpro["discount"]."";
    }


if(($booking_from <= $today) AND ($booking_to >= $today)){    
    echo "
    <div class=\"col-md-12\" style=\"padding:0px;margin-bottom:10px;\">
    <h5 style=\"margin:0px;\"><i class=\"fa fa-tag\"></i> <span>".$allpro["rate_plan_name"]." ".$thismenu["discount"]." ".$discount[$i]."</span></h5>
    <div style=\"font-weight:300;margin-left:20px;\">".$thismenu["period_of_stay"]." ".date("d",$travel_from)." ".$thismenu["".strtolower(date("F",$travel_from)).""]." ".date("Y",$travel_from)." - ".date("d",$travel_to)." ".$thismenu["".strtolower(date("F",$travel_to)).""]." ".date("Y",$travel_to)." ".$allpro["more_description"]."</div>
    </div>
";
}
}
?>
</div>
<?PHP }?>

<?PHP }?>
					
					</div>
					<div class="col-md-5" style="<?=$padding;?>">
						<img src="<?=$thiscomp["engine_path"];?>/img-server/hotels/<?=$thishotel["hotel_sec"];?>/gallery/<?=$thishotel["main_image"];?>" style="width:100%;">
					</div>
				</div>
			</div>
		</div>
<?PHP }?>

<?PHP
$sql  = "SELECT COUNT(room_id) AS totals FROM room WHERE hotel_sec = '".$thishotel["hotel_sec"]."' AND room_status = '1' AND room_recommend = 'YES' ";
$results = mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error());
$room_recommend = mysql_fetch_array($results);
if($room_recommend["totals"] > '0'){?>


<div style="height:10px;border-top:1px solid #e5e5e5;border-bottom:1px solid #e5e5e5;background:#eee;"></div>
		<div class="mg-best-rooms" style="background:#fff;padding-top:20px;<?=$padding_bottom;?>margin-top:0px;margin-bottom:0px;">
			<div class="container" style="<?=$padding;?>">
			 
				<div class="row">
					<div class="col-md-12" style="<?=$padding;?>">
						<div style="padding-bottom:0px;text-align:left;">
							<div style="<?=$padding_body;?>">
							<h3 class="mg-sec-left-title" style="text-transform: none;">Our Best Rooms</h3>
							<p style="padding-bottom:0px;">These best rooms chosen by our customers</p>
							</div>
						</div>
						<div class="row">
<?php
$i=0;
while($allroom[$i]["room_id"]){ 
if($allroom[$i]["room_recommend"] == 'YES'){
$image[$i]  = "".$thiscomp["engine_path"]."/img-server/rooms/".$thishotel["hotel_sec"]."_".$allroom[$i]["room_id"]."/".$allroom[$i]["main_image"].""; 

$sql  = "SELECT rate, master_allotment.master_rate_id FROM master_allotment LEFT JOIN master_rate ON master_allotment.master_rate_id = master_rate.master_rate_id WHERE master_rate_status = '1' AND master_allotment.room_id = '".$allroom[$i]["room_id"]."' AND fix_date = '".date("Y-m-d")."' ORDER BY rate ASC LIMIT 1 ";
$resultmaster = mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error());
$thismaster = mysql_fetch_array($resultmaster);

$sql  = "SELECT rate FROM rate_plan_allotment LEFT JOIN rate_plan ON rate_plan_allotment.rate_plan_id = rate_plan_allotment.rate_plan_id WHERE rate_plan_status = '1' AND rate_plan_allotment.room_id = '".$allroom[$i]["room_id"]."' AND rate_plan_allotment.master_rate_id = '".$thismaster["master_rate_id"]."' AND fix_date = '".date("Y-m-d")."' ORDER BY rate ASC LIMIT 1 ";
$resultrateplan = mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error());
$thisrateplan = mysql_fetch_array($resultrateplan);
if($thisrateplan["rate"] > 0){
if($thisrateplan["rate"] <= $thismaster["rate"]){
	$rate = $thisrateplan["rate"];
}
else {
	$rate = $thismaster["rate"];
}
}
else {
	$rate = $thismaster["rate"];
}
$rateA = number_format(($rate),2);
$rate = substr($rateA, 0,-3);
$subrate = substr($rateA, -3);
if($i > '0'){
	$img_margin_top = "margin-top:10px;";
}
else {
	$img_margin_top = "";
}
?>
<?PHP if($deviceType == 'phone'){?>
							<div class="col-sm-4" style="<?=$padding;?>">
								<div class="mg-room" style="color: #fff;font-size:14px;margin-bottom:0px;<?=$img_margin_top;?>">
									<img src="<?=$image[$i];?>" alt="img11" class="img-responsive">

									<div style="position:absolute;top:0px;left:0px;padding:10px;
  background: -webkit-linear-gradient(top, rgba(0, 0, 0, 0) 15%, rgba(0, 0, 0, 0.3) 100%);
  background: linear-gradient(to bottom, rgba(0, 0, 0, 0) 15%, rgba(0, 0, 0, 0.3) 100%);
  -webkit-transition: background-color 0.3s;
          transition: background-color 0.3s;height:100%;bottom:0px;">
										<h3 style="color:#fff;"><?=$allroom[$i]["room_type"];?></h3>
										
										<div style="font-size: 20px;color: #FCC918;"><small><?=$thiscur["currency_abb"];?></small> <?=$rate;?><sup><?=$subrate;?>/Night</sup></div>
										<div><?=substr($allroom[$i]["room_details"], 0, 80);?>...</div>
										<div align="right"><a href="#" onClick="Menu('rooms.php?hotel_sec=<?=$thishotel["hotel_sec"];?>&language_id=<?=$language_id;?>&ID=<?=$ID;?>&currency_id=<?=$thiscur["currency_abb"];?>&room_id=<?=$allroom[$i]["room_id"];?>');"><?=$thismenu["tmore_details"];?> <i class="fa fa-angle-double-right"></i></a></div>
									</div>			
								</div>
							</div>
<?PHP }else {?>
							<div class="col-sm-3" style="<?=$padding;?>">
								<figure class="mg-room">
									<img src="<?=$image[$i];?>" alt="img11" class="img-responsive">
									<figcaption>
										<h2 style="font-size:18px;margin-top:0px;"><?=$allroom[$i]["room_type"];?></h2>
										<div class="mg-room-rating"><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i> </div>
										<div class="mg-room-price" style="color: #FCC918;"><small><?=$thiscur["currency_abb"];?></small> <?=$rate;?><sup><?=$subrate;?>/Night</sup></div>
										<p style="margin-bottom:0px;"><?=substr($allroom[$i]["room_details"], 0, 40);?>...</p>
										<div align="right"><a href="#" class="btn btn-link" onClick="Menu('rooms.php?hotel_sec=<?=$thishotel["hotel_sec"];?>&language_id=<?=$language_id;?>&ID=<?=$ID;?>&currency_id=<?=$thiscur["currency_abb"];?>&room_id=<?=$allroom[$i]["room_id"];?>');"><?=$thismenu["tmore_details"];?> <i class="fa fa-angle-double-right"></i></a></div>
									</figcaption>			
								</figure>
							</div>
<?PHP }?>
<?PHP }$i++;}?>

						</div>
					</div>
				</div>
				
			</div>
		</div>
<?PHP }?>

<div style="height:10px;border-top:1px solid #e5e5e5;border-bottom:1px solid #e5e5e5;background:#eee;"></div>
<div class="mg-best-rooms" style="text-align:left;margin-top:0px;padding-top:20px;">
			<div class="container">
			 
				<div class="row">
					<div class="row">
						<div class="col-md-12" style="<?=$padding;?>">
		<!-- Special Offers -->
<?PHP
$sql  = "SELECT COUNT(package_id) AS total_package FROM package WHERE hotel_sec = '".$thishotel["hotel_sec"]."' AND package_status = 'ON' ";
$countresault = mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error());
$total = mysql_fetch_array($countresault);
if($total["total_package"] > 0){
?>
		
					   <div class="col-md-12">
							<h3 class="mg-sec-left-title" style="text-transform: none;"><?=$thismenu["tspecialoffer"];?></h3>
            </div>
					


<?PHP 
$sql  = "SELECT *, (package_language.package_name) AS package_name FROM package LEFT JOIN package_language ON package.package_id = package_language.package_id AND language_id = '".$language_id."' WHERE package.hotel_sec = '".$thishotel["hotel_sec"]."' AND package_status = 'ON' ";
$resault = mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error());
while ($allpackage = mysql_fetch_array($resault)) {
$image  = "".$thiscomp["engine_path"]."/img-server/hotels/".$thishotel["hotel_sec"]."/package/".$allpackage["package_id"]."/".$allpackage["main_image"]."";
$response = get_headers($image, 1);
if(strpos($response[0], "404") === false){
$main_image = $image; 
}
else
{
$main_image = "".$thiscomp["engine_path"]."/img-server/temp.png"; 
}
?>
<?PHP 
$sql  = "SELECT MIN(package_price) AS package_price FROM package_room WHERE package_id = '".$allpackage["package_id"]."' ";
$resault_rate = mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error());
$thisprice = mysql_fetch_array($resault_rate);
?>

						
							<div class="col-md-3" style="<?=$padding;?>">
								<figure class="mg-room mg-room-col-4" style="margin-bottom:10px;">
									<img src="<?=$main_image;?>" alt="img11" class="img-responsive" >

									<figcaption>

										<h2 style="margin-top:0px;font-size:16px;"><?=$allpackage["package_name"];?></h2>
										<div class="mg-room-rating"><i class="fa fa-gift"></i></div>
										<div class="mg-room-price" style="margin-bottom:0px;"><small><?=$thiscur["currency_abb"];?></small> <?=number_format(($thisprice["package_price"]),2);?></div>
										<p style="margin:0px;"><small><?=substr($allpackage["package_desc"], 0, 100);?>...</small></p>
										<a href="#" class="btn btn-main" style="margin:0px;">Book</a>
									</figcaption>			
								</figure>
								<div><b><?=$thismenu["tbenefits"];?></b></div>
								<div style="font-weight:300;font-size:13px;"><i class="fa fa-gift text-color"></i> <?=($allpackage["package_nights"]+1);?> <?=$thismenu["day"];?> <?=$allpackage["package_nights"]; ?> <?=$thismenu["night"];?></div>
								<?PHP 
                $sql  = "SELECT *, (extra_service_language.extra_name) AS benefits_desc_language, (package_benefits.benefits_desc) AS benefits_desc FROM package_benefits LEFT JOIN extra_service_language ON benefits_id = extra_service_id AND language_id = '".$language_id."' WHERE package_benefits.package_id = '".$allpackage["package_id"]."'  ";
                $resault_benefits = mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error());
                while ($allbenefits = mysql_fetch_array($resault_benefits)) {?>
                <div style="font-weight:300;font-size:13px;"><i class="fa fa-gift text-color"></i> <?PHP if($allbenefits["benefits_desc_language"] <> ''){echo $allbenefits["benefits_desc_language"];}else {echo $allbenefits["benefits_desc"];}?></div>
                <?PHP }?>

							</div>
							
<?PHP } }else{?>
<div class="col-md-3" style="<?=$padding;?>"></div>
<div class="col-md-3" style="<?=$padding;?>"></div>
<div class="col-md-3" style="<?=$padding;?>"></div>
<?PHP }?>
				
<!--Start Facebook Plugin-->
<?PHP
$sql  = "SELECT * FROM hotel_social WHERE hotel_sec = '".$thishotel["hotel_sec"]."' AND social_link <> '' ";
$resault = mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error());
$thisfacebook = mysql_fetch_array($resault);
?>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.5";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
</script>
<div class="col-md-3" style="<?=$padding;?>">
<div class="fb-page" data-href="<?=$thisfacebook["social_link"];?>" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="false" data-show-posts="false" style="margin-left:0px;"><div class="fb-xfbml-parse-ignore"><blockquote cite="<?=$thisfacebook["social_link"];?>"><a href="https://www.facebook.com/facebook">Facebook</a></blockquote></div></div>
</div>
<!--Facebook Plugin-->




					</div>
				</div>
			</div>
		</div>
	</div>

		<!-- <div class="container">
			<div class="row">
				<div class="col-md-12">
					<hr>
				</div>
			</div>
		</div> -->
<input type="hidden" id="page" value="home">		
<script type="text/javascript">
$('#pleasewait').fadeOut('slow');
 </script>
<script src="js/owl.carousel.min.js"></script>
    <script src="js/starrr.min.js"></script>
    <script src="js/jquery.parallax-1.1.3.js"></script>
    <script src="js/script.js"></script>
<script>
 $('#mg-part-promotion-full').click();
</script>