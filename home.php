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

$thishotel  = $hotel->getHotel($hotel_sec);
$thiscomp   = $company->getCompany($thishotel["hotel_chain_id"]);
require_once("iclass/class.member.php");
$member = new Member();
$thisproject = $member->getMemberProject($hotel_sec);

$sql = "select * from member_benefits WHERE benefits_hotel_sec = '".$thishotel["hotel_sec"]."' ";
$result = mysql_query($sql)or die(mysql_error());
$i=0;
while($allbenefits = mysql_fetch_array($result)){
$benefits .= "<div>".$allbenefits["benefits_name"]."</div>";
}
$imgmember = "".$thiscomp["engine_path"]."/img-server/hotels/".$thishotel["hotel_sec"]."/member/".$thisproject["ID"]."/".$thisproject["main_image"]."";
$response = get_headers($imgmember, 1);
if(strpos($response[0], "404") === false){
$img_member = "<div class=\"col-sm-5\" style=\"padding-left:0px;\"><img src=\"".$imgmember."\" style=\"width:100%\"></div>";
$div = "7";
}
else {
$img_member = ""; 
$div = "12";
}

$ID = $_REQUEST["ID"];
if($ID > '0'){
  $sql = "select * from member_guest WHERE ID = '".$_REQUEST["ID"]."' ";
  $resultcheck = mysql_query($sql)or die(mysql_error());
  $thismember = mysql_fetch_array($resultcheck);
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
$width = "width:100%;";
$margin_top_event = "10px";
$margin_top_event_image = "10%";

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
$width = "width:60%;";
$margin_top_event = "0px";
$margin_top_event_image = "";

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

<style type="text/css">
::-webkit-scrollbar {
    width: 0px;
    background: transparent; /* make scrollbar transparent */
}
</style>
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

<div class="mg-about-clients" style="padding:0px;margin:0px; background:<?=$thishotel["bg_color"];?>;" id="promotion">
      <div class="container" style="padding:0px;">
        <div class="row" style="">
          <div class="col-md-12" style="padding:5px;">
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
    <div class=\"mg-bn-title\" style=\"padding-bottom:0px;color:#fff;font-size:16px;font-weight:400;\"><b><i class=\"fa fa-tag\" style=\"color:<?=$text_color;?>;\"></i> ".$allpro["rate_plan_name"]." ".$thismenu["discount"]." ".$discount[$i]."</b></div>
    <div style=\"color:#fff;font-size:14px;font-weight:300;\">".date("d",$travel_from)." ".$thismenu["".strtolower(date("F",$travel_from)).""]." ".date("Y",$travel_from)." - ".date("d",$travel_to)." ".$thismenu["".strtolower(date("F",$travel_to)).""]." ".date("Y",$travel_to)."</div>
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
<div class="mg-best-rooms" style="position: relative;z-index: 1; padding:0px; background: #eee; border-bottom: 1px solid #ddd;">
      <div class="container" align="center">
        <h3 style="margin: 10px; font-size:28px;" class="text-main"><?=$thishotel["hotel_shot"];?></h3>
      </div>
</div>
<?PHP if($deviceType == 'phone'){?>

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
       alert(austDay);

    });
  
    </script>
<div class="mg-best-rooms parallax" id="bodyhome" style="padding-top:10px;padding-bottom:10px;background:#f5f5f5;border-bottom:1px solid #e5e5e5;">
  <div class="container" style="margin-bottom:0px;<?=$padding;?>">
    <div align="center">
      <h4 style="margin:0px;margin-bottom:10px;"><?=$thisflashdeal["secret_deal_name"];?></h4>
      <div id="countdown"></div>
      <div id="year"></div>
      <div style="font-size:16px;">Get more disc. <?=$thisflashdeal["discount"];?>% off.</div>
    </div>  <!-- / .row -->   
  </div>
</div>

