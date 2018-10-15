<?PHP 
class Users { 
// FUNCTION : Users CONSTRUCTORS
	function Users()
	{ 
	// #################### //
	} // END FUNCTION
// FUNCTION : USER Security
function checkSecurity($staff_sec){ 
		if ($staff_sec == '' ) {
			header ("Location:".$thiscomp["website"]."admin/index.php");	
			exit;
		}
	}

// FUNCTION : USER Security

	function checkSecurityActivities($staff_id){ 
		if ($staff_id < 0 ) {
			header ("Location:../login.php");	
			exit;
		}
	}

// FUNCTION : USER Security
	function checkSecuritySpecial($staff_id){ 
		if ($staff_id < 0 ) {
			header ("Location:../login.php");	
			exit;
		}
	}				

// FUNCTION : ADMIN Security
	function checkAdmin($group_id){ 
		if ($group_id != 1 ) {
			header ("Location:../login.php");	
			exit;
		}
	}	

// FUNCTION : Get "User Loin"
	function getStaffLogin($username, $password)
	{
		$sql  = "SELECT * FROM user_staff ";
		$sql .= "WHERE email = '".$username."' ";
		$sql .= "AND staff_password = PASSWORD('".$password."') ";
		$sql .= "AND staff_status = '1' ";
		$query = mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error()); 
		return mysql_fetch_array($query);
	} // END FUNCTION

// FUNCTION : INSERT "Group"
	function insertGroup($args)
	{
		$sql  = "INSERT INTO user_group VALUES (";
		$sql .= "NULL, ";
		$sql .= "'".$args["group_name"]."', ";
		$sql .= "'".$args["group_status"]."') ";
		mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error()); 
		return mysql_insert_id();
	} // END FUNCTION

// FUNCTION : Update "Group"
	function updateGroup($args)
	{
		$sql  = "UPDATE user_group SET ";
		$sql .= "group_name	= '".$args["group_name"]."', ";
		$sql .= "group_status 	= '".$args["group_status"]."' ";
		$sql .= "WHERE group_id = '".$args["group_id"]."' ";
		mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error()); 
		return  mysql_affected_rows();
	} // END FUNCTION

// FUNCTION : Get "Group"
	function getGroup($group_id)
	{
		$sql  = "SELECT * FROM user_group ";
		$sql .= "WHERE group_id = '".$group_id."'";
		$query = mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error()); 
		return mysql_fetch_array($query);
	} // END FUNCTION

// FUNCTION : GET USER
	function getUser($user_id)
	{
		$sql  = "SELECT * FROM user_staff ";
		$sql .= "WHERE staff_id = '".$staff_id."'";
		$query = mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error()); 
		return mysql_fetch_array($query);
	} // END FUNCTION
// FUNCTION : Get All "Group"
	function getAllGroup()
	{
		if($admintaff["group_id"] == '1'){
		$group = "";	
		}
		else {
		$group = "WHERE group_id != '1'";	
		}
		$sql  = "SELECT * FROM user_group ";
		$sql .= "".$group." "; // FOR ADMINISTRATOR 
		$query = mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error()); 
		$i = 0;
		while ($row = mysql_fetch_array($query)) {
			$result[$i]["group_id"]			= $row["group_id"];
			$result[$i]["group_name"]		= $row["group_name"];
			$result[$i]["group_status"]		= $row["group_status"];	
			$i++;	
		}
		return $result;
	}
	function getAllGroupMenu()
	{
		
		$sql  = "SELECT * FROM user_group ";
		$sql .= "WHERE group_menu != '' GROUP BY group_menu "; // FOR ADMINISTRATOR 
		$query = mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error()); 
		$i = 0;
		while ($row = mysql_fetch_array($query)) {
			$result[$i]["group_menu"]		= $row["group_menu"];	
			$i++;	
		}
		return $result;
	}
	
	 // END FUNCTION

