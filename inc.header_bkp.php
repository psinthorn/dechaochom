<?PHP
require_once("site.configs.php");
if($deviceType == 'phone'){
$Fixed = "position:fixed;top:0px;z-index:10001;";
$height = "height:40px;";
$logo = "height:30px;";
}
else {
$Fixed = "";
$height = "height:55px;";
$logo = "height:40px;";
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
else {
	$home = "active";
}
?>

		<header class="header transp sticky" style="background:none;background: -webkit-linear-gradient(top, rgba(22, 38, 46, 0.8) 15%, rgba(22, 38, 46, 0) 100%);
  background: linear-gradient(to bottom, rgba(22, 38, 46, 0.8) 15%, rgba(22, 38, 46, 0) 100%);"> <!-- available class for header: .sticky .center-content .transp -->
			<nav class="navbar navbar-inverse" style="<?=$height;?><?=$Fixed;?>width:100%;">
				<div class="container">
					<!-- Brand and toggle get grouped for better mobile display -->
					<div class="navbar-header">
						<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false" style="padding:7px;">
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						<a class="navbar-brand" href="#"><img src="images/logo.png" alt="logo" style="<?=$logo;?>"></a>
					</div>
					<!-- Collect the nav links, forms, and other content for toggling -->
					<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
						<ul class="nav navbar-nav navbar-right">
							<li class="<?=$home;?>"><a href="#Home" onClick="Menu('home.php?hotel_sec=<?=$thishotel["hotel_sec"];?>&language_id=<?=$language_id;?>&ID=<?=$ID;?>');" style="padding:10px;padding-top:15px;padding-bottom:20px;font-size:15px;"><i class="fa fa-home" ></i> <?=$thishotel["home"];?></a></li>

							<li class="<?=$facilities;?>"><a href="#Facilities" onClick="Menu('facilities.php?hotel_sec=<?=$thishotel["hotel_sec"];?>&language_id=<?=$language_id;?>&ID=<?=$ID;?>');" style="padding:10px;padding-top:15px;padding-bottom:20px;font-size:15px;"><i class="fa fa-list" ></i> <?=$thishotel["facilities"];?></a></li>

							<li class="<?=$rooms;?>"><a href="#Accommodations" onClick="Menu('rooms.php?hotel_sec=<?=$thishotel["hotel_sec"];?>&language_id=<?=$language_id;?>&ID=<?=$ID;?>');" style="padding:10px;padding-top:15px;padding-bottom:20px;font-size:15px;"><i class="fa fa-bed"></i> <?=$thishotel["menu_room"];?></a></li>

							<li class="<?=$dining;?>"><a href="#Dinning" onClick="Menu('dining.php?hotel_sec=<?=$thishotel["hotel_sec"];?>&language_id=<?=$language_id;?>&ID=<?=$ID;?>');" style="padding:10px;padding-top:15px;padding-bottom:20px;font-size:15px;"><i class="fa fa-cutlery" ></i> <?=$thishotel["dining"];?></a></li>

							<li class="<?=$gallery;?>"><a href="#Gallery" onClick="Menu('hotel_gallery.php?hotel_sec=<?=$thishotel["hotel_sec"];?>&language_id=<?=$language_id;?>&ID=<?=$ID;?>');" style="padding:10px;padding-top:15px;padding-bottom:20px;font-size:15px;"><i class="fa fa-picture-o"></i> <?=$thishotel["gallery"];?></a></li>

							<li class="<?=$contact;?>"><a href="#Contact" onClick="Menu('contact-us.php?hotel_sec=<?=$thishotel["hotel_sec"];?>&language_id=<?=$language_id;?>&ID=<?=$ID;?>');" style="padding:10px;padding-top:15px;padding-bottom:20px;font-size:15px;"><i class="fa fa-envelope-o" ></i> <?=$thishotel["contact"];?></a></li>


							<li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" style="padding:10px;padding-top:15px;padding-bottom:20px;font-size:15px;"><?=$thisflag;?> <?=$thismenu["tlanguage"];?></a>
              <ul class="dropdown-menu" style="background:url('images/bg_navy30.png');background: -webkit-linear-gradient(top, rgba(22, 38, 46, 0.23) 25%, rgba(22, 38, 46, 0.8) 100%);
  background: linear-gradient(to bottom, rgba(22, 38, 46, 0.23) 25%, rgba(22, 38, 46, 0.8) 100%);width:100%;">
                              <li>
                              <div>
                                        <?PHP
$sql  = "SELECT * FROM hotel_language WHERE hotel_sec = '".$thishotel["hotel_sec"]."' AND front_end = 'YES' ";
$querylanguage = mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error());
while ($rowlanguage = mysql_fetch_array($querylanguage)) {
$icons = "".$thiscomp["engine_path"]."/img-server/flags_iso/24/".$rowlanguage["ISO639_1"].".png";
$icon_images = "<img src=\"".$icons."\">"; 
$newtitle = $rowlanguage["hotel_title"];
$newhotelname = $rowlanguage["hotel_name"];
 ?>

  <div class="col-md-6 language" onClick="ChangeLanguage('<?=$rowlanguage["ID"];?>', '<?PHP echo strtoupper($newhotelname);?> | <?PHP echo strtoupper($newtitle);?>', '<?=$thiscur["currency_abb"];?>');" style="cursor:pointer;padding:10px;"><?=$icon_images;?> <?=$rowlanguage["NativeName"];?>
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
		</header>

<script type="text/javascript">
	$('ul.navbar-nav li a').click(
    function(e) {
        e.preventDefault(); // prevent the default action
        e.stopPropagation(); // stop the click from bubbling
        $(this).closest('ul').find('.active').removeClass('active');
        $(this).parent().addClass('active');
  });
</script>