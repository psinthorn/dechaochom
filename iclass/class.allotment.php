<?PHP 
class Allotment { 
//RESOTEL GROUP

// FUNCTION : roomallotment CONSTRUCTORS
	function Allotment()
	{ 
	// #################### //
	} // END FUNCTION

	


// FUNCTION : GET "allotment" by "Date"
	function getAllotmentFix($master_rate_id, $fix_date)
	{
		$sql  = "SELECT * FROM master_allotment ";
		$sql .= "WHERE master_rate_id = '".$master_rate_id."' ";
		$sql .= "AND fix_date = '".$fix_date."' ";
		$query = mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error());  
		return mysql_fetch_array($query);
	} // END FUNCTION

	function getAllotmentModify($master_rate_id, $fix_date, $rooms)
	{
		$sql  = "SELECT * FROM master_allotment ";
		$sql .= "WHERE master_rate_id = '".$master_rate_id."' ";
		$sql .= "AND fix_date = '".$fix_date."' ";
		$query = mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error());  
		return mysql_fetch_array($query);
	} // END FUNCTION



// FUNCTION : GET ALL "allotment" by "Month"
	function getAllotmentMonth($room_id, $month, $year)
	{
		$sql  = "SELECT *, (room_allotment-sold) AS room_left FROM master_allotment ";
		$sql .= "WHERE room_id = '".$room_id."' ";
		$sql .= "AND MONTH(fix_date) = '".$month."' ";
		$sql .= "AND YEAR(fix_date) = '".$year."' ";		
		$sql .= "ORDER BY fix_date ASC ";
		$query = mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error());  
		while ($row = mysql_fetch_array($query)) {
			$result[$row["fix_date"]]["allotment_id"]		= $row["allotment_id"];
			$result[$row["fix_date"]]["room_allotment"]		= $row["room_allotment"];
			$result[$row["fix_date"]]["rate"]				= $row["rate"];
			$result[$row["fix_date"]]["agent_rate_a"]				= $row["agent_rate_a"];
			$result[$row["fix_date"]]["agent_rate_b"]				= $row["agent_rate_b"];
			$result[$row["fix_date"]]["sold"]				= $row["sold"];
			$result[$row["fix_date"]]["room_left"]			= $row["room_left"];
			$result[$row["fix_date"]]["deposit"]			= $row["deposit"];
			$result[$row["fix_date"]]["deposit_agent"]			= $row["deposit_agent"];
			$result[$row["fix_date"]]["allotment_status"]	= $row["allotment_status"];
			$result[$row["fix_date"]]["occ"]	= $row["occ"];
			$result[$row["fix_date"]]["OI"]	= $row["OI"];
			$result[$row["fix_date"]]["percent"]	= $row["percent"];
		}
		return $result;		
	} // END FUNCTION


// FUNCTION : GET ALL "allotment" by "Month"
	function getAllotmentPeriod($master_rate_id, $valid_from, $valid_to)
	{
		$sql  = "SELECT *, (room_allotment) AS room_left FROM master_allotment ";
		$sql .= "WHERE master_rate_id = '".$master_rate_id."' ";
		$sql .= "AND fix_date >= '".$valid_from."' ";
		$sql .= "AND fix_date <= '".$valid_to."' ";	
		$query = mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error());  
		while ($row = mysql_fetch_array($query)) {
			$result[$row["fix_date"]]["allotment_id"]		= $row["allotment_id"];
			$result[$row["fix_date"]]["room_allotment"]		= $row["room_allotment"];
			$result[$row["fix_date"]]["rate"]				= $row["rate"];
			$result[$row["fix_date"]]["room_left"]			= $row["room_left"];
			$result[$row["fix_date"]]["allotment_status"]	= $row["allotment_status"];
			$result[$row["fix_date"]]["occ"]	= $row["occ"];
			$result[$row["fix_date"]]["OI"]	= $row["OI"];
			$result[$row["fix_date"]]["percent"]	= $row["percent"];
		}
		return $result;		
	} // END FUNCTION
	
	// FUNCTION : GET ALL "allotment" by "Month"
	function getAllAllotmentPeriod($valid_from, $valid_to)
	{
		$sql  = "SELECT *, (room_allotment-sold) AS room_left FROM master_allotment ";
		$sql .= "WHERE fix_date >= '".$valid_from."' ";
		$sql .= "AND fix_date <= '".$valid_to."' ";	
		$query = mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error());  
		while ($row = mysql_fetch_array($query)) {
			$result[$row["fix_date"]]["allotment_id"]		= $row["allotment_id"];
			$result[$row["fix_date"]]["room_allotment"]		= $row["room_allotment"];
			$result[$row["fix_date"]]["rate"]				= $row["rate"];
			$result[$row["fix_date"]]["agent_rate_a"]		= $row["agent_rate_a"];
			$result[$row["fix_date"]]["agent_rate_b"]		= $row["agent_rate_b"];
			$result[$row["fix_date"]]["sold"]				= $row["sold"];
			$result[$row["fix_date"]]["room_left"]			= $row["room_left"];
			$result[$row["fix_date"]]["deposit"]			= $row["deposit"];
			$result[$row["fix_date"]]["deposit_agent"]			= $row["deposit_agent"];
			$result[$row["fix_date"]]["allotment_status"]	= $row["allotment_status"];
			$result[$row["fix_date"]]["occ"]	= $row["occ"];
			$result[$row["fix_date"]]["OI"]	= $row["OI"];
			$result[$row["fix_date"]]["percent"]	= $row["percent"];
		}
		return $result;		
	} // END FUNCTION
	
	function getAllotmentDate($room_id, $valid_from)
	{
		$sql  = "SELECT *, (room_allotment) AS room_left FROM master_allotment ";
		$sql .= "WHERE room_id = '".$room_id."' ";
		$sql .= "AND fix_date <= '".$valid_from."' ";	
		$query = mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error());  
		while ($row = mysql_fetch_array($query)) {
			$result[$row["fix_date"]]["allotment_id"]		= $row["allotment_id"];
			$result[$row["fix_date"]]["room_allotment"]		= $row["room_allotment"];
			$result[$row["fix_date"]]["rate"]		= $row["rate"];
			$result[$row["fix_date"]]["agent_rate_a"]		= $row["agent_rate_a"];
			$result[$row["fix_date"]]["agent_rate_b"]		= $row["agent_rate_b"];
			$result[$row["fix_date"]]["deposit"]			= $row["deposit"];
			$result[$row["fix_date"]]["deposit_agent"]			= $row["deposit_agent"];
			$result[$row["fix_date"]]["sold"]				= $row["sold"];
			$result[$row["fix_date"]]["room_left"]			= $row["room_left"];
			$result[$row["fix_date"]]["allotment_status"]	= $row["allotment_status"];
			$result[$row["fix_date"]]["occ"]	= $row["occ"];
			$result[$row["fix_date"]]["OI"]	= $row["OI"];
			$result[$row["fix_date"]]["percent"]	= $row["percent"];
		}
		return $result;		
	} // END FUNCTION	
	