// FUNCTION : Get All "Group"
	function getAllMemberGroup($status)
	{
		$sql  = "SELECT * FROM member_group ";
		$sql .= "WHERE group_id > '1' "; // FOR AGENT
		if(($status == 0)||($status == 1)) {
			$sql .= "WHERE group_status = '".$status."'";
		}
		$query = mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error()); 
		$i = 0;
		while ($row = mysql_fetch_array($query)) {
			$result[$i]["group_id"]			= $row["group_id"];
			$result[$i]["group_name"]		= $row["group_name"];
			$result[$i]["group_status"]		= $row["group_status"];	
			$i++;	
		}
		return $result;
	} // END FUNCTION
// FUNCTION : Get Member "Group"
	function getMemberGroup($status)
	{
		$sql  = "SELECT * FROM member_group ";
		$sql .= "WHERE group_id = '1' "; // FOR MEMBER
		if(($status == 0)||($status == 1)) {
			$sql .= "WHERE group_status = '".$status."'";
		}
		$query = mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error()); 
		$i = 0;
		while ($row = mysql_fetch_array($query)) {
			$result[$i]["group_id"]			= $row["group_id"];
			$result[$i]["group_name"]		= $row["group_name"];
			$result[$i]["group_status"]		= $row["group_status"];	
			$i++;	
		}
		return $result;
	} // END FUNCTION		
// FUNCTION : INSERT "Staff"
	function insertStaff($args)
	{
		$ref0 = md5(uniqid(rand()));
		$ref = strtoupper($ref0);
		$sql  = "INSERT INTO user_staff VALUES (";
		$sql .= "NULL, ";
		$sql .= "'".$ref."', ";	
		$sql .= "'".$args["authorize"]."', ";	
		$sql .= "'".$args["hotel_sec"]."', ";
		$sql .= "'".$args["group_id"]."', ";
		$sql .= "'".$args["hotel_id"]."', ";
		$sql .= "'".$args["staff_user"]."', ";
		$sql .= "PASSWORD('".$args["staff_password"]."'), ";
		$sql .= "'".$args["first_name"]."', ";
		$sql .= "'".$args["last_name"]."', ";
		$sql .= "'".$args["email"]."', ";
		$sql .= "'".$args["staff_agent"]."', ";		
		$sql .= "'".$args["positions"]."', ";
		$sql .= "'".$args["staff_status"]."',";
		$sql .= "'0000-00-00 00:00:00',";
		$sql .= "'".date("Y-m-d H:i:s")."',";
		$sql .= "'".$args["def_menu"]."',";
		$sql .= "'".$args["Cc_Access"]."',";
		$sql .= "'".$args["Cc_Access_Day"]."')";
		mysql_query($sql) or die(header ("Location: ?note=duplicate&user=".$args["email"]."&group_id=".$args["group_id"]."&mid=".$_REQUEST["mid"]."&sid=".$_REQUEST["sid"]."")); 
		return mysql_insert_id();
	} // END FUNCTION

// FUNCTION : INSERT "Agent"
	function insertAgent($args)
	{
		$sql  = "INSERT INTO member_staff VALUES (";
		$sql .= "NULL, ";
		$sql .= "'".$args["group_id"]."', ";
		$sql .= "'".$args["hotel_id"]."', ";
		$sql .= "'".$args["staff_user"]."', ";
		$sql .= "PASSWORD('".$args["staff_password"]."'), ";
		$sql .= "'".$args["title"]."', ";
		$sql .= "'".$args["first_name"]."', ";
		$sql .= "'".$args["last_name"]."', ";
		$sql .= "'".$args["email"]."', ";
		$sql .= "'".$args["company"]."', ";		
		$sql .= "'".$args["positions"]."', ";
		$sql .= "'".$args["staff_status"]."',";
		$sql .= "'".$args["address"]."', ";
		$sql .= "'".$args["city"]."', ";
		$sql .= "'".$args["country"]."', ";	
		$sql .= "'".$args["zip"]."', ";	
		$sql .= "'".$args["vip_no1"]."', ";	
		$sql .= "'".$args["vip_no2"]."', ";	
		$sql .= "'".$args["vip_no3"]."', ";	
		$sql .= "'".$args["vip_no4"]."', ";	
		$sql .= "'".$args["agent_name"]."', ";
		$sql .= "'".$args["tel"]."', ";
		$sql .= "'".$args["agent_type"]."', ";	
		$sql .= "'".$args["agent_class"]."', ";																		
		$sql .= "'0000-00-00 00:00:00',";
		$sql .= "'".date("Y-m-d H:i:s")."')";
		mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error()); 
		return mysql_insert_id();
	} // END FUNCTION	
