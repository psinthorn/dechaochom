<?PHP 
class Hotel { 


// FUNCTION : Customer CONSTRUCTORS
	function Hotel()
	{
	// #################### //
	} // END FUNCTION
	
// FUNCTION : Contact CONSTRUCTORS
	function Contact()
	{ 
	// #################### //
	} // END FUNCTION	

	
// FUNCTION : GET ALL HOTEL
	function getAllHotel()
	{
		$sql  = "SELECT * FROM hotel ";				
		$sql .= "ORDER BY hotel_name ";	
		$query = mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error()); 
		$i = 0;
		while ($row = mysql_fetch_array($query)){
			$result[$i]["hotel_id"]		=  $row["hotel_id"];
			$result[$i]["hotel_sec"]		=  $row["hotel_sec"];			
			$result[$i]["hotel_ref"] 	=  $row["hotel_ref"];		
			$result[$i]["hotel_name"] 	=  $row["hotel_name"];
			$result[$i]["hotel_shot"] 	=  $row["hotel_shot"];
			$result[$i]["hotel_city"] 	=  $row["hotel_city"];
			$result[$i]["hotel_province"] 	=  $row["hotel_province"];
			$result[$i]["hotel_country"] 	=  $row["hotel_country"];			
			$result[$i]["start_rate"] 	=  $row["start_rate"];
			$result[$i]["rating"] 	=  $row["rating"];															
			$result[$i]["currency_id"] 	=  $row["currency_id"];	
			$result[$i]["hotel_group"] 	=  $row["hotel_group"];	
			$result[$i]["reccommend"] 	=  $row["reccommend"];
			$result[$i]["hotel_priority"] 	=  $row["hotel_priority"];
			$result[$i]["hotel_agent"] 	=  $row["hotel_agent"];			
										
			$i++;
			}
		return $result;
	}
// FUNCTION : GET ACCOMMODATION TYPE
	function getAccommodationType()
	{
		$sql  = "SELECT * FROM accommodation_type ";				
		$sql .= "ORDER BY group_name ";	
		$query = mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error()); 
		$i = 0;
		while ($row = mysql_fetch_array($query)){
			$result[$i]["group_id"]		=  $row["group_id"];
			$result[$i]["group_name"]		=  $row["group_name"];			
			$result[$i]["group_status"] 	=  $row["group_status"];					
			$i++;
			}
		return $result;
	}	
	
// FUNCTION : GET ALL HOTEL GROUP
	function getAllHotelGroup()
	{
		$sql  = "SELECT * FROM hotel ";
		$sql .= "LEFT JOIN user_staff ON hotel.hotel_agent = user_staff.staff_agent ";		
		$sql .= "WHERE hotel.hotel_agent = '".$staff_agent."' ";				
		$sql .= "ORDER BY hotel_name ";	
		$query = mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error()); 
		$i = 0;
		while ($row = mysql_fetch_array($query)){
			$result[$i]["hotel_id"]		=  $row["hotel_id"];
			$result[$i]["hotel_sec"]		=  $row["hotel_sec"];			
			$result[$i]["hotel_ref"] 	=  $row["hotel_ref"];		
			$result[$i]["hotel_name"] 	=  $row["hotel_name"];
			$result[$i]["hotel_shot"] 	=  $row["hotel_shot"];
			$result[$i]["hotel_city"] 	=  $row["hotel_city"];
			$result[$i]["hotel_province"] 	=  $row["hotel_province"];
			$result[$i]["hotel_country"] 	=  $row["hotel_country"];			
			$result[$i]["start_rate"] 	=  $row["start_rate"];
			$result[$i]["rating"] 	=  $row["rating"];															
			$result[$i]["currency_id"] 	=  $row["currency_id"];	
			$result[$i]["hotel_group"] 	=  $row["hotel_group"];	
			$result[$i]["reccommend"] 	=  $row["reccommend"];
			$result[$i]["hotel_priority"] 	=  $row["hotel_priority"];
			$result[$i]["hotel_agent"] 	=  $row["hotel_agent"];			
										
			$i++;
			}
		return $result;
	}		
		
	// FUNCTION : GET "BOOK"
	function getCountHotelAll($hotel_id)
	{
		$sql  = "SELECT COUNT(*) AS allhotel FROM hotel ";
		$sql .= "WHERE hotel.hotel_id = '".$hotel_id."' ";
		$query = mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error()); 
		$result = mysql_fetch_array($query);
		return $result["allhotel"]; // COUNT ALL ROW IN DATABASE
	} // END FUNCTION
	
	// FUNCTION : GET "BOOK"
	function getCountHotel($hotel_group)
	{
		$sql  = "SELECT COUNT(*) AS allhotel FROM hotel ";
		$sql .= "WHERE accommodation_type = '1' ";
		$query = mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error()); 
		$result = mysql_fetch_array($query);
		return $result["allhotel"]; // COUNT ALL ROW IN DATABASE
	} // END FUNCTION
	
// FUNCTION : GET HOTEL

	function getHotel($hotel_sec){
$lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);	

	
if(!$_REQUEST["language_id"]){
$sql  = "SELECT * FROM hotel_language WHERE hotel_sec = '".$hotel_sec."' AND ISO639_1 = '".$lang."' ";
$query = mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error());
$language = mysql_fetch_array($query);	
$language_id = $language["ID"];

if($language_id <> ''){	
$language_id = $language_id;
}
else {
$sql  = "SELECT * FROM hotel_language WHERE hotel_sec = '".$hotel_sec."' AND language_default = 'YES' ";
$query = mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error());
$thislanguage = mysql_fetch_array($query);	
$language_id = $thislanguage["ID"];			
}

}
else {
$language_id = $_REQUEST["language_id"];	
}

		$sql  = "SELECT * FROM hotel LEFT JOIN hotel_language ON hotel.hotel_sec = hotel_language.hotel_sec ";
		$sql .= "WHERE hotel_language.hotel_sec = '".$hotel_sec."' AND hotel_language.ID = '".$language_id."' ";
		$query = mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error()); 
		return mysql_fetch_array($query);
		}
		
function getHotelBook($hotel_sec){

		$sql  = "SELECT * FROM hotel WHERE hotel_sec = '".$hotel_sec."' ";
		$query = mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error()); 
		return mysql_fetch_array($query);
		}
		
	// FUNCTION : GET HOTEL
	function getOption($option_id){
		$sql  = "SELECT * FROM `option` ";
		$sql .= "WHERE option_id = '".$option_id."' ";
		$query = mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error()); 
		return mysql_fetch_array($query);
		}	
		
