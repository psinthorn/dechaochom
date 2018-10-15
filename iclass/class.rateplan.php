<?PHP 

class rateplan { 





// FUNCTION : Promotion CONSTRUCTORS

	function Rateplan()

	{ 

	// #################### //

	} // END FUNCTION


// FUNCTION : INSERT "Promotion"

	function insertRateplan($args)

	{
	
		$ref = md5(uniqid(rand()));
		$ref2 = substr($ref,0,6);
		$ref3 = strtoupper($ref2);
		$sql  = "INSERT INTO rate_plan VALUES (";
		$sql .= "NULL, ";
		$sql .= "'".$args["rate_plan_name"]."', ";		
		$sql .= "'".$args["room_id"]."', ";
		$sql .= "'".$args["master_rate_id"]."', ";
		$sql .= "'".$args["hotel_sec"]."', ";
		$sql .= "'".$args["ABF"]."', ";
		$sql .= "'".$args["minimum_stay"]."', ";
		$sql .= "'".$args["maximum_stay"]."', ";
		$sql .= "'".$args["early_book"]."', ";
		$sql .= "'".$args["discount_type"]."', ";
		$sql .= "'".$args["discount"]."', ";
		$sql .= "'".$args["deposit"]."', ";
		$sql .= "'".$args["cancellation"]."', ";
		$sql .= "'".$args["cancel_day"]."', ";
		$sql .= "'".$args["booking_from"]."', ";
		$sql .= "'".$args["booking_to"]."', ";
		$sql .= "'".$args["stay_from"]."', ";
		$sql .= "'".$args["stay_to"]."', ";
		$sql .= "'0', ";
		$sql .= "'1', ";
		$sql .= "'".$args["active_day"]."' ,";
		$sql .= "'".$ref3."', ";
		$sql .= "'".$args["user_update"]."', ";
		$sql .= "'".date("Y-m-d H:i:s")."' )"; // TIMESTAMP
		mysql_query($sql); 
		return mysql_insert_id();

	} // END FUNCTION
	// FUNCTION : UPDATE "Promotion"
	function updateRateplan($args)
	{
		
		$sql  = "UPDATE rate_plan SET ";
		$sql .= "rate_plan_name 		= '".$args["rate_plan_name"]."', ";
		$sql .= "minimum_stay 	= '".$args["minimum_stay"]."', ";
		$sql .= "maximum_stay  = '".$args["maximum_stay"]."', ";
		$sql .= "early_book  = '".$args["early_book"]."', ";
		$sql .= "discount_type  = '".$args["discount_type"]."', ";
		$sql .= "discount 		= '".$args["discount"]."', ";
		$sql .= "deposit 		= '".$args["deposit"]."', ";
		$sql .= "cancellation 		= '".$args["cancellation"]."', ";
		$sql .= "cancel_day 		= '".$args["cancel_day"]."', ";
		$sql .= "booking_from 		= '".$args["booking_from"]."', ";
		$sql .= "booking_to 		= '".$args["booking_to"]."', ";
		$sql .= "stay_from 		= '".$args["stay_from"]."', ";
		$sql .= "stay_to 		= '".$args["stay_to"]."', ";			
		$sql .= "last_update 		= '".date("Y-m-d H:i:s")."', ";
		$sql .= "user_update 		= '".$args["user_update"]."', ";
		$sql .= "active_day 		= '".$args["active_day"]."' ";
		$sql .= "WHERE rate_plan_id 		= '".$args["rate_plan_id"]."' ";
		mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error()); 
		return mysql_affected_rows();
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

// FUNCTION : GET ALL "Master rate"

	function getAllMaster($hotel_sec)

	{

		$sql  = "SELECT *, room_type, master_rate.minimum_stay, master_rate.maximum_stay, master_rate.deposit FROM master_rate LEFT JOIN room ON master_rate.room_id = room.room_id WHERE master_rate.hotel_sec = '".$hotel_sec."' ORDER BY master_rate.room_id ";
		$query = mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error()); 
		$i = 0;