// FUNCTION : INSERT "Member"
	function insertMember($args)
	{
		$sql  = "INSERT INTO member_staff VALUES (";
		$sql .= "NULL, ";
		$sql .= "'".$args["group_id"]."', ";
		$sql .= "'".$args["hotel_id"]."', ";
		$sql .= "'".$args["staff_user"]."', ";
		$sql .= "PASSWORD('".$args["staff_password"]."'), ";
		$sql .= "'".$args["title"]."', ";
		$sql .= "'".$args["first_name"]."', ";
		$sql .= "'".$args["last_name"]."', ";
		$sql .= "'".$args["email"]."', ";
		$sql .= "'".$args["company"]."', ";		
		$sql .= "'".$args["positions"]."', ";
		$sql .= "'".$args["staff_status"]."',";
		$sql .= "'".$args["address"]."', ";
		$sql .= "'".$args["city"]."', ";
		$sql .= "'".$args["country"]."', ";	
		$sql .= "'".$args["zip"]."', ";	
		$sql .= "'".$args["vip_no1"]."', ";	
		$sql .= "'".$args["vip_no2"]."', ";	
		$sql .= "'".$args["vip_no3"]."', ";	
		$sql .= "'".$args["vip_no4"]."', ";	
		$sql .= "'".$args["agent_name"]."', ";
		$sql .= "'".$args["tel"]."', ";
		$sql .= "'".$args["agent_type"]."', ";	
		$sql .= "'".$args["agent_class"]."', ";																		
		$sql .= "'0000-00-00 00:00:00',";
		$sql .= "'".date("Y-m-d H:i:s")."')";
		mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error()); 
		return mysql_insert_id();
	} // END FUNCTION	
		
// FUNCTION : Update "Staff"
	function updateStaff($args)
	{
		$sql  = "UPDATE user_staff SET ";
		if ($args["staff_password"] != "") { $sql .= "staff_password = PASSWORD('".$args["staff_password"]."'), "; }					
		$sql .= "first_name 	= '".$args["first_name"]."', ";
		$sql .= "last_name		= '".$args["last_name"]."', ";
		$sql .= "positions		= '".$args["positions"]."', ";
		$sql .= "email			= '".$args["email"]."', ";
		$sql .= "last_update 	= '".date("Y-m-d H:i:s")."' ";
		$sql .= "WHERE staff_id =  '".$args["staff_id"]."' ";
		$query = mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error()); 
		return  mysql_affected_rows();
	} // END FUNCTION


// FUNCTION : Update "Staff"

	function updatePassword($args)
	{
		$sql  = "UPDATE user_staff SET ";		
		if ($args["staff_password"] != "") { $sql .= "staff_password = PASSWORD('".$args["staff_password"]."'), "; }			
		$sql .= "last_update 	= '".date("Y-m-d H:i:s")."' ";
		$sql .= "WHERE staff_id =  '".$args["staff_id"]."' ";
		$query = mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error()); 
		return  mysql_affected_rows();
	} // END FUNCTION	


// FUNCTION : UPDATE STAFF FOR ADMIN
	function updateStaffAdmin($args)
	{
		$sql  = "UPDATE user_staff SET ";
		if ($args["staff_password"] != "") { $sql .= "staff_password = PASSWORD('".$args["staff_password"]."'), "; }
		$sql .= "first_name 	= '".$args["first_name"]."', ";
		$sql .= "last_name		= '".$args["last_name"]."', ";
		$sql .= "positions		= '".$args["positions"]."', ";
		$sql .= "email			= '".$args["email"]."', ";
		$sql .= "staff_status	= '".$args["staff_status"]."', ";
		$sql .= "group_id			= '".$args["group_id"]."', ";
		$sql .= "authorize			= '".$args["authorize"]."', ";
		
		$sql .= "hotel_sec	= '".$args["hotel_sec"]."', ";
		$sql .= "Cc_Access	= '".$args["Cc_Access"]."', ";
		$sql .= "Cc_Access_Day	= '".$args["Cc_Access_Day"]."', ";
		$sql .= "last_update 	= '".date("Y-m-d H:i:s")."' ";
		$sql .= "WHERE staff_id =  '".$args["staff_id"]."' ";
		$query = mysql_query($sql)  or die("SQL : ".$sql."<br>ERROR : ". mysql_error());  
		return  mysql_affected_rows();
	} // END FUNCTION

	// FUNCTION : Update "Staff"
	function updateStaffsalf($args)
	{
	$sql  = "UPDATE user_staff SET ";	
		if ($args["staff_password"] != "") { $sql .= "staff_password = PASSWORD('".$args["staff_password"]."'), "; }					
		$sql .= "last_update 	= '".date("Y-m-d H:i:s")."' ";
		$sql .= "WHERE staff_id =  '".$args["staff_id"]."' ";
		$query = mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error()); 
		return  mysql_affected_rows();
	} // END FUNCTION