<?PHP }?>
   
   <div class="mg-best-rooms parallax" id="bodyhome" style="padding-top:20px;<?=$padding_bottom;?>">
      <div class="container" style="margin-bottom:0px;<?=$padding;?>">
				<div class="row">
						<div class="col-md-12" align="left" style="<?=$padding;?>">
						<div style="<?=$padding_body;?>">
						<h2 class="mg-sec-left-title" style="<?=$font_size;?>"><?=$thishotel["hotel_name"];?></h2>

						</div>
						</div>
				</div>

				<div class="row" style="margin:0px;">

					<div class="col-md-12" align="left" style="padding:0px;">
						<div style="font-weight:400;<?=$padding_body;?>"><?=$thishotel["hotel_shot"];?></div>					
						<div style="font-weight:300;<?=$padding_body;?>"><?=$thishotel["info"];?></div>					
					</div>

					<div class="col-md-12" style="padding:0px;margin-top:0px;">
            <img src="<?=$thiscomp["engine_path"]."/img-server/hotels/".$thishotel["hotel_sec"]."/gallery/".$thishotel["main_image"];?>" style="width:100%;">
          </div>
        </div>

        
          <?PHP if($thisproject["status"] == 'Online'){?>
          <div class="row" style="margin:0px;margin-top:20px;padding-bottom:20px;" align="center">
          <h4 class="text-color-title" style="margin-bottom:10px;margin-top:0px;padding-top:0px;"><span class="border-color"><?=$thisproject["project_name"];?></span></h4>
          <div><?=$thisproject["more_desc"];?></div>
          <div class="col-md-12" align="center">
          
          
          <img src="<?=$imgmember;?>" style="width:100%">

<?PHP if($ID > '0'){?>
<div style="color:#333;margin-top:10px;"><b>Dear <?=$thismember["FIRSTNAME"];?> <?=$thismember["LASTNAME"];?></b></div>
<div style="color:#333;"><?=$welcomemessage;?> (ID <?=$thismember["ID"];?>)</div>
<?PHP } else {?>
<div><b><?=$thisproject["short_desc"];?></b></div>
<?PHP }?>

          <?=$benefits;?>

<?PHP if($ID < '0'){?>
<table><tr>
<td style="padding-right:10px;">
<a href="#formModalMemberLogin" data-toggle="modal"><button class="btn btn-main" style="padding:5px;margin-top:5px;">Member Sign in</button></a>
</td>
<?PHP if($thisproject["facebook"] == 'YES'){?>
<td style="padding-right:10px;">
<div class="button-circle-tranparent" style="padding-top:7px;font-size:12px;border:1px solid #777;width:25px;height:25px;padding:0px;color:#777;" >OR</div>
</td>
<td>
<span id="Button_login"> <fb:login-button scope="public_profile,email" onlogin="checkLoginState();" style="height:30px;">
</fb:login-button></span>

<script>
  // This is called with the results from from FB.getLoginStatus().
  function statusChangeCallback(response) {
    console.log('statusChangeCallback');
    console.log(response);
    // The response object is returned with a status field that lets the
    // app know the current login status of the person.
    // Full docs on the response object can be found in the documentation
    // for FB.getLoginStatus().
    if (response.status === 'connected') {
      // Logged into your app and Facebook.
      testAPI();
    } else if (response.status === 'not_authorized') {
      // The person is logged into Facebook, but not your app.
      document.getElementById('status').innerHTML = 'Please log ' +
        'into this app.';
    } else {
      // The person is not logged into Facebook, so we're not sure if
      // they are logged into this app or not.
      document.getElementById('status').innerHTML = 'Please log ' +
        'into Facebook.';
    }
  }

  // This function is called when someone finishes with the Login
  // Button.  See the onlogin handler attached to it in the sample
  // code below.
  function checkLoginState() {
    FB.getLoginStatus(function(response) {
      statusChangeCallback(response);
    });
  }

  window.fbAsyncInit = function() {
  FB.init({
    appId      : '<?=$thisproject["fb_app_id"];?>',
    cookie     : true,  // enable cookies to allow the server to access 
                        // the session
    xfbml      : true,  // parse social plugins on this page
    version    : 'v2.2' // use version 2.2
  });


  FB.getLoginStatus(function(response) {
    statusChangeCallback(response);
  });

  };



  // Load the SDK asynchronously
  (function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/en_US/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));

  // Here we run a very simple test of the Graph API after login is
  // successful.  See statusChangeCallback() for when this call is made.
  function testAPI() {
    console.log('Welcome!  Fetching your information.... ');
    FB.api('/me',{ fields: 'first_name, last_name, locale, email' }, function(response) {
      console.log(JSON.stringify(response));
      //console.log('Successful login for: ' + response.name);
   
      var dataString = 'hotel_sec=<?=$thishotel["hotel_sec"];?>&language_id=<?=$language_id;?>&currency_id=<?=$currency_id;?>&ID='+response.id+'&member_type=FB&FIRSTNAME='+response.first_name+'&LASTNAME='+response.last_name+'&ID='+response.id+'&email='+response.email;
      $.ajax({ type: "POST",
            url: "member-signin.php",
            data: dataString,
            success: function(response)
            {
              //alert(response);
              $('#main_stage').load('home.php?hotel_sec=<?=$thishotel["hotel_sec"];?>&language_id=<?=$language_id;?>&currency_id=<?=$currency_id;?>&ID='+response);
              $('#formModalMemberLogin').modal('hide');
            }
      //return false ;
        });

    });
  }
</script>
</td>
<?PHP }?>
<!--./ FB Login-->
</tr></table>
<?PHP }?>

          </div>
          </div>
          <?PHP }?>

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



					</div>

					</div>
					<div class="row">
					<div class="col-md-7" align="left" style="<?=$padding;?>">					
						<div align="justify"><?=$thishotel["info"];?></div>

          <?PHP if($thisproject["status"] == 'Online'){?>
          <div class="row" style="margin:0px;margin-top:20px;">
          
          <?=$img_member;?>
          <div class="col-md-<?=$div;?>" style="padding-left:0px;padding-right:0px;">
          <h4 class="text-color-title" style="margin-bottom:10px;margin-top:0px;padding-top:0px;"><span class="border-color"><?=$thisproject["project_name"];?></span></h4>

          <div><?=$thisproject["more_desc"];?></div>

<?PHP if($ID > '0'){?>
<div style="color:#333;"><b>Dear <?=$thismember["FIRSTNAME"];?> <?=$thismember["LASTNAME"];?> (ID <?=$thismember["ID"];?>)</b></div>
<div style="color:#333;"><?=$welcomemessage;?></div>

<?PHP } else {?>
<div><b><?=$thisproject["short_desc"];?></b></div>
<?PHP }?>

          <?=$benefits;?>
          <?PHP
if($ID < '0'){?>
<table><tr>
<td style="padding-right:10px;">
<a href="#formModalMemberLogin" data-toggle="modal"><button class="btn btn-main" style="padding:5px;margin-top:5px;">Member Sign in</button></a>
</td>
<?PHP if($thisproject["facebook"] == 'YES'){?>
<td style="padding-right:10px;">
<div class="button-circle-tranparent" style="padding-top:7px;font-size:12px;border:1px solid #333;width:25px;height:25px;padding:0px;color:#333;margin-top:5px;">OR</div>
</td>
<td>
<span id="Button_login"> <fb:login-button scope="public_profile,email" onlogin="checkLoginState();" style="height:30px;margin-top:10px;">
</fb:login-button></span>

<script>
  // This is called with the results from from FB.getLoginStatus().
  function statusChangeCallback(response) {
    console.log('statusChangeCallback');
    console.log(response);
    // The response object is returned with a status field that lets the
    // app know the current login status of the person.
    // Full docs on the response object can be found in the documentation
    // for FB.getLoginStatus().
    if (response.status === 'connected') {
      // Logged into your app and Facebook.
      testAPI();
    } else if (response.status === 'not_authorized') {
      // The person is logged into Facebook, but not your app.
      document.getElementById('status').innerHTML = 'Please log ' +
        'into this app.';
    } else {
      // The person is not logged into Facebook, so we're not sure if
      // they are logged into this app or not.
      document.getElementById('status').innerHTML = 'Please log ' +
        'into Facebook.';
    }
  }

  // This function is called when someone finishes with the Login
  // Button.  See the onlogin handler attached to it in the sample
  // code below.
  function checkLoginState() {
    FB.getLoginStatus(function(response) {
      statusChangeCallback(response);
    });
  }

  window.fbAsyncInit = function() {
  FB.init({
    appId      : '<?=$thisproject["fb_app_id"];?>',
    cookie     : true,  // enable cookies to allow the server to access 
                        // the session
    xfbml      : true,  // parse social plugins on this page
    version    : 'v2.2' // use version 2.2
  });


  FB.getLoginStatus(function(response) {
    statusChangeCallback(response);
  });

  };



  // Load the SDK asynchronously
  (function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/en_US/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));

  // Here we run a very simple test of the Graph API after login is
  // successful.  See statusChangeCallback() for when this call is made.
  function testAPI() {
    console.log('Welcome!  Fetching your information.... ');
    FB.api('/me',{ fields: 'first_name, last_name, locale, email' }, function(response) {
      console.log(JSON.stringify(response));
      //console.log('Successful login for: ' + response.name);
   
      var dataString = 'hotel_sec=<?=$thishotel["hotel_sec"];?>&language_id=<?=$language_id;?>&currency_id=<?=$currency_id;?>&ID='+response.id+'&member_type=FB&FIRSTNAME='+response.first_name+'&LASTNAME='+response.last_name+'&ID='+response.id+'&email='+response.email;
      $.ajax({ type: "POST",
            url: "member-signin.php",
            data: dataString,
            success: function(response)
            {
              //alert(response);
              $('#main_stage').load('home.php?hotel_sec=<?=$thishotel["hotel_sec"];?>&language_id=<?=$language_id;?>&currency_id=<?=$currency_id;?>&ID='+response);
              $('#formModalMemberLogin').modal('hide');
            }
      //return false ;
        });

    });
  }
</script>
</td>
<?PHP }?>
<!--./ FB Login-->
</tr></table>
<?PHP }?>

          </div>
          </div>
          <?PHP }?>

