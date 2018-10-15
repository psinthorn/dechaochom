<?PHP 

class promotion { 





// FUNCTION : Promotion CONSTRUCTORS

	function Promotion()

	{ 

	// #################### //

	} // END FUNCTION


// FUNCTION : INSERT "Promotion"

	function insertPromotion($args)

	{
	$bookingfrom 		= explode("/", $_POST["booking_from"]);
	$bookingto 		= explode("/", $_POST["booking_to"]);
	$args["booking_from"]	= date("Y-m-d", mktime(0,0,0, intval($bookingfrom[1]), intval($bookingfrom[0]), intval($bookingfrom[2])));
	$args["booking_to"]	= date("Y-m-d", mktime(0,0,0, intval($bookingto[1]), intval($bookingto[0]), intval($bookingto[2])));
	
	$travelfrom 		= explode("/", $_POST["travel_from"]);
	$travelto 		= explode("/", $_POST["travel_to"]);
	$args["travel_from"]	= date("Y-m-d", mktime(0,0,0, intval($travelfrom[1]), intval($travelfrom[0]), intval($travelfrom[2])));
	$args["travel_to"]	= date("Y-m-d", mktime(0,0,0, intval($travelto[1]), intval($travelto[0]), intval($travelto[2])));
	
		$ref = md5(uniqid(rand()));
		$ref2 = substr($ref,0,6);
		$ref3 = strtoupper($ref2);
		$sql  = "INSERT INTO promotion VALUES (";
		$sql .= "NULL, ";
		$sql .= "'".$args["pro_name"]."', ";		
		$sql .= "'".$args["pro_type"]."', ";
		$sql .= "'".$args["pro_details"]."', ";
		$sql .= "'".$ref3."', ";
		$sql .= "'".$args["cancellation"]."', ";
		$sql .= "'".$args["hotel_sec"]."', ";
		$sql .= "'".$args["pro_status"]."', ";
		if($args["pro_type"] == '1'){
		if($args["discount_type1"] == 'PERCENT'){
		$sql .= "'".$args["discount1"]."', ";
		$sql .= "'', ";
		$sql .= "'PERCENT', ";
		}
		else {
		$sql .= "'', ";
		$sql .= "'".$args["discount1"]."', ";	
		$sql .= "'AMOUNT', ";	
		}
		}
		//
		else if($args["pro_type"] == '2'){	
		if($args["discount_type2"] == 'PERCENT'){
		$sql .= "'".$args["discount2"]."', ";
		$sql .= "'', ";
		$sql .= "'PERCENT', ";	
		}
		else {
		$sql .= "'', ";		
		$sql .= "'".$args["discount2"]."', ";
		$sql .= "'AMOUNT', ";
		}
		}
		else {
		$sql .= "'', ";
		$sql .= "'', ";
		$sql .= "'', ";
		}
		$sql .= "'".$args["early_day"]."', ";
		$sql .= "'".$args["stay"]."', ";
		$sql .= "'".$args["pay"]."', ";	
		$sql .= "'".$args["price"]."', ";	
		$sql .= "'".$args["minimum_stay"]."', ";
		$sql .= "'".$args["extend_stay"]."', ";
		$sql .= "'".$args["deposit"]."', ";
		$sql .= "'".$args["booking_from"]."', ";
		$sql .= "'".$args["booking_to"]."', ";
		$sql .= "'".$args["travel_from"]."', ";
		$sql .= "'".$args["travel_to"]."', ";
		$sql .= "'".date("Y-m-d H:i:s")."' ,"; // TIMESTAMP
		$sql .= "'".$args["user_update"]."', ";
		$sql .= "'".$args["only_day"]."' )";
		mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error()); 
		return mysql_insert_id();

	} // END FUNCTION
	
	function insertPromotionRoom($args, $room_id, $pro_id)

	{
		$ref = md5(uniqid(rand()));
		$ref2 = substr($ref,0,6);
		$ref3 = strtoupper($ref2);
		$sql  = "INSERT INTO pro_room VALUES (";
		$sql .= "NULL, ";
		$sql .= "'".$room_id."', ";
		$sql .= "'".$args["hotel_sec"]."', ";
		$sql .= "'".$pro_id."', ";		
		$sql .= "'".$args["pro_type"]."', ";
		$sql .= "'".$args["pro_status"]."', ";
		$sql .= "'".date("Y-m-d H:i:s")."' )"; // TIMESTAMP
		mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error()); 
		return mysql_insert_id();

	} // END FUNCTION
	
	function getAllotmentFix($pro_id, $fix_date)
	{
		$sql  = "SELECT * FROM pro_allotment ";
		$sql .= "WHERE allotment_pro_id = '".$pro_id."' ";
		$sql .= "AND fix_date = '".$fix_date."' ";
		$query = mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error());  
		return mysql_fetch_array($query);
	} // END FUNCTION
	
	function insertProAllotment($args)
	{
		$sql  = "INSERT INTO pro_allotment VALUES (";
		$sql .= "NULL, ";
		$sql .= "'".$args["allotment_pro_id"]."', ";
		$sql .= "'".$args["fix_date"]."', ";
		$sql .= "'".$args["discount_per"]."', ";
		$sql .= "'".$args["discount_amount"]."', ";
		$sql .= "'".$args["discount_type"]."', ";
		$sql .= "'1', ";
		$sql .= "'".date("Y-m-d H:i:s")."', "; // TIMESTAMP
		$sql .= "'".$args["week_day"]."' )"; // TIMESTAMP
		mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error()); 
		return mysql_insert_id();
	} // END FUNCTION
	
	// FUNCTION : UPDATE "allotment"
	function updateProAllotmentPeriod($args)
	{
		$sql  = "UPDATE pro_allotment SET ";

		if($args["discount_per"] <> ''){
		$sql .= "discount 	= '".$args["discount_per"]."' , ";
		}
		
		if($_REQUEST["closeallot"] <> ''){
		$sql .= "allotment_status 	= '".$args["alloment_status"]."' , ";
		}
		$sql .= "discount_amount 	= '".$args["discount_amount"]."' , ";
		$sql .= "discount_type 	= '".$args["discount_type"]."' , ";
		$sql .= "lastupdate = '".date("Y-m-d H:i:s")."' ";
		$sql .= "WHERE allotment_pro_id = '".$args["pro_id"]."' ";
		$sql .= "AND (fix_date >= '".$args["valid_from"]."') ";	
		$sql .= "AND (fix_date <= '".$args["valid_to"]."') ".$args["week_day"]." ";
		mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error()); 
		return mysql_affected_rows();
	} // END FUNCTION
	
	// FUNCTION : UPDATE "allotment"
	function updateProAllotmentWeekday($args)
	{
		$sql  = "UPDATE pro_allotment SET ";

		$sql .= "week_day 	= '".$args["week_day"]."' ";
		$sql .= "WHERE fix_date = '".$args["fix_date"]."' ";
		mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error()); 
		return mysql_affected_rows();
	} // END FUNCTION
	
	