// FUNCTION : Update "Member"
	function updateMember($args)
	{
		$sql  = "UPDATE member_staff SET ";
		$sql .= "group_id 		= '".$args["group_id"]."', ";
		if ($args["staff_password"] != "") { $sql .= "staff_password = PASSWORD('".$args["staff_password"]."'), "; }			
		$sql .= "title 			= '".$args["title"]."', ";
		$sql .= "first_name 	= '".$args["first_name"]."', ";
		$sql .= "last_name		= '".$args["last_name"]."', ";
		$sql .= "email			= '".$args["email"]."', ";	
		$sql .= "company	 	= '".$args["company"]."', ";
		$sql .= "positions		= '".$args["positions"]."', ";
		$sql .= "staff_status 	= '".$args["staff_status"]."', ";
		$sql .= "address	 	= '".$args["address"]."', ";
		$sql .= "city		 	= '".$args["city"]."', ";	
		$sql .= "country 		= '".$args["country"]."', ";
		$sql .= "zip		 	= '".$args["zip"]."', ";							
		$sql .= "tel		 	= '".$args["tel"]."', ";	
		$sql .= "vip_no1		= '".$args["vip_no1"]."', ";	
		$sql .= "vip_no2		= '".$args["vip_no2"]."', ";	
		$sql .= "vip_no3		= '".$args["vip_no3"]."', ";	
		$sql .= "vip_no4		= '".$args["vip_no4"]."', ";							
		$sql .= "last_update 	= '".date("Y-m-d H:i:s")."' ";
		$sql .= "WHERE member_id =  '".$args["member_id"]."' ";
		$query = mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error()); 
		return  mysql_affected_rows();
	} // END FUNCTION	

// FUNCTION : UPDATE Access Booking
	function accessLogin($staff_sec)
	{
		$sql  = "UPDATE user_staff SET ";
		$sql .= "last_login			= '".date("Y-m-d H:i:s")."' ";
		$sql .= "WHERE staff_sec 	= '".$staff_sec."' ";
		mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error()); 
		return mysql_affected_rows();
	} // END FUNCTION		

// FUNCTION : Get "Staff"
	function getStaff($staff_sec)
	{
		$sql  = "SELECT *, ";
		$sql .= "DATE_FORMAT(last_update, '%d %M %Y %r') AS last_update_show ";
		$sql .= "FROM user_staff ";
		$sql .= "WHERE staff_sec = '".$staff_sec."' ";
		$query = mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error()); 
		return mysql_fetch_array($query);
	} // END FUNCTION
	
	function getStaffID($staff_id)
	{
		$sql  = "SELECT *, ";
		$sql .= "DATE_FORMAT(last_update, '%d %M %Y %r') AS last_update_show ";
		$sql .= "FROM user_staff ";
		$sql .= "WHERE staff_id = '".$staff_id."'";
		$query = mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error()); 
		return mysql_fetch_array($query);
	} // END FUNCTION

// FUNCTION : GET STAFF CLIENT
	function getStaffClient($staff_sec)
{
		$sql  = "SELECT *, ";
		$sql .= "DATE_FORMAT(last_update, '%d %M %Y %r') AS last_update_show ";
		$sql .= "FROM user_staff ";
		$sql .= "WHERE staff_sec = '".$staff_sec."'";
		$query = mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error()); 
		return mysql_fetch_array($query);
	} // END FUNCTION	