<input type="hidden" id="ID" value="<?=$ID;?>">


<?PHP }?>
					
					</div>
					<div class="col-md-5" style="<?=$padding;?>">
					  
            <img src="<?=$thiscomp["engine_path"]."/img-server/hotels/".$thishotel["hotel_sec"]."/gallery/".$thishotel["main_image"];?>" style="width:100%;">
             <?PHP if($deviceType <> 'phone'){?>

<?PHP
$sql  = "SELECT COUNT(rate_plan_id) AS promotion FROM rate_plan WHERE hotel_sec = '".$thishotel["hotel_sec"]."'  AND booking_from <= '".date("Y-m-d",$today)."' AND booking_to >= '".date("Y-m-d",$today)."' AND rate_plan_status = '1' GROUP BY rate_plan_name_id ";
$prorcount= mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error());
$total = mysql_fetch_array($prorcount);
if($total["promotion"] > 0){ 
?>
<div class="row" style="margin:0px;margin-top:10px;padding-top:10px;">
<h3 class="text-color-title" style=""><?=$thismenu["tpromotion"];?></h3>
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
    <h5 style=\"margin:0px; font-family: 'Muli', sans-serif;\"><i class=\"fa fa-tag\"></i> <span class=\"text-main\">".$allpro["rate_plan_name"]." ".$thismenu["discount"]." ".$discount[$i]."</span></h5>
    <div style=\"font-weight:300;margin-left:20px;\" class=\"\">".$thismenu["period_of_stay"]." ".date("d",$travel_from)." ".$thismenu["".strtolower(date("F",$travel_from)).""]." ".date("Y",$travel_from)." - ".date("d",$travel_to)." ".$thismenu["".strtolower(date("F",$travel_to)).""]." ".date("Y",$travel_to)." ".$allpro["more_description"]."</div>
    </div>
";
}
}
?>
</div>
<?PHP }?>

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