// FUNCTION : GET HOTEL
	function getHotelid($hotel_id){
		$sql  = "SELECT * FROM hotel ";
		$sql .= "WHERE hotel_id = '".$hotel_id."' ";
		$query = mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error()); 
		return mysql_fetch_array($query);
		}	

	function insertHotelWizard($args)
	{
		$ref = md5(uniqid(rand()));
		$sql  = "INSERT INTO hotel VALUES (";
		$sql .= "NULL, ";
		$sql .= "'".$ref."', ";
		$sql .= "'".$args["hotel_group"]."', ";		
		$sql .= "'".$args["hotel_name"]."', ";
		$sql .= "'".$args["hotel_ref"]."', ";
		$sql .= "'".$args["contact_name"]."', ";			
		$sql .= "'".$args["hotel_address"]."', ";						
		$sql .= "'".$args["hotel_city"]."', ";	
		$sql .= "'".$args["hotel_area"]."', ";	
		$sql .= "'".$args["hotel_country"]."', ";	
		$sql .= "'".$args["hotel_shot"]."', ";
		$sql .= "'".$args["start_rate"]."', ";	
		$sql .= "'".$args["rating"]."', ";
		$sql .= "'".$args["hotel_tel"]."', ";									
		$sql .= "'".$args["hotel_fax"]."', ";	
		$sql .= "'".$args["website"]."', ";
		$sql .= "'".$args["hotel_email"]."', ";
		$sql .= "'".$args["rsvn_email"]."', ";
		$sql .= "'".$args["booking_fee"]."', ";
		$sql .= "'".$args["currency_id"]."', ";	
		$sql .= "'".$args["transfer_rate"]."', ";
		$sql .= "'".$args["transfer_adult"]."', ";	
		$sql .= "'".$args["transfer_child"]."', ";
		$sql .= "'".$args["merchant_id"]."', ";
		$sql .= "'".$args["terminal_id"]."', ";		
		$sql .= "'".$args["online_payment"]."', ";
		$sql .= "'".$args["bank_id"]."', ";				
		$sql .= "'".$args["term_condition"]."', ";	
		$sql .= "'".$args["info"]."', ";
		$sql .= "'".$args["fac"]."', ";
		$sql .= "'".$args["restaurant"]."', ";
		$sql .= "'".$args["location"]."', ";
		$sql .= "'".$args["about"]."', ";
		$sql .= "'".$args["bank"]."', ";	
		$sql .= "'".$args["bank_account"]."', ";
		$sql .= "'".$args["account_type"]."', ";
		$sql .= "'".$args["account_name"]."', ";
		$sql .= "'".$args["branch"]."', ";	
		$sql .= "'".$args["swiftcode"]."', ";	
		$sql .= "'".$args["reccommend"]."', ";																				
		$sql .= "'".$args["hotel_priority"]."', ";
		$sql .= "'".$args["hotel_agent"]."', ";
		$sql .= "'".$args["lat"]."', ";
		$sql .= "'".$args["lng"]."', ";
		$sql .= "'".$args["cancel_policy"]."', ";
		$sql .= "'".$args["hotel_title"]."', ";
		$sql .= "'".$args["keyword"]."', ";
		$sql .= "'".$args["description"]."', ";
		$sql .= "'".$args["expire_date"]."', ";
		$sql .= "'".$args["promotion_license"]."', ";
		$sql .= "'".$args["hotel_license"]."', ";
		$sql .= "'".$args["hotel_chain_id"]."', ";
		$sql .= "'".$args["hotel_sub_chain_id"]."', ";
		$sql .= "'".$args["hotel_country_id"]."', ";
		$sql .= "'".$args["hotel_city_id"]."', ";
		$sql .= "'".$args["hotel_area_id"]."') ";
		mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error()); 
		
		
		$sql  = "INSERT INTO promotion VALUES (";
		$sql .= "NULL, ";	
		$sql .= "'Last Minute Booking', ";
		$sql .= "'4', ";		
		$sql .= "'".$args["LMB"]."', ";	
		$sql .= "'Please insert Promotion Details', ";	
		$sql .= "'Please insert Promotion Benefits', ";					
		$sql .= "'".$args["website"]."', ";	
		$sql .= "'".$args["pro_email"]."', ";
		$sql .= "'".$args["currency_id"]."', ";	
		$sql .= "'".$args["transfer_rate"]."', ";
		$sql .= "'".$args["transfer_adult"]."', ";	
		$sql .= "'".$args["transfer_child"]."', ";
		$sql .= "'".$args["merchant_id"]."', ";
		$sql .= "'".$args["terminal_id"]."', ";			
		$sql .= "'".$args["online_payment"]."', ";
		$sql .= "'".$args["bank_id"]."', ";	
		$sql .= "'".$args["term_condition"]."', ";	
		$sql .= "'".$args["bank"]."', ";	
		$sql .= "'".$args["bank_account"]."', ";
		$sql .= "'".$args["account_name"]."', ";
		$sql .= "'".$args["branch"]."', ";	
		$sql .= "'".$args["swiftcode"]."', ";
		$sql .= "'".$args["pro_priority"]."', ";		
		$sql .= "'".$ref."', ";
		$sql .= "'1', ";
		$sql .= "'', ";
		$sql .= "'', ";
		$sql .= "'', ";
		$sql .= "'', ";
		$sql .= "'', ";
		$sql .= "'', ";
		$sql .= "'', ";
		$sql .= "'', ";
		$sql .= "'') ";
		mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error()); 
		
		
		$sql  = "INSERT INTO promotion VALUES (";
		$sql .= "NULL, ";	
		$sql .= "'Early Bird Booking', ";
		$sql .= "'1', ";		
		$sql .= "'".$args["EBB"]."', ";	
		$sql .= "'".$args["pro_details"]."', ";	
		$sql .= "'".$args["benefits"]."', ";					
		$sql .= "'".$args["website"]."', ";	
		$sql .= "'".$args["pro_email"]."', ";
		$sql .= "'".$args["currency_id"]."', ";	
		$sql .= "'".$args["transfer_rate"]."', ";
		$sql .= "'".$args["transfer_adult"]."', ";	
		$sql .= "'".$args["transfer_child"]."', ";
		$sql .= "'".$args["merchant_id"]."', ";
		$sql .= "'".$args["terminal_id"]."', ";			
		$sql .= "'".$args["online_payment"]."', ";
		$sql .= "'".$args["bank_id"]."', ";	
		$sql .= "'".$args["term_condition"]."', ";	
		$sql .= "'".$args["bank"]."', ";	
		$sql .= "'".$args["bank_account"]."', ";
		$sql .= "'".$args["account_name"]."', ";
		$sql .= "'".$args["branch"]."', ";	
		$sql .= "'".$args["swiftcode"]."', ";
		$sql .= "'".$args["pro_priority"]."', ";		
		$sql .= "'".$ref."', ";
		$sql .= "'1', ";
		$sql .= "'', ";
		$sql .= "'', ";
		$sql .= "'', ";
		$sql .= "'', ";
		$sql .= "'', ";
		$sql .= "'', ";
		$sql .= "'', ";
		$sql .= "'', ";
		$sql .= "'') ";
		mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error()); 
		
		
		$sql  = "INSERT INTO license VALUES (";
		$sql .= "NULL, ";
		$sql .= "'".$args["hotel_name"]."', ";	
		$sql .= "'".$ref."', ";
		$sql .= "'".$args["hotel_license"]."', ";	
		$sql .= "'".$args["expire_date"]."', ";		
		$sql .= "'".date("Y-m-d")."') ";
																											
		mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error()); 
		header ("Location: new_hotel_wizard2.php?hotel_sec=".$ref.""); 
		exit();
		
	}
	
// FUNCTION : INSERT "HOTEL WIZARD"
	function insertLicenseDB($args)
	{
		$sql  = "INSERT INTO license VALUES (";
		$sql .= "NULL, ";
		$sql .= "'".$args["hotel_name"]."', ";	
		$sql .= "'".$args["hotel_sec"]."', ";
		$sql .= "'".$args["hotel_license"]."', ";	
		$sql .= "'".date("Y-m-d")."', ";		
		$sql .= "'".date("Y-m-d")."') ";																											
		mysql_query($sql) or die(header ("Location: new_hotel.php?note=duplicate")); 
		
		return mysql_insert_id();
	} 	
// FUNCTION : UPDATE HOTEL WIZARD2
	function updateHotelWizard2($args)
	{
		$sql  = "UPDATE hotel SET ";
		$sql .= "hotel_area		= '".$args["hotel_area"]."', ";
		$sql .= "hotel_city		= '".$args["hotel_city"]."', ";
		$sql .= "hotel_country		= '".$args["hotel_country"]."', ";
		$sql .= "start_rate		= '".$args["start_rate"]."', ";
		$sql .= "booking_fee	= '".$args["booking_fee"]."', ";
		$sql .= "transfer_rate	= '".$args["transfer_rate"]."', ";
		$sql .= "transfer_adult	= '".$args["transfer_adult"]."', ";
		$sql .= "transfer_child	= '".$args["transfer_child"]."', ";
		$sql .= "bank			= '".$args["bank"]."', ";
		$sql .= "bank_account	= '".$args["bank_account"]."', ";
		$sql .= "account_type	= '".$args["account_type"]."', ";
		$sql .= "account_name	= '".$args["account_name"]."', ";
		$sql .= "branch			= '".$args["branch"]."', ";
		$sql .= "swiftcode		= '".$args["swiftcode"]."' ";
		$sql .= "WHERE hotel_sec = '".$args["hotel_sec"]."' ";
		mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error()); 
		return mysql_affected_rows();
	}
	
// FUNCTION : UPDATE HOTEL WIZARD3
	function updateHotelWizard3($args)
	{
		$sql  = "UPDATE hotel SET ";
		$sql .= "hotel_shot		= '".$args["hotel_shot"]."', ";
		$sql .= "info			= '".$args["info"]."', ";
		$sql .= "term_condition	= '".$args["term_condition"]."', ";
		$sql .= "cancel_policy	= '".$args["cancel_policy"]."' ";
		$sql .= "WHERE hotel_sec = '".$args["hotel_sec"]."' ";
		mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error()); 
		return mysql_affected_rows();
	}	
	

	// FUNCTION : DELETE "hotel"
	function deleteHotel($hotel_id)
	{
		$sql = "DELETE FROM hotel ";
		$sql .= "WHERE hotel_sec = '".$hotel_sec."' ";
		mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error()); 
		return  mysql_affected_rows();
	} // END FUNCTION	
	
// FUNCTION : DELETE "room"
	function deleteRoom($hotel_id)
	{
		$sql = "DELETE FROM room ";
		$sql .= "WHERE hotel_sec = '".$hotel_sec."' ";
		mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error()); 
		return  mysql_affected_rows();
	} // END FUNCTION

// FUNCTION : UPDATE HOTEL
	function updateHotel($args)
	{
		$sql  = "UPDATE hotel SET ";
		$sql .= "contact_name		= '".$args["contact_name"]."', ";		
		$sql .= "website		= '".$args["website"]."', ";
		$sql .= "hotel_email	= '".$args["hotel_email"]."', ";
		$sql .= "rsvn_email		= '".$args["rsvn_email"]."', ";
		$sql .= "booking_fee	= '".$args["booking_fee"]."', ";
		$sql .= "currency_id	= '".$args["currency_id"]."', ";
		$sql .= "transfer_rate	= '".$args["transfer_rate"]."', ";
		$sql .= "transfer_adult	= '".$args["transfer_adult"]."', ";
		$sql .= "transfer_child	= '".$args["transfer_child"]."', ";
		$sql .= "term_condition	= '".$args["term_condition"]."' ";			
		$sql .= "WHERE hotel_sec = '".$args["hotel_sec"]."' ";
		mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error()); 
		return mysql_affected_rows();
	}
