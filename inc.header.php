<?PHP
require_once("site.configs.php");

$arrival = explode("/", date("d/m/Y"));
          $sday = $arrival[0];
          $smonth = $arrival[1];
          $syear = $arrival[2];       
$mk_in = mktime(0,0,0, intval($smonth), intval($sday), intval($syear));
$mk_out = mktime(0,0,0, intval($smonth), intval($sday+1), intval($syear));

require_once 'Mobile_Detect.php';
$detect = new Mobile_Detect;
$deviceType = ($detect->isMobile() ? ($detect->isTablet() ? 'tablet' : 'phone') : 'computer');
$scriptVersion = $detect->getScriptVersion();

if (!$_REQUEST["currency_id"]){
$currency_abb = $thishotel["currency_id"];
}
else {
$currency_abb = $_REQUEST["currency_id"];
}
$thiscur  = $hotel->getCurrency($currency_abb);

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

if($deviceType == 'phone'){
$Fixed = "position:fixed;top:0px;z-index:10001;";
$height = "height:40px;";
$logo = "height:30px;";
}
else {
$Fixed = "";
$height = "height:50px;";
$logo = "height:60px;";
}
if($_REQUEST["active"] == 'facilities'){
	$facilities = "active";
}
else if($_REQUEST["active"] == 'rooms'){
	$room = "active";
}
else if($_REQUEST["active"] == 'dining'){
	$dining = "active";
}
else if($_REQUEST["active"] == 'hotel_gallery'){
	$gallery = "active";
}
else if($_REQUEST["active"] == 'contact-us'){
	$contact = "active";
}
else if($_REQUEST["active"] == 'location'){
  $location = "active";
}
else {
	$home = "active";
}
?>
<style type="text/css">
::-webkit-scrollbar {
    width: 0px;
    background: transparent; /* make scrollbar transparent */
}

</style>
<!--
font-family: 'Roboto Condensed', sans-serif;
font-family: 'Titillium Web', sans-serif;
-->

