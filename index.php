<?PHP
require_once("site.configs.php");
$todaydate = explode("/", date("d/m/Y"));
          $day = $todaydate[0];
          $month = $todaydate[1];
          $year = $todaydate[2];    
$today = mktime(0,0,0, intval($month), intval($day), intval($year));

$thishotel  = $hotel->getHotel($hotel_sec);
$thiscomp   = $company->getCompany($thishotel["hotel_chain_id"]);
require_once("iclass/class.member.php");
$member = new Member();
$thisproject = $member->getMemberProject($hotel_sec);


require_once 'Mobile_Detect.php';
$detect = new Mobile_Detect;
$deviceType = ($detect->isMobile() ? ($detect->isTablet() ? 'tablet' : 'phone') : 'computer');
$scriptVersion = $detect->getScriptVersion();
if($deviceType == 'phone'){
$margin_top = "0px";
$max_logo = "max-width:70px;";
$img_height = "450px";
$topmenu_slide = "vertical-slide-top";
$topmenu_top = "0px";
$topmenu_bg = "".$thishotel["bg_color"]."";
}
else {
$margin_top = "80px";
$max_logo = "max-width:90px;";
$data_target = "";
$img_height = "650px";
$topmenu_slide = "vertical-slide-out";
$topmenu_top = "-70px";
$topmenu_bg = "";
}

if($deviceType == 'computer'){
  $data_target = "";
}
else {
  $data_target = "data-toggle=\"collapse\" data-target=\".navbar-collapse\"";
}