// FUNCTION : UPDATE "Promotion"
	function updatePromotion($args)
	{
		$bookingfrom 		= explode("/", $_POST["booking_from"]);
		$bookingto 		= explode("/", $_POST["booking_to"]);
		$args["booking_from"]	= date("Y-m-d", mktime(0,0,0, intval($bookingfrom[1]), intval($bookingfrom[0]), intval($bookingfrom[2])));
		$args["booking_to"]	= date("Y-m-d", mktime(0,0,0, intval($bookingto[1]), intval($bookingto[0]), intval($bookingto[2])));
		
		$travelfrom 		= explode("/", $_POST["travel_from"]);
		$travelto 		= explode("/", $_POST["travel_to"]);
		$args["travel_from"]	= date("Y-m-d", mktime(0,0,0, intval($travelfrom[1]), intval($travelfrom[0]), intval($travelfrom[2])));
		$args["travel_to"]	= date("Y-m-d", mktime(0,0,0, intval($travelto[1]), intval($travelto[0]), intval($travelto[2])));
		
		$sql  = "UPDATE promotion SET ";
		$sql .= "pro_name 		= '".$args["pro_name"]."', ";
		$sql .= "pro_details 	= '".$args["pro_details"]."', ";
		$sql .= "discount  = '".$args["discount"]."', ";
		$sql .= "discount_amount  = '".$args["discount_amount"]."', ";
		$sql .= "discount_type  = '".$args["discount_type"]."', ";
		$sql .= "cancellation 		= '".$args["cancellation"]."', ";
		$sql .= "early_day 		= '".$args["early_day"]."', ";
		$sql .= "stay 		= '".$args["stay"]."', ";
		$sql .= "pay 		= '".$args["pay"]."', ";
		$sql .= "price 		= '".$args["price"]."', ";
		if($args["pro_type"] == '3'){
		$sql .= "minimum_stay 		= '".$args["stay"]."', ";
		}
		else {
		$sql .= "minimum_stay 		= '".$args["minimum_stay"]."', ";	
		}
		$sql .= "extend_stay 		= '".$args["extend_stay"]."', ";
		$sql .= "deposit 		= '".$args["deposit"]."', ";
		$sql .= "booking_from 		= '".$args["booking_from"]."', ";
		$sql .= "booking_to 		= '".$args["booking_to"]."', ";
		$sql .= "travel_from 		= '".$args["travel_from"]."', ";
		$sql .= "travel_to 		= '".$args["travel_to"]."', ";						
		$sql .= "pro_status 		= '".$args["pro_status"]."', ";		
		$sql .= "lastupdate 		= '".date("Y-m-d H:i:s")."', ";
		$sql .= "user_update 		= '".$args["user_update"]."', ";
		$sql .= "only_day 		= '".$args["only_day"]."' ";
		$sql .= "WHERE pro_id 		= '".$args["pro_id"]."' ";
		mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error()); 
		return mysql_affected_rows();
	} // END FUNCTION
	
