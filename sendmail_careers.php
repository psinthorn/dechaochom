<?php
require_once 'config.php';

$json = array();
$position = isset( $_POST['position'] ) ? $_POST['position'] : '';
$salary = isset( $_POST['salary'] ) ? $_POST['salary'] : '';
$available_date = isset( $_POST['available_date'] ) ? $_POST['available_date'] : '';
$full_name = isset( $_POST['full_name'] ) ? $_POST['full_name'] : '';
$birthday = isset( $_POST['birthday'] ) ? $_POST['birthday'] : '';
$gender = isset( $_POST['gender'] ) ? $_POST['gender'] : '';
$address = isset( $_POST['address'] ) ? $_POST['address'] : '';
$province = isset( $_POST['province'] ) ? $_POST['province'] : '';
$telephone = isset( $_POST['telephone'] ) ? $_POST['telephone'] : '';
$email = isset( $_POST['email'] ) ? $_POST['email'] : '';



if( !$position ) {
    $json['error']['position'] = 'Please enter your position.';
}
if( !$salary ) {
    $json['error']['salary'] = 'Please enter your expected salry.';
}
if( !$available_date ) {
    $json['error']['available_date'] = 'Please enter your available date.';
}
if( !$full_name ) {
    $json['error']['full_name'] = 'Please enter your full name.';
}
if( !$birthday ) {
    $json['error']['birthday'] = 'Please enter your date of birth.';
}
if( !$address ) {
    $json['error']['address'] = 'Please enter your address.';
}
if( !$province ) {
    $json['error']['province'] = 'Please enter your city or province.';
}
if( !$telephone ) {
    $json['error']['telephone'] = 'Please enter your telephone.';
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
$birthday = explode("/", $_POST["birthday"]);
                    $day = $birthday[0];
                    $month = $birthday[1];
                    $year = $birthday[2];       
$birthday_date = mktime(0,0,0, intval($month), intval($day), intval($year));
$reference = rand(8, 1000000); 
$args["reference"] = $reference;
$args["position"] = $_POST["position"];
$args["salary"] = $_POST["salary"];
$args["available_date"] = $_POST["available_date"];
$args["full_name"] = $_POST["full_name"];
$args["birthday"] = date("Y-m-d", $birthday_date);
$args["gender"] = $_POST["gender"];
$args["marital_status"] = $_POST["marital_status"];
$args["national"] = $_POST["national"];
$args["address"] = $_POST["address"];
$args["province"] = $_POST["province"];
$args["country"] = $_POST["country"];
$args["zipcode"] = $_POST["zipcode"];
$args["telephone"] = $_POST["telephone"];
$args["email"] = $_POST["email"];
$args["year_study"] = $_POST["year_study"];
$args["degree"] = $_POST["degree"];
$args["major"] = $_POST["major"];
$args["gpa"] = $_POST["gpa"];
$args["school"] = $_POST["school"];
$args["school_city"] = $_POST["school_city"];
$args["school_province"] = $_POST["school_province"];
$args["school_country"] = $_POST["school_country"];
$args["hotel_sec"] = "".$thishotel["hotel_sec"]."";

$id = $guest->insertCareers($args);
//$thismessage = $guest->GetMessage($contact_id);


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
    $mail_message .= "<table style=\"color:#1D2F43;font-size:14px;font-family: 'Open Sans';font-size: 14px;width:100%;\">
                        <tr>
                        <td style=\"font-size:16px;color:#F26531;font-family:Playfair Display, serif;
  text-transform: uppercase;\"><b>Job Application Form</b></td>
                        </tr>
                        </table>

                        <table style=\"width:100%;\">
                        <tr>
                        <td style=\"font-size:16px;font-family: 'Open Sans';\"><b>Application Data</b></td>
                        </tr>
                        <tr>
                        <td>
                        <div style=\"border:1px solid #eee;padding:10px;\">                       
                        <table style=\"font-size:14px;width:100%;\">
                        <tr>
                        <td style=\"padding:5px;\"><b>Position:</b></td><td style=\"padding:5px;\">".$_POST['position']."</td>
                        <td style=\"padding:5px;\"><b>Expected Salary:</b></td><td style=\"padding:5px;\">".$_POST['salary']."</td>
                        <td style=\"padding:5px;\"><b>Available Date</b></td><td style=\"padding:5px;\">".$_POST['available_date']."</td>
                        </tr>
                        </table>
                        </div>
                        </td>
                        </tr></table>
                        
                        <div style=\"height:20px;\"></div>

                        <table style=\"width:100%;\">
                        <tr>
                        <td style=\"font-size:16px;font-family: 'Open Sans';\"><b>Personal Profile</b></td>
                        </tr>
                        <tr>
                        <td>
                        <div style=\"border:1px solid #eee;padding:10px;\">                       
                        <table style=\"font-size:14px;font-size: 14px;width:100%;\">
                        <tr>
                        <td style=\"padding:5px;width:25%;\"><b>Full name:</b></td><td style=\"padding:5px;width:25%;\">".$_POST['full_name']."</td>
                        <td style=\"padding:5px;width:25%;\"><b>Date of Birth:</b></td><td style=\"padding:5px;width:25%;\">".$_POST['birthday']."</td>
                        </tr>

                        <tr>
                        <td style=\"padding:5px;width:25%;\"><b>Gender</b></td><td style=\"padding:5px;width:25%;\">".$_POST['gender']."</td>
                        <td style=\"padding:5px;width:25%;\"><b>Marital Status</b></td><td style=\"padding:5px;width:25%;\">".$_POST['marital_status']."</td>
                        </tr>
                        <tr>
                        <td style=\"padding:5px;width:25%;\"><b>Nationality:</b></td><td style=\"padding:5px;width:25%;\">".$_POST['national']."</td>
                        <td style=\"padding:5px;width:25%;\"><b></b></td><td style=\"padding:5px;width:25%;\"></td>
                        </tr>

                        <tr>
                        <td style=\"padding:5px;width:25%;\"><b>Address:</b></td><td style=\"padding:5px;width:25%;\" colspan=\"3\">".$_POST['address']."</td>
                        </tr>
                        <tr>
                        <td style=\"padding:5px;width:25%;\"><b>Street/Province</b></td><td style=\"padding:5px;width:25%;\">".$_POST['province']."</td>
                        <td style=\"padding:5px;width:25%;\"><b>Country:</b></td><td style=\"padding:5px;width:25%;\">".$_POST['country']."</td>
                        </tr>
                        <tr>                        
                        <td style=\"padding:5px;width:25%;\"><b>Postalcode:</b></td><td style=\"padding:5px;width:25%;\">".$_POST['zipcode']."</td>
                        <td style=\"padding:5px;width:25%;\"><b>Telephone</b></td><td style=\"padding:5px;width:25%;\">".$_POST['telephone']."</td>
                        </tr>

                        <tr>                       
                        <td style=\"padding:5px;width:25%;\"><b>Email</b></td><td style=\"padding:5px;width:25%;\" colspan=\"3\">".$_POST['email']."</td>
                        </tr>
                        </table>
                        </div>
                        </td>
                        </tr></table>

                        <div style=\"height:20px;\"></div>

                        <table style=\"width:100%;\">
                        <tr>
                        <td style=\"font-size:16px;font-family: 'Open Sans';\"><b>Education Background</b></td>
                        </tr>
                        <tr>
                        <td>
                        <div style=\"border:1px solid #eee;padding:10px;\">                       
                        <table style=\"font-size:14px;width:100%;\">
                        <tr>
                        <td style=\"padding:5px;width:25%;\"><b>Year of Study:</b></td><td style=\"padding:5px;width:25%;\">".$_POST['year_study']."</td>
                        <td style=\"padding:5px;width:25%;\"><b>Degree Received:</b></td><td style=\"padding:5px;width:25%;\">".$_POST['degree']."</td>
                        </tr>
                        <tr>
                        <td style=\"padding:5px;width:25%;\"><b>Major:</b></td><td style=\"padding:5px;width:25%;\">".$_POST['major']."</td>
                        <td style=\"padding:5px;width:25%;\"><b>GPA:</b></td><td style=\"padding:5px;width:25%;\">".$_POST['gpa']."</td>
                        </tr>
                        <tr>
                        <td style=\"padding:5px;width:25%;\"><b>Institution Name:</b></td><td style=\"padding:5px;width:25%;\">".$_POST['school']."</td>
                        <td style=\"padding:5px;width:25%;\"><b>City:</b></td><td style=\"padding:5px;width:25%;\">".$_POST['school_city']."</td>
                        </tr>
                        <tr>
                        <td style=\"padding:5px;width:25%;\"><b>Province:</b></td><td style=\"padding:5px;width:25%;\">".$_POST['school_province']."</td>
                        <td style=\"padding:5px;width:25%;\"><b>Country:</b></td><td style=\"padding:5px;width:25%;\">".$_POST['school_country']."</td>
                        </tr>
                        </table>
                        </div>
                        </td>
                        </tr></table>




                        ";

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
                <div>".$thismenu["email"]." ".$thishotel["career_email"]."</div>
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
                <div><b>".$thismenu["email"]."</b> ".$thishotel["career_email"]."</div>
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
                <b>".$thismenu["dear"]." ".$_POST['full_name']."</b><br>
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
    $from_email = $thishotel["career_email"];
    $mail_headers_cust  = "Content-type: text/html; charset=UTF-8\r\n";
    $mail_headers_cust .= "From: " . $from_email . "\r\n";
    $mail_subject_cust .= "Job Application Form\r\n";

    // Email to property
    $mail_headers  = "Content-type: text/html; charset=UTF-8\r\n";
    $mail_headers .= "From: {$mail_sender}\r\n";
    $mail_subject .= "Job Application Form\r\n";

    // Sending email
    $to_email = $thishotel["career_email"];
    mail( $to_email, $mail_subject, $bodys, $mail_headers );
    mail( $email, $mail_subject_cust, $bodys_cust, $mail_headers_cust );
    $json['success'] = 'Your message was sent successfully!';


}

echo json_encode( $json );
?>