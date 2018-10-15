<?php
require_once 'config.php';

$json = array();
$email = isset( $_POST['email'] ) ? $_POST['email'] : '';
$tel = isset( $_POST['tel'] ) ? $_POST['tel'] : '';
$name = isset( $_POST['name'] ) ? $_POST['name'] : '';
$subject = isset( $_POST['subject'] ) ? $_POST['subject'] : '';
$message = isset( $_POST['message'] ) ? $_POST['message'] : '';


if( !$name ) {
    $json['error']['name'] = 'Please enter your full name.';
}
if( !$subject ) {
    $json['error']['subject'] = 'Please enter your subject.';
}
if( !$message ) {
    $json['error']['message'] = 'Please enter your message.';
}
if( !$email || !preg_match('/^[^\@]+@.*\.[a-z]{2,6}$/i', $email ) ) {
    $json['error']['email'] = 'Please enter your email address.';
}

// Checking reCaptcha
if ($_POST["g-recaptcha-response"]) {
	//
	$resp = file_get_contents( "https://www.google.com/recaptcha/api/siteverify?secret={$privatekey}&response={$_POST['g-recaptcha-response']}&remoteip={$_SERVER['REMOTE_ADDR']}" );
	$resp = json_decode( $resp );
	// Если капча не прошла проверку
	if( $resp->success == false ) {
		$json['error']['recaptcha'] = 'Incorrect code. Please try again.';
	}
	
//
} else {
    $json['error']['recaptcha'] = 'Please enter the text from reCaptcha.';
}