// FUNCTION : GET MAX & MIN
	function getMaxMin($room_id, $id_field)
	{
		$sql  = "SELECT MAX(".$id_field.") as max_field, Min(".$id_field.") as min_field ";
		$sql .= "FROM master_allotment ";
		$sql .= "WHERE room_id = '".$room_id."' ";
		$query = mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error());  
		return mysql_fetch_array($query);		
	} // END FUNCTION		


// FUNCTION : GET ALL Room Availiable
	function getCheckVal($master_rate_id, $valid_from, $valid_to, $rooms)
	{
		$sql  = "SELECT COUNT(*) AS all_day ";
		$sql .= "FROM master_allotment ";
		$sql .= "WHERE master_rate_id = '".$master_rate_id."' ";
		$sql .= "AND fix_date >= '".$valid_from."' ";
		$sql .= "AND fix_date < '".$valid_to."' ";
		$sql .= "AND (room_allotment) >= '".$rooms."' ";
		$sql .= "AND allotment_status = '1' "; // ROOM STATUS = ON
		$query = mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error());  
		$row = mysql_fetch_array($query);
		return $row["all_day"];
	} // END FUNCTION
	
	// FUNCTION : GET CHECK RATE
	function getCheckRate($room_id, $valid_from, $valid_to, $rooms)
	{
		$sql  = "SELECT SUM(rate) AS all_rate ";
		$sql .= "FROM master_allotment ";
		$sql .= "WHERE room_id = '".$room_id."' ";
		$sql .= "AND fix_date >= '".$valid_from."' ";
		$sql .= "AND fix_date < '".$valid_to."' ";
		$query = mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error());  
		$row = mysql_fetch_array($query);
		return $row["all_rate"];
	} // END FUNCTION	
// FUNCTION : GET ALL Room Availiable
	function getCheckAllVal($room_id, $valid_from, $valid_to, $rooms)
	{
		$sql  = "SELECT COUNT(*) AS all_day ";
		$sql .= "FROM master_allotment ";
		$sql .= "WHERE room_id = '".$room_id."' ";
		$sql .= "AND fix_date >= '".$valid_from."' ";
		$sql .= "AND fix_date < '".$valid_to."' ";
		$sql .= "AND (room_allotment-sold) >= '".$rooms."' ";
		$sql .= "AND allotment_status = '1' "; // ROOM STATUS = ON
		$query = mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error());  
		$row = mysql_fetch_array($query);
		return $row["all_day"];
	} // END FUNCTION

	// FUNCTION : CUT ALLOTMENT
	function cutAllotment($master_rate_id, $room_id, $valid_from, $valid_to, $rooms)
	{
		$sql  = "UPDATE master_allotment SET ";
		$sql .= "room_allotment = (room_allotment-".$rooms.") ";
		$sql .= "WHERE room_id = '".$room_id."' ";
		//$sql .= "AND master_rate_id = '".$master_rate_id."' ";
		$sql .= "AND fix_date >= '".$valid_from."' ";
		$sql .= "AND fix_date < '".$valid_to."' ";
		$query = mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error()); 
		return mysql_affected_rows();
	} // END FUNCTION			

} // END OF CLASS 
?>