<?PHP if($deviceType == 'phone'){?>
<div style="height:10px;border-top:1px solid #e5e5e5;border-bottom:1px solid #e5e5e5;background:#eee;"></div>
<?PHP }?>
		<div class="mg-best-rooms" style="padding-top:20px;<?=$padding_bottom;?>margin-top:0px;margin-bottom:0px;">
			<div class="container" style="border-top:1px solid #e5e5e5; padding-top: 20px;">
			 
				<div class="row">
					<div class="col-md-12" style="<?=$padding;?>">
						<div style="padding-bottom:0px;text-align:left;">
							<div style="<?=$padding_body;?>">
							<h3 class="mg-sec-left-title" style="text-transform: none;">Our Best Rooms</h3>
							</div>
						</div>
						<div class="row">
<?php
$i=0;
while($allroom[$i]["room_id"]){ 
if(($allroom[$i]["room_recommend"] == 'YES') AND ($allroom[$i]["room_status"] == '1')){
$image[$i]  = "".$thiscomp["engine_path"]."/img-server/rooms/".$thishotel["hotel_sec"]."_".$allroom[$i]["room_id"]."/".$allroom[$i]["main_image"].""; 

$sql  = "SELECT rate, master_allotment.master_rate_id FROM master_allotment LEFT JOIN master_rate ON master_allotment.master_rate_id = master_rate.master_rate_id WHERE master_rate_status = '1' AND master_allotment.room_id = '".$allroom[$i]["room_id"]."' AND fix_date = '".date("Y-m-d")."' ORDER BY rate ASC LIMIT 1 ";
$resultmaster = mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error());
$thismaster = mysql_fetch_array($resultmaster);

$sql  = "SELECT rate FROM rate_plan_allotment LEFT JOIN rate_plan ON rate_plan_allotment.rate_plan_id = rate_plan.rate_plan_id WHERE rate_plan_status = '1' AND rate_plan_allotment.master_rate_id = '".$thismaster["master_rate_id"]."' AND fix_date = '".date("Y-m-d")."' AND rate_status = 'ON' ORDER BY rate ASC LIMIT 1 ";
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
  background: -webkit-linear-gradient(top, rgba(0, 0, 0, 0) 15%, rgba(0, 0, 0, 0.2) 100%);
  background: linear-gradient(to bottom, rgba(0, 0, 0, 0) 15%, rgba(0, 0, 0, 0.2) 100%);
  -webkit-transition: background-color 0.3s;
          transition: background-color 0.3s;height:100%;bottom:0px;">
										<h3 style="color:#fff;"><?=$allroom[$i]["room_type"];?></h3>
										
										<div style="font-size: 20px;color: #fff;"><small><?=$thiscur["currency_abb"];?></small> <?=$rate;?><sup><?=$subrate;?>/Night</sup></div>
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
										<div><?=$allroom[$i]["room_type"];?></div>
										<div class="mg-room-rating"><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i> </div>
										<div class="mg-room-price" style="color: #fff;"><small><?=$thiscur["currency_abb"];?></small> <?=$rate;?><sup><?=$subrate;?>/Night</sup></div>
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


<!-- History-->
<div class="mg-best-rooms" id="bodyhome" style="padding:0px;padding-top:20px;<?=$padding_bottom;?>padding-bottom:20px;border-bottom:1px solid #e5e5e5;background:#fff;">
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
    if ( strpos( $header_response[0], "404" ) === false ) {
      $img = "";
      echo "<div class=\"col-md-12\" style=\"background:none;\">";
    
    }
    else {
      $img = "<img src=\"".$url."\" style=\"width:100%\">";
      echo "<div class=\"col-md-4\">".$img."</div>";
      echo "<div class=\"col-md-8\" style=\"background:none;\">";
    }

    echo " <h4 class=\"mg-bn-title\" style=\"<?=$margin_top_event;?>padding-bottom:0px;font-size:16px;font-weight:400;\"><b>".$allsocial["social_res_name"]."</b></h4>
    <div style=\"font-size:14px;\"><b>".$allsocial["social_res_title"]."</b></div>
    <div style=\"font-size:13px;\">".$allsocial["social_res_desc"]."</div>
    </div>
    </div>
    </div>
";
$i++;}
?>
    