//1.1		
	function updateHotelLanguageInformation($args)
	{
		mysql_query("SET NAMES 'utf8' COLLATE 'utf8_general_ci';");
		$sql  = "UPDATE hotel_language SET ";
		$sql .= "hotel_address	= '".$args["hotel_address"]."', ";
		$sql .= "hotel_name	= '".$args["hotel_name"]."', ";
		$sql .= "hotel_city	= '".$args["hotel_city"]."', ";
		$sql .= "hotel_province	= '".$args["hotel_province"]."', ";
		$sql .= "hotel_country	= '".$args["hotel_country"]."' ";
		$sql .= "WHERE hotel_sec = '".$args["hotel_sec"]."' AND ID = '".$args["language_id"]."' ";	
		mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error()); 
		return mysql_affected_rows();
	}
	
	function updateHotelInformation($args)
	{
		mysql_query("SET NAMES 'utf8' COLLATE 'utf8_general_ci';");
		$sql  = "UPDATE hotel SET ";
		$sql .= "rating	= '".$args["rating"]."', ";	
		$sql .= "hotel_tel	= '".$args["hotel_tel"]."', ";
		$sql .= "hotel_fax	= '".$args["hotel_fax"]."', ";								
		$sql .= "hotel_email	= '".$args["hotel_email"]."', ";
		$sql .= "website	= '".$args["website"]."', ";
		$sql .= "hotel_built	= '".$args["hotel_built"]."', ";
		$sql .= "hotel_renervated	= '".$args["hotel_renervated"]."', ";
		$sql .= "hotel_postalcode	= '".$args["hotel_postalcode"]."', ";
		$sql .= "total_room	= '".$args["total_room"]."' ";
		$sql .= "WHERE hotel_sec = '".$args["hotel_sec"]."' ";	
		mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error()); 
		return mysql_affected_rows();
	}
	
//1.1.2

	
	 // END FUNCTION
	
	
		function updateHotelContact($args)
	{
		mysql_query("SET NAMES 'utf8' COLLATE 'utf8_general_ci';");
		$sql  = "UPDATE hotel SET ";
		$sql .= "contact_email	= '".$args["contact_email"]."', ";
		$sql .= "rsvn_email	= '".$args["rsvn_email"]."' ";		
		$sql .= "WHERE hotel_sec = '".$args["hotel_sec"]."' ";	
		mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error()); 
		return mysql_affected_rows();
	}
	function updateHotelLanguageContact($args)
	{
		mysql_query("SET NAMES 'utf8' COLLATE 'utf8_general_ci';");
		$sql  = "UPDATE hotel_language SET ";
		$sql .= "contact_name	= '".$args["contact_name"]."', ";
		$sql .= "contact_position	= '".$args["contact_position"]."', ";
		$sql .= "rsvn_name	= '".$args["rsvn_name"]."', ";	
		$sql .= "rsvn_position	= '".$args["rsvn_position"]."' ";	
		$sql .= "WHERE hotel_sec = '".$args["hotel_sec"]."' AND ID = '".$args["language_id"]."' ";	
		mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error()); 
		return mysql_affected_rows();
	}
//1.2
		function updateHotelDescription($args)
	{
		$sql  = "UPDATE hotel_language SET ";
		$sql .= "info	= '".$args["info"]."', ";
		$sql .= "hotel_shot		= '".$args["hotel_shot"]."' ";
		$sql .= "WHERE hotel_sec = '".$args["hotel_sec"]."' AND ID = '".$args["language_id"]."'  ";	
		mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error()); 
		return mysql_affected_rows();
	}
	
	function updateHotelKeyword($args)
	{
		mysql_query("SET NAMES 'utf8' COLLATE 'utf8_general_ci';");
		$sql  = "UPDATE hotel_language SET ";
		$sql .= "hotel_title	= '".$args["hotel_title"]."', ";
		$sql .= "description	= '".$args["description"]."', ";
		$sql .= "keyword		= '".$args["keyword"]."', ";
		$sql .= "custom		= '".$args["custom"]."' ";
		$sql .= "WHERE hotel_sec = '".$args["hotel_sec"]."' AND ID = '".$args["language_id"]."' ";	
		mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error()); 
		return mysql_affected_rows();
	}
	
	function updateHotelFacilities($args)
	{
		$sql  = "UPDATE hotel SET ";
		$sql .= "fac	= '".$args["fac"]."' ";
		$sql .= "WHERE hotel_sec = '".$args["hotel_sec"]."' ";	
		mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error()); 
		return mysql_affected_rows();
	}
//1.2.2
		function updateHotelterm($args)
	{
		$sql  = "UPDATE hotel SET ";
		$sql .= "term_condition	= '".$args["term_condition"]."', ";
		$sql .= "check_in_time	= '".$args["check_in_time"]."', ";
		$sql .= "check_out_time	= '".$args["check_out_time"]."', ";
		$sql .= "transfer_rate = '".$args["transfer_rate"]."', ";
		$sql .= "transfer_adult	= '".$args["transfer_adult"]."', ";
		$sql .= "transfer_child	= '".$args["transfer_child"]."' ";
		$sql .= "WHERE hotel_sec = '".$args["hotel_sec"]."' ";	
		mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error()); 
		return mysql_affected_rows();
	}
//1.2.3
	function updateHotelCancelPolicy($args)
	{
		$sql  = "UPDATE hotel SET ";
		$sql .= "cancel_policy	= '".$args["cancel_policy"]."', ";
		$sql .= "no_show_policy	= '".$args["no_show_policy"]."', ";
		$sql .= "cancel_day	= '".$args["cancel_day"]."', ";
		$sql .= "auto_cancel	= '".$args["auto_cancel"]."', ";
		$sql .= "remind_cancel_day	= '".$args["remind_cancel_day"]."', ";
		$sql .= "auto_remind_cancel	= '".$args["auto_remind_cancel"]."' ";
		$sql .= "WHERE hotel_sec = '".$args["hotel_sec"]."' ";	
		mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error()); 
		return mysql_affected_rows();
	}
	
				
//1.3
	function updateHotelLocation($args)
	{
		$sql  = "UPDATE hotel SET ";
		$sql .= "hotel_address	= '".$args["hotel_address"]."', ";
		$sql .= "hotel_district	= '".$args["hotel_district"]."', ";		
		$sql .= "hotel_city	= '".$args["hotel_city"]."', ";	
		$sql .= "hotel_country	= '".$args["hotel_country"]."', ";	
		$sql .= "hotel_postalcode	= '".$args["hotel_postalcode"]."', ";
		$sql .= "hotel_area	= '".$args["hotel_area"]."', ";	
		$sql .= "hotel_timezone	= '".$args["hotel_timezone"]."' ";							
		$sql .= "WHERE hotel_sec = '".$args["hotel_sec"]."' ";	
		mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error()); 
		return mysql_affected_rows();
	}
//1.3.2
	function updateHotelMap($args)
	{
		$sql  = "UPDATE hotel SET ";
		$sql .= "lat	= '".$args["lat"]."', ";
		$sql .= "lng	= '".$args["lng"]."', ";	
		$sql .= "arrival_property	= '".$args["arrival_property"]."' ";							
		$sql .= "WHERE hotel_sec = '".$args["hotel_sec"]."' ";	
		mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error()); 
		return mysql_affected_rows();
	}	
//====================== START FUNCTION 1.4 =====================
	function SelectFacilities($args)
	{
		$sql  = "UPDATE hotel_facilities SET ";
		$sql .= "hotel_facilities_select 		= 'YES' ";		
		$sql .= "WHERE fac_id 		= '".$args["fac_id"]."' ";
		mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error()); 
		return mysql_affected_rows();
	}
		function UnselectFacilities($fac_id)
	{
		$sql = "DELETE FROM hotel_facilities ";
		$sql .= "WHERE fac_id = '".$fac_id."' ";
		mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error()); 
		return  mysql_affected_rows();
	}
 
		function updateHotelFacilitiesValue($fac_id)
	{
		$sql  = "UPDATE hotel_facilities SET ";
		$sql .= "hotel_facilities_value 		= '".$_REQUEST["hotel_facilities_value"]."' ";		
		$sql .= "WHERE fac_id 		= '".$fac_id."' ";
		mysql_query($sql); 
		return mysql_affected_rows();
	} 

	function UserDefinedFacilities($args)
	{
		mysql_query("SET NAMES 'utf8' COLLATE 'utf8_general_ci';");
		$sql  = "INSERT INTO hotel_facilities VALUES (";
		$sql .= "NULL, ";
		$sql .= "'".$args["hotel_facilities_hotel_sec"]."', ";
		$sql .= "'".$args["hotel_facilities_type_id"]."', ";		
		$sql .= "'".$args["hotel_facilities_type_name"]."', ";
		$sql .= "'99', ";
		$sql .= "'".$args["hotel_facilities_name"]."', ";
		$sql .= "'".$args["hotel_facilities_value"]."', ";	
		$sql .= "'YES', ";
		$sql .= "'".$args["language_id"]."' )";		
		mysql_query($sql); 
		return mysql_insert_id();
	} 
	