<?PHP if($deviceType == 'phone'){?>

<div style="position:fixed;top:0px;z-index:100002;width:100%;height:40px; background:<?=$thishotel["bg_color"];?>;" id="top">
<div id="wrapperhead">
<table style="width:100%"><tr>
<td>

<a href="#" id="menu-toggle"><span class="glyphicon glyphicon-align-justify" style="margin-left:10px;color:#fff;font-size:20px;margin-top:10px;"></span>
</a>

</td>
<td align="center"></td>
<td align="right">
<span style="margin-top:10px;margin-right:10px;color:#fff">
<a href="#" id="menu-toggle-right" style="color:#fff;"><?=$thisflag_mobile;?></a>
</span>
</td>
</tr></table>
</div>
</div>
<div id="wrapper">

      <!-- Sidebar -->
            <!-- Sidebar -->
      <div id="sidebar-wrapper" style="background:#1D2F43;-ms-filter:alpha(opacity=95);-moz-opacity:0.95;-khtml-opacity:0.95;opacity:0.95;">     
      <div>
        <ul class="sidebar-nav" id="sidebar" style="font-family: 'Raleway';">
          <li class="<?=$home;?>" style="height:40px;background:<?=$thishotel["bg_color"];?>;color:#fff;"><div style="margin-left:-10px;"><?=$thishotel["hotel_name"];?></div></li> 

              <li class="<?=$facilities;?>"><a href="#Facilities" onClick="Menu('home.php?hotel_sec=<?=$thishotel["hotel_sec"];?>&language_id=<?=$language_id;?>&ID=<?=$ID;?>&currency_id=<?=$thiscur["currency_abb"];?>');"  style="margin-left:-28px;color:#fff;"> <i class="fa fa-home"></i> <?=$thismenu["home"];?></a></li>

              <li class="<?=$facilities;?>"><a href="#Facilities" onClick="Menu('facilities.php?hotel_sec=<?=$thishotel["hotel_sec"];?>&language_id=<?=$language_id;?>&ID=<?=$ID;?>&currency_id=<?=$thiscur["currency_abb"];?>');"  style="margin-left:-28px;color:#fff;"><i class="fa fa-list" ></i> <?=$thismenu["facilities"];?></a></li>

              <li class="<?=$rooms;?>"><a href="#Accommodations" onClick="Menu('rooms.php?hotel_sec=<?=$thishotel["hotel_sec"];?>&language_id=<?=$language_id;?>&ID=<?=$ID;?>&currency_id=<?=$thiscur["currency_abb"];?>');"  style="margin-left:-28px;color:#fff;"><i class="fa fa-bed"></i> <?=$thismenu["menu_room"];?></a></li>

              <li class="<?=$dining;?>"><a href="#Dinning" onClick="Menu('dining.php?hotel_sec=<?=$thismenu["hotel_sec"];?>&language_id=<?=$language_id;?>&ID=<?=$ID;?>&currency_id=<?=$thiscur["currency_abb"];?>');" style="margin-left:-28px;color:#fff;"><i class="fa fa-cutlery" ></i> <?=$thismenu["dining"];?></a></li>

              <li class="<?=$contact;?>"><a href="#Contact" onClick="Menu('social_responsibility.php?hotel_sec=<?=$thishotel["hotel_sec"];?>&language_id=<?=$language_id;?>&ID=<?=$ID;?>&currency_id=<?=$thiscur["currency_abb"];?>');" style="margin-left:-28px;color:#fff;"><i class="fa fa-globe" ></i> <?=$thismenu["social_responsibility"];?></a></li>

              <li class="<?=$gallery;?>"><a href="#Gallery" onClick="Menu('hotel_gallery.php?hotel_sec=<?=$thishotel["hotel_sec"];?>&language_id=<?=$language_id;?>&ID=<?=$ID;?>&currency_id=<?=$thiscur["currency_abb"];?>');"  style="margin-left:-28px;color:#fff;"><i class="fa fa-picture-o"></i> <?=$thismenu["gallery"];?></a></li>

              <li class="<?=$contact;?>"><a href="#Contact" onClick="Menu('location.php?hotel_sec=<?=$thishotel["hotel_sec"];?>&language_id=<?=$language_id;?>&ID=<?=$ID;?>&currency_id=<?=$thiscur["currency_abb"];?>');" style="margin-left:-28px;color:#fff;"><i class="fa fa-map-o" ></i> <?=$thismenu["map"];?></a></li>

              <li class="<?=$contact;?>"><a href="#Contact" onClick="Menu('contact-us.php?hotel_sec=<?=$thishotel["hotel_sec"];?>&language_id=<?=$language_id;?>&ID=<?=$ID;?>&currency_id=<?=$thiscur["currency_abb"];?>');"  style="margin-left:-28px;color:#fff;"><i class="fa fa-envelope-o" ></i> <?=$thismenu["contact"];?></a></li>
        </ul>
      </div>
      <div>
      
      </div>
      </div>

    </div>



<div id="wrapper2">

      <!-- Sidebar -->
            <!-- Sidebar -->
      <div id="sidebar-wrapper2"  style="background:#1D2F43;-ms-filter:alpha(opacity=95);-moz-opacity:0.95;-khtml-opacity:0.95;opacity:0.95;">     
      <div>
        <ul class="sidebar-nav2" id="sidebar2" style=";margin-left:-28px;">
        <li style="height:40px;background:<?=$thishotel["bg_color"];?>;"><div style="margin-left:28px;color:#fff;"><?=$thismenu["choose_language"];?></div></li> 
          
                                        <?PHP
$sql  = "SELECT NativeName, ID, ISO639_1 FROM hotel_language WHERE hotel_sec = '".$thishotel["hotel_sec"]."' AND front_end = 'YES' ";
$querylanguage = mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error());
while ($rowlanguage = mysql_fetch_array($querylanguage)) {
$icons = "".$thiscomp["engine_path"]."/img-server/flags_iso/24/".$rowlanguage["ISO639_1"].".png";
$icon_images = "<img src=\"".$icons."\">"; 
$newtitle = $rowlanguage["hotel_title"];
$newhotelname = $rowlanguage["hotel_name"];
 ?>

  <li onClick="ChangeLanguage('<?=$rowlanguage["ID"];?>', '<?PHP echo strtoupper($newhotelname);?> | <?PHP echo strtoupper($newtitle);?>', '<?=$thiscur["currency_abb"];?>');" style="cursor:pointer;padding:5px;padding-top:0px;padding-bottom:0px;color:#fff;margin-left:-10px"><?=$icon_images;?> <?=$rowlanguage["NativeName"];?>
  </li>

<?PHP }?>
           
        </ul>
      </div>
      <div>
      
      </div>
      </div>

    </div>
  
