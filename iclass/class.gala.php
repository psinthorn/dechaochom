<?PHP 
class Gala { 
// FUNCTION : Room CONSTRUCTORS
	function Gala()
	{ 
	// #################### //
	} // END FUNCTION

// FUNCTION : INSERT "gala"
	function insertGala($args)
	{
		$sql  = "INSERT INTO gala VALUES (";
		$sql .= "NULL, ";
		$sql .= "'".$args["hotel_id"]."', ";
		$sql .= "'".$args["hotel_sec"]."', ";		
		$sql .= "'".$args["gala_date"]."', ";
		$sql .= "'".$args["gala_name"]."', ";
		$sql .= "'".$args["adult_rate"]."', ";
		$sql .= "'".$args["child_rate"]."', ";
		$sql .= "'".$args["gala_status"]."', ";
		$sql .= "'".date("Y-m-d H:i:s")."' )"; // TIMESTAMP
		mysql_query($sql) or die (header("Location: ../offers/compulsory.php?hotel_sec=".$args["hotel_sec"]."&gala_date=".$args["gala_date"].""));
		return mysql_insert_id();
	} // END FUNCTION





// FUNCTION : UPDATE "gala"

	function updateGala($args)

	{

		$sql  = "UPDATE gala SET ";

		$sql .= "gala_date 		= '".$args["gala_date"]."', ";

		$sql .= "gala_name 		= '".$args["gala_name"]."', ";

		$sql .= "adult_rate 	= '".$args["adult_rate"]."', ";

		$sql .= "child_rate 	= '".$args["child_rate"]."', ";

		$sql .= "gala_status 	= '".$args["gala_status"]."' ";

		$sql .= "WHERE gala_id 	= '".$args["gala_id"]."' ";

		mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error()); 

		return mysql_affected_rows();

	} // END FUNCTION	





// FUNCTION : DELETE "gala"

	function deleteGala($gala_id)

	{

		$sql = "DELETE FROM gala ";

		$sql .= "WHERE gala_id = '".$gala_id."' ";

		mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error()); 

		return  mysql_affected_rows();

	} // END FUNCTION	

	

	

// FUNCTION : GET "gala"

	function getGala($gala_id)

	{

		$sql  = "SELECT *, ";

		$sql .= "DATE_FORMAT(gala_date, '%d/%m/%Y') AS date01 ";

		$sql .= "FROM gala ";

		$sql .= "WHERE gala_id = '".$gala_id."' ";

		$result = mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error()); 

		return mysql_fetch_array($result);	

	}	

	

// FUNCTION : GET "gala"

	function getGalaFix($hotel_sec, $valid_from, $valid_to, $gala_status)

	{

		$sql  = "SELECT *, ";

		$sql .= "DATE_FORMAT(gala_date, '%e %M %Y') AS dateshow ";

		$sql .= "FROM gala ";

		$sql .= "WHERE hotel_sec = '".$hotel_sec."' ";

		$sql .= "AND gala_date >= '".$valid_from."' ";

		$sql .= "AND gala_date < '".$valid_to."' ";

		$sql .= "AND gala_status = '".$gala_status."' ";

		$sql .= "ORDER BY gala_date ASC ";

		$query = mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error());  

		$i = 0;

		while ($row = mysql_fetch_array($query)) {

			$result[$i]["gala_id"]		= $row["gala_id"];

			$result[$i]["dateshow"]		= $row["dateshow"];

			$result[$i]["gala_name"]	= $row["gala_name"];

			$result[$i]["adult_rate"] 	= $row["adult_rate"];

			$result[$i]["child_rate"]	= $row["child_rate"];

			$i++;

		}

		return $result;		

	}		





// FUNCTION : GET ALL "gala"

	function getAllGala($hotel_sec, $gala_status)

	{

		$sql  = "SELECT *, ";

		$sql .= "DATE_FORMAT(gala_date, '%d %M %Y') AS dateshow ";

		$sql .= "FROM gala ";

		$sql .= "WHERE hotel_sec = '".$hotel_sec."' ";

		if (($gala_status==0) || ($gala_status==1)) { 

			$sql .= "AND gala_status = '".$gala_status."' ";

		}

		$sql .= "ORDER BY gala_date ASC ";

		$query = mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error()); 

		$i = 0;

		while ($row = mysql_fetch_array($query)) {

			$result[$i]["gala_id"]		= $row["gala_id"];

			$result[$i]["dateshow"]		= $row["dateshow"];

			$result[$i]["gala_name"]	= $row["gala_name"];

			$result[$i]["adult_rate"] 	= $row["adult_rate"];

			$result[$i]["child_rate"]	= $row["child_rate"];

			$result[$i]["gala_status"]	= $row["gala_status"];

			$i++;

		}

		return $result;	

	} // END FUNCTION





} // END OF CLASS 

?>