// FUNCTION : Get "Member"
	function getMember($member_id)
	{
		$sql  = "SELECT *, ";
		$sql .= "DATE_FORMAT(last_update, '%d %M %Y %r') AS last_update_show ";
		$sql .= "FROM member_staff ";
		$sql .= "WHERE member_id = '".$member_id."'";
		$query = mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error()); 
		return mysql_fetch_array($query);
	} // END FUNCTION	

// FUNCTION : Get All "Staff"
	function getAllStaff($group_id)
	{
		$sql  = "SELECT user_staff.*, hotel.hotel_name FROM user_staff ";
		$sql .= "LEFT JOIN hotel ON hotel.hotel_id = user_staff.hotel_id ";
		$sql .= "WHERE group_id = '".$group_id."' ";
		if(($status == 0)||($status == 1)) { $sql .= "AND staff_status = '".$status."'"; }
		$query = mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error()); 
		$i = 0;
		while ($row = mysql_fetch_array($query)) {
			$result[$i]["staff_id"]		= $row["staff_id"];
			$result[$i]["staff_user"]	= $row["staff_user"];
			$result[$i]["hotel_name"]	= $row["hotel_name"];
			$result[$i]["first_name"]	= $row["first_name"];
			$result[$i]["last_name"]	= $row["last_name"];
			$result[$i]["positions"]	= $row["positions"];		
			$result[$i]["staff_status"]	= $row["staff_status"];	
			$i++;	
		}
		return $result;
	} // END FUNCTION

// FUNCTION : Get All "Member"
	function getAllMember($group_id, $status)
	{
		$sql  = "SELECT member_staff.*, hotel.hotel_id FROM member_staff ";
		$sql .= "LEFT JOIN hotel ON hotel.hotel_id = member_staff.hotel_id ";
		$sql .= "WHERE group_id = '".$group_id."' ";
		if(($status == 0)||($status == 1)) { $sql .= "AND staff_status = '".$status."'"; }
		$query = mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error()); 
		$i = 0;
		while ($row = mysql_fetch_array($query)) {
			$result[$i]["member_id"]		= $row["member_id"];
			$result[$i]["staff_user"]		= $row["staff_user"];
			$result[$i]["hotel_name"]	= $row["hotel_name"];
			$result[$i]["first_name"]		= $row["first_name"];
			$result[$i]["last_name"]		= $row["last_name"];
			$result[$i]["positions"]		= $row["positions"];
			$result[$i]["agent_name"]	= $row["agent_name"];
			$result[$i]["title"]			= $row["title"];
			$result[$i]["tel"]			= $row["tel"];			
			$result[$i]["city"]			= $row["city"];
			$result[$i]["country"]		= $row["country"];			
			$result[$i]["agent_class"]	= $row["agent_class"];	
			$result[$i]["staff_status"]	= $row["staff_status"];	
			$i++;	
		}
		return $result;
	} // END FUNCTION	

// FUNCTION : Get All "Menu"
	function getAllMenu()
	{
		$sql  = "SELECT * FROM user_menu ";
		$sql .= "ORDER BY menu_id ASC ";
		$query = mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error()); 
		$i = 0;
		while ($row = mysql_fetch_array($query)) {
			$result[$i]["menu_id"]		= $row["menu_id"];
			$result[$i]["menu_name"]	= $row["menu_name"];	
			$result[$i]["menu_link"]	= $row["menu_link"];
			$result[$i]["menu_icon"]	= $row["menu_icon"];	
			$i++;	
		}
		return $result;
	} // END FUNCTION

// FUNCTION : Get All "Sub Menu"
	function getAllSubMenu($menu_id)
	{
		$sql  = "SELECT * FROM user_submenu ";
		$sql .= "WHERE menu_id = '".$menu_id."' ";
		$sql .= "ORDER BY submenu_id ASC";
		$query = mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error()); 
		$i = 0;
		while ($row = mysql_fetch_array($query)) {
			$result[$i]["submenu_id"]	= $row["submenu_id"];
			$result[$i]["submenu_name"]	= $row["submenu_name"];	
			$result[$i]["submenu_link"]	= $row["submenu_link"];	
			$i++;	
		}
		return $result;
	} // END FUNCTION
