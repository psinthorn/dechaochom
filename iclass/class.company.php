<?PHP 

class company {	
// FUNCTION : GET OWNER
	function getCompany($comp_id)
	{
		$sql  = "SELECT * FROM company  WHERE comp_id = '".$comp_id."' ";
		$query = mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error()); 
		return mysql_fetch_array($query);
	}


// FUNCTION : UPDATE INFORMATION
	function updateCompanyInformation($args)
	{
		$sql  = "UPDATE company SET ";
		$sql .= "owner_name	= '".$args["owner_name"]."', ";
		$sql .= "comp_address	= '".$args["comp_address"]."', ";
		$sql .= "comp_city		= '".$args["comp_city"]."', ";		
		$sql .= "comp_country		= '".$args["comp_country"]."', ";	
		$sql .= "comp_tel		= '".$args["comp_tel"]."', ";
		$sql .= "comp_fax 		= '".$args["comp_fax"]."', ";
		$sql .= "comp_email	= '".$args["comp_email"]."', ";
		$sql .= "rsvn_email		= '".$args["rsvn_email"]."', ";
		$sql .= "technical_email		= '".$args["technical_email"]."', ";
		$sql .= "comp_about		= '".$args["comp_about"]."' ";															
		$sql .= "WHERE owner_id = '".$args["owner_id"]."' ";
		mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error()); 
		return mysql_affected_rows();
	}
	
	function updateLogo($args)
	{
		$sql  = "UPDATE company SET ";
		$sql .= "owner_id = '".$args["owner_id"]."' ";															
		$sql .= "WHERE owner_id = '".$args["owner_id"]."' ";
		mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error()); 
		return mysql_affected_rows();
	}		
	
// FUNCTION : UPDATE DESCRIPTION
	function updateCompanyDescription($args)
	{
		$sql  = "UPDATE company SET ";
		$sql .= "comp_info		= '".$args["comp_info"]."', ";
		$sql .= "keyword		= '".$args["keyword"]."', ";	
		$sql .= "title		= '".$args["title"]."' ";										
		$sql .= "WHERE owner_id = '".$args["owner_id"]."' ";
		mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error()); 
		return mysql_affected_rows();
	}	
	

} // END OF CLASS 

?>