// FUNCTION : UPDATE "Promotion Details"
	function updatePromotionDetails($args)
	{
		$sql  = "UPDATE promotion SET ";
		$sql .= "pro_short 		= '".$args["pro_short"]."', ";
		$sql .= "pro_details 		= '".$args["pro_details"]."', ";
		$sql .= "benefits 		= '".$args["benefits"]."', ";
		$sql .= "transfer_rate 		= '".$args["transfer_rate"]."', ";
		$sql .= "transfer_adult	= '".$args["transfer_adult"]."', ";
		$sql .= "transfer_child		= '".$args["transfer_child"]."', ";
		$sql .= "last_update 		= '".date("Y-m-d H:i:s")."' ";
		$sql .= "WHERE pro_id 		= '".$args["pro_id"]."' ";
		mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error()); 
		return mysql_affected_rows();
	} // END FUNCTION	
	
// FUNCTION : UPDATE "Promotion Details"
	function updatePromotionBenefits($args)
	{
		$sql  = "UPDATE promotion SET ";
		$sql .= "benefits		= '".$args["benefits"]."', ";
		$sql .= "last_update 		= '".date("Y-m-d H:i:s")."' ";
		$sql .= "WHERE pro_id 		= '".$args["pro_id"]."' ";
		mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error()); 
		return mysql_affected_rows();
	} // END FUNCTION			


// FUNCTION : DELETE "room"
	function deletePromotion($pro_id)
	{
		$sql = "DELETE FROM promotion ";
		$sql .= "WHERE pro_id = '".$pro_id."' ";
		mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error()); 
		return  mysql_affected_rows();
	} // END FUNCTION	

