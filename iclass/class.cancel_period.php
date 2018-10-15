<?PHP 
class Period { 
// FUNCTION : Period CONSTRUCTORS
	function Period()
	{ 
	// #################### //
	} // END FUNCTION

// FUNCTION : INSERT "Period"
	function insertPeriod($args){
		$sql  = "INSERT INTO cancel_period VALUES (";
		$sql .= "NULL, ";
		$sql .= "'".$args["hotel_sec"]."', ";
		$sql .= "'".$args["hotel_id"]."', ";
		$sql .= "'".$args["period_name"]."', ";
		$sql .= "'".$args["period_details"]."', ";		
		$sql .= "'".$args["valid_from"]."', ";
		$sql .= "'".$args["valid_to"]."', ";
		$sql .= "'".$args["cancel_day"]."', ";
		$sql .= "'".$args["noshow_charge"]."', ";
		$sql .= "'".$args["cancel_charge"]."', ";
		$sql .= "'".$args["early_checkout_charge"]."', ";
		$sql .= "'".$args["period_status"]."', ";
		$sql .= "'".date("Y-m-d H:i:s")."' )"; // TIMESTAMP
		$query = mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error()); 
		return mysql_insert_id();
	}

// 1_2_3_period	
	function updateCancelPeriod($args){ 
		$sql  = "UPDATE cancel_period SET ";
		$sql .= "period_name 	= '".$args["period_name"]."', ";
		$sql .= "period_details 	= '".$args["period_details"]."', ";		
		$sql .= "valid_from 	= '".$args["valid_from"]."', ";
		$sql .= "valid_to 	= '".$args["valid_to"]."', ";
		$sql .= "cancel_day	= '".$args["cancel_day"]."', ";
		$sql .= "noshow_charge	= '".$args["noshow_charge"]."', ";
		$sql .= "cancel_charge	= '".$args["cancel_charge"]."', ";
		$sql .= "early_checkout_charge	= '".$args["early_checkout_charge"]."' ";
		$sql .= "WHERE period_id= '".$args["period_id"]."' ";
		$query = mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error()); 
		return mysql_affected_rows();
	}
// FUNCTION : DELETE "Period"	
	function deletePeriod($period_id){
		$sql  = "DELETE FROM cancel_period ";
		$sql .= "WHERE period_id = '".$period_id."' ";
		$query = mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error()); 
		return mysql_affected_rows();
	}

// FUNCTION : GET "Period"
	function getPeriod($period_id){
		$sql  = "SELECT *, ";
		$sql .= "DATE_FORMAT(valid_from, '%d/%m/%Y') AS date01, ";
		$sql .= "DATE_FORMAT(valid_to, '%d/%m/%Y') AS date02 ";
		$sql .= "FROM cancel_period ";
		$sql .= "WHERE period_id = '".$period_id."' ";
		$query = mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error()); 
		return mysql_fetch_array($query);
	}

// FUNCTION : GET All "Period"
	function getAllPeriod($hotel_sec){
		$sql  = "SELECT *, ";
		$sql .= "DATE_FORMAT(valid_from, '%d %M %Y') AS date01, ";
		$sql .= "DATE_FORMAT(valid_to, '%d %M %Y') AS date02, ";
		$sql .= "DATE_FORMAT(valid_from, '%d %b \'%y') AS date03, ";
		$sql .= "DATE_FORMAT(valid_to, '%d %b \'%y') AS date04 ";
		$sql .= "FROM cancel_period ";
		$sql .= "WHERE hotel_sec = '".$hotel_sec."' ";
		$sql .= "ORDER BY valid_from ASC";	
		$query = mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error()); 
		$i = 0;
		while ($row = mysql_fetch_array($query)) {
			$result[$i]["period_id"] 	= $row["period_id"];
			$result[$i]["hotel_sec"] 	= $row["hotel_sec"];			
			$result[$i]["period_name"] 	= $row["period_name"];
			$result[$i]["period_details"] 	= $row["period_details"];			
			$result[$i]["valid_from"] 	= $row["valid_from"];
			$result[$i]["valid_to"] 	= $row["valid_to"];
			$result[$i]["date01"] 		= $row["date01"];
			$result[$i]["date02"] 		= $row["date02"];
			$result[$i]["date03"] 		= $row["date03"];
			$result[$i]["date04"] 		= $row["date04"];
			$result[$i]["cancel_day"] 		= $row["cancel_day"];
			$result[$i]["noshow_charge"] 		= $row["noshow_charge"];			
			$result[$i]["cancel_charge"] 		= $row["cancel_charge"];
			$result[$i]["early_checkout_charge"] 		= $row["early_checkout_charge"];	
			$result[$i]["period_status"]= $row["period_status"];
			$i++;
		}
		return $result;	
	}

} // END OF CLASS 

?>