// If no errors
if( !isset( $json['error'] ) ) {

$number = rand(6, 1000000); 
$args["message_id"] = $number;
$args["contact_to"] = $thishotel["hotel_email"];
$args["contact_name"] = $name;
$args["contact_email"] = $email;
$args["contact_tel"] = $tel;
$args["subject"] = "Contact Message ID ".$number."";
$args["message"] = $message;
$args["hotel_sec"] = $thishotel["hotel_sec"];
$contact_id = $guest->insertContactMessage($args);
$thismessage = $guest->GetMessage($contact_id);
$senddate = explode("-", $thismessage["date"]);
                    $sendday = $senddate[2];
                    $sendmonth = $senddate[1];
                    $sendyear = $senddate[0];       
$send_date = mktime(0,0,0, intval($sendmonth), intval($sendday), intval($sendyear));

$ip = $_SERVER['REMOTE_ADDR']; // the IP address to query
$lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
$div_desc = htmlentities($_SERVER['HTTP_USER_AGENT']);
$query = @unserialize(file_get_contents('http://ip-api.com/php/'.$ip));
if($query && $query['status'] == 'success') {
$check_ip_rsvn .= '<b>'.$query['country'].', '.$query['city'].'!</b>';
} else {
$check_ip_rsvn .= '<b>Unable to get location</b>';
}
$useragent = $_SERVER['REMOTE_ADDR'];


    // Email text
    $mail_message .= "<table style=\"color:#1D2F43;font-size:14px;font-family: 'Open Sans';font-size: 14px;\">
                        <tr>
                        <td colspan=\"2\" style=\"font-size:16px;color:#F26531;font-family:Playfair Display, serif;
  text-transform: uppercase;\"><b>".$thismenu["tmessage_id"]." ".$number."</b></td>
                        </tr>
                        <tr>
                        <td style=\"padding:5px;\"><b>".$thismenu["full_name"].":</b></td><td style=\"padding:5px;\">".$name."</td>
                        </tr>
                        <tr>
                        <td style=\"padding:5px;\"><b>".$thismenu["email"].":</b></td><td style=\"padding:5px;\">".$email."</td>
                        </tr>
                        <tr>
                        <td style=\"padding:5px;\"><b>".$thismenu["ttelephone"].":</b></td><td style=\"padding:5px;\">".$tel."</td>
                        </tr>
                        <tr>
                        <td colspan=\"2\" style=\"padding:5px;\"><b>".$subject."</b><br>".$message."</td>
                        </tr>
                        </table>";

$bodys .= "
<link href=\"".$thishotel["website"]."/css/bootstrap/bootstrap.min.css\" rel=\"stylesheet\">
<link href=\"".$thishotel["website"]."/fonts/font-awesome/css/font-awesome.min.css\" rel=\"stylesheet\">
<link href=\"".$thishotel["website"]."/css/styles.css\" rel=\"stylesheet\">";

$bodys .= "<html><body><div style=\"padding:10px;\" align=\"center\"><table style=\"width:700px;max-width:700px;\"><tr><td style=\"border:1px solid #ddd;\">";

$bodys .="      <div style=\"width: 100%;padding:0px;background:#fff;\">
                <table style=\"width:100%; font-size:13px;color:#949DA6;padding:0px;\"><tr>
                <td style=\"padding:0px;\">
                <table style=\"width:100%; font-size:13px;color:#949DA6;font-family: Arial, Helvetica, sans-serif;
    font-style: normal ;\"><tr>
                <td style=\"padding:15px;\"><img src=\"".$thiscomp["engine_path"]."/img-server/hotels/".$thishotel["hotel_sec"]."/logo/".$thishotel["logo"]."\" style=\"height:60px;width:auto;\"></td>
                <td style=\"padding:15px;color:#949DA6;\" align=\"right\">
                <div><b>".$thishotel["hotel_name"]."</b></div>
                <div>".$thismenu["ttelephone"]." ".$thishotel["hotel_tel"]."</div>
                <div>".$thismenu["tfax"]." ".$thishotel["hotel_fax"]."</div>
                <div>".$thismenu["email"]." ".$thishotel["hotel_email"]."</div>
                <div>".$thismenu["thomepage"]." ".$thishotel["website"]."</div>
                </td>
                </tr>
                </table>
                </td>
                </tr>

                <tr>
                <td style=\"height:5px;background-color:#F26531;padding:0px;\"></td>
                </tr>

                <tr>
                <td style=\"padding:0px;\">
                <table style=\"width:100%;margin:0px;\"><tr>
                <td style=\"padding:15px;background-color:#f2f2f2;color:#1D2F43;font-size:14px;font-family: 'Open Sans';;\">
                <b>".$thismenu["dear"]." ".$thishotel["hotel_name"]."</b><br>
                ".$thismenu["tplease_retain"]."<br><br>
                ".$thismenu["best_regards"].",<br>
                <b>".$thiscomp["comp_name"]."</b>
                </td>
                </tr></table>
                </td>
                </tr>
                <tr>
                <td style=\"padding:15px;border-top:1px solid #ddd;\">
                    ".$mail_message."
                </td>
                </tr>
                <tr>
                <td style=\"padding:0px;\">
                <table style=\"width:100%;\"><tr>
                <td style=\"padding:15px;background-color:#f2f2f2;color:#F26531;font-size:15px;\"align=\"center\">
                    <b>Visit from ".$useragent." ".$check_ip_rsvn."</b>
                </td>
                </tr></table>
                </td>
                </tr>
                </table>
                </div>";

$bodys .= "</td></tr></table></div></body></html>";

//Guest
$bodys_cust .= "
<link href=\"".$thishotel["website"]."/css/bootstrap/bootstrap.min.css\" rel=\"stylesheet\">
<link href=\"".$thishotel["website"]."/fonts/font-awesome/css/font-awesome.min.css\" rel=\"stylesheet\">
<link href=\"".$thishotel["website"]."/css/styles.css\" rel=\"stylesheet\">";

$bodys_cust .= "<html><body><div style=\"padding:10px;\" align=\"center\"><table style=\"width:700px;max-width:700px;\"><tr><td style=\"border:1px solid #ddd;\">";
$bodys_cust .="<div style=\"border:none; width: 100%;padding:0px;background:#fff;\">
                <table style=\"width:100%; font-size:13px;color:#949DA6;\"><tr>
                <td style=\"padding:0px;\">
                <table style=\"width:100%; font-size:13px;color:#949DA6;font-family: Arial, Helvetica, sans-serif;
    font-style: normal ;\"><tr>
                <td style=\"padding:15px;\"><img src=\"".$thiscomp["engine_path"]."/img-server/hotels/".$thishotel["hotel_sec"]."/logo/".$thishotel["logo"]."\" style=\"height:60px;width:auto;\"></td>
                <td style=\"padding:15px;color:#949DA6;\" align=\"right\">
                <div><b>".$thishotel["hotel_name"]."</b></div>
                <div><b>".$thismenu["ttelephone"]."</b> ".$thishotel["hotel_tel"]."</div>
                <div><b>".$thismenu["tfax"]."</b> ".$thishotel["hotel_fax"]."</div>
                <div><b>".$thismenu["email"]."</b> ".$thishotel["hotel_email"]."</div>
                <div><b>".$thismenu["thomepage"]."</b> ".$thishotel["website"]."</div>
                </td>
                </tr>
                </table>
                </td>
                </tr>

                <tr>
                <td style=\"height:5px;background-color:#F26531;padding:0px;\"></td>
                </tr>

                <tr>
                <td style=\"padding:0px;\">
                <table style=\"width:100%;\"><tr>
                <td style=\"padding:15px;background-color:#f2f2f2;color:#1D2F43;font-size:14px;font-family: 'Open Sans';\">
                <b>".$thismenu["dear"]." ".$name."</b><br>
                ".$thismenu["tthank_message"]."<br><br>
                ".$thismenu["best_regards"].",<br>
                <b>".$thishotel["hotel_name"]."</b>
                </td>
                </tr></table>
                </td>
                </tr>
                <tr>
                <td style=\"padding:15px;border-top:1px solid #ddd;\">
                    ".$mail_message."
                </td>
                </tr>
                </table>
                </div>
                ";



$bodys_cust .= "</td></tr></table></div></body></html>";

    // Email to guest
    $mail_headers_cust  = "Content-type: text/html; charset=UTF-8\r\n";
    $mail_headers_cust .= "From: " . $thishotel["hotel_email"] . "\r\n";
    $mail_subject_cust .= "".$args["subject"]."\r\n";

    // Email to property
    $mail_headers  = "Content-type: text/html; charset=UTF-8\r\n";
    $mail_headers .= "From: {$mail_sender}\r\n";
    $mail_subject .= "".$args["subject"]."\r\n";

    // Sending email
    mail( $to_email, $mail_subject, $bodys, $mail_headers );
    mail( $email, $mail_subject_cust, $bodys_cust, $mail_headers_cust );
    $json['success'] = 'Your message was sent successfully! We will concact you back with in 24 Hrs.';


}

echo json_encode( $json );
?>