</div>
</div>


		<!-- Special Offers -->
<?PHP
$sql  = "SELECT COUNT(package_id) AS total_package FROM package WHERE hotel_sec = '".$thishotel["hotel_sec"]."' AND booking_from <= '".date("Y-m-d")."' AND booking_to >= '".date("Y-m-d")."' AND package_status = 'ON' ";
$countresault = mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error());
$total = mysql_fetch_array($countresault);

$sql  = "SELECT COUNT(id) As total_extra FROM extra_service WHERE extra_hotel_sec = '".$thishotel["hotel_sec"]."' AND promote = 'YES' ";
$querycount = mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error());
$Count = mysql_fetch_array($querycount);

if(($total["total_package"] > '0') OR ($Count["total_extra"] > '0')){?>
<?PHP if($deviceType == 'phone'){?>
<div style="height:10px;border-top:1px solid #e5e5e5;border-bottom:1px solid #e5e5e5;background:#eee;"></div>
<?PHP }?>
<div class="mg-best-rooms" style="text-align:left;margin-top:0px;padding-top:30px;">
      <div class="container" style="border-top:1px solid #e5e5e5; padding-top: 20px;">
       
        <div class="row">
          <div class="row">
            <div class="col-md-12" style="<?=$padding;?>">
        <?PHP if($total["total_package"] > '0'){?>
        <div class="col-md-12"><h3 class="mg-sec-left-title" style="text-transform: none;"><?=$thismenu["tspecialoffer"];?></h3></div>	
        <?PHP }?>	


<?PHP 
$sql  = "SELECT *, (package_language.package_name) AS package_name FROM package LEFT JOIN package_language ON package.package_id = package_language.package_id AND language_id = '".$language_id."' WHERE package.hotel_sec = '".$thishotel["hotel_sec"]."' AND booking_from <= '".date("Y-m-d")."' AND booking_to >= '".date("Y-m-d")."' AND package_status = 'ON' ";
$resault = mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error());
$p=0;
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
$stay_from = explode("-", $allpackage["stay_from"]);
          $sday = $stay_from[2];
          $smonth = $stay_from[1];
          $syear = $stay_from[0];       
$stayfrom = mktime(0,0,0, intval($smonth), intval($sday), intval($syear));
$stay_to = explode("-", $allpackage["stay_to"]);
          $tday = $stay_to[2];
          $tmonth = $stay_to[1];
          $tyear = $stay_to[0];       
$stayto = mktime(0,0,0, intval($tmonth), intval($tday), intval($tyear));



if($stayfrom >= $today){
$stayfrom = mktime(0,0,0, intval($smonth), intval($sday), intval($syear));
$stayto = mktime(0,0,0, intval($smonth), intval($sday+$allpackage["package_nights"]), intval($syear));
}
else {
$stayfrom = mktime(0,0,0, intval($month), intval($day), intval($year)); 
$stayto = mktime(0,0,0, intval($month), intval($day+$allpackage["package_nights"]), intval($year)); 
}

?>
<?PHP 
$sql  = "SELECT MIN(package_price) AS package_price FROM package_room WHERE package_id = '".$allpackage["package_id"]."' ";
$resault_rate = mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error());
$thisprice = mysql_fetch_array($resault_rate);
?>

						
							<div class="col-md-3" style="<?=$padding;?>">
								<figure class="mg-room mg-room-col-12" style="margin-bottom:10px;">
									<img src="<?=$main_image;?>" alt="img11" class="img-responsive" >

									<figcaption>

										<div><?=$allpackage["package_name"];?></div>
										<div class="mg-room-rating"><i class="fa fa-gift"></i></div>
										<div class="mg-room-price"><small><?=$thiscur["currency_abb"];?></small> <?=number_format(($thisprice["package_price"]),2);?></div>
                    <form action="https://www.bookingboxes.com/mega/" method="post">
                    <input type="hidden" name="hotel_sec" value="<?=$thishotel["hotel_sec"];?>">
                    <input type="hidden" name="page" value="package">
                    <input type="hidden" name="arrival_date" value="<?=date("d/m/Y",$stayfrom);?>">
                    <input type="hidden" name="departure_date" value="<?=date("d/m/Y",$stayto);?>">
										<button type="submit" class="btn btn-main">Book</button>
                    </form>
									</figcaption>			
								</figure>
							</div>
              <div class="col-md-3" style="<?=$padding;?>">
                <div><b><?=$thismenu["tbenefits"];?></b></div>
                <div style="font-weight:300;font-size:13px;"><i class="fa fa-gift text-color"></i> <?=($allpackage["package_nights"]+1);?> <?=$thismenu["day"];?> <?=$allpackage["package_nights"]; ?> <?=$thismenu["night"];?></div>
                <?PHP 
                $sql  = "SELECT *, (extra_service_language.extra_name) AS benefits_desc_language, (package_benefits.benefits_desc) AS benefits_desc FROM package_benefits LEFT JOIN extra_service_language ON benefits_id = extra_service_id AND language_id = '".$language_id."' WHERE package_id = '".$allpackage["package_id"]."'  ";
                $resault_benefits = mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error());
                while ($allbenefits = mysql_fetch_array($resault_benefits)) {?>
                <div style="font-weight:300;font-size:13px;"><i class="fa fa-gift text-color"></i> <?PHP if($allbenefits["benefits_desc_language"] <> ''){echo $allbenefits["benefits_desc_language"];}else {echo $allbenefits["benefits_desc"];}?></div>
                <?PHP }?>
              </div>
							
