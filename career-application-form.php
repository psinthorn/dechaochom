
<?PHP
require_once("site.configs.php");
$thishotel  = $hotel->getHotel($hotel_sec);
$thiscomp   = $company->getCompany($thishotel["hotel_chain_id"]);

require_once 'Mobile_Detect.php';
$detect = new Mobile_Detect;
$deviceType = ($detect->isMobile() ? ($detect->isTablet() ? 'tablet' : 'phone') : 'computer');
$scriptVersion = $detect->getScriptVersion();

if($deviceType == 'phone'){
$padding = "padding:0px;";
}
else {
$padding = "";	
}

if($thishotel["skin_color"] == ''){
  $skin_color = 'orange';
}
else {
  $skin_color = $thishotel["skin_color"];
}

?>


		<form role="form" id="form_careers" class="clearfix">			

			<h4 class="mg-avl-room-title" style="margin-left:15px;">Application Data</h4>
					<hr style="margin:10px;">
			<div class="row">
				<div class="col-md-12">

					<div class="col-md-6">
					<label>Position</label>
					<input type="text" name="position" class="form-control input-sm" id="position" placeholder="..." data-original-title="" title="">
					</div>

					<div class="col-md-3">
					<label>Expected Salary</label>
					<input type="text" name="salary" class="form-control input-sm" id="salary" placeholder="..." data-original-title="" title="">
					</div>

					<div class="col-md-3">
					<label>Available Date</label>
					<input type="text" name="available_date" class="form-control input-sm" id="available_date" placeholder="..." data-original-title="" title="">
					</div>

				</div>
			</div>

			<h4 class="mg-avl-room-title" style="margin-left:15px;">Personal Profile</h4>
					<hr style="margin:10px;">
			<div class="row">
				<div class="col-md-12">
					
					<div class="col-md-3">
					<label><?=$thismenu["full_name"];?></label>
					<input type="text" name="full_name" class="form-control input-sm" id="full_name" placeholder="..." data-original-title="" title="">
					</div>

					<div class="col-md-3">
					<label>Date of Birth</label>
					<input type="text" name="birthday" class="form-control input-sm" id="birthday" placeholder="..." data-original-title="" title="">
					</div>

					<div class="col-md-3">
					<label>Gender</label>
					<select name="gender" class="form-control chzn-select" data-required="true" style="margin-bottom:0px;height:36px;">
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
					</select>
					</div>

					<div class="col-md-3">
					<label>Marital Status</label>
					<select name="marital_status" class="form-control chzn-select" data-required="true" style="margin-bottom:0px;height:36px;">
                        <option value="Single" id ="men">Single</option>
                        <option value="Married" id ="women">Married</option>
					</select>
					</div>

				</div>
			</div>

			<div class="row">
				<div class="col-md-12">
					
					<div class="col-md-3">
					<label><?=$thismenu["nationality"];?></label>
					<select class="form-control chzn-select" name="national" data-required="true" style="margin-bottom:0px;height:36px;">
<?PHP 
$sql  = "SELECT * FROM languages ORDER BY Name";
$query = mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error());
while ($allnational = mysql_fetch_array($query)) {
	if($allnational["Name"] == 'Thai'){
	echo "<option value=\"Thai\" selected=\"selected\">Thai</option>";
	}
	else {
	echo "<option value=\"".$allnational["Name"]."\">".$allnational["Name"]."</option>";
	}	
}

?>
					</select>
					</div>

					<div class="col-md-6">
					<label><?=$thismenu["address"];?></label>
					<input type="text" name="address" class="form-control input-sm" id="address" placeholder="..." data-original-title="" title="">
					</div>

					<div class="col-md-3">
					<label><?=$thismenu["tcity"];?>/<?=$thismenu["tprovince"];?></label>
					<input type="text" name="province" class="form-control input-sm" id="province" placeholder="..." data-original-title="" title="">
					</div>

				</div>
			</div>

			<div class="row">
				<div class="col-md-12">

					<div class="col-md-3">
					<label><?=$thismenu["country"];?></label>
					<select class="form-control chzn-select" name="country" data-required="true" style="margin-bottom:0px;height:36px;">
<?PHP 
$sql  = "SELECT * FROM country ORDER BY COUNTRY_NAME";
$fquery = mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error());
while ($frow = mysql_fetch_array($fquery)) {
	if($frow["COUNTRY_NAME"] == 'Thailand'){
	echo "<option value=\"Thailand\" selected=\"selected\">Thailand</option>";
	}
	else {
	echo "<option value=\"".$frow["COUNTRY_NAME"]."\">".$frow["COUNTRY_NAME"]."</option>";
	}	
}