//====================== END FUNCTION 1_4 =====================
			
	function updateHotelAdminInformation($args)
	{
		$sql  = "UPDATE hotel SET ";
		$sql .= "hotel_name	= '".$args["hotel_name"]."', ";	
		$sql .= "website	= '".$args["website"]."', ";	
		$sql .= "hotel_ref	= '".$args["hotel_ref"]."', ";	
		$sql .= "rating	= '".$args["rating"]."', ";	
		$sql .= "contact_name	= '".$args["contact_name"]."', ";
		$sql .= "hotel_address	= '".$args["hotel_address"]."', ";
		$sql .= "hotel_city	= '".$args["hotel_city"]."', ";
		$sql .= "hotel_country	= '".$args["hotel_country"]."', ";
		$sql .= "hotel_area	= '".$args["hotel_area"]."', ";				
		$sql .= "hotel_tel	= '".$args["hotel_tel"]."', ";
		$sql .= "hotel_fax	= '".$args["hotel_fax"]."', ";								
		$sql .= "hotel_email	= '".$args["hotel_email"]."', ";
		$sql .= "lat		= '".$args["lat"]."', ";
		$sql .= "lng		= '".$args["lng"]."', ";
		$sql .= "rsvn_email		= '".$args["rsvn_email"]."' ";
		$sql .= "WHERE hotel_sec = '".$args["hotel_sec"]."' ";	
		mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error()); 
		return mysql_affected_rows();
	}	
	// FUNCTION : GET ALL GATEWAY
	function getAllGateway()
	{
		$sql  = "SELECT * FROM payment_gateway WHERE status = 'ON' ";
		$sql .= "ORDER BY gateway_id ";
		
		$query = mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error()); 
		$i = 0;
		while ($row = mysql_fetch_array($query)) {
			$result[$i]["gateway_id"]			= $row["gateway_id"];
			$result[$i]["gateway_code"]			= $row["gateway_code"];
			$result[$i]["gateway_name"]			= $row["gateway_name"];
			$result[$i]["gateway_link"]			= $row["gateway_link"];
			$i++;	
		}
		return $result;
	}
	
	// FUNCTION : GET ALL BANK TYPE
	function getAllBanktype()
	{
		$sql  = "SELECT * FROM bank_type ";
		$sql .= "ORDER BY id ";
		
		$query = mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error()); 
		$i = 0;
		while ($row = mysql_fetch_array($query)) {
			$result[$i]["id"]			= $row["id"];
			$result[$i]["type_name"]			= $row["type_name"];
			$result[$i]["type_name_TH"]			= $row["type_name_TH"];
			$i++;	
		}
		return $result;
	} // END FUNCTION		
	
	//GET SICIAL
	function getSocial($hotel_sec, $social_id){
		$sql  = "SELECT * FROM social ";
		$sql .= "WHERE hotel_sec = '".$hotel_sec."' AND id = '".$social_id."' ";
		$query = mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error()); 
		return mysql_fetch_array($query);
		}
	// GET ALL SOCIAL
	function getAllSocial($hotel_sec)
	{
		$sql  = "SELECT * FROM hotel_social ";
		$sql .= "WHERE hotel_sec = '".$hotel_sec."' ";
		$sql .= "ORDER BY id ";
		
		$query = mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error()); 
		$i = 0;
		while ($row = mysql_fetch_array($query)) {
			$result[$i]["id"]			= $row["id"];
			$result[$i]["social_code"]			= $row["social_code"];
			$result[$i]["social_name"]			= $row["social_name"];
			$result[$i]["social_icon"]			= $row["social_icon"];
			$result[$i]["social_class"]			= $row["social_class"];
			$result[$i]["text_title"]			= $row["text_title"];
			$result[$i]["social_link"]			= $row["social_link"];
			$result[$i]["social_status"]			= $row["social_status"];
			$i++;	
		}
		return $result;
	}
	//ADD SOCIAL
	function insertSocial($args)
	{
		$sql  = "INSERT INTO social VALUES (";
		$sql .= "NULL, ";
		$sql .= "'".$args["social_code"]."', ";		
		$sql .= "'".$args["social_name"]."', ";
		$sql .= "'".$args["social_link"]."', ";
		$sql .= "'".$args["text_title"]."', ";
		$sql .= "'".$args["hotel_sec"]."' )";		
		mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error());
		return mysql_insert_id();
	} // END FUNCTION
	//UPDATE SOCIAL
	function updateSocial($args)
	{
		$sql  = "UPDATE social SET ";	
		$sql .= "social_code	= '".$args["social_code"]."', ";
		$sql .= "social_name	= '".$args["social_name"]."', ";
		$sql .= "social_link	= '".$args["social_link"]."', ";	
		$sql .= "text_title	= '".$args["text_title"]."' ";					
		$sql .= "WHERE id = '".$args["id"]."' ";
		mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error()); 
		return mysql_affected_rows();
	}
	
	//ADD REVIEW TEMPLATE
	function insertReviewTemplate($args)
	{
		
		$sql  = "INSERT INTO GSS_review_template VALUES (";
		$sql .= "NULL, ";
		$sql .= "'".$args["name"]."', ";
		$sql .= "'".$args["subject"]."', ";		
		$sql .= "'".$args["header"]."".$args["description"]."".$args["footer0"]."".$args["socialimage"]."".$args["footer"]."', ";
		$sql .= "'".$args["social_id"]."', ";
		$sql .= "'".$args["hotel_sec"]."', ";
		$sql .= "'".date("Y-m-d H:i:s")."', ";
		$sql .= "'".$args["update_by"]."', ";
		$sql .= "'".$args["defaults"]."' )";		
		mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error());
		return mysql_insert_id();
	}
	
	//ADD REVIEW TEMPLATE
	function insertNewsletterdraft($args)
	{
		
		$sql  = "INSERT INTO news_letter_draft VALUES (";
		$sql .= "NULL, ";
		$sql .= "'".$args["type"]."', ";
		$sql .= "'".$args["type_title"]."', ";
		$sql .= "'".$args["theme"]."', ";
		$sql .= "'".$args["subject"]."', ";
		$sql .= "'".$args["promotion"]."', ";		
		$sql .= "'".$args["descriptions"]."', ";
		$sql .= "'".$args["market"]."', ";
		$sql .= "'".$args["national"]."', ";
		$sql .= "'".date("Y-m-d H:i:s")."', ";
		$sql .= "'".date("H:i:s")."', ";
		$sql .= "'".$args["update_by"]."', ";
		$sql .= "'".$args["hotel_sec"]."', ";
		$sql .= "'YES' )";		
		mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error());
		return mysql_insert_id();
	}
	//GET NEWS LETTER DRAFT
	function getNewsletter($hotel_sec, $id){
		$sql  = "SELECT * FROM news_letter_draft ";
		$sql .= "WHERE hotel_sec = '".$hotel_sec."' AND id = '".$id."' ";
		$query = mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error()); 
		return mysql_fetch_array($query);
		}
	
	//UPDATE NEWS LETTER
	function UpdateNewsletter($args)
	{
		$sql  = "UPDATE news_letter_draft SET ";	
		$sql .= "type	= '".$args["type"]."', ";
		$sql .= "type_title	= '".$args["type_title"]."', ";
		$sql .= "theme	= '".$args["theme"]."', ";
		$sql .= "subject	= '".$args["subject"]."', ";
		$sql .= "pro_id	= '".$args["pro_id"]."', ";
		$sql .= "descriptions	= '".$args["descriptions"]."', ";
		$sql .= "market	= '".$args["market"]."', ";
		$sql .= "national	= '".$args["national"]."', ";	
		$sql .= "create_date	= '".date("Y-m-d")."', ";	
		$sql .= "create_time	= '".date("H:i:s")."', ";	
		$sql .= "create_by	= '".$args["create_by"]."' ";					
		$sql .= "WHERE id = '".$args["id"]."' ";
		mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error()); 
		return mysql_affected_rows();
	}
	
	//UPDATE REVIEW TEMPLATE
	function updateReviewTemplate($args)
	{
		$sql  = "UPDATE GSS_review_template SET ";	
		$sql .= "name	= '".$args["name"]."', ";
		$sql .= "subject	= '".$args["subject"]."', ";
		$sql .= "description	= '".$args["description"]."', ";	
		$sql .= "last_update	= '".date("Y-m-d H:i:s")."', ";	
		$sql .= "update_by	= '".$args["update_by"]."' ";					
		$sql .= "WHERE id = '".$args["id"]."' ";
		mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error()); 
		return mysql_affected_rows();
	}
	//UPDATE REVIEW TEMPLATE DEFAULTS
	function updateReviewTemplateDefaults($args)
	{
		$sql  = "UPDATE GSS_review_template SET ";	
		$sql .= "defaults	= '".$args["defaults"]."' ";					
		$sql .= "WHERE id = '".$args["id"]."' ";
		mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error()); 
		return mysql_affected_rows();
	}
	//GET TEMPLATE
	function getReviewTemplate($hotel_sec, $template_id){
		$sql  = "SELECT * FROM GSS_review_template ";
		$sql .= "WHERE hotel_sec = '".$hotel_sec."' AND id = '".$template_id."' ";
		$query = mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error()); 
		return mysql_fetch_array($query);
		}	
	// GET ALL SOCIAL
	function getAllReviewTemplate($hotel_sec)
	{
		$sql  = "SELECT * FROM GSS_review_template ";
		$sql .= "WHERE hotel_sec = '".$hotel_sec."' ";
		$sql .= "ORDER BY id ";
		
		$query = mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error()); 
		$i = 0;
		while ($row = mysql_fetch_array($query)) {
			$result[$i]["id"]			= $row["id"];
			$result[$i]["name"]			= $row["name"];
			$result[$i]["subject"]			= $row["subject"];
			$result[$i]["description"]			= $row["description"];
			$result[$i]["social_id"]			= $row["social_id"];
			$result[$i]["hotel_sec"]			= $row["hotel_sec"];
			$result[$i]["last_update"]			= $row["last_update"];
			$result[$i]["update_by"]			= $row["update_by"];
			$result[$i]["defaults"]			= $row["defaults"];
			$i++;	
		}
		return $result;
	}
	
	
	function updateHotelBank($args)
	{
		$sql  = "UPDATE hotel SET ";	
		$sql .= "bank			= '".$args["bank"]."', ";
		$sql .= "bank_account	= '".$args["bank_account"]."', ";
		$sql .= "account_type	= '".$args["account_type"]."', ";
		$sql .= "account_name	= '".$args["account_name"]."', ";
		$sql .= "branch			= '".$args["branch"]."', ";
		$sql .= "swiftcode		= '".$args["swiftcode"]."' ";						
		$sql .= "WHERE hotel_sec = '".$args["hotel_sec"]."' ";
		mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error()); 
		return mysql_affected_rows();
	}	
	
	function updateHotelGateway($args)
	{
		$sql  = "UPDATE hotel SET ";	
		$sql .= "online_payment		= '".$args["online_payment"]."', ";
		$sql .= "gateway			= '".$args["gateway"]."', ";
		$sql .= "merchant_id	= '".$args["merchant_id"]."', ";
		$sql .= "terminal_id		= '".$args["terminal_id"]."' ";						
		$sql .= "WHERE hotel_sec = '".$args["hotel_sec"]."' ";
		mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error()); 
		return mysql_affected_rows();
	}		

	function CustommizeFacilities($args)
	{
		$sql  = "INSERT INTO hotel_facilities VALUES (";
		$sql .= "NULL, ";
		$sql .= "'".$args["hotel_facilities_hotel_sec"]."', ";
		$sql .= "'".$args["hotel_facilities_type_id"]."', ";		
		$sql .= "'".$args["hotel_facilities_type_name"]."', ";
		$sql .= "'".$args["hotel_facilities_id"]."', ";
		$sql .= "'".$args["hotel_facilities_name"]."', ";
		$sql .= "'".$args["hotel_facilities_value"]."' )";		
		mysql_query($sql) or die(header("Location: index.php?hotel_sec=".$args["hotel_facilities_hotel_sec"]."&id=facilities"));
		return mysql_insert_id();
	} // END FUNCTION			
	

	function insertFacilitiesTemplate($args)
	{
		$sql  = "INSERT INTO facilities VALUES (";
		$sql .= "'".$args["facilities_type_id"]."', ";		
		$sql .= "'".$args["facilities_type_name"]."', ";
		$sql .= "NULL, ";
		$sql .= "'".$args["facilities_name"]."', ";
		$sql .= "'".$args["facilities_value"]."' )";		
		mysql_query($sql) or die(header("Location: facilities_template.php"));
		return mysql_insert_id();
	} // END FUNCTION
	
	// FUNCTION : DELETE "room"
	function deleteFacilitiesTemplate($facilities_id)
	{
		$sql = "DELETE FROM facilities ";
		$sql .= "WHERE facilities_id = '".$_REQUEST["facilities_id"]."' ";
		mysql_query($sql) or die(header("Location: facilities_template.php")); 
		return  mysql_affected_rows();
	} // END FUNCTION	
	
	function updateFacilitiesValue($facilities_id)
	{
		$sql  = "UPDATE facilities SET ";
		$sql .= "facilities_value 		= '".$_REQUEST["facilities_value"]."' ";		
		$sql .= "WHERE facilities_id 		= '".$_REQUEST["facilities_id"]."' ";
		mysql_query($sql) or die(header("location: facilities_template.php?error=duplicate")); 
		return mysql_affected_rows();
	} // END FUNCTION

	function updateHotelTransfer($args)
	{
		$sql  = "UPDATE hotel SET ";	
		$sql .= "transfer_rate		= '".$args["transfer_rate"]."', ";
		$sql .= "transfer_adult			= '".$args["transfer_adult"]."', ";
		$sql .= "transfer_child	= '".$args["transfer_child"]."'  ";
		$sql .= "WHERE hotel_sec = '".$args["hotel_sec"]."' ";
		mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error()); 
		return mysql_affected_rows();
	}
		
				
	
