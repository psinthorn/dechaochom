<?PHP 
class Room { 
// FUNCTION : Room CONSTRUCTORS
	function Room()
	{ 
	// #################### //
	} // END FUNCTION	

// FUNCTION : GET "room"
	function getRoom($room_id)
	{
$sql = "SELECT ID FROM hotel_language WHERE hotel_sec = '".$_REQUEST["hotel_sec"]."' AND language_default = 'YES' ";
$query = mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error());
$rowdefault = mysql_fetch_array($query);

if(!$_REQUEST["language_id"]){
$language_id = $rowdefault["ID"];	
}
else {
$language_id = $_REQUEST["language_id"];	
}

		$sql  = "SELECT * FROM room LEFT JOIN room_language ON room.room_id = room_language.room_id ";
		$sql .= "WHERE room.room_id = '".$room_id."' AND language_id = '".$language_id."' ";
		$result = mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error()); 
		return mysql_fetch_array($result);	
	}
// FUNCTION : GET "room"
function getRoomManual($room_id)
	{
		$sql  = "SELECT * FROM room WHERE room_id = '".$room_id."' ";
		$result = mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error()); 
		return mysql_fetch_array($result);	
	}
// FUNCTION : GET "room"
	function getRoomTest($room_id)
	{
		
		$sql  = "SELECT * FROM room ";
		$sql .= "WHERE room_id = '".$room_id."' ";
		$result = mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error()); 
		return mysql_fetch_array($result);	
	}
// FUNCTION : GET "room"
	function getRoomCode($room_code)
	{
		$sql  = "SELECT * FROM room ";
		$sql .= "WHERE room_code = '".$room_code."' ";
		$result = mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error()); 
		return mysql_fetch_array($result);	
	}	
	
// FUNCTION : GET "room"
	function getAmenity($hotel_sec, $room_id)
	{
		$sql  = "SELECT * FROM room_amenity ";
		$sql .= "WHERE hotel_sec = '".$hotel_sec."' ";
		$sql .= "AND room_id = '".$room_id."' ";
		$result = mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error()); 
		return mysql_fetch_array($result);	
	}	

// FUNCTION : GET ALL "room"
	function getAllRoom($hotel_sec)
	{

$sql = "SELECT ID FROM hotel_language WHERE hotel_sec = '".$hotel_sec."' AND language_default = 'YES' ";
$query = mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error());
$rowdefault = mysql_fetch_array($query);

if(!$_REQUEST["language_id"]){
$language_id = $rowdefault["ID"];	
}
else {
$language_id = $_REQUEST["language_id"];	
}

		
		$sql  = "SELECT * FROM room LEFT JOIN room_language ON room.room_id = room_language.room_id ";
		$sql .= "WHERE room.hotel_sec = '".$hotel_sec."' AND room_language.language_id = '".$language_id."'  ";
		$sql .= "ORDER BY room.published_rate ASC ";
		$query = mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error()); 
		$i = 0;
		while ($row = mysql_fetch_array($query)) {
			$result[$i]["room_id"]			= $row["room_id"];
			$result[$i]["hotel_id"]			= $row["hotel_id"];			
			$result[$i]["hotel_sec"]			= $row["hotel_sec"];			
			$result[$i]["room_type"]			= $row["room_type"];
			$result[$i]["room_code"]			= $row["room_code"];
			$result[$i]["room_short"]		= $row["room_short"];
			$result[$i]["room_details"]		= $row["room_details"];			
			$result[$i]["published_rate"] 		= $row["published_rate"];
			$result[$i]["minimum_stay"]		= $row["minimum_stay"];
			$result[$i]["maximum_stay"]		= $row["maximum_stay"];
			$result[$i]["inc_breakfast"]		= $row["inc_breakfast"];
			$result[$i]["extra_adult"]			= $row["extra_adult"];
			$result[$i]["extra_adult_rate"]	= $row["extra_adult_rate"];
			$result[$i]["extra_children"]		= $row["extra_children"];
			$result[$i]["extra_children_rate"]	= $row["extra_children_rate"];
			$result[$i]["max_childage"]	= $row["max_childage"];
			$result[$i]["infant_age"]	= $row["infant_age"];
			$result[$i]["room_status"] 		= $row["room_status"];
			$result[$i]["package"] 			= $row["package"];
			$result[$i]["max_people"] 			= $row["max_people"];
			$result[$i]["no_ofroom"] 			= $row["no_ofroom"];
			$result[$i]["room_size"] 			= $row["room_size"];
			$result[$i]["highlight"] 			= $row["highlight"];
			$result[$i]["main_image"] 			= $row["main_image"];
			$result[$i]["room_recommend"] 		= $row["room_recommend"];
			$result[$i]["free_wifi"] 			= $row["free_wifi"];

			
			$i++;
			}
		return $result;	
	}
	 // END FUNCTION