<?PHP $p++;}?>

<?PHP 
$sql  = "SELECT COUNT(id) As total FROM extra_service WHERE extra_hotel_sec = '".$thishotel["hotel_sec"]."' AND promote = 'YES' ";
$querycount = mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error());
$Count = mysql_fetch_array($querycount);
if($Count["total"] > '0'){?>
<div class="col-md-12" style="<?=$padding;?>">
<h3 class="mg-sec-left-title" style="text-transform: none;"><?=$thismenu["show_more_extra"];?></h3>
</div>
<?PHP 
//Promote
$sql  = "SELECT *, extra_service_language.extra_name, extra_service_language.extra_desc FROM extra_service LEFT JOIN extra_service_language ON extra_service.id = extra_service_language.extra_service_id AND language_id = '".$language_id."' WHERE hotel_sec = '".$thishotel["hotel_sec"]."' AND promote = 'YES' ";
$querypromote = mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error());
while ($allpromote = mysql_fetch_array($querypromote)) {
$ThumbImg = "".$thiscomp["engine_path"]."/img-server/hotels/".$thishotel["hotel_sec"]."/extra_service/".$allpromote["extra_service_id"]."/thumb/thumb_".$allpromote["main_image"]."";
if($allpromote["extra_min_charge"] > '0'){
    $min_charge = "(Minimum ".$thishotel["currency_id"]."".$allpromote["extra_min_charge"].")";
}
else {
    $min_charge = "";
}
echo "
<div class=\"col-md-6\" style=\"".$padding."margin-bottom:20px;padding-left:0px;\">
<div class=\"col-md-4\" style=\"".$padding."\"><img src=\"".$ThumbImg."\" style=\"width:100%;\"></div>
<div class=\"col-md-8\" style=\"".$padding."\">
<div style=\"font-weight:400;font-size:16px;\"><div style=\"font-size:20px;margin-top:0px;\">".$allpromote["extra_name"]."</div></div>
<div style=\"font-weight:300;\">".$allpromote["extra_desc"]."</div>
<div style=\"font-weight:300;\"><b>".$thismenu["adult"]." </b> ".$thishotel["currency_id"]." ".$allpromote["extra_adult_rate"]." / <b>".$thismenu["child"]."</b> ".$thishotel["currency_id"]." ".$allpromote["extra_children_rate"]."<br>".$min_charge."</div>
</div>
</div>";

?>

<?PHP } }?>
		



					</div>
				</div>
			</div>
		</div>
	</div>
<?PHP }?>

<!--Event-->

<?PHP
$sql  = "SELECT COUNT(id) AS event FROM event WHERE hotel_sec = '".$thishotel["hotel_sec"]."'  ";
$prorcount= mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error());
$total = mysql_fetch_array($prorcount);
if($total["event"] > 0){?> 
<?PHP if($deviceType == 'phone'){?>
<div style="height:10px;border-top:1px solid #e5e5e5;border-bottom:1px solid #e5e5e5;background:#eee;"></div>
<?PHP }?>
<div class="mg-best-rooms parallax" id="bodyhome" style="padding:0px;padding-top:20px;<?=$padding_bottom;?>padding-bottom:20px;">
      <div class="container" style="border-top:1px solid #e5e5e5; padding-top: 20px;">
            <div style="padding-bottom:0px;text-align:left;margin-left:10px;">
              <h3 class="mg-sec-left-title" style="text-transform: none;">Event & Activities</h3>
            </div>             

<?PHP
$sql  = "SELECT *, (event_language.event_name) AS event_name, (event_language.event_title) AS event_title, (event_language.event_description) AS event_description FROM event LEFT JOIN event_language ON event.id = event_language.event_id AND language_id = '".$language_id."' WHERE event.hotel_sec = '".$thishotel["hotel_sec"]."'  ";
$resaultevent = mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error());
while ($allevent = mysql_fetch_array($resaultevent)) {
$img = "".$thiscomp["engine_path"]."/img-server/hotels/".$thishotel["hotel_sec"]."/event/".$allevent["id"]."/".$allevent["main_image"]."";
$response = get_headers($img, 1);
if(strpos($response[0], "404") === false){
$img_event = "<img src=\"".$img."\" style=\"width:100%\">";
}
else {
$img_event = "<div style=\"background:#f5f5f5;padding-top:50%;min-height:250px;\" align=\"center\"><i class=\"fa fa-image\"></i></div>"; 

}

    echo "<div class=\"col-md-6\" style=\"padding:0px;min-height:200px;\">
    <div class=\"row\" style=\"margin:0px;\">
    <div class=\"col-md-5\"><a style=\"cursor:pointer;\" onclick=\"EventDetails('".$allevent["id"]."');\">".$img_event."</a></div>
    <div class=\"col-md-7\" style=\"background:none;\">
    <div class=\"mg-bn-title\" style=\"<?=$margin_top_event;?>padding-bottom:0px;font-size:16px;font-weight:400;\"><b>".$allevent["event_name"]."</b></div>
    <div style=\"font-size:14px;font-weight:300;\"><b>".$allevent["event_title"]."</b></div>
    <div style=\"font-size:13px;font-weight:300;\">".substr($allevent["event_description"],0,300)."...<a style=\"cursor:pointer;\" onclick=\"EventDetails('".$allevent["id"]."');\">more details</a></div>
    </div>
    </div>
    </div>
";
}
?>
    
