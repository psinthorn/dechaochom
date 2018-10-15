<?php
require_once("site.configs.php");

$arrival = explode("/", date("d/m/Y"));
          $sday = $arrival[0];
          $smonth = $arrival[1];
          $syear = $arrival[2];       
$mk_in = mktime(0,0,0, intval($smonth), intval($sday), intval($syear));
$mk_out = mktime(0,0,0, intval($smonth), intval($sday+1), intval($syear));
?>


<div id="FormAvailable" class="mg-book-now" style="position:relative;width:100%;background:url('images/bg_navy100.png');">
      <div class="container" style="<?=$padding_top;?><?=$padding_bottom;?>">
        <div class="row">
          <div class="col-md-3" style="padding-top:5px;">
            <h2 class="mg-bn-title" style="font-size:24px;"><?=$thismenu["online_reservation"];?> <span class="mg-bn-big hidden-xs"><?=str_replace('and', '&', $thismenu["availability_check"]);?></span></h2>
          </div>
          <div class="col-md-9" style="padding-top:0px;padding-bottom:0px;">
            <div class="mg-bn-forms" style="padding-top:0px;padding-bottom:0px;margin-top:0px;">
              <form class="no-margin" method="post" action="<?=$thishotel["engine_path"];?>">
                <div class="row" style="margin:0px;">
                  <div class="col-md-3" style="padding-top:0px;padding-bottom:0px;">
                    <div style="color:#fff;"><?=$thismenu["arrival_date"];?></div>
                    <div class="input-group date mg-check-in">
                      <div class="input-group-addon" style="background:url('images/bg_black30.png');"><i class="fa fa-calendar"></i></div>
                      <input type="text" class="form-control" id="arrival_date" name="arrival_date" value="<?=date("d/m/Y", $mk_in);?>" readonly style="cursor:pointer;background:url('images/bg_black30.png');">
                    </div>
                  </div>
                  <div class="col-md-3" style="padding-top:0px;padding-bottom:0px;">
                    <div style="color:#fff;"><?=$thismenu["departure_date"];?></div>
                    <div class="input-group date mg-check-out">
                      <div class="input-group-addon" style="background:url('images/bg_black30.png');"><i class="fa fa-calendar"></i></div>
                      <input type="text" class="form-control" id="departure_date" name="departure_date" placeholder="<?=$thismenu["departure_date"];?>" value="<?=date("d/m/Y", $mk_out);?>" readonly style="cursor:pointer;background:url('images/bg_black30.png');">
                    </div>
                  </div>
<?PHP
$sql  = "SELECT * FROM secret_deal WHERE hotel_sec = '".$thishotel["hotel_sec"]."' AND secret_deal_status = 'ON' AND secret_deal_name = 'Promotion Code' ";
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
                  <div class="col-md-3" style="padding-top:22px;padding-bottom:0px;">
                    <div class="input-group">
                      <div class="input-group-addon" style="background:url('images/bg_black30.png');"><i class="fp-ht-key"></i></div>
                      <input type="text" class="form-control" id="promotion_code" placeholder="Promotion code" style="background:url('images/bg_black30.png');" name="promotion_code">
                      <input type="hidden" id="secret_deal_id_promotion_code" name="secret_deal_id_promotion_code" value="<?=$thisdealpromotioncode["secret_deal_id"];?>">
                    </div>
                  </div>
<?PHP } }?>

                  <div class="col-md-3" style="padding-top:22px;padding-right:0px;">
                    <button type="submit" class="btn btn-main btn-block"><?=$thismenu["check_now"];?></button>
                  </div>
                </div>
                <input type="hidden" name="hotel_sec" value="<?=$thishotel["hotel_sec"];?>">
                <input type="hidden" name="language_id" value="<?=$_REQUEST["language_id"];?>">
                <input type="hidden" name="currency_id" value="<?=$_REQUEST["currency_id"];?>">
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>



<script type="text/javascript">
  var DivgetFixed = $('#mega-slider').height();

  function fixDiv() {
    var $cachetable = $('#FormAvailable');

    if ($(window).scrollTop() > DivgetFixed+110)
      $cachetable.css({
        'position': 'fixed',
        'top': '40px',
        'z-index': '100',
        'width': '100%',
        'background':'url("images/bg_navy95.png")',
        'animation-name': 'vertical-slide',
        'animation-duration': '1s'
      });
    
    else
      $cachetable.css({
        'position': 'relative',
        'top': 'auto',
        'width': '100%',
        'background':'url("images/bg_navy100.png")',
        'animation-name': 'vertical-slide-out',
        'animation-duration': '1s'
      });

  }
  $(window).scroll(fixDiv);
  fixDiv();



  function fixDivGuest() {
    var $cacheGuest = $('#returnguest');

    if ($(window).scrollTop() > DivgetFixed+75)
      $cacheGuest.css({
        'position': 'fixed',
        'top': '0px',
        'z-index': '101',
        'width': '100%'
        

      });
    
    else
      $cacheGuest.css({
        'position': 'relative',
        'top': 'auto',
        'width': '100%',
        'z-index': '101'
        
      });

  }
  $(window).scroll(fixDivGuest);
  fixDivGuest();

    function fixDivbodyhome() {
    var $cachebodyhome = $('#bodyhome');

    if ($(window).scrollTop() > DivgetFixed+110){
      $cachebodyhome.css({
        'padding-top': '180px'

      });
    }

    else if ($(window).scrollTop() > DivgetFixed+75){
      $cachebodyhome.css({
        'padding-top': '90px'

      });
    }
    
    else {
      $cachebodyhome.css({
        'padding-top': '40px'
      });
    }

    

  }
  $(window).scroll(fixDivbodyhome);
  fixDivbodyhome();
</script>

<style>
@keyframes vertical-slide {
  0% {
    top: -120px;
  }
  100% {
    top: 40px;
  }
}

@keyframes vertical-slide-out {
  0% {
    top: 130px;
  }
  100% {
    top: 0px;
  }
}
</style>





    <script src="js/owl.carousel.min.js"></script>
    <script src="js/bootstrap-datepicker.min.js"></script>
    <script src="js/starrr.min.js"></script>
    <script src="js/jquery.parallax-1.1.3.js"></script>
    <script src="js/script.js"></script>