		while ($row = mysql_fetch_array($query)) {

			$result[$i]["master_rate_id"]			= $row["master_rate_id"];
			$result[$i]["room_type"]			= $row["room_type"];	
			$result[$i]["room_id"]		= $row["room_id"];
			$result[$i]["hotel_sec"]		= $row["hotel_sec"];
			$result[$i]["ABF"]		= $row["ABF"];
			$result[$i]["minimum_stay"]		= $row["minimum_stay"];
			$result[$i]["maximum_stay"] 		= $row["maximum_stay"];
			$result[$i]["discount_type"]		= $row["discount_type"];
			$result[$i]["discount"]		= $row["discount"];
			$result[$i]["deposit"]		= $row["deposit"];
			$result[$i]["master_rate_status"] 		= $row["master_rate_status"];
			$result[$i]["user_update"] 		= $row["user_update"];
			$result[$i]["last_update"] 		= $row["last_update"];
			$i++;

		}

		return $result;	

	} // END FUNCTION
	function insertMasterRate($args)
	{
		$sql  = "INSERT INTO master_rate VALUES (";
		$sql .= "NULL, ";
		$sql .= "'".$args["room_id"]."', ";
		$sql .= "'".$args["hotel_sec"]."', ";
		$sql .= "'".$args["ABF"]."', ";
		$sql .= "'".$args["minimum_stay"]."', ";
		$sql .= "'".$args["maximum_stay"]."', ";
		$sql .= "'PERCENT', ";
		$sql .= "'0', ";
		$sql .= "'".$args["deposit"]."', ";
		$sql .= "'1', ";
		$sql .= "'".$args["user_update"]."', "; // TIMESTAMP
		$sql .= "'".date("Y-m-d H:i:s")."' )"; // TIMESTAMP
		mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error()); 
		return mysql_insert_id();
	} // END FUNCTION

	// FUNCTION : DELETE "Master rate"
	function deleteMasterRate($master_rate_id)
	{
		$sql = "DELETE FROM master_rate ";
		$sql .= "WHERE master_rate_id = '".$master_rate_id."' ";
		mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error()); 
		return  mysql_affected_rows();
	} // END FUNCTION
	// FUNCTION : DELETE "Master rate"
	function deleteRateplan($rate_plan_id)
	{
		$sql = "DELETE FROM rate_plan ";
		$sql .= "WHERE rate_plan_id = '".$rate_plan_id."' ";
		mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error()); 
		return  mysql_affected_rows();
	} // END FUNCTION
	// FUNCTION : DELETE "allroom"
	function deleteRateplanAllotment($rate_plan_id)
	{
		$sql = "DELETE FROM rate_plan_allotment ";
		$sql .= "WHERE rate_plan_id = '".$rate_plan_id."' ";
		mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error()); 
		return  mysql_affected_rows();
	} // END FUNCTION

	// FUNCTION : UPDATE "Master rate"
	function updateMasterRate($args)
	{
		$sql  = "UPDATE master_rate SET ";
		$sql .= "ABF		= '".$args["ABF"]."', ";
		$sql .= "minimum_stay		= '".$args["minimum_stay"]."', ";
		$sql .= "maximum_stay		= '".$args["maximum_stay"]."', ";
		$sql .= "deposit		= '".$args["deposit"]."', ";
		$sql .= "master_rate_status		= '".$args["master_rate_status"]."', ";
		$sql .= "user_update		= '".$args["user_update"]."', ";
		$sql .= "last_update 		= '".date("Y-m-d H:i:s")."' ";
		$sql .= "WHERE master_rate_id 		= '".$args["master_rate_id"]."' ";
		mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error()); 
		return mysql_affected_rows();
	} // END FUNCTION

	// FUNCTION : UPDATE "Master Status"
	function updateMasterStatus($args)
	{
		$sql  = "UPDATE master_rate SET ";
		$sql .= "master_rate_status		= '".$args["master_rate_status"]."', ";
		$sql .= "user_update		= '".$args["user_update"]."', ";
		$sql .= "last_update 		= '".date("Y-m-d H:i:s")."' ";
		$sql .= "WHERE master_rate_id 		= '".$args["master_rate_id"]."' ";
		mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error()); 
		return mysql_affected_rows();
	} // END FUNCTION

	function updateRateplanStatus($args)
	{
		$sql  = "UPDATE rate_plan SET ";
		$sql .= "rate_plan_status		= '".$args["rate_plan_status"]."', ";
		$sql .= "user_update		= '".$args["user_update"]."', ";
		$sql .= "last_update 		= '".date("Y-m-d H:i:s")."' ";
		$sql .= "WHERE rate_plan_id 		= '".$args["rate_plan_id"]."' ";
		mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error()); 
		return mysql_affected_rows();
	} // END FUNCTION