// FUNCTION : GET "Promotion"
	function getPromotion($pro_id)
{
		$sql  = "SELECT * FROM promotion ";
		$sql .= "WHERE pro_id = '".$pro_id."' ";
		$result = mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error()); 
		return mysql_fetch_array($result);	
	}	




// FUNCTION : GET ALL "Promotion"

	function getAllPromotion($hotel_sec)

	{

		$sql  = "SELECT * FROM promotion LEFT JOIN promotion_type on pro_type = pro_type_id WHERE hotel_sec = '".$hotel_sec."'";
		$sql .= "ORDER BY travel_from, pro_id ASC ";
		$query = mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error()); 
		$i = 0;

		while ($row = mysql_fetch_array($query)) {

			$result[$i]["pro_id"]			= $row["pro_id"];
			$result[$i]["pro_name"]			= $row["pro_name"];
			$result[$i]["pro_type"]			= $row["pro_type"];	
			$result[$i]["pro_details"]		= $row["pro_details"];
			$result[$i]["social_link"]		= $row["social_link"];
			$result[$i]["cancellation"]		= $row["cancellation"];
			$result[$i]["hotel_sec"]		= $row["hotel_sec"];
			$result[$i]["pro_status"] 		= $row["pro_status"];
			$result[$i]["discount"]		= $row["discount"];
			$result[$i]["discount_amount"]		= $row["discount_amount"];
			$result[$i]["discount_type"]		= $row["discount_type"];
			$result[$i]["early_day"] 		= $row["early_day"];
			$result[$i]["stay"] 		= $row["stay"];
			$result[$i]["pay"] 		= $row["pay"];
			$result[$i]["price"] 		= $row["price"];
			$result[$i]["minimum_stay"]		= $row["minimum_stay"];
			$result[$i]["extend_stay"] 		= $row["extend_stay"];
			$result[$i]["booking_from"] 		= $row["booking_from"];
			$result[$i]["booking_to"] 		= $row["booking_to"];
			$result[$i]["travel_from"] 		= $row["travel_from"];
			$result[$i]["travel_to"] 		= $row["travel_to"];
			$result[$i]["lastupdate"] 		= $row["lastupdate"];
			$result[$i]["pro_type_name"] 		= $row["pro_type_name"];
			$result[$i]["lastupdate"] 		= $row["lastupdate"];
			$result[$i]["user_update"] 		= $row["user_update"];
			$result[$i]["only_day"] 		= $row["only_day"];
			$i++;

		}

		return $result;	

	} // END FUNCTION

	

// FUNCTION : GET ALL "Promotion Type"

	function getAllPromotionType()

	{

		$sql  = "SELECT * FROM promotion_type ";

		$sql .= "ORDER BY pro_type_id ASC ";

		$query = mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error()); 

		$i = 0;

		while ($row = mysql_fetch_array($query)) {

			$result[$i]["pro_type_id"]			= $row["pro_type_id"];

			$result[$i]["pro_type_name"]			= $row["pro_type_name"];

			$result[$i]["pro_type_status"] 		= $row["pro_type_status"];

			$i++;

		}

		return $result;	

	} // END FUNCTION	

	

// FUNCTION : GET "Promotion Type"

	function getPromotionType($pro_type_id)

	{

		$sql  = "SELECT * FROM promotion_type ";

		$sql .= "WHERE pro_type_id = '".$pro_type_id."' ";

		$result = mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error()); 

		return mysql_fetch_array($result);	

	} // END FUNCTION	

	

// FUNCTION : INSERT "Promotion Type"

	function insertPromotionType($args)

	{

		$sql  = "INSERT INTO promotion_type VALUES (";

		$sql .= "NULL, ";

		$sql .= "'".$args["pro_type_name"]."', ";

		$sql .= "'".$args["pro_type_status"]."') ";

		mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error()); 

		return mysql_insert_id();



	} // END FUNCTION	

	