// FUNCTION : UPDATE HOTEL PICTURE
	function updateHotelpicture($args)
	{
		$sql  = "UPDATE hotel SET ";
		$sql .= "hotel_name	= '".$args["hotel_name"]."', ";
		$sql .= "hotel_ref	= '".$args["hotel_ref"]."' ";					
		$sql .= "WHERE hotel_id = '".$args["hotel_id"]."' ";
		mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error()); 
		return mysql_affected_rows();
	}		
	
// FUNCTION : UPDATE "currency"
	function updateCurrency($args)
	{
		$sql  = "UPDATE currency SET ";
		$sql .= "currency_status	= '".$args["currency_status"]."' ";
		$sql .= "WHERE currency_id 	= '".$args["currency_id"]."' ";
		mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error());
		return mysql_affected_rows();
	} // END FUNCTION
	
// FUNCTION : UPDATE "usdcurrency"
	function updateUSDCurrency($args)
	{
		$sql  = "UPDATE usdcurrency SET ";
		$sql .= "currency_rate		= '".$args["currency_rate"]."', ";
		$sql .= "currency_status	= '".$args["currency_status"]."' ";
		$sql .= "WHERE currency_id 	= '".$args["currency_id"]."' ";
		mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error());
		return mysql_affected_rows();
	} // END FUNCTION		


	
// FUNCTION : GET "currency"
	function getCurrency($currency_abb)
	{
		$sql  = "SELECT * FROM currency ";
		$sql .= "WHERE currency_abb = '".$currency_abb."' ";
		$result = mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error()); 
		return mysql_fetch_array($result);	
	}
	
// FUNCTION : GET "usdcurrency"
	function getUSDCurrency($currency_id)
	{
		$sql  = "SELECT * FROM usdcurrency ";
		$sql .= "WHERE currency_id = '".$currency_id."' ";
		$result = mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error()); 
		return mysql_fetch_array($result);	
	}		

// FUNCTION : GET ALL "index_currency"
	function getAllindexCurrency($currency_status)
	{
		$sql  = "SELECT * FROM currency ";
		if (($currency_status == 0) || ($currency_status == 1)) { 
			$sql .= "WHERE currency_status = '".$currency_status."' ";
			}
		$sql .= "ORDER BY currency_abb ASC ";
		$result = mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error()); 
				
	} // END FUNCTION
	
// FUNCTION : GET ALL "currency"
	function getAllCurrency()
	{
		$sql  = "SELECT * FROM currency ";
		//$sql .= "WHERE currency_status = '1' ";
		$sql .= "ORDER BY currency_id ASC ";
		$query = mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error()); 
		$i = 0;
		while ($row = mysql_fetch_array($query)) {
			$result[$i]["currency_id"]	= $row["currency_id"];
			$result[$i]["currency_rate"]	= $row["currency_rate"];
			$result[$i]["currency_abb"]	= $row["currency_abb"];
			$result[$i]["currency_name"]	= $row["currency_name"];
			$result[$i]["currency_rate_convert"]	= $row["currency_rate_convert"];
			$result[$i]["currency_rate_invert"]	= $row["currency_rate_invert"];
			$result[$i]["currency_status"]	= $row["currency_status"];
			$i++;
		}
		return $result;	
	} // END FUNCTION
	
	
	
	
	

	// FUNCTION : INSERT "Agency"
	function insertGroup($args)
	{
		$sql  = "INSERT INTO group_management VALUES (";
		$sql .= "NULL, ";
		$sql .= "'".$args["group_name"]."', ";	
		$sql .= "'".$args["group_status"]."') ";
		mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error()); 
		return mysql_insert_id();
	} // END FUNCTION
	
// FUNCTION : UPDATE "group"
	function updateGroup($args)
	{
		$sql  = "UPDATE group_management SET ";
		$sql .= "group_name		= '".$args["group_name"]."', ";
		$sql .= "group_status 		= '".$args["group_status"]."' ";
		$sql .= "WHERE group_id 		= '".$args["group_id"]."' ";
		mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error()); 
		return mysql_affected_rows();
	} // END FUNCTION	
	
	
// FUNCTION : Get "Group"
	function getGroup($group_id)
	{
		$sql  = "SELECT * FROM group_management ";
		$sql .= "WHERE group_id = '".$group_id."'";
		$query = mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error()); 
		return mysql_fetch_array($query);
	} // END FUNCTION

// FUNCTION : Get "Country"
	function getCountry($country_id)
	{
		$sql  = "SELECT * FROM country ";
		$sql .= "WHERE country_id = '".$country_id."'";
		$query = mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error()); 
		return mysql_fetch_array($query);
	} // END FUNCTION


// FUNCTION : Get All "Country"
	function getAllCountry()
	{
		$sql  = "SELECT * FROM country ";
		$sql .= "ORDER BY COUNTRY_NAME ";
		
		$query = mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error()); 
		$i = 0;
		while ($row = mysql_fetch_array($query)) {
			$result[$i]["COUNTRY_CODE"]			= $row["COUNTRY_CODE"];
			$result[$i]["COUNTRY_NAME"]		= $row["COUNTRY_NAME"];
			$result[$i]["ZONECODE"]		= $row["ZONECODE"];
			$i++;	
		}
		return $result;
	} // END FUNCTION	
	
// FUNCTION : Get All "Country"
	function getAllNational()
	{
		$sql  = "SELECT * FROM national ";
		$sql .= "ORDER BY national_NAME ";
		
		$query = mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error()); 
		$i = 0;
		while ($row = mysql_fetch_array($query)) {
			$result[$i]["national_CODE"]		= $row["national_CODE"];
			$result[$i]["national_NAME"]		= $row["national_NAME"];
			$i++;	
		}
		return $result;
	} // END FUNCTION		
	
	
	// FUNCTION : INSERT "Hotel Group"
	function insertHotelGroup($args)
	{
		$sql  = "INSERT INTO hotel_group VALUES (";
		$sql .= "NULL, ";
		$sql .= "'".$args["group_name"]."', ";
		$sql .= "'".$args["group_status"]."') ";
		mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error()); 
		return mysql_insert_id();
	} // END FUNCTION
	