<style type="text/css">
  .row{
    margin-left:0px;
    margin-right:0px;
}

#wrapperhead{
    left: 0px;
    right: 0px;
    width:100%;
    transition: all .4s ease 0s;
}


#wrapper {
    padding-left: 0px;
    transition: all .4s ease 0s;
    height: 100%;
}
#wrapper2 {
    padding-right: 0px;
    transition: all .4s ease 0s;
    height: 100%;
}
.wrapperhead-right {
    margin-right: 200px;
    transition: all .4s ease 0s;
    height: 100%;
}
.wrapperhead-right-out {
    margin-right: -150px;
    transition: all .4s ease 0s;
    height: 100%;
}

.wrapperhead-left {
    margin-left: 200px;
    transition: all .4s ease 0s;
    height: 100%;
}
.wrapperhead-left-out {
    margin-left: -150px;
    transition: all .4s ease 0s;
    height: 100%;
}


#sidebar-wrapper {
    margin-left: -250px;
    left: 0px;
    width: 250px;
    background: none;
    position: fixed;
    height: 100%;
    z-index: 10001;
    transition: all .4s ease 0s;
}
#sidebar-wrapper2 {
    margin-right: -300px;
    right: 0px;
    width: 250px;
    background: none;
    position: fixed;
    height: 100%;
    z-index: 10001;
    transition: all .4s ease 0s;
}

.sidebar-nav {
    display: block;
    float: left;
    width: 250px;
    list-style: none;
    margin: 0;
    padding: 0;

}
.sidebar-nav2 {
    display: block;
    float: right;
    width: 250px;
    list-style: none;
    margin: 0;
    padding: 0;

}

#wrapper.active {
    padding-left: 0px;
}
#wrapper2.active {
    padding-right: 0px;
}
#wrapperhead.active {
    padding-right: 0px;
}



#wrapper.active #sidebar-wrapper {
    left: 250px;
}
#wrapper2.active #sidebar-wrapper2 {
    right: 250px;
}


#page-content-wrapper {
  width: 100%;
}

#sidebar_menu li a, .sidebar-nav li a {
    color: #263940;
    display: block;
    float: left;
    text-decoration: none;
    width: 250px;
    background: none;
    border-bottom: 1px solid #999;
    -webkit-transition: background .5s;
    -moz-transition: background .5s;
    -o-transition: background .5s;
    -ms-transition: background .5s;
    transition: background .5s;
}

#sidebar_menu2 li a, .sidebar-nav2 li a {
    color: #fff;
    display: block;
    float: left;
    text-decoration: none;
    width: 250px;
    background: none;
    border-bottom: 1px solid #999;
    -webkit-transition: background .5s;
    -moz-transition: background .5s;
    -o-transition: background .5s;
    -ms-transition: background .5s;
    transition: background .5s;
}


.sidebar-nav li {
  line-height: 40px;
  text-indent: 20px;
}
.sidebar-nav2 li {
  line-height: 40px;
  text-indent: 20px;
}

.sidebar-nav li a {
  color: #999999;
  display: block;
  text-decoration: none;
}
.sidebar-nav2 li a {
  color: #999999;
  display: block;
  text-decoration: none;
}

