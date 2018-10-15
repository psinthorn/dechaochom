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


		<footer class="mg-footer">
			<div class="mg-footer-widget" style="padding-top:30px;padding-bottom:30px;">
				<div class="container">
					<div class="row">
						
						<div class="col-md-4 col-sm-6" style="<?=$padding_footer;?>">
							<div class="widget"  style="padding-bottom:0px;margin-bottom:0px;padding-top:0px;margin-top:0px;">
								<h2 class="mg-widget-title" style="margin-bottom:5px;"><?=$thismenu["contact"];?></h2>
								<address>
									<?=$thishotel["hotel_address"];?><br>
									<?=$thishotel["hotel_city"];?> <?=$thishotel["hotel_province"];?> <?=$thishotel["hotel_country"];?> <?=$thishotel["hotel_postalcode"];?>
								</address>
				
								<p>
									<?=$thismenu["ttelephone"];?> <?=$thishotel["hotel_tel"];?> <?=$thismenu["tfax"];?> <?=$thishotel["hotel_fax"];?><br>
									<?=$thismenu["temail"];?> <a href="mailto:#"><?=$thishotel["hotel_email"];?></a>
								</p>
							</div>
						</div>
<?PHP 
$sql  = "SELECT COUNT(id) AS total FROM hotel_partner WHERE hotel_sec = '".$thishotel["hotel_sec"]."' AND partner_status = 'ON' ";
$query = mysql_query($sql);
$countrow = mysql_fetch_array($query);
if($countrow["total"] > '0'){?>						
						<div class="col-md-4 col-sm-6" style="<?=$padding_footer;?>">
							<div class="widget"  style="padding-bottom:0px;margin-bottom:0px;padding-top:0px;margin-top:0px;">
								<h2 class="mg-widget-title" style="margin-bottom:4px;"><?=$thismenu["tpartner"];?></h2>
								<p style="margin-bottom:10px;">
								<?PHP 
$sql  = "SELECT *  FROM hotel_partner WHERE hotel_sec = '".$thishotel["hotel_sec"]."' AND partner_status = 'ON' ";
$query = mysql_query($sql);
$i=0;
while ($row = mysql_fetch_array($query)) {?>
								<div><a href="<?=$row["partner_link"];?>" target="blank"><i class="fa fa-globe"></i>&nbsp;&nbsp;<?=$row["partner_name"];?></a></div>
								<?PHP }?>

								</p>
								
							</div>
						</div>
<?PHP }?>
						<div class="col-md-4 col-sm-6 hidden-md hidden-lg" style="<?=$padding_footer;?>">
							<div class="widget"  style="padding-bottom:0px;margin-bottom:0px;padding-top:0px;margin-top:0px;">
								<h2 class="mg-widget-title" style="margin-bottom:4px;"><?=$thismenu["tsocial"];?></h2>
								<p style="margin-bottom:10px;"><?=$thismenu["tsocial_text"];?></p>
								<ul class="mg-footer-social">
<?PHP
$sql  = "SELECT * FROM hotel_social WHERE hotel_sec = '".$thishotel["hotel_sec"]."' AND social_status = 'YES' ";
$resault = mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error());
while ($allsocial = mysql_fetch_array($resault)) {?>
									<li><a href="<?=$allsocial["social_link"];?>" target="blank"><i class="<?=$allsocial["social_icon"];?>"></i></a></li>
<?PHP }?>
								</ul>
							</div>
						</div>

						<div class="col-md-4 col-sm-6" style="<?=$padding_footer;?>">
							<div class="widget"  style="padding-bottom:0px;margin-bottom:0px;padding-top:0px;margin-top:0px;">
								<h2 class="mg-widget-title" style="margin-bottom:4px;"><?=$thismenu["tcareers"];?></h2>
								<p style="margin-bottom:10px;"><?=$thismenu["tcareer_text"];?> <?=$thishotel["career_email"];?>
								or <a onClick="Menu('career.php?hotel_sec=<?=$thishotel["hotel_sec"];?>&language_id=<?=$language_id;?>&ID=<?=$ID;?>');" style="cursor:pointer;"><b>Click here to Apply Now</b></a></p>
								
							</div>
						</div>


					</div>
				</div>
			</div>
			<div class="mg-copyright" style="background:<?=$thishotel["bg_color"]?>;">
				<div class="container">
					<div class="row">
						
						<div class="col-md-7 hidden-xs">
							<ul class="mg-footer-nav">
								<li><a href="#" onClick="Menu('home.php?hotel_sec=<?=$thishotel["hotel_sec"];?>&language_id=<?=$language_id;?>&ID=<?=$ID;?>');"><?=$thishotel["home"];?></a></li>
								<li><a href="#" onClick="Menu('facilities.php?hotel_sec=<?=$thishotel["hotel_sec"];?>&language_id=<?=$language_id;?>&ID=<?=$ID;?>');"><?=$thishotel["facilities"];?></a></li>
								<li><a href="#" onClick="Menu('rooms.php?hotel_sec=<?=$thishotel["hotel_sec"];?>&language_id=<?=$language_id;?>&ID=<?=$ID;?>');"><?=$thishotel["menu_room"];?></a></li>
								<li><a href="#" onClick="Menu('dining.php?hotel_sec=<?=$thishotel["hotel_sec"];?>&language_id=<?=$language_id;?>&ID=<?=$ID;?>');"><?=$thishotel["dining"];?></a></li>
								<li><a href="#" onClick="Menu('contact-us.php?hotel_sec=<?=$thishotel["hotel_sec"];?>&language_id=<?=$language_id;?>&ID=<?=$ID;?>');"><?=$thishotel["contact"];?></a></li>
								
								<li><a href="#" onClick="Menu('media.php?hotel_sec=<?=$thishotel["hotel_sec"];?>&language_id=<?=$language_id;?>&ID=<?=$ID;?>');">Media Download</a></li>
								<li><a href="#" onClick="Menu('career.php?hotel_sec=<?=$thishotel["hotel_sec"];?>&language_id=<?=$language_id;?>&ID=<?=$ID;?>');"><?=$thishotel["career"];?><?=$thismenu["tcareers"];?></a></li>
							</ul>
						</div>
						<div class="col-md-5" style="<?=$padding_footer;?><?=$align;?>color:#fff;">
							&copy; 2015 <a href="<?=$thishotel["hotel_website"];?>"><?=$thishotel["hotel_name"];?></a>. All rights reserved.
						</div>

					</div>
				</div>
			</div>

		</footer>
