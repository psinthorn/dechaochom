<?php
require_once("site.configs.php");
$thishotel  = $hotel->getHotel($hotel_sec);
$thiscomp   = $company->getCompany($thishotel["hotel_chain_id"]);
require_once 'Mobile_Detect.php';
$detect = new Mobile_Detect;
$deviceType = ($detect->isMobile() ? ($detect->isTablet() ? 'tablet' : 'phone') : 'computer');
$scriptVersion = $detect->getScriptVersion();
if($deviceType == 'phone'){
$margin_left = "margin-left:0px;";
$padding = "padding:0px;";
}
else {
$margin_left = "";
$padding = "";
}

$skin_color = "green";
?>


            <form role="form" id="form_sendemail" class="clearfix">

              <div class="mg-contact-form-input">
                <label for="full-name"><?=$thismenu["full_name"];?></label>
                <input type="text" name="name" class="form-control" id="name" placeholder="..." data-original-title="" title="">
              </div>
              <div class="mg-contact-form-input">
                <label for="email"><?=$thismenu["email"];?></label>
                <input type="email" name="email" class="form-control" id="email" placeholder="..." data-original-title="" title="">
              </div>
              <div class="mg-contact-form-input">
                <label for="tel"><?=$thismenu["ttelephone"];?></label>
                <input type="text" name="tel" class="form-control" id="tel" placeholder="..." data-original-title="" title="">
              </div>
              <div class="mg-contact-form-input">
                <label for="subject"><?=$thismenu["subject"];?></label>
                <input type="text" name="subject" class="form-control" id="subject" placeholder="..." data-original-title="" title="">
              </div>
              <div class="mg-contact-form-input">
                <label for="subject"><?=$thismenu["message"];?></label>
                <textarea name="message" class="form-control" rows="3" id="message" placeholder="<?=$thismenu["please_write"];?>"></textarea>
              </div>
              <!-- reCAPTCHA -->
              <div class="form-group" id="form-captcha">
                
                <div class="g-recaptcha" data-sitekey="6LcIbgoTAAAAAIUJV3E6Qf5gMHM2hDk8d9DKmlpU"></div>
                <span class="help-block"></span>
              </div>
              <input type="hidden" name="language_id" id="language_id" value="<?=$language_id;?>">
              <input type="hidden" name="hotel_sec" id="hotel_sec" value="<?=$hotel_sec;?>">
              <!-- /reCAPTCHA -->
              <button type="submit" class="btn btn-dark-main btn-sm pull-right"><?=$thismenu["send_message"];?></button>
            </form>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src='https://www.google.com/recaptcha/api.js'></script>
    <script src="js/contact.js"></script> 
            