if (!$_REQUEST["currency_id"]){
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
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no,minimal-ui">
    <meta name="description" content="<?=$thishotel["description"];?>">
    <meta name="keyword" content="<?=$thishotel["keyword"];?>">
    <meta name="author" content="<?=$thishotel["hotel_title"];?>">
    <title><?=$thishotel["hotel_name"];?> <?=$thishotel["hotel_title"];?></title>

    <link rel="icon" href="../assets/ico/logo_color.png">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?=$thiscomp["engine_path"]."/img-server/hotels/".$thishotel["hotel_sec"]."/logo/".$thishotel["logo"];?>">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href=<?=$thiscomp["engine_path"]."/img-server/hotels/".$thishotel["hotel_sec"]."/logo/".$thishotel["logo"];?>">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?=$thiscomp["engine_path"]."/img-server/hotels/".$thishotel["hotel_sec"]."/logo/".$thishotel["logo"];?>">
    <link rel="apple-touch-icon-precomposed" sizes="57x57" href="<?=$thiscomp["engine_path"]."/img-server/hotels/".$thishotel["hotel_sec"]."/logo/".$thishotel["logo"];?>">
    <link rel="shortcut icon" href="<?=$thiscomp["engine_path"]."/img-server/hotels/".$thishotel["hotel_sec"]."/logo/".$thishotel["logo"];?>">

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">

    <link href="css/owl.carousel.css" rel="stylesheet">
    <link href="css/owl.theme.css" rel="stylesheet">
    <link href="css/owl.transitions.css" rel="stylesheet">
    <link href="css/cs-select.css" rel="stylesheet">
    <link href="css/bootstrap-datepicker3.min.css" rel="stylesheet">
    <link href="css/freepik.hotels.css" rel="stylesheet">
    <link href="css/style.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,500,600" rel="stylesheet">

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-74330000-12"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-74330000-12');
</script>


  </head>
  <body>


    <div class="preloader"></div>
    <!--Header-->
    <div id="DivHeaders">
    <?PHP include("inc.header.php"); ?>
    </div>

    <div id="DivSlide">
    
    </div>

  <div id="main_stage">
    <!--Header-->   
    <script src="http://maps.google.com/maps/api/js?sensor=true"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBxH8TyCWxN5OiD5nnWI22kHEMnyGdr5XE" async="" defer="defer" type="text/javascript"></script>
    <script src="js/gmaps.min.js"></script>   
  </div> <!--Main_Stage-->  

    <!--Footer-->
    <div id="DivSocial">
    <?PHP //include("inc.social.php"); ?>
    </div>
    <!--Footer-->
    <div id="DivFooter">
    <?PHP include("inc.footer.php"); ?>
    </div>
  </body>
</html>

<!-- Include all compiled plugins (below), or include individual files as needed -->
  <script src="js/modernizr.custom.min.js"></script>
<script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/jssor.slider.mini.js"></script>
    <script src="js/classie.js"></script>
    <script src="js/selectFx.js"></script>
    
    <script src="js/starrr.min.js"></script>
    <script src="js/nivo-lightbox.min.js"></script>
    <script src="js/jquery.shuffle.min.js"></script>
    
    <script src="js/jquery.parallax-1.1.3.js"></script>
    <script src="js/script.js"></script>

    <script src="js/bootstrap-datepicker.min.js"></script>

<script type="text/javascript">
$('#main_stage').load('home.php?hotel_sec=<?=$thishotel["hotel_sec"];?>&language_id=<?=$language_id;?>&currency_id=<?=$currency_id;?>&ID=<?=$ID;?>');
function ChangeLanguage(language_id, title, currency_id){
//document.getElementById('pleasewait').style.display = "block";
//$("#wrapper2").removeClass("active");
//$("#wrapperhead").toggleClass("wrapperhead-right");
var page = document.getElementById('page').value;

$('#DivHeaders').load('inc.header.php?hotel_sec=<?=$thishotel["hotel_sec"];?>&language_id='+language_id+'&currency_id='+currency_id+'&ID=<?=$ID;?>&active='+page);

//$('#DivSlide').load('inc.slide.php?hotel_sec=<?=$thishotel["hotel_sec"];?>&language_id='+language_id);

$('#main_stage').load(page+'.php?hotel_sec=<?=$thishotel["hotel_sec"];?>&language_id='+language_id+'&currency_id='+currency_id+'&ID=<?=$ID;?>');

$('#DivFooter').load('inc.footer.php?hotel_sec=<?=$thishotel["hotel_sec"];?>&language_id='+language_id+'&currency_id='+currency_id+'&ID=<?=$ID;?>');   

document.title = title;

};


$('ul.navbar-nav li a').click(
    function(e) {
        e.preventDefault(); // prevent the default action
        e.stopPropagation(); // stop the click from bubbling
        $(this).closest('ul').find('.active').removeClass('active');
        $(this).parent().addClass('active');
  });
//$('#LoadFormBook').load('form-book-home.php?language_id=<?=$language_id;?>&currency_id=<?=$thiscur["currency_id"];?>');

function Menu(menu, page){ 
document.getElementById('pleasewait').style.display = "block";
$("#wrapper").removeClass("active");
$("#wrapperhead").toggleClass("wrapperhead-left");
$("#navbar-nav .active").removeClass("active");
$("#"+page).addClass("active");
//$('#pleasewait').delay(400).fadeOut('slow');  
$("html, body").animate({ scrollTop: 340 }, 800);    
$('#main_stage').load(menu);
    
};



$("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("active");
        $("#wrapper2").removeClass("active");
        $("#wrapperhead").toggleClass("wrapperhead-left");
        $("#wrapperhead").toggleClass("wrapperhead-right-out");
});

</script>

<script type="text/javascript">
$("#menu-toggle-right").click(function(e) {
        e.preventDefault();
        $("#wrapper2").toggleClass("active");
        $("#wrapper").removeClass("active");
        $("#wrapperhead").toggleClass("wrapperhead-right");
        $("#wrapperhead").toggleClass("wrapperhead-left-out");
});

function BookNow(){
  $('#BookNow').submit();
}




</script>

<div id="pleasewait" style="display:none;" align="center">
<style>
#popup_loading {
    position: absolute;
    top: 0px;
    left:0px;
    z-index: 10000;
    width:100%;
    min-height:100% !important;
    background:none;
    opacity:0.5;
filter:alpha(opacity=50); /* For IE8 and earlier */ 
}
.loading {
    position: fixed;
    z-index: 10001;
    top:20%;
    text-align:center;
    width:100%;
}
</style>
<div class="loading" align="center"><i class="fa fa-spinner fa-pulse fa-2x text-color"></i></div>
<div id="popup_loading" align="center"></div>
</div>


<script type="text/javascript">
var screenWidth = $('#top').width();
var $cacheMenu = $('#dropdownmenu');
$cacheMenu.css({
        'width': screenWidth+'px'
});


  //var DivgetFixed = $('#mega-slider').height(); 


  function fixDivTop() {
    var $cacheTop = $('#top');

    if (($(window).scrollTop() >= 100) && ($(window).scrollTop() <= 1000))
      $cacheTop.css({
        'top': '-120px',
        'width': '100%',
        'z-index': '90003',
        'animation-name': 'vertical-slide-out',
        'animation-duration': '1s'
      });
    
    else
      $cacheTop.css({
        'top': '0px',
        'width': '100%',
        'z-index': '90003',
        'animation-name': 'vertical-slide-top',
        'animation-duration': '1s'
        
      });

  }
  $(window).scroll(fixDivTop);
  fixDivTop();

  function FormAvailable() {
    var $cacheFormAvailable = $('#FormAvailable');

    if (($(window).scrollTop() >= 100) && ($(window).scrollTop() <= 1000))
      $cacheFormAvailable.css({
        'top': '0px',
        'width': '100%',
        'z-index': '90002',
        'animation-name': 'vertical-slide-out-form',
        'animation-duration': '1s'
      });
    
    else
      $cacheFormAvailable.css({
        'top': '48px',
        'width': '100%',
        'z-index': '90002',
        'animation-name': 'vertical-slide-top-form',
        'animation-duration': '1s'
        
      });

  }
  $(window).scroll(FormAvailable);
  FormAvailable();
</script>


<style>
@keyframes vertical-slide {
  0% {
    top: -120px;
  }
  100% {
    top: 50px;
  }
}

@keyframes vertical-slide-out {
  0% {
    top: 0px;
  }
  100% {
    top: -100px;
  }
}

@keyframes vertical-slide-top {
  0% {
    top: -100px;
  }
  100% {
    top: 0px;
  }
}

@keyframes vertical-slide-out-form {
  0% {
    top: 48px;
  }
  100% {
    top: 0px;
  }
}

@keyframes vertical-slide-top-form {
  0% {
    top: 0px;
  }
  100% {
    top: 48px;
  }
}

@keyframes vertical-slide-top-out {
  0% {
    top: -70px;
  }
  100% {
    top: 0px;
  }
}

@keyframes MenuTop {
  0% {
    top: -220px;
  }
  100% {
    top: 51px;
  }
}
@keyframes MenuTop-Out {
  0% {
    top: 51px;
  }
  100% {
    top: -220px;
  }
}
</style>

<script>
function HideModal(ID){
  $('#'+ID).modal('hide');
}

function Selectdate(arrival, departure){ 
        // disabling dates

        var nowTemp = new Date();
        var now = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate(), 0, 0, 0, 0);
        var checkin = $('#'+arrival).datepicker({
          onRender: function(date) {
            return date.valueOf() < now.valueOf() ? 'disabled' : '';

          }
        }).on('changeDate', function(ev) {
          
            var newDate = new Date(ev.date)
            newDate.setDate(newDate.getDate() + 1);
            checkout.setValue(newDate);
          
          checkin.hide();
          $('#'+departure).focus();
        }).data('datepicker');
        var checkout = $('#'+departure).datepicker({
          onRender: function(date) {
            return date.valueOf() <= checkin.date.valueOf() ? 'disabled' : '';
          }
        }).on('changeDate', function(ev) {

          checkout.hide();
        }).data('datepicker');

  };
</script>