.sidebar-nav li a:hover {
  color: #fff;
  background: none;
  text-decoration: none;
}
.sidebar-nav2 li a:hover {
  color: #fff;
  background: none;
  text-decoration: none;
}

.sidebar-nav li a:active,
.sidebar-nav li a:focus {
  text-decoration: none;
}
.sidebar-nav2 li a:active,
.sidebar-nav2 li a:focus {
  text-decoration: none;
}

.sidebar-nav > .sidebar-brand a:hover {
  color: #fff;
  background: #222;
}
.sidebar-nav2 > .sidebar-brand2 a:hover {
  color: #fff;
  background: #222;
}


@media (max-width:767px) {
    #wrapper {
    padding-left: 0px;
    transition: all .4s ease 0s;
}
    #wrapper2 {
    padding-right: 0px;
    transition: all .4s ease 0s;
}



#sidebar-wrapper {
    left: 0px;
}
#sidebar-wrapper2 {
    right: 0px;
}

#wrapper.active {
    padding-left: 250px;
}
#wrapper2.active {
    padding-right: 250px;
}

#wrapper.active #sidebar-wrapper {
    left: 250px;
    width: 250px;
    transition: all .4s ease 0s;
}
#wrapper2.active #sidebar-wrapper2 {
    right: 250px;
    width: 250px;
    transition: all .4s ease 0s;
}


}


</style>


<script type="text/javascript">
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