// FUNCTION : UPDATE "Promotion Type"

	function updatePromotionType($args)

	{

		$sql  = "UPDATE promotion_type SET ";

		$sql .= "pro_type_name		= '".$args["pro_type_name"]."', ";

		$sql .= "pro_type_status 		= '".$args["pro_type_status"]."' ";

		$sql .= "WHERE pro_type_id 		= '".$args["pro_type_id"]."' ";

		mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error()); 

		return mysql_affected_rows();

	} // END FUNCTION	

// FUNCTION : DELETE "room"
	function deletePromotionRoom($id)
	{
		$sql = "DELETE FROM pro_room ";
		$sql .= "WHERE id = '".$id."' ";
		mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error()); 
		return  mysql_affected_rows();
	} // END FUNCTION
	
	// FUNCTION : DELETE "allroom"
	function deletePromotionAllRoom($pro_id)
	{
		$sql = "DELETE FROM pro_room ";
		$sql .= "WHERE pro_room_pro_id = '".$pro_id."' ";
		mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error()); 
		return  mysql_affected_rows();
	} // END FUNCTION
	
	function deletePromotionAllallotment($pro_id)
	{
		$sql = "DELETE FROM pro_allotment ";
		$sql .= "WHERE allotment_pro_id = '".$pro_id."' ";
		mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error()); 
		return  mysql_affected_rows();
	} // END FUNCTION
	
function insertPackageBenefits($args, $extra_id, $pro_id)
	{
		$sql  = "INSERT INTO package_benefits VALUES (";
		$sql .= "NULL, ";
		$sql .= "'".$args["package_hotel_sec"]."', ";
		$sql .= "'".$args["package_name"]."', ";		
		$sql .= "'".$args["package_desc"]."', ";
		$sql .= "'".$args["package_value"]."', ";
		$sql .= "'".$pro_id."', ";
		$sql .= "'".$extra_id."' )";		
		mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error()); 
		return mysql_insert_id();
	} // END FUNCTION
	
	// FUNCTION : GET ALL "allotment" by "Month"
	function getProAllotmentPeriod($pro_id, $valid_from, $valid_to)
	{
		$sql  = "SELECT * FROM pro_allotment ";
		$sql .= "WHERE allotment_pro_id = '".$pro_id."' ";
		$sql .= "AND fix_date >= '".$valid_from."' ";
		$sql .= "AND fix_date <= '".$valid_to."' ";	
		$query = mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error());  
		while ($row = mysql_fetch_array($query)) {
			$result[$row["fix_date"]]["discount"]		= $row["discount"];
			$result[$row["fix_date"]]["discount_amount"]		= $row["discount_amount"];
			$result[$row["fix_date"]]["allotment_status"]		= $row["allotment_status"];
			
		}
		return $result;		
	} // END FUNCTION	
	
	function getProAllotmentDate($pro_id, $valid_from)
	{
		$sql  = "SELECT * FROM pro_allotment ";
		$sql .= "WHERE allotment_pro_id = '".$pro_id."' ";
		$sql .= "AND fix_date <= '".$valid_from."' ";	
		$query = mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error());  
		while ($row = mysql_fetch_array($query)) {
			$result[$row["fix_date"]]["discount"]		= $row["discount"];
			$result[$row["fix_date"]]["discount_amount"]		= $row["discount_amount"];
		}
		return $result;		
	} // END FUNCTION
	
	function getProCheckVal($pro_id, $valid_from, $valid_to)
	{
		$sql  = "SELECT COUNT(*) AS all_day ";
		$sql .= "FROM pro_allotment ";
		$sql .= "WHERE allotment_pro_id = '".$pro_id."' ";
		$sql .= "AND fix_date >= '".$valid_from."' ";
		$sql .= "AND fix_date < '".$valid_to."' ";
		$sql .= "AND allotment_status = '1' "; // ROOM STATUS = ON
		$query = mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error());  
		$row = mysql_fetch_array($query);
		return $row["all_day"];
	} // END FUNCTION
		
} // END OF CLASS 

?>