</div></div>

<?PHP }?>

<!--end Event-->

<input type="hidden" id="page" value="home">
<script src="js/owl.carousel.min.js"></script>
<script src="js/starrr.min.js"></script>
<script src="js/jquery.parallax-1.1.3.js"></script>
<script src="js/script.js"></script>
<script type="text/javascript">
$('#pleasewait').fadeOut('slow');

$('#mg-part-promotion-full').click();
</script>

<div class="modal fade" id="formModalMemberLogin">
    <div class="modal-dialog" style="margin-top:50px;">
   
    <div class="login-widget animation-delay1"> 
      <div class="panel panel-default">
      <span class="pull-right"><div class="button-circle-tranparent" style="padding-top:7px;font-size:20px;width:25px;height:25px;padding:0px;margin-top:5px;margin-right:5px;" onclick="HideModal('formModalMemberLogin');"><i class="fa fa-times-circle-o"></i></div></span>
        <div class="panel-body">
           <div class="text-center">
            <h4 class="mg-sec-left-title"><?=$thisproject["project_name"];?></h4>
            <div><?=$thisproject["more_desc"];?></div>
          </div>
          <form class="form-login" id="formMemberLogin" name="formMemberLogin" method="post" action="#">
            <div class="form-group">
              <label><?=$thismenu["email"];?></label>
              <input type="text" placeholder="Your email address" data-type="email" class="form-control input-sm bounceIn animation-delay2" data-required="true" name="loginemail" id="loginemail">
            </div>
            <div class="form-group">
              <label>Password</label>
              <input type="password" placeholder="Password" class="form-control input-sm bounceIn animation-delay4" data-required="true" name="loginpassword" id="loginpassword">
            </div>
            <div align="center"><span id="show_message"></span></div>
            <div class="seperator"></div>
            <div class="form-group text-333 small">
            <table style="width:100%;"><tr>
            <td class="text-color">
              Forgot your password?<br/>
              Click <a href="#formModalResetPassword" class="text-info" data-dismiss="modal" data-toggle="modal">here</a> to reset your password
            </td>
            <td align="right">
              <button type="button" class="btn btn-success btn-sm bounceIn animation-delay5 pull-right" onClick="MemberLogin();"><i class="fa fa-sign-in"></i> Sign in</button>
            </td>
            </tr></table>
            </div>
            <?PHP
          if($thisproject["online_register"] == 'YES'){?>
          <div class="pull-right">
            <span style="font-size:11px;">Don't have any account?</span>
            <a class="btn btn-default btn-xs login-link" href="register.html" style="margin-top:-2px;"><i class="fa fa-plus-circle"></i> Sign up</a>
          </div>
          <?PHP }?>
            
            <input name="hotel_sec" type="hidden" value="<?=$thishotel["hotel_sec"];?>">
            <input name="actions" type="hidden" value="Login">
          </form>
        </div>
      </div><!-- /panel -->
    </div><!-- /login-widget -->

  </div>
  </div><!-- /modal fade formModalMemberLogin-->

  <div class="modal fade" id="formModalResetPassword">
    <div class="modal-dialog" style="margin-top:50px;">
      
    <div class="login-widget animation-delay1"> 
      <div class="panel panel-default">
          <span class="pull-right"><div class="button-circle-tranparent" style="padding-top:7px;font-size:20px;width:25px;height:25px;padding:0px;margin-top:5px;margin-right:5px;" onclick="HideModal('formModalResetPassword');"><i class="fa fa-times-circle-o"></i></div></span>
        <div class="panel-body">      
    <div class="text-center">
      <h4 class="mg-sec-left-title"><?=$thisproject["project_name"];?></h4>
    </div>
          <form class="form-login" id="formResetPassword" name="formResetPassword" method="post" data-validate="parsley" novalidate>
            <div class="form-group">
              <label><?=$thismenu["email"];?></label>
              <input type="text" placeholder="Your email address" data-type="email" class="form-control input-sm bounceIn animation-delay2" data-required="true" name="email_account" id="email_account">
            </div>
            <div class="form-group text-333 small">
            <table style="width:100%"><tr>
            <td>
              <span id="show_message_fail">New password will be send to your email.</span>
            </td>
            <td align="right">
              <button type="button" class="btn btn-success btn-sm bounceIn animation-delay5" onclick="ResetPassword();"><i class="fa fa-unlock"></i> <?=$thismenu["tcontinue"];?></button>
            </td>
            </tr></table>
            </div>
            
            <input name="actions" type="hidden" value="ResetPassword">
            <input name="hotel_sec" type="hidden" value="<?=$thishotel["hotel_sec"];?>">
            <input name="language_id" type="hidden" value="<?=$language_id;?>">
          </form>
        </div>
      </div><!-- /panel -->
    </div><!-- /login-widget -->

  </div>
  </div><!-- /modal fade formModalResetPassword-->

  <script>
  //Login
