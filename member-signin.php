<?PHP
require_once("iclass/sys.configs.php");
require_once("iclass/class.dbconn.php");
require_once("iclass/class.member.php");
require_once("iclass/class.hotel.php");
require_once("iclass/class.company.php");

$member = new Member();
$dbConn   = new DbConn($config);
$hotel    = new Hotel();
$company  = new company();

$hotel_sec = $_REQUEST["hotel_sec"];
$language_id = $_REQUEST["language_id"];
$thishotel  = $hotel->getHotel($hotel_sec);

if($_REQUEST["member_type"] == 'FB'){
  $sql = "select * from member_guest WHERE email = '".$_REQUEST["email"]."' ";
  $resultcheck = mysql_query($sql)or die(mysql_error());
  $checkmember = mysql_fetch_array($resultcheck);
  $welcomemessage = "Thank you for your sign in on facebook";
    if($checkmember["ID"] > '0'){
      $ID = $checkmember["ID"];
      $thismember = $member->getMemberID($ID); 
    }
    else {
    $ref = md5(uniqid(rand()));
    $guest_ref = strtoupper($ref);
    $args["reference"] = $guest_ref;
    $args["member_type"] = $_REQUEST["member_type"];
    $args["FIRSTNAME"] = $_REQUEST["FIRSTNAME"];
    $args["LASTNAME"] = $_REQUEST["LASTNAME"];
    $args["email"] = $_REQUEST["email"];
    $args["pms_member_no"] = $_REQUEST["ID"];
    $args["hotel_sec"] = $_REQUEST["hotel_sec"];
    $ID = $member->insertMemberGuest($args);
    $thismember = $member->getMemberID($ID); 
    $welcomemessage = "Thank you for your sign in on facebook";
    }
echo $ID;
}

if ($_REQUEST["actions"] == "Login") {
  $password = $_POST['loginpassword'];
  $sql = "select * from member_guest WHERE email = '".$_POST['loginemail']."' AND password = PASSWORD('".$password."') AND STATUS = 'CONFIRM'  ";
  $resultcheck = mysql_query($sql)or die(mysql_error());
  $checkmember = mysql_fetch_array($resultcheck);
  $ID = $checkmember["ID"];
echo $ID;
  //echo $password;
}

if($_REQUEST["actions"] == 'ResetPassword'){
$hotel_sec = $_POST["hotel_sec"];
$EMAIL = $_POST["email_account"];
$sql  = "SELECT * FROM member_guest  WHERE email = '".$EMAIL."' ";
$query = mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error()); 
$thismember = mysql_fetch_array($query);
$ID = $thismember["ID"];

if($ID > '0'){
$hotel_sec = $thismember["hotel_sec"];
$thishotel  = $hotel->getHotel($hotel_sec);
$thisproject = $member->getMemberProject($hotel_sec);
$thiscomp = $company->getCompany($thishotel["hotel_chain_id"]);
$sql  = "SELECT *, hotel_language.ISO639_1, hotel_language.Name, hotel_language.NativeName  FROM hotel_language LEFT JOIN icontrol_language ON hotel_language.hotel_sec = icontrol_language.hotel_sec AND hotel_language.ID = icontrol_language.ID WHERE hotel_language.hotel_sec = '".$thishotel["hotel_sec"]."' AND hotel_language.ID = '".$language_id."' ";
$query = mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error());
$thismenu = mysql_fetch_array($query);

$ranpassword  = rand(0, 9999999); 
$member->ResetMemberPassword($ID, $ranpassword );


$text = "font-size: 12px; font-family: Arial, Helvetica, sans-serif; color:#444;";
$from = "".$thishotel["hotel_email"]."";
$to = "".$thismember["email"]."";
$subject = "".$thisproject["project_name"]." Reset Password";
$mailheaders  .= "From: ".$thishotel["hotel_email"]."\r\n";
$mailheaders .= "Content-type: text/html; charset=UTF-8\r\n";

$guestmailheaders  .= "From: ".$thishotel["hotel_email"]."\r\n";
$guestmailheaders .= "Content-type: text/html; charset=UTF-8\r\n";
//