// FUNCTION : Get "Hotel Group"
	function getHotelGroup($group_id)
	{
		$sql  = "SELECT * FROM hotel_group ";
		$sql .= "WHERE group_id = '".$group_id."'";
		$query = mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error()); 
		return mysql_fetch_array($query);
	} // END FUNCTION


// FUNCTION : Get All "Hotel Group"
	function getAllHotelGroupManagement($status)
	{
		$sql  = "SELECT * FROM hotel_group ";		
		$sql .= "ORDER BY group_id ";	
		$query = mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error()); 
		$i = 0;
		while ($row = mysql_fetch_array($query)){
			$result[$i]["group_id"]			= $row["group_id"];
			$result[$i]["group_name"]		= $row["group_name"];
			$result[$i]["group_status"]		= $row["group_status"];	
			$i++;	
		}
		return $result;
	} // END FUNCTION	
	
// FUNCTION : Get All "Rating"
	function getAllRating($status)
	{
		$sql  = "SELECT * FROM rating ";
		$sql .= "ORDER BY rate_id ";

		$query = mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error()); 
		$i = 0;
		while ($row = mysql_fetch_array($query)) {
			$result[$i]["rate_id"]		= $row["rate_id"];
			$result[$i]["rate_name"]		= $row["rate_name"];
			$result[$i]["code"]		= $row["code"];			
			$i++;	
		}
		return $result;
	} // END FUNCTION
			