?>
					</select>
					</div>

					<div class="col-md-3">
					<label><?=$thismenu["tpostalcode"];?></label>
					<input type="text" name="zipcode" class="form-control input-sm" id="zipcode" placeholder="..." data-original-title="" title="">
					</div>

					<div class="col-md-3">
					<label><?=$thismenu["ttelephone"];?></label>
					<input type="text" name="telephone" class="form-control input-sm" id="telephone" placeholder="..." data-original-title="" title="">
					</div>

					<div class="col-md-3">
					<label><?=$thismenu["email"];?></label>
					<input type="text" name="email" class="form-control input-sm" id="email" placeholder="..." data-original-title="" title="">
					</div>

				</div>
			</div>

					

			<div class="row">
				<div class="col-md-12">
					<h4 class="mg-avl-room-title" style="margin-left:15px;">Education Background</h4>
					<hr style="margin:10px;">
				</div>
				<div class="col-md-12">
					<div class="col-md-3">
					<label>Month/Year</label>
					<input type="text" name="year_study" class="form-control input-sm" id="year_study" placeholder="..." data-original-title="" title="">
					</div>

					<div class="col-md-3">
					<label>Degree Received</label>
					<input type="text" name="degree" class="form-control input-sm" id="degree" placeholder="..." data-original-title="" title="">
					</div>

					<div class="col-md-3">
					<label>Major</label>
					<input type="text" name="major" class="form-control input-sm" id="major" placeholder="..." data-original-title="" title="">
					</div>

					<div class="col-md-3">
					<label>GPA</label>
					<input type="text" name="gpa" class="form-control input-sm" id="gpa" placeholder="..." data-original-title="" title="">
					</div>

				</div>
			</div>

			<div class="row">
				<div class="col-md-12">
					
					<div class="col-md-3">
					<label>Institution Name</label>
					<input type="text" name="school" class="form-control input-sm" id="school" placeholder="..." data-original-title="" title="">
					</div>

					<div class="col-md-3">
					<label><?=$thismenu["tcity"];?></label>
					<input type="text" name="school_city" class="form-control input-sm" id="school_city" placeholder="..." data-original-title="" title="">
					</div>

					<div class="col-md-3">
					<label><?=$thismenu["tprovince"];?></label>
					<input type="text" name="school_province" class="form-control input-sm" id="school_province" placeholder="..." data-original-title="" title="">
					</div>

					<div class="col-md-3">
					<label><?=$thismenu["country"];?></label>
					<select class="form-control chzn-select" name="school_country" data-required="true" style="margin-bottom:0px;height:36px;">
<?PHP 
$sql  = "SELECT * FROM country ORDER BY COUNTRY_NAME";
$fquery = mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error());
while ($frow = mysql_fetch_array($fquery)) {
	if($frow["COUNTRY_NAME"] == 'Thailand'){
	echo "<option value=\"Thailand\" selected=\"selected\">Thailand</option>";
	}
	else {
	echo "<option value=\"".$frow["COUNTRY_NAME"]."\">".$frow["COUNTRY_NAME"]."</option>";
	}	
}

?>
					</select>
					</div>

				</div>
			</div>

			<!-- Please carefully read the README.txt file in order to setup
                 the PHP contact form properly -->
				<input type="hidden" name="language_id" id="language_id" value="<?=$language_id;?>">
				<input type="hidden" name="hotel_sec" id="hotel_sec" value="<?=$hotel_sec;?>">
							
							<!-- reCAPTCHA -->
              <div class="form-group" id="form-captcha" align="center">               
                <div class="g-recaptcha" data-sitekey="6LcIbgoTAAAAAIUJV3E6Qf5gMHM2hDk8d9DKmlpU" style="width:100%;"></div>
                <span class="help-block"></span>
              </div>
              <!-- /reCAPTCHA -->

			<div class="row" style="margin:0px;">
				<div class="col-md-12" align="center">
				<button type="submit" class="btn btn-dark-main btn-sm"><?=$thismenu["send_message"];?></button>
				</div>
			</div>
		</form>
		<!-- Alert message -->
		<div class="row" style="margin:0px;">
			<div class="col-md-12" align="center">
    			<div class="alert" id="form_message" role="alert" style="padding:5px;bottom:0px;width:100%;"></div>
    		</div>
    	</div>	
						
    <script src='https://www.google.com/recaptcha/api.js'></script>
    <script src="js/careers.js"></script>
		