$logo = "<img src=\"".$thiscomp["engine_path"]."/img-server/hotels/".$thishotel["hotel_sec"]."/logo/".$thishotel["logo"]."\" border=\"0\" width=\"140\" style=\"max-height:100px;max-width:180px;\">";    


$body .= "
<meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no,minimal-ui\">
<div style=\"width: 100%;background:#ffffff;padding:12px;\" align=\"center\">

<div align=\"center\" style=\"padding:0px;\"> 
<div style=\"padding:20px;width:640px;background:#e5e9ec;border:1px solid #dddddd;\"> 
<table width=\"620px\" border=\"0\" cellspacing=\"0\" cellpadding=\"0\">  
  <tbody>
    <tr>
      <td>  
        <table bgcolor=\"#84CCC5\" align=\"center\" width=\"100%\" style=\"height:5px;\">
          <tbody><tr><td></td></tr></tbody>
        </table>
      </td> 
    </tr>
    <tr>
      <td>  
        <table bgcolor=\"#fafafa\" align=\"center\" width=\"100%\" style=\"border-bottom: 1px solid #eee;\">
          <tbody>
            <tr>
              <td>
                <table width=\"98%\" style=\"padding:10px 0;\">
                  <tbody>
                    <tr>
                      <td align=\"left\" valign=\"top\" style=\"font:Bold 11px Arial, Helvetica, sans-serif; padding-left:5px;\">
                        <a href=\"".$thishotel["website"]."\" style=\"color:#84CCC5;text-decoration:none;\">".$thisproject["project_name"]."</a>
                      </td>
                      <td align=\"right\" valign=\"top\" style=\"font:Bold 11px Arial, Helvetica, sans-serif;\">
                        
                      </td>
                    </tr>
                  </tbody>
                </table>
              </td>
            </tr>
          </tbody>
        </table>
      </td> 
    </tr>
    <tr>
      <td>  
        <table bgcolor=\"#ffffff\" align=\"center\" width=\"100%\" style=\"border-bottom: 1px solid #eee; padding:15px 0;\">
          <tbody>
            <tr>
              <td>
                <table bgcolor=\"#ffffff\" align=\"left\" width=\"100%\">
                  <tbody>
                    <tr>
                      <td align=\"left\" valign=\"top\">
                        <table width=\"100%\" border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\" style=\"padding:0px 10px;0px 10px;\">
                          <tbody>
                            <tr>
                              <td width=\"20%\" align=\"left\" valign=\"top\">
                                ".$logo."
                              </td>
                              <td valign=\"middle\" style=\"font:20px Arial, Helvetica, sans-serif; color:#84CCC5; padding-left:6px;padding:0 20px 0px;\">
                                <a href=\"#\" style=\"color:#84CCC5;text-decoration:none;\">".$thishotel["hotel_name"]."</a><br>
                                <font style=\"font:12px Arial, Helvetica, sans-serif;color:#999999;\">".$thishotel["hotel_city"]." ".$thishotel["hotel_province"]." ".$thishotel["hotel_country"]."</font>
                              </td>
                            </tr>
                          </tbody>
                        </table>
                      </td>
                      </tr>
                  </tbody>
                </table>
                
              </td>
            </tr>
          </tbody>
        </table>
      </td> 
    </tr>
    <tr>
      <td>  
        <table bgcolor=\"#ffffff\" align=\"center\" width=\"100%\" style=\"border-spacing: 0;color:#999;border-bottom: 1px solid #eee;\">
          <tbody>
            <tr style=\"height:20px;\"><td></td></tr>
            <tr align=\"left\">
              <td style=\"font:16px Arial, Helvetica, sans-serif;padding:0 50px 0px;color:#444;\">".$thismenu["dear"]." ".$thismember["TITLE"]." ".$thismember["FIRSTNAME"]." ".$thismember["LASTNAME"]."</td>
            </tr>
            <tr style=\"height:15px;\"><td></td></tr>
            <tr style=\"padding-top: 10px;\">
              <td style=\"font:14px Arial, Helvetica, sans-serif; padding:0 50px 20px;color:#444;\">
                ".$thisproject["project_name"]." password has been reset on your request<br><br>
                <b>Login name : ".$thismember["email"]."<br>New password : ".$ranpassword."</b>
              </td>
            </tr>
            <tr style=\"height:40px;\"><td></td></tr>
          </tbody>
        </table>
      </td>
    </tr>
    <tr align=\"center\">
      <td>  
        <table bgcolor=\"#fafafa\" align=\"center\" width=\"100%\" style=\"padding:15px 0; border-bottom: 1px solid #eee;\">
          <tbody>
            <tr style=\"padding-top: 10px;\">
              <td style=\"font:12px Arial, Helvetica, sans-serif; padding:0 50px 0px;color:#444;\">
                Member name : ".$thismember["TITLE"]." ".$thismember["FIRSTNAME"]." ".$thismember["LASTNAME"]."<br>Member Email : ".$thismember["email"]."<br>IP Address : ".$_SERVER['REMOTE_ADDR']."
              </td>
            </tr>
          </tbody>
        </table>
      </td>
    </tr>";
    //Footer