// FUNCTION : GET "option"

	function getAllOption($hotel_sec, $activities_atatus)
	{
		$sql  = "SELECT * FROM activities ";
		$sql .= "WHERE activities_hotel_sec = '".$hotel_sec."' ";
		$sql .= "ORDER BY activities_id ";
		$query = mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error());  
		$i = 0;
		while ($row = mysql_fetch_array($query)) {
			$result[$i]["activities_id"]		= $row["activities_id"];
			$result[$i]["activities_price"] 	= $row["activities_price"];
			$result[$i]["activities_name"]	= $row["activities_name"];
			$result[$i]["activities_hotel_sec"] 	= $row["activities_hotel_sec"];
			$i++;
		}
		return $result;		
	}
	
	//Insert Extra
	function insertExtra($args)
	{
		$sql  = "INSERT INTO extra_service VALUES (";
		$sql .= "NULL, ";	
		$sql .= "'".$args["extra_hotel_sec"]."', ";
		$sql .= "'".$args["extra_name"]."', ";	
		$sql .= "'".$args["extra_desc"]."', ";
		$sql .= "'".$args["extra_value"]."', ";
		$sql .= "'".$args["extra_min_charge"]."', ";
		$sql .= "'".date("Y-m-d H:i:s")."' )";
		mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error()); 
		return mysql_insert_id();

	} // END FUNCTION
	
	// FUNCTION DELETE EXTRA
	function deleteExtra($id)
	{
		$sql = "DELETE FROM extra_service ";
		$sql .= "WHERE id = '".$id."' ";
		mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error()); 
		return  mysql_affected_rows();
	} // END FUNCTION	
	
	function deleteSocial($id)
	{
		$sql = "DELETE FROM social ";
		$sql .= "WHERE id = '".$id."' ";
		mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error()); 
		return  mysql_affected_rows();
	} // END FUNCTION
	
	// FUNCTION : DINING
	function updateHotelDining($args)
	{
		mysql_query("SET NAMES 'utf8' COLLATE 'utf8_general_ci';");
		$sql  = "UPDATE dining_language SET ";
		$sql .= "dining_name		= '".$args["dining_name"]."', ";
		$sql .= "dining_title		= '".$args["dining_title"]."', ";
		$sql .= "dining_description 		= '".$args["dining_description"]."' ";
		$sql .= "WHERE dining_id 		= '".$args["dining_id"]."' AND language_id = '".$args["language_id"]."' AND hotel_sec = '".$args["hotel_sec"]."' ";
		mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error()); 
		return mysql_affected_rows();
	} 
	function insertHotelDining($args)
	{
		mysql_query("SET NAMES 'utf8' COLLATE 'utf8_general_ci';");
		$sql  = "INSERT INTO dining VALUES (";
		$sql .= "NULL, ";	
		$sql .= "'".$args["dining_name"]."', ";
		$sql .= "'".$args["dining_title"]."', ";	
		$sql .= "'', ";
		$sql .= "'".date("Y-m-d H:i:s")."', ";
		$sql .= "'".$args["user_update"]."', ";
		$sql .= "'".$args["hotel_sec"]."' )";
		mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error()); 
		return mysql_insert_id();

	}
	
	function deleteHotelDining($diningid, $hotel_sec)
	{
		$sql = "DELETE FROM dining ";
		$sql .= "WHERE id = '".$diningid."' AND hotel_sec = '".$hotel_sec."' ";
		mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error()); 
		return  mysql_affected_rows();
	} // END FUNCTION
	
	function deleteHotelDiningLanguage($diningid, $hotel_sec)
	{
		$sql = "DELETE FROM dining_language ";
		$sql .= "WHERE dining_id = '".$diningid."' AND hotel_sec = '".$hotel_sec."' ";
		mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error()); 
		return  mysql_affected_rows();
	} // END FUNCTION
	
	// FUNCTION : EVENT
	function updateHotelEvent($args)
	{
		mysql_query("SET NAMES 'utf8' COLLATE 'utf8_general_ci';");
		$sql  = "UPDATE event_language SET ";
		$sql .= "event_name		= '".$args["event_name"]."', ";
		$sql .= "event_title		= '".$args["event_title"]."', ";
		$sql .= "event_description 		= '".$args["event_description"]."' ";
		$sql .= "WHERE event_id 	= '".$args["event_id"]."' AND language_id = '".$args["language_id"]."' AND hotel_sec = '".$args["hotel_sec"]."' ";
		mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error()); 
		return mysql_affected_rows();
	} 
	function insertHotelEvent($args)
	{
		$sql  = "INSERT INTO event VALUES (";
		$sql .= "NULL, ";	
		$sql .= "'".$args["event_name"]."', ";
		$sql .= "'".$args["event_title"]."', ";	
		$sql .= "'', ";
		$sql .= "'".date("Y-m-d H:i:s")."', ";
		$sql .= "'".$args["user_update"]."', ";
		$sql .= "'".$args["hotel_sec"]."' )";
		mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error()); 
		return mysql_insert_id();

	}
	
	function deleteHotelEvent($eventid, $hotel_sec)
	{
		$sql = "DELETE FROM event ";
		$sql .= "WHERE id = '".$eventid."' AND hotel_sec = '".$hotel_sec."' ";
		mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error()); 
		return  mysql_affected_rows();
	}
	
	function deleteHotelEventLanguage($eventid, $hotel_sec)
	{
		$sql = "DELETE FROM event_language ";
		$sql .= "WHERE event_id = '".$eventid."' AND hotel_sec = '".$hotel_sec."' ";
		mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error()); 
		return  mysql_affected_rows();
	} // END FUNCTION
	
	function insertLanguage($args)
	{
		$sql  = "INSERT INTO hotel_language VALUES (";
		$sql .= "'".$args["ID"]."', ";	
		$sql .= "'".$args["ISO639_1"]."', ";	
		$sql .= "'".$args["Name"]."', ";		
		$sql .= "'".$args["NativeName"]."', ";	
		$sql .= "'".$args["hotel_sec"]."', ";
		$sql .= "'".$args["hotel_name"]."', ";
		$sql .= "'".$args["hotel_shot"]."', ";
		$sql .= "'".$args["info"]."', ";
		$sql .= "'".$args["term_condition"]."', ";
		$sql .= "'".$args["fac"]."', ";
		$sql .= "'".$args["hotel_dining"]."', ";
		$sql .= "'Home', ";
		$sql .= "'Book', ";
		$sql .= "'Facilities', ";
		$sql .= "'Room', ";
		$sql .= "'Dining', ";
		$sql .= "'Event', ";
		$sql .= "'Gallery', ";
		$sql .= "'Contact', ";
		$sql .= "'Map', ";
		$sql .= "'Hide', ";
		
		$sql .= "'online_reservation', ";
		$sql .= "'adult', ";
		$sql .= "'child', ";
		$sql .= "'availability_check', ";
		$sql .= "'arrival_date', ";
		$sql .= "'departure_date', ";
		$sql .= "'room_availability', ";
		$sql .= "'room_type', ";
		$sql .= "'person', ";
		$sql .= "'night', ";
		$sql .= "'average', ";
		$sql .= "'no_of_room', ";
		$sql .= "'net_per_stay', ";
		$sql .= "'book_now', ";
		$sql .= "'choose_your_room', ";
		$sql .= "'your_booking_detail', ";
		$sql .= "'confirm_your_payment', ";
		$sql .= "'sunday', ";
		$sql .= "'monday', ";
		$sql .= "'tuesday', ";
		$sql .= "'wednesday', ";
		$sql .= "'thursday', ";
		$sql .= "'friday', ";
		$sql .= "'saturday', ";
		$sql .= "'january', ";
		$sql .= "'february', ";
		$sql .= "'march', ";
		$sql .= "'april', ";
		$sql .= "'may', ";
		$sql .= "'june', ";
		$sql .= "'july', ";
		$sql .= "'august', ";
		$sql .= "'september', ";
		$sql .= "'october', ";
		$sql .= "'november', ";
		$sql .= "'december', ";
		$sql .= "'daily_rate', ";
		$sql .= "'booking_summary', ";
		$sql .= "'reservation_info', ";
		$sql .= "'contact_detail', ";
		$sql .= "'special_request', ";
		$sql .= "'tcontinue', ";
		$sql .= "'cancellation_policy', ";
		$sql .= "'none_refund', ";
		$sql .= "'title', ";
		$sql .= "'first_name', ";
		$sql .= "'last_name', ";
		$sql .= "'address', ";
		$sql .= "'city', ";
		$sql .= "'country', ";
		$sql .= "'nationality', ";
		$sql .= "'email', ";
		$sql .= "'bed_preference', ";
		$sql .= "'smoking_preference', ";
		$sql .= "'arrival_detail', ";
		$sql .= "'arrival_time', ";
		
		$sql .= "'included', ";
		$sql .= "'excluded', ";
		$sql .= "'breakfast', ";
		$sql .= "'room_left', ";
		$sql .= "'deposit_guarantee', ";
		$sql .= "'total_charge', ";
		$sql .= "'early_bird', ";
		$sql .= "'hot_deal', ";
		$sql .= "'service', ";
		$sql .= "'tax', ";
		$sql .= "'max_adult', ";
		$sql .= "'person_per_room', ";
		$sql .= "'allow_extra_adult', ";
		$sql .= "'allow_extra_child', ";
		$sql .= "'max_children_age', ";
		$sql .= "'year_old', ";
		$sql .= "'extra_adult_charge', ";
		$sql .= "'extra_children_charge', ";
		$sql .= "'contact_to', ";
		$sql .= "'subject', ";
		$sql .= "'message', ";
		$sql .= "'send_message', ";
		
		$sql .= "'NO') ";		
		mysql_query($sql);
		return mysql_insert_id();
	} // END FUNCTION
	
	function DeletehotelLanguage($ID, $hotel_sec)
	{
		$sql = "DELETE FROM hotel_language ";
		$sql .= "WHERE ID = '".$ID."' AND hotel_sec = '".$hotel_sec."' ";
		mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error()); 
		return  mysql_affected_rows();
	} // END FUNCTION
	function DeletecontrolLanguage($ID, $hotel_sec)
	{
		$sql = "DELETE FROM icontrol_language ";
		$sql .= "WHERE ID = '".$ID."' AND hotel_sec = '".$hotel_sec."' ";
		mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error()); 
		return  mysql_affected_rows();
	} // END FUNCTION
	
	function UnDefaultLanguage($UID, $hotel_sec)
	{
		$sql  = "UPDATE hotel_language SET ";
		$sql .= "language_default		= 'NO' ";
		$sql .= "WHERE ID 		= '".$UID."' AND hotel_sec = '".$hotel_sec."' ";
		mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error()); 
		return mysql_affected_rows();
	}
	function DefaultLanguage($ID, $hotel_sec)
	{
		$sql  = "UPDATE hotel_language SET ";
		$sql .= "status		= 'Show', ";
		$sql .= "language_default		= 'YES' ";
		$sql .= "WHERE ID 		= '".$ID."' AND hotel_sec = '".$hotel_sec."'  ";
		mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error()); 
		return mysql_affected_rows();
	}
	function StatusLanguage($args)
	{
		$sql  = "UPDATE hotel_language SET ";
		$sql .= "status		= '".$args["status"]."' ";
		$sql .= "WHERE ID 		= '".$args["ID"]."' AND hotel_sec = '".$args["hotel_sec"]."' ";
		mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error()); 
		return mysql_affected_rows();
	}
	
	
	function updatecontentLanguage($args)
	
	{
		mysql_query("SET NAMES 'utf8' COLLATE 'utf8_general_ci';");
		$sql  = "UPDATE hotel_language SET ";
		
		//Description	
		$sql .= "hotel_name	= '".$args["hotel_name"]."', ";	
		$sql .= "hotel_shot	= '".$args["hotel_shot"]."', ";	
		$sql .= "info	= '".$args["info"]."', ";	
		$sql .= "hotel_dining	= '".$args["hotel_dining"]."', ";	
		$sql .= "fac	= '".$args["fac"]."', ";	
		$sql .= "term_condition	= '".$args["term_condition"]."' ";					
		$sql .= "WHERE hotel_sec = '".$args["hotel_sec"]."' AND ID = '".$args["ID"]."' ";	
		mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error()); 
		
		return mysql_affected_rows();
	}
	
	function updatemenuLanguage($args)
	
	{
		mysql_query("SET NAMES 'utf8' COLLATE 'utf8_general_ci';");
		$sql  = "UPDATE hotel_language SET ";
		
		if($args["selecthotel"] == 'All Hotel'){
		$hotel = "";	
		}
		else {
		$hotel = "AND hotel_sec = '".$args["hotel_sec"]."' ";	
		}
		//Description	
		$sql .= "home	= '".$args["home"]."', ";	
		$sql .= "book	= '".$args["book"]."', ";	
		$sql .= "facilities	= '".$args["facilities"]."', ";	
		$sql .= "room	= '".$args["room"]."', ";	
		$sql .= "dining	= '".$args["dining"]."', ";	
		$sql .= "event	= '".$args["event"]."', ";
		$sql .= "gallery	= '".$args["gallery"]."', ";
		$sql .= "contact	= '".$args["contact"]."', ";
		$sql .= "map	= '".$args["map"]."' ";					
		$sql .= "WHERE ID = '".$args["ID"]."' ".$hotel." ";	
		mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error()); 
		
		return mysql_affected_rows();
	}
	
	function updatereservationLanguage($args)
	
	{
		mysql_query("SET NAMES 'utf8' COLLATE 'utf8_general_ci';");
		$sql  = "UPDATE hotel_language SET ";
		
		if($args["selecthotel"] == 'All Hotel'){
		$hotel = "";	
		}
		else {
		$hotel = "AND hotel_sec = '".$args["hotel_sec"]."' ";	
		}
		//Description	
		$sql .= "online_reservation	= '".$args["online_reservation"]."', ";	
		$sql .= "adult	= '".$args["adult"]."', ";	
		$sql .= "child	= '".$args["child"]."', ";	
		$sql .= "availability_check	= '".$args["availability_check"]."', ";	
		$sql .= "arrival_date	= '".$args["arrival_date"]."', ";	
		$sql .= "departure_date	= '".$args["departure_date"]."', ";
		$sql .= "room_availability	= '".$args["room_availability"]."', ";
		$sql .= "room_type	= '".$args["room_type"]."', ";
		$sql .= "person	= '".$args["person"]."', ";
		$sql .= "night	= '".$args["night"]."', ";
		$sql .= "average	= '".$args["average"]."', ";
		$sql .= "no_of_room	= '".$args["no_of_room"]."', ";
		$sql .= "net_per_stay	= '".$args["net_per_stay"]."', ";
		$sql .= "book_now	= '".$args["book_now"]."', ";
		$sql .= "choose_your_room	= '".$args["choose_your_room"]."', ";
		$sql .= "your_booking_detail	= '".$args["your_booking_detail"]."', ";
		$sql .= "confirm_your_payment	= '".$args["confirm_your_payment"]."', ";
		
		$sql .= "included	= '".$args["included"]."', ";
		$sql .= "excluded	= '".$args["excluded"]."', ";
		$sql .= "breakfast	= '".$args["breakfast"]."', ";
		$sql .= "room_left	= '".$args["room_left"]."', ";
		$sql .= "tax	= '".$args["tax"]."', ";
		$sql .= "service	= '".$args["service"]."', ";
		$sql .= "early_bird	= '".$args["early_bird"]."', ";
		$sql .= "hot_deal	= '".$args["hot_deal"]."', ";
		$sql .= "max_adult	= '".$args["max_adult"]."', ";
		$sql .= "person_per_room	= '".$args["person_per_room"]."', ";
		$sql .= "allow_extra_adult	= '".$args["allow_extra_adult"]."', ";
		$sql .= "allow_extra_child	= '".$args["allow_extra_child"]."', ";
		$sql .= "extra_adult_charge	= '".$args["extra_adult_charge"]."', ";
		$sql .= "extra_children_charge	= '".$args["extra_children_charge"]."', ";
		$sql .= "max_children_age	= '".$args["max_children_age"]."', ";
		$sql .= "year_old	= '".$args["year_old"]."', ";
		
		$sql .= "fully_book	= '".$args["fully_book"]."', ";
		$sql .= "pay_latter	= '".$args["pay_latter"]."', ";
		$sql .= "discount	= '".$args["discount"]."', ";
		$sql .= "room_charge	= '".$args["room_charge"]."', ";
		$sql .= "compulsory	= '".$args["compulsory"]."', ";
		$sql .= "hotel_policy	= '".$args["hotel_policy"]."' ";
						
		$sql .= "WHERE ID = '".$args["ID"]."' ".$hotel." ";	
		mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error()); 
		
		return mysql_affected_rows();
	}
	
	function updatedaymonthLanguage($args)
	
	{
		mysql_query("SET NAMES 'utf8' COLLATE 'utf8_general_ci';");
		$sql  = "UPDATE hotel_language SET ";
		
		if($args["selecthotel"] == 'All Hotel'){
		$hotel = "";	
		}
		else {
		$hotel = "AND hotel_sec = '".$args["hotel_sec"]."' ";	
		}
		//Description	
		$sql .= "sunday	= '".$args["sunday"]."', ";	
		$sql .= "monday	= '".$args["monday"]."', ";	
		$sql .= "tuesday	= '".$args["tuesday"]."', ";	
		$sql .= "wednesday	= '".$args["wednesday"]."', ";	
		$sql .= "thursday	= '".$args["thursday"]."', ";	
		$sql .= "friday	= '".$args["friday"]."', ";
		$sql .= "saturday	= '".$args["saturday"]."', ";
		
		$sql .= "january	= '".$args["january"]."', ";
		$sql .= "february	= '".$args["february"]."', ";
		$sql .= "march	= '".$args["march"]."', ";
		$sql .= "april	= '".$args["april"]."', ";
		$sql .= "may	= '".$args["may"]."', ";
		$sql .= "june	= '".$args["june"]."', ";
		$sql .= "july	= '".$args["july"]."', ";
		$sql .= "august	= '".$args["august"]."', ";
		$sql .= "september	= '".$args["september"]."', ";
		$sql .= "october	= '".$args["october"]."', ";
		$sql .= "november	= '".$args["november"]."', ";
		$sql .= "december	= '".$args["december"]."' ";
						
		$sql .= "WHERE ID = '".$args["ID"]."' ".$hotel." ";	
		mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error()); 
		
		return mysql_affected_rows();
	}
	
	function updatebookingLanguage($args)
	
	{
		mysql_query("SET NAMES 'utf8' COLLATE 'utf8_general_ci';");
		$sql  = "UPDATE hotel_language SET ";
		if($args["selecthotel"] == 'All Hotel'){
		$hotel = "";	
		}
		else {
		$hotel = "AND hotel_sec = '".$args["hotel_sec"]."' ";	
		}
		//Description	
		$sql .= "daily_rate	= '".$args["daily_rate"]."', ";	
		$sql .= "booking_summary	= '".$args["booking_summary"]."', ";	
		$sql .= "reservation_info	= '".$args["reservation_info"]."', ";	
		$sql .= "contact_detail	= '".$args["contact_detail"]."', ";	
		$sql .= "special_request	= '".$args["special_request"]."', ";	
		$sql .= "tcontinue	= '".$args["tcontinue"]."', ";
		$sql .= "cancellation_policy	= '".$args["cancellation_policy"]."', ";
		$sql .= "none_refund	= '".$args["none_refund"]."', ";
		
		$sql .= "title	= '".$args["title"]."', ";
		$sql .= "first_name	= '".$args["first_name"]."', ";
		$sql .= "last_name	= '".$args["last_name"]."', ";
		$sql .= "address	= '".$args["address"]."', ";
		$sql .= "city	= '".$args["city"]."', ";
		$sql .= "country	= '".$args["country"]."', ";
		$sql .= "nationality	= '".$args["nationality"]."', ";
		$sql .= "email	= '".$args["email"]."', ";
		$sql .= "bed_preference	= '".$args["bed_preference"]."', ";
		$sql .= "smoking_preference	= '".$args["smoking_preference"]."', ";
		$sql .= "arrival_detail	= '".$args["arrival_detail"]."', ";
		$sql .= "arrival_time	= '".$args["arrival_time"]."', ";
		
		$sql .= "deposit_guarantee	= '".$args["deposit_guarantee"]."', ";
		$sql .= "total_charge	= '".$args["total_charge"]."', ";
		$sql .= "contact_to	= '".$args["contact_to"]."', ";
		$sql .= "subject	= '".$args["subject"]."', ";
		$sql .= "message	= '".$args["message"]."', ";
		$sql .= "send_message	= '".$args["send_message"]."', ";
		
		$sql .= "show_more_extra	= '".$args["show_more_extra"]."', ";
		$sql .= "please_write_data	= '".$args["please_write_data"]."', ";
		$sql .= "please_write	= '".$args["please_write"]."', ";
		$sql .= "receive_email	= '".$args["receive_email"]."', ";
		$sql .= "special_request_text	= '".$args["special_request_text"]."', ";
		$sql .= "i_agree	= '".$args["i_agree"]."', ";
		$sql .= "cancellation_date	= '".$args["cancellation_date"]."' ";
						
		$sql .= "WHERE ID = '".$args["ID"]."' ".$hotel." ";
		mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error()); 
		
		return mysql_affected_rows();
	}
	
	function updateHotelControlLanguage($args)
	
	{
		mysql_query("SET NAMES 'utf8' COLLATE 'utf8_general_ci';");
		$sql  = "UPDATE icontrol_language SET ";
		if($args["selecthotel"] == 'All Hotel'){
		$hotel = "";	
		}
		else {
		$hotel = "AND hotel_sec = '".$args["hotel_sec"]."' ";	
		}
		//Description
		
		$sql .= "tproperty_name	= '".$args["tproperty_name"]."', ";	
		$sql .= "tproperty_type	= '".$args["tproperty_type"]."', ";	
		$sql .= "thotel_standard	= '".$args["thotel_standard"]."', ";	
		$sql .= "ttotal_room	= '".$args["ttotal_room"]."', ";	
		$sql .= "tyear_built	= '".$args["tyear_built"]."', ";	
		$sql .= "tyear_renervate	= '".$args["tyear_renervate"]."', ";
		$sql .= "taddress	= '".$args["taddress"]."', ";
		$sql .= "tcity	= '".$args["tcity"]."', ";		
		$sql .= "tprovince	= '".$args["tprovince"]."', ";
		$sql .= "tcountry	= '".$args["tcountry"]."', ";
		$sql .= "ttelephone	= '".$args["ttelephone"]."', ";
		$sql .= "tfax	= '".$args["tfax"]."', ";
		$sql .= "thomepage	= '".$args["thomepage"]."', ";
		$sql .= "temail	= '".$args["temail"]."', ";
		$sql .= "tpostalcode	= '".$args["tpostalcode"]."', ";
		
		$sql .= "tcontact_name	= '".$args["tcontact_name"]."', ";
		$sql .= "tcontact_position	= '".$args["tcontact_position"]."', ";
		$sql .= "tcontact_email	= '".$args["tcontact_email"]."', ";
		$sql .= "trsvn_name	= '".$args["trsvn_name"]."', ";
		$sql .= "trsvn_position	= '".$args["trsvn_position"]."', ";
		$sql .= "trsvn_email	= '".$args["trsvn_email"]."', ";
		
		$sql .= "ttitle	= '".$args["ttitle"]."', ";
		$sql .= "tdescription	= '".$args["tdescription"]."', ";
		$sql .= "tlogo	= '".$args["tlogo"]."', ";
		$sql .= "tmainphoto	= '".$args["tmainphoto"]."', ";
		$sql .= "tgallery	= '".$args["tgallery"]."', ";
		$sql .= "ttagtitle	= '".$args["ttagtitle"]."', ";
		$sql .= "ttagdescription	= '".$args["ttagdescription"]."', ";
		$sql .= "ttagkeyword	= '".$args["ttagkeyword"]."', ";
		$sql .= "ttaguserdefind	= '".$args["ttaguserdefind"]."' ";
						
		$sql .= "WHERE ID = '".$args["ID"]."' ".$hotel." ";
		mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error()); 
		
		return mysql_affected_rows();
	}
	
	function updateRoomControlLanguage($args)
	
	{
		mysql_query("SET NAMES 'utf8' COLLATE 'utf8_general_ci';");
		$sql  = "UPDATE icontrol_language SET ";
		if($args["selecthotel"] == 'All Hotel'){
		$hotel = "";	
		}
		else {
		$hotel = "AND hotel_sec = '".$args["hotel_sec"]."' ";	
		}
		//Description
		
		$sql .= "troom_type	= '".$args["troom_type"]."', ";	
		$sql .= "trackrate	= '".$args["trackrate"]."', ";	
		$sql .= "troom_details	= '".$args["troom_details"]."', ";	
		$sql .= "troom_info	= '".$args["troom_info"]."', ";	
		$sql .= "troom_condition	= '".$args["troom_condition"]."', ";	
		$sql .= "troom_amenity	= '".$args["troom_amenity"]."', ";
		$sql .= "tbed_config	= '".$args["tbed_config"]."', ";
		$sql .= "tadd_master_room	= '".$args["tadd_master_room"]."', ";		
		$sql .= "tmin_stay	= '".$args["tmin_stay"]."', ";
		$sql .= "tmax_stay	= '".$args["tmax_stay"]."', ";
		$sql .= "troom_status	= '".$args["troom_status"]."', ";
		$sql .= "thighlight	= '".$args["thighlight"]."', ";
		
		$sql .= "troom_code	= '".$args["troom_code"]."', ";
		$sql .= "troom_size	= '".$args["troom_size"]."', ";
		$sql .= "tsqm	= '".$args["tsqm"]."', ";
		$sql .= "tamenity_name	= '".$args["tamenity_name"]."', ";
		$sql .= "tvalue	= '".$args["tvalue"]."', ";
		$sql .= "tadd	= '".$args["tadd"]."' ";
						
		$sql .= "WHERE ID = '".$args["ID"]."' ".$hotel." ";
		mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error()); 
		
		return mysql_affected_rows();
	}
				
} // END OF CLASS 
?>