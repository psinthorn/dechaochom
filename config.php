<?php
require_once("site.configs.php");
$thishotel  = $hotel->getHotel($hotel_sec);
$thiscomp   = $company->getCompany($thishotel["hotel_chain_id"]);


// reCaptcha Setup
// ===============

// Insert below your reCaptcha Public and Private Keys
// Go to https://www.google.com/recaptcha/admin/create if you don't have the keys yet

$publickey = "6LeDoAoTAAAAAIwOiSekWPv3e_lqUwbxcIVzy4Ov";
$privatekey = "6LcIbgoTAAAAAFBZsOVCEXpb3pgo1OIgHhompoOy";

// Mail Setup
// ==========

// Sender Name and <email address> separated by space
$mail_sender = $thishotel["hotel_email"];
// Your Email Address where new emails will be sent to
//$to_email = "admin@bookinglibrary.com";
$to_email = $thishotel["hotel_email"];
// Email Subject
$mail_subject = '';

// Email content can be modified in the sendmail.php file.

?>