$body .="<tr>
      <td>
        <table align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"100%\">
          <tbody>
            <tr>
              <td bgcolor=\"#84CCC5\" align=\"center\">
                <table cellspacing=\"0\" cellpadding=\"10\" border=\"0\"width=\"98%\">
                  <tbody>
                    <tr>
                      <td>
                        <table cellspacing=\"0\" cellpadding=\"0\" border=\"0\">
                          <tbody>
                            <tr>
                              <td style=\"color:#444;font-size:14px;\">Contact info</td>        
                            </tr>
                            <tr>
                              <td style=\"color:#444;font-size:11px;\">".$thishotel["hotel_address"]."<br>".$thishotel["hotel_city"]." ".$thishotel["hotel_province"]." ".$thishotel["hotel_country"]." ".$thishotel["hotel_postalcode"]."<br>".$thismenu["ttelephone"]." : ".$thishotel["hotel_tel"]." ".$thismenu["tfax"]." : ".$thishotel["hotel_fax"]."<br>".$thismenu["email"]." : ".$thishotel["hotel_email"]."</td>              
                            </tr>
                          </tbody>
                        </table>
                      </td>
                      <td align=\"right\">
                        <table cellspacing=\"0\" cellpadding=\"0\" border=\"0\">
                          <tbody>
                            <tr>";
$i = 0;
while ($allsocial[$i]["id"]){
if($allsocial[$i]["show"] == 'YES'){  
$body .="<td align=\"right\"><a href=".$allsocial[$i]["social_link"]."\" target=\"_blank\" data-toggle=\"tooltip\" data-original-title=\"".$allsocial[$i]["social_name"]."\"><img src=\"".$thiscomp["engine_path"]."/img-server/hotels/".$thishotel["hotel_sec"]."/social/icon/".$allsocial[$i]["social_code"].".png\" style=\"width:32px;padding:1px;\"></a></td>";
}
$i++;}
$body .="                       </tr>
                          </tbody>
                        </table>
                      </td>
                    </tr>
                  </tbody>
                </table>

              </td>
            </tr>
          </tbody>
        </table>
      </td>
    </tr>";
// end footer -->
$body .="</tbody>
</table>
</div>
</div>


</div>";
$bodys .= "<div align=\"left\" style=\"padding:0px;border:none;\">".$body."</div>";
$CC1 = "it@resotelgroup.com";
$CC2 = "edp@resotelgroup.com";
mail($CC1, $subject, stripslashes($bodys), $mailheaders);
mail($CC2, $subject, stripslashes($bodys), $mailheaders);
mail($to, $subject, stripslashes($bodys), $mailheaders);

//$guestbodys .= "<div align=\"left\" style=\"padding:0px;border:none;\">".$body."</div>";
//mail($from, $subject, stripslashes($guestbodys), $guestmailheaders);
}
echo $ID;
}
?>