function isEMailAddr(elem) {
    var str = elem.value;
    var re = /^[\w-]+(\.[\w-]+)*@([\w-]+\.)+[a-zA-Z]{2,7}$/;
    if (!str.match(re)) {
        return false;
    } else {
    return true;
  } 
}


function MemberLogin(){ 
var frm = document.formMemberLogin;
if(frm.loginemail.value == ''){
    alert("Please check your Email Address");
    frm.loginemail.focus();
    return false();
}
else if (isEMailAddr(frm.loginemail)==false){
    alert("Your email is incorect");
    frm.mailfrom.focus();
    return false;
  }
else if(frm.loginpassword.value == ''){
    alert("Please check your password");
    frm.loginpassword.focus();
    return false();
}
else {
  
  $("#formMemberLogin").submit(function() {
    var url = 'member-signin.php'; // the script where you handle the form input.
    $.ajax({
           type: "POST",
           url: url,
           data: $("#formMemberLogin").serialize(), // serializes the form's elements.
           success: function(session)
           {
              //alert(session);
              if(session > '0'){
              $('#main_stage').load('home.php?hotel_sec=<?=$thishotel["hotel_sec"];?>&language_id=<?=$language_id;?>&currency_id=<?=$currency_id;?>&ID='+session);
              $('#formModalMemberLogin').modal('hide');
              }
              else {
                setTimeout(function() {document.getElementById('show_message').innerHTML = '<span class="text-danger">!member account not found or Invalid your email address or password</span>'; }, 1000);
              
              }
           }

         });

    e.preventDefault(); // avoid to execute the actual submit of the form.
});
$('#formMemberLogin').submit();
} 
};

function ResetPassword(){ 
var frm = document.formResetPassword;
if(frm.email_account.value == ''){
    alert("Please check your Email Address");
    frm.email_account.focus();
    return false();
}
else if (isEMailAddr(frm.email_account)==false){
    alert("Your email is incorect");
    frm.email_account.focus();
    return false;
  }

else {
  
  $("#formResetPassword").submit(function() {
    var url = 'member-signin.php'; // the script where you handle the form input.
    $.ajax({
           type: "POST",
           url: url,
           data: $("#formResetPassword").serialize(), // serializes the form's elements.
           success: function(session)
           {
              //alert(session);
              if(session > '0'){
              //$('#main_stage').load('home.php?hotel_sec=<?=$thishotel["hotel_sec"];?>&language_id=<?=$language_id;?>&currency_id=<?=$currency_id;?>&ID='+session);
              $('#formModalResetPassword').modal('hide'); 
              $('#formModalMemberLogin').modal('show');           
              setTimeout(function() {document.getElementById('show_message').innerHTML = '<span class="text-success">Password has been send to your email. Please check your inbox</span>';}, 1000);

              }
              else {
              setTimeout(function() {document.getElementById('show_message_fail').innerHTML = '<span class="text-danger">!member account not found or Invalid your email address</span>'; }, 1000);
              
              }
           }

         });

    e.preventDefault(); // avoid to execute the actual submit of the form.
});
$('#formResetPassword').submit();
} 
};

function EventDetails(id){
$( '#formModalEvent' ).modal( 'toggle' );
$( '#loadModalEvent' ).load('event-details.php?hotel_sec=<?=$thishotel["hotel_sec"];?>&id='+id+'&language_id=<?=$language_id;?>');
}
</script>
<script type="text/javascript">
  document.getElementById('Member').value = '<?=$ID;?>';
</script>

<div class="modal fade" id="formModalEvent" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" style="<?=$width;?>margin-top:<?=$margin_top_event_image;?>;">
          <div class="modal-content">

            <div class="modal-body" id="loadModalEvent">
            </div>

          </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
</div><!-- /.modal --> 