// FUNCTION : GET ALL "RatePlan"

	function getAllRatePlan($hotel_sec)

	{

		$sql  = "SELECT * FROM rate_plan WHERE hotel_sec = '".$hotel_sec."' ORDER BY room_id";
		$query = mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error()); 
		$i = 0;

		while ($row = mysql_fetch_array($query)) {

			$result[$i]["rate_plan_id"]			= $row["rate_plan_id"];
			$result[$i]["rate_plan_name"]			= $row["rate_plan_name"];	
			$result[$i]["room_id"]		= $row["room_id"];
			$result[$i]["hotel_sec"]		= $row["hotel_sec"];
			$result[$i]["ABF"]		= $row["ABF"];
			$result[$i]["minimum_stay"]		= $row["minimum_stay"];
			$result[$i]["maximum_stay"] 		= $row["maximum_stay"];
			$result[$i]["discount_type"]		= $row["discount_type"];
			$result[$i]["discount"]		= $row["discount"];
			$result[$i]["deposit"]		= $row["deposit"];
			$result[$i]["rate_plan_priority"]		= $row["rate_plan_priority"];
			$result[$i]["rate_plan_status"] 		= $row["rate_plan_status"];
			$result[$i]["user_update"] 		= $row["user_update"];
			$result[$i]["last_update"] 		= $row["last_update"];
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

// FUNCTION : GET "allotment" by "Date"
	function getRateplanAllotmentFix($rate_plan_id, $fix_date)
	{
		$sql  = "SELECT * FROM rate_plan_allotment ";
		$sql .= "WHERE rate_plan_id = '".$rate_plan_id."' ";
		$sql .= "AND fix_date = '".$fix_date."' ";
		$query = mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error());  
		return mysql_fetch_array($query);
	} // END FUNCTION

// FUNCTION : INSERT "allotment"
	function insertRateplanAllotment($args)
	{
		$sql  = "INSERT INTO rate_plan_allotment VALUES (";
		$sql .= "NULL, ";
		$sql .= "'".$args["rate_plan_id"]."', ";
		$sql .= "'".$args["master_rate_id"]."', ";
		$sql .= "'".$args["room_id"]."', ";
		$sql .= "'".$args["fix_date"]."', ";
		$sql .= "'".$args["discount"]."', ";
		$sql .= "'".$args["discount_type"]."', ";
		$sql .= "'".$args["rate"]."', ";		
		$sql .= "'".$args["deposit"]."', ";
		$sql .= "'1', ";
		$sql .= "'".date("Y-m-d H:i:s")."', "; // TIMESTAMP
		$sql .= "'".$args["week_day"]."' )"; // TIMESTAMP
		mysql_query($sql); 
		return mysql_insert_id();
	} // END FUNCTION

	// FUNCTION : UPDATE "allotment"
	function updateAllotmentDetails($args)
	{
		$sql  = "UPDATE rate_plan_allotment SET ";
		$sql .= "discount 	= '".$args["discount"]."', ";
		$sql .= "discount_type 	= '".$args["discount_type"]."', ";
		$sql .= "rate 	= '".$args["rate"]."', ";
		$sql .= "deposit 	= '".$args["deposit"]."', ";
		$sql .= "week_day 	= '".$args["week_day"]."', ";
		$sql .= "lastupdate 	= '".date("Y-m-d H:i:s")."' ";
		$sql .= "WHERE fix_date = '".$args["fix_date"]."' AND rate_plan_id = '".$args["rate_plan_id"]."' ";
		mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error()); 
		return mysql_affected_rows();
	} // END FUNCTION		
		
} // END OF CLASS 

?>