// FUNCTION : GET SHOW "room"
	function getShowRoom($hotel_sec, $room_status)
	{
		$sql  = "SELECT * FROM room ";
		$sql .= "WHERE hotel_sec = '".$hotel_sec."' ";
		$sql .= "AND room_id <> '".$_REQUEST["room_id"]."' ";
		if (($room_status==0) || ($room_status==1)) { 
			$sql .= "AND room_status = '".$room_status."' ";
		}
		$sql .= "ORDER BY published_rate ASC ";
		$query = mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error()); 
		$i = 0;
		while ($row = mysql_fetch_array($query)) {
			$result[$i]["room_id"]			= $row["room_id"];
			$result[$i]["hotel_id"]			= $row["hotel_id"];			
			$result[$i]["hotel_sec"]			= $row["hotel_sec"];			
			$result[$i]["room_type"]			= $row["room_type"];
			$result[$i]["room_code"]			= $row["room_code"];
			$result[$i]["room_short"]		= $row["room_short"];
			$result[$i]["room_details"]		= $row["room_details"];			
			$result[$i]["published_rate"] 		= $row["published_rate"];
			$result[$i]["minimum_stay"]		= $row["minimum_stay"];
			$result[$i]["maximum_stay"]		= $row["maximum_stay"];
			$result[$i]["inc_breakfast"]		= $row["inc_breakfast"];
			$result[$i]["extra_adult"]			= $row["extra_adult"];
			$result[$i]["extra_adult_rate"]	= $row["extra_adult_rate"];
			$result[$i]["extra_children"]		= $row["extra_children"];
			$result[$i]["extra_children_rate"]	= $row["extra_children_rate"];
			$result[$i]["room_status"] 		= $row["room_status"];
			$result[$i]["package"] 			= $row["package"];
			$result[$i]["max_people"] 			= $row["max_people"];
			$i++;
			}
		return $result;	
	} // END FUNCTION	
	
// FUNCTION : GET ALL "room"
	function getAllAmenity()
	{
		$sql  = "SELECT * FROM amenity ";
		$sql .= "ORDER BY id ASC ";
		$query = mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error()); 
		$i = 0;
		while ($row = mysql_fetch_array($query)) {
			$result[$i]["id"]			= $row["id"];
			$result[$i]["amenity_name"]			= $row["amenity_name"];			
			$i++;
			}
		return $result;	
	} // END FUNCTION	

	

// FUNCTION : GET ALL "room available"

	function getAllRoomAvailable($room_status)

	{

		$sql  = "SELECT * FROM room ";

		if (($room_status==0) || ($room_status==1)) { 

			$sql .= "WHERE room_status = '".$room_status."' ";

		}

		$query = mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error()); 

		$i = 0;

		while ($row = mysql_fetch_array($query)) {

			$result[$i]["room_id"]			= $row["room_id"];

			$result[$i]["hotel_id"]			= $row["hotel_id"];			

			$result[$i]["hotel_sec"]			= $row["hotel_sec"];			

			$result[$i]["room_type"]			= $row["room_type"];

			$result[$i]["room_short"]		= $row["room_short"];

			$result[$i]["room_details"]		= $row["room_details"];			

			$result[$i]["published_rate"] 		= $row["published_rate"];

			$result[$i]["minimum_stay"]		= $row["minimum_stay"];

			$result[$i]["maximum_stay"]		= $row["maximum_stay"];

			$result[$i]["inc_breakfast"]		= $row["inc_breakfast"];

			$result[$i]["extra_adult"]			= $row["extra_adult"];

			$result[$i]["extra_adult_rate"]	= $row["extra_adult_rate"];

			$result[$i]["extra_children"]		= $row["extra_children"];

			$result[$i]["extra_children_rate"]	= $row["extra_children_rate"];

			$result[$i]["room_status"] 		= $row["room_status"];

			$result[$i]["package"] 			= $row["package"];

			$i++;

		}

		return $result;	

	} // END FUNCTION	





} // END OF CLASS 

?>