// FUNCTION : INSERT "Access"
	function insertAccess($staff_id, $hotel_sec, $menu_id,$submenu_id, $access_status)
	{
		$sql  = "INSERT INTO user_access VALUES (";
		$sql .= "NULL, ";
		$sql .= "'".$staff_id."', ";
		$sql .= "'".$hotel_sec."', ";
		$sql .= "'".$menu_id."', ";
		$sql .= "'".$submenu_id."', ";
		$sql .= "'2') ";
		mysql_query($sql); 
		return mysql_insert_id();
	} // END FUNCTION

// FUNCTION : Update "Access" by "Access_Status"
	function updateAccess($access_id, $access_status)
	{
		$sql  = "UPDATE user_access SET ";
		$sql .= "access_status = '".$access_status."' ";
		$sql .= "WHERE access_id = '".$access_id."' ";
		$sql = mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error()); 
		return mysql_affected_rows();
	} // END FUNCTION	

// FUNCTION : Update "Member Access" by "Access_Status"
	function updatememberAccess($access_id, $access_status)
	{
		$sql  = "UPDATE member_access SET ";
		$sql .= "access_status = '".$access_status."' ";
		$sql .= "WHERE access_id = '".$access_id."' ";
		$sql = mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error()); 
		return mysql_affected_rows();
	} // END FUNCTION		

// FUNCTION : Get "Access"
	function getAccess($staff_id, $menu_id, $submenu_id)
	{
		$sql  = "SELECT * FROM user_access  ";
		$sql .= "WHERE staff_id = '".$staff_id."' AND menu_id = '".$menu_id."' AND submenu_id = '".$submenu_id."'";
		
		$query = mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error()); 
		return mysql_fetch_array($query);
	} // END FUNCTION

// FUNCTION : Get "Member Access"



	function getmemberAccess($group_id, $submenu_id)



	{



		$sql  = "SELECT * FROM member_access ";



		$sql .= "WHERE group_id 	= '".$group_id."' ";



		$sql .= "AND submenu_id 	= '".$submenu_id."' ";



		$query = mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error()); 



		return mysql_fetch_array($query);



	} // END FUNCTION		











// FUNCTION : Get All "Access"
	function getAllSubAccess()
	{
		$sql  = "SELECT * FROM user_access ";
		$sql .= "LEFT JOIN user_submenu ON user_submenu.submenu_id = user_access.submenu_id ";
		$sql .= "WHERE user_access.staff_id = '".$staff_id."' ";
		$sql .= "AND user_access.hotel_sec = '$hotel_sec' ";
		$sql .= "AND user_access.menu_id = '$menu_id' ";
		$sql .= "AND user_access.access_status = '1' ";
		$sql .= "ORDER BY user_submenu.submenu_id ASC ";
		$query = mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error()); 
		$i = 0;
		while ($row = mysql_fetch_array($query)) {
			$result[$i]["submenu_name"]	= $row["submenu_name"];	
			$result[$i]["submenu_link"]	= $row["submenu_link"];	
			$i++;	



		}



		return $result;



	} // END FUNCTION	

	// FUNCTION : DELETE "USER"

	function deleteUser($staff_id)

	{

		$sql = "DELETE FROM user_staff ";

		$sql .= "WHERE staff_id = '".$staff_id."' ";

		mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error()); 

		return  mysql_affected_rows();

	} // END FUNCTION

// FUNCTION : GET HOTEL
	function getLicense($hotel_sec){
		$sql  = "SELECT * FROM license ";
		$sql .= "WHERE hotel_sec = '".$_GET["hotel_sec"]."' ";
		$query = mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error()); 
		return mysql_fetch_array($query);
		}


	
// FUNCTION : Update "Group"
	function UpdateLicense($args)
	{
		$sql  = "UPDATE hotel SET ";
		$sql .= "hotel_license	= '".$args["hotel_license"]."', ";
		$sql .= "expire_date 	= '".date("".$args["expire_date"]."")."' ";
		$sql .= "WHERE hotel_sec = '".$args["hotel_sec"]."' ";
		mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error()); 
		return  mysql_affected_rows();
	} // END FUNCTION	


} // END OF CLASS 




?>