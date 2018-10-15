<?PHP 
class Member { 
// FUNCTION : Users CONSTRUCTORS
	function Member()
	{ 
	// #################### //
	} // END FUNCTION
// FUNCTION : USER Security
function checkSecurity($ID){ 
		if ($staff_sec == '' ) {
			header ("Location:".$thishotel["website"]."");	
			exit;
		}
	}	

// FUNCTION : Get "User Loin"
	function getMemberLogin($email, $password, $hotel_sec)
	{
		$sql  = "SELECT * FROM member_guest ";
		$sql .= "WHERE email = '".$email."' ";
		$sql .= "AND password = PASSWORD('".$password."') ";
		$sql .= "AND STATUS = 'CONFIRM' AND hotel_sec = '".$hotel_sec."' ";
		$query = mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error()); 
		return mysql_fetch_array($query);
	} // END FUNCTION


// FUNCTION : GET USER
	function getUser($ID)
	{
		$sql  = "SELECT * FROM member_guest ";
		$sql .= "WHERE ID = '".$ID."'";
		$query = mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error()); 
		return mysql_fetch_array($query);
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
	function accessMemberLogin($staff_sec)
	{
		$sql  = "UPDATE user_staff SET ";
		$sql .= "last_login			= '".date("Y-m-d H:i:s")."' ";
		$sql .= "WHERE staff_sec 	= '".$staff_sec."' ";
		mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error()); 
		return mysql_affected_rows();
	} // END FUNCTION		
	

// FUNCTION : Get "Member"
	function getMember($ID)
	{
		$sql  = "SELECT * FROM member_guest ";
		$sql .= "WHERE ID = '".$ID."'";
		$query = mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error()); 
		return mysql_fetch_array($query);
	} // END FUNCTION
	
	function getMemberReference($REFERENCE)
	{
		$sql  = "SELECT * FROM member_guest ";
		$sql .= "WHERE reference = '".$REFERENCE."'";
		$query = mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error()); 
		return mysql_fetch_array($query);
	} // END FUNCTION	
	
	function getMemberEmail($EMAIL, $hotel_sec)
	{
		$sql  = "SELECT * FROM member_guest ";
		$sql .= "WHERE email = '".$EMAIL."' AND hotel_sec = '".$hotel_sec."' ";
		$query = mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error()); 
		return mysql_fetch_array($query);
	} // END FUNCTION	


