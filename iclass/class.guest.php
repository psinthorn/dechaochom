<?PHP 
class Guest { 
// FUNCTION : Room CONSTRUCTORS
	function Guest()
	{ 
	// #################### //
	} // END FUNCTION
	

	function insertContactMessage($args)
	{
		$sql  = "INSERT INTO contact_message VALUES (";
		$sql .= "'', ";		
		$sql .= "'".$args["message_id"]."', ";
		$sql .= "'".$args["hotel_sec"]."', ";
		$sql .= "'".$args["contact_to"]."', ";
		$sql .= "'".$args["contact_name"]."', ";
		$sql .= "'".$args["contact_email"]."', ";
		$sql .= "'".$args["contact_tel"]."', ";
		$sql .= "'".$args["subject"]."', ";
		$sql .= "'".$args["message"]."', ";
		$sql .= "'".date("Y-m-d")."', ";
		$sql .= "'".date("H:i:s")."', ";
		$sql .= "'', ";
		$sql .= "'', ";
		$sql .= "'' )";		
		mysql_query($sql); 
		return mysql_insert_id();
	} // END FUNCTION
	function GetMessage($contact_id)
	{
		$sql  = "SELECT * FROM contact_message WHERE contact_id = '".$contact_id."' ";
		$result = mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error()); 
		return mysql_fetch_array($result);	
	}

	function insertCareers($args)
	{
		$sql  = "INSERT INTO career_details VALUES (";
		$sql .= "'', ";		
		$sql .= "'".$args["reference"]."', ";
		$sql .= "'".$args["position"]."', ";
		$sql .= "'".$args["salary"]."', ";
		$sql .= "'".$args["available_date"]."', ";
		$sql .= "'".$args["full_name"]."', ";
		$sql .= "'".$args["birthday"]."', ";
		$sql .= "'".$args["gender"]."', ";
		$sql .= "'".$args["marital_status"]."', ";
		$sql .= "'".$args["national"]."', ";
		$sql .= "'".$args["address"]."', ";
		$sql .= "'".$args["province"]."', ";
		$sql .= "'".$args["country"]."', ";
		$sql .= "'".$args["zipcode"]."', ";
		$sql .= "'".$args["telephone"]."', ";
		$sql .= "'".$args["email"]."', ";
		$sql .= "'".$args["year_study"]."', ";
		$sql .= "'".$args["degree"]."', ";
		$sql .= "'".$args["major"]."', ";
		$sql .= "'".$args["gpa"]."', ";
		$sql .= "'".$args["school"]."', ";
		$sql .= "'".$args["school_city"]."', ";
		$sql .= "'".$args["school_province"]."', ";
		$sql .= "'".$args["school_country"]."', ";
		$sql .= "'".$args["hotel_sec"]."', ";
		$sql .= "'".date("Y-m-d H:i:s")."' )";		
		mysql_query($sql); 
		return mysql_insert_id();
	} // END FUNCTION
	
} // END OF CLASS 

?>