</script>
<?PHP }else {?>

<div id="top" style="position: fixed; top: 0px; width: 100%;z-index: 90003;">

<div style="background: rgba(255,255,255,0.95);width:100%;height:48px;" align="right">

        <div class="container" style="padding:0px;background:none;;">
          <div class="row" style="margin:0px;">
            <nav class="navbar navbar-inverse" style="width:100%;background:none;">
        <div class="container" style="">
          <!-- Brand and toggle get grouped for better mobile display -->
          <!-- Collect the nav links, forms, and other content for toggling -->
          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1" style="background:none;margin-top:0px;padding-top:0px;float: right;">
            <ul class="nav navbar-nav" id="navbar-nav" style="text-align:center;margin-top:0px;padding-top:0px;font-family: 'Raleway';font-size:14px;">
              <li class="<?=$home;?>" id="home"><a href="#Home" class=" text-dark mainmenu" onClick="Menu('home.php?hotel_sec=<?=$thishotel["hotel_sec"];?>&language_id=<?=$language_id;?>&ID=<?=$ID;?>&currency_id=<?=$thiscur["currency_abb"];?>', 'home');" style="padding:10px;padding-top:15px;padding-bottom:15px;"><i class="fa fa-home" ></i> <?=$thismenu["home"];?></a></li>

              <li class="<?=$facilities;?>" id="facilities"><a href="#Facilities" class="mainmenu" onClick="Menu('facilities.php?hotel_sec=<?=$thishotel["hotel_sec"];?>&language_id=<?=$language_id;?>&ID=<?=$ID;?>&currency_id=<?=$thiscur["currency_abb"];?>', 'facilities');" style="padding:10px;padding-top:15px;padding-bottom:15px;"><i class="fp-ht-swimmingpool" ></i> <?=$thismenu["facilities"];?></a></li>

              <li class="<?=$rooms;?>" id="rooms"><a href="#Accommodations" class="mainmenu" onClick="Menu('rooms.php?hotel_sec=<?=$thishotel["hotel_sec"];?>&language_id=<?=$language_id;?>&ID=<?=$ID;?>&currency_id=<?=$thiscur["currency_abb"];?>', 'rooms');" style="padding:10px;padding-top:15px;padding-bottom:15px;"><i class="fp-ht-bed"></i> <?=$thismenu["menu_room"];?></a></li>

              <li class="<?=$dining;?>" id="dining"><a href="#Dinning" class="mainmenu" onClick="Menu('dining.php?hotel_sec=<?=$thismenu["hotel_sec"];?>&language_id=<?=$language_id;?>&ID=<?=$ID;?>&currency_id=<?=$thiscur["currency_abb"];?>', 'dining');" style="padding:10px;padding-top:15px;padding-bottom:15px;"><i class="fa fa-cutlery" ></i> <?=$thismenu["dining"];?></a></li>

              <li class="<?=$gallery;?>" id="hotel_gallery"><a href="#Gallery" class="mainmenu" onClick="Menu('hotel_gallery.php?hotel_sec=<?=$thishotel["hotel_sec"];?>&language_id=<?=$language_id;?>&ID=<?=$ID;?>&currency_id=<?=$thiscur["currency_abb"];?>', 'hotel_gallery');" style="padding:10px;padding-top:15px;padding-bottom:15px;"><i class="fa fa-picture-o"></i> <?=$thismenu["gallery"];?></a></li>

              <li class="<?=$contact;?>" id="location"><a href="#Contact" class="mainmenu" onClick="Menu('location.php?hotel_sec=<?=$thishotel["hotel_sec"];?>&language_id=<?=$language_id;?>&ID=<?=$ID;?>&currency_id=<?=$thiscur["currency_abb"];?>', 'location');" style="padding:10px;padding-top:15px;padding-bottom:15px;"><i class="fa fa-map-o" ></i> <?=$thismenu["map"];?></a></li>

              <li class="<?=$contact;?>" id="contact-us"><a href="#Contact" class="mainmenu" onClick="Menu('contact-us.php?hotel_sec=<?=$thishotel["hotel_sec"];?>&language_id=<?=$language_id;?>&ID=<?=$ID;?>&currency_id=<?=$thiscur["currency_abb"];?>', 'contact-us');" style="padding:10px;padding-top:15px;padding-bottom:15px;"><i class="fa fa-envelope-o" ></i> <?=$thismenu["contact"];?></a></li>
              <li class="dropdown">
    <a href="#dropdownmenu text-white" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" style="padding:10px;padding-top:15px;padding-bottom:15px;"><?=$thisflag;?> <?=$thislanguage;?></a>
              <ul id="dropdownmenu" class="dropdown-menu" style="background:rgba(38,57,64,0.9); top:5px;min-width:250px;z-index: 90003; border-radius: 0px;padding:0px;">
                              <li>
                              <div class="col-md-12" style="padding:0px;">
                                        <?PHP
$sql  = "SELECT * FROM hotel_language WHERE hotel_sec = '".$thishotel["hotel_sec"]."' AND front_end = 'YES' ";
$querylanguage = mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error());
while ($rowlanguage = mysql_fetch_array($querylanguage)) {
$icons = "".$thiscomp["engine_path"]."/img-server/flags_iso/24/".$rowlanguage["ISO639_1"].".png";
$icon_images = "<img src=\"".$icons."\">"; 
$newtitle = $rowlanguage["hotel_title"];
$newhotelname = $rowlanguage["hotel_name"];
 ?>

  <div class="col-md-12 language" onClick="ChangeLanguage('<?=$rowlanguage["ID"];?>', '<?PHP echo strtoupper($newhotelname);?> | <?PHP echo strtoupper($newtitle);?>', '<?=$thiscur["currency_abb"];?>');" style="cursor:pointer;padding:10px; color:#fff;font-family: 'Raleway';"><?=$icon_images;?> <?=$rowlanguage["NativeName"];?>
  </div>

<?PHP }?>
                              </div>
                              </li>
                              
                            </ul>
                          </li>
            </ul>
             
          </div><!-- /.navbar-collapse -->


        </div><!-- /.container-fluid -->
      </nav>
      </div>
  </div>

</div>
</div>
<?PHP }?>
<script src="js/owl.carousel.min.js"></script>
    <script src="js/starrr.min.js"></script>
    <script src="js/jquery.parallax-1.1.3.js"></script>
    <script src="js/script.js"></script>






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
    top: 0px;
  }
}

@keyframes vertical-slide-top {
  0% {
    top: -70px;
  }
  100% {
    top: 0px;
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