// FUNCTION : Get All "Member"
	function getAllMember($hotel_sec)
	{
		$sql  = "SELECT * FROM member_guest ";
		$sql .= "LEFT JOIN hotel ON hotel.hotel_sec = member_.hotel_sec ";
		$sql .= "WHERE group_id = '".$group_id."' ";
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


// FUNCTION : Update "Member Access" by "Access_Status"
	function updatememberAccess($access_id, $access_status)
	{
		$sql  = "UPDATE member_access SET ";
		$sql .= "access_status = '".$access_status."' ";
		$sql .= "WHERE access_id = '".$access_id."' ";
		$sql = mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error()); 
		return mysql_affected_rows();
	} // END FUNCTION
	
	// FUNCTION : GET MEMBER Project
	function getMemberProject($hotel_sec){
		$sql  = "SELECT * FROM member_hotel ";
		$sql .= "WHERE member_hotel.hotel_sec = '".$hotel_sec."' ";
		$query = mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error()); 
		return mysql_fetch_array($query);
		}
		
	//Insert Extra
	function insertMemberBenefits($args)
	{
		$sql  = "INSERT INTO member_benefits VALUES (";
		$sql .= "NULL, ";	
		$sql .= "'".$args["benefits_hotel_sec"]."', ";
		$sql .= "'".$args["benefits_name"]."', ";	
		$sql .= "'".$args["benefits_desc"]."', ";
		$sql .= "'".$args["benefits_breakdown"]."', ";
		$sql .= "'".$args["benefits_minstay"]."', ";
		$sql .= "'".$args["benefits_status"]."', ";
		$sql .= "'".date("Y-m-d H:i:s")."' )";
		mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error()); 
		return mysql_insert_id();

	} // END FUNCTION
	
	// FUNCTION DELETE EXTRA
	function deleteMemberBenefits($id)
	{
		$sql = "DELETE FROM member_benefits ";
		$sql .= "WHERE benefits_id = '".$id."' ";
		mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error()); 
		return  mysql_affected_rows();
	} // END FUNCTION		
		
	// FUNCTION : UPDATE MEMBER Project
	function updateMemberHotel($args)
	{
		$sql  = "UPDATE member_hotel SET ";
		$sql .= "project_name		= '".$args["project_name"]."', ";		
		$sql .= "short_desc		= '".$args["short_desc"]."', ";
		$sql .= "more_desc	= '".$args["more_desc"]."', ";
		$sql .= "contact_name		= '".$args["contact_name"]."', ";
		$sql .= "contact_email	= '".$args["contact_email"]."', ";
		$sql .= "discount	= '".$args["discount"]."', ";
		$sql .= "term_condition	= '".$args["term_condition"]."', ";
		$sql .= "status	= '".$args["status"]."' ";			
		$sql .= "WHERE hotel_sec = '".$args["hotel_sec"]."' ";
		mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error()); 
		return mysql_affected_rows();
	}
	function UpdateInvitationLetter($args)
	{
		$sql  = "UPDATE member_hotel SET ";
		$sql .= "invitation_text		= '".$args["invitation_text"]."', ";		
		$sql .= "subject		= '".$args["subject"]."' ";			
		$sql .= "WHERE hotel_sec = '".$args["hotel_sec"]."' ";
		mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error()); 
		return mysql_affected_rows();
	}
	function UpdateMemberProcess($args)
	{
		$sql  = "UPDATE member_hotel SET ";
		$sql .= "auto_send		= '".$args["auto_send"]."', ";		
		$sql .= "time		= '".$args["time"]."' ";			
		$sql .= "WHERE hotel_sec = '".$args["hotel_sec"]."' ";
		mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error()); 
		return mysql_affected_rows();
	}
	function UpdateMemberSendCompleted($args)
	{
		$sql  = "UPDATE member_guest SET ";
		$sql .= "PROCESS		= 'YES', ";		
		$sql .= "send_date		= '".date("Y-m-d H:i:s")."', ";	
		$sql .= "STATUS		= 'SEND' ";			
		$sql .= "WHERE ID = '".$args["ID"]."' ";
		mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error()); 
		return mysql_affected_rows();
	}
	function UpdateMemberSendFailed($args)
	{
		$sql  = "UPDATE member_guest SET ";
		$sql .= "PROCESS		= 'YES', ";		
		$sql .= "send_date		= '".date("Y-m-d H:i:s")."', ";	
		$sql .= "STATUS		= 'FAILED' ";			
		$sql .= "WHERE ID = '".$args["ID"]."' ";
		mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error()); 
		return mysql_affected_rows();
	}
	
	function UpdateMemberConfirm($MEMBER_REF, $ranpassword)
	{
		$sql  = "UPDATE member_guest SET ";
		$sql .= "STATUS	= 'CONFIRM', ";
		$sql .= "password	= PASSWORD('".$ranpassword."') ";	
		$sql .= "WHERE reference = '".$MEMBER_REF."' ";
		mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error()); 
		return mysql_affected_rows();
	}
	
	function UpdateMemberProfile($args)
	{
		$sql  = "UPDATE member_guest SET ";
		$sql .= "LASTNAME	= '".$args["LASTNAME"]."', ";
		$sql .= "FIRSTNAME	= '".$args["FIRSTNAME"]."', ";	
		$sql .= "ADDRESS	= '".$args["ADDRESS"]."', ";	
		$sql .= "CITY	= '".$args["CITY"]."', ";	
		$sql .= "COUNTRY	= '".$args["COUNTRY"]."', ";	
		$sql .= "NATIONAL	= '".$args["NATIONAL"]."', ";	
		if($args["email"] <> ''){
		$sql .= "email	= '".$args["email"]."', ";
		}
		if($args["password"] <> ''){	
		$sql .= "password	= PASSWORD('".$args["password"]."'), ";
		}
		$sql .= "TITLE	= '".$args["TITLE"]."' ";
		
		
		$sql .= "WHERE ID = '".$args["ID"]."' ";
		mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error()); 
		return mysql_affected_rows();
	}
	
	function ResetMemberPassword($ID, $ranpassword)
	{
		$sql  = "UPDATE member_guest SET ";
		$sql .= "STATUS	= 'CONFIRM', ";
		$sql .= "password	= PASSWORD('".$ranpassword."') ";	
		$sql .= "WHERE ID = '".$ID."' ";
		mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error()); 
		return mysql_affected_rows();
	}
	
	function insertMemberGuest($args)
	{
		$sql  = "INSERT INTO member_guest VALUES (";
		$sql .= "'', ";		
		$sql .= "'".$args["reference"]."', ";
		$sql .= "'".$args["LASTNAME"]."', ";
		$sql .= "'".$args["FIRSTNAME"]."', ";
		$sql .= "'".$args["TITLE"]."', ";
		$sql .= "'".$args["STATUS"]."', ";
		$sql .= "'".$args["pms_member_no"]."', ";
		$sql .= "'".$args["email"]."', ";
		$sql .= "'".$args["password"]."', ";
		$sql .= "'".$args["send_date"]."', ";
		$sql .= "'".$args["confirm_date"]."', ";
		$sql .= "'".$args["hotel_sec"]."', ";
		$sql .= "'".$args["travel_type"]."', ";
		$sql .= "'".$args["ADDRESS"]."', ";
		$sql .= "'".$args["CITY"]."', ";
		$sql .= "'".$args["COUNTRY"]."', ";
		$sql .= "'".$args["ICOMPNAME"]."', ";
		$sql .= "'".$args["NATIONAL"]."', ";
		$sql .= "'NO' )";		
		mysql_query($sql); 
		return mysql_insert_id(); 
	} // END FUNCTION			

} // END OF CLASS 




?>