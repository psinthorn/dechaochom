<?PHP 
class Booking { 

// FUNCTION : Contact CONSTRUCTORS
	function Contact()
	{ 
	// #################### //
	} // END FUNCTION

// FUNCTION : Booking CONSTRUCTORS
	function Booking()
	{ 
	// #################### //
	} // END FUNCTION

	
// FUNCTION : INSERT "Booking"
	function insertBooking($args)
	{
		$sql  = "INSERT INTO booking VALUES (";
		$sql .= "NULL, ";
		$sql .= "'".$args["hotel_id"]."', ";
		$sql .= "'".$args["hotel_sec"]."', ";			
		$sql .= "'".$args["bookref"]."', ";
		$sql .= "'".$args["contact"]."', ";
		$sql .= "'".$args["title"]."', ";
		$sql .= "'".$args["first"]."', ";
		$sql .= "'".$args["last"]."', ";						
		$sql .= "'".$args["email"]."', ";
		$sql .= "'".$args["telephone"]."', ";
		//10
		$sql .= "'".$args["address"]."', ";
		$sql .= "'".$args["city"]."', ";
		$sql .= "'".$args["zipcode"]."', ";
		$sql .= "'".$args["country"]."', ";
		$sql .= "'".$args["national"]."', ";		
		$sql .= "'".$args["transfer_type"]."', ";
		$sql .= "'".$args["flight_no"]."', ";
		$sql .= "'".$args["arr_time"]."', ";
		$sql .= "'".$args["book_request"]."', ";
		$sql .= "'".$args["smoking_preference"]."', ";
		//20
		$sql .= "'".$args["bed_preference"]."', ";
		$sql .= "'".$args["book_remark"]."', ";
		$sql .= "'".$args["room_id"]."', ";
		$sql .= "'".$args["room_code"]."', ";
		$sql .= "'".$args["room_type"]."', ";
		$sql .= "'".$args["ABF"]."', ";
		$sql .= "'".$args["rooms"]."', ";
		$sql .= "'".$args["checkin"]."', ";
		$sql .= "'".$args["checkout"]."', ";
		$sql .= "'".$args["nights"]."', ";
		//30
		$sql .= "'".$args["adult"]."', ";
		$sql .= "'".$args["extra_adult"]."', ";
		$sql .= "'".$args["extra_children"]."', ";
		$sql .= "'".$args["total"]."', ";
		$sql .= "'".$args["extra_adult_charge"]."', ";
		$sql .= "'".$args["extra_children_charge"]."', ";
		$sql .= "'".$args["gala_charge"]."', ";
		$sql .= "'".$args["transfer_charge"]."', ";
		$sql .= "'".$args["extra_service_charge"]."', ";
		$sql .= "'".$args["book_fee"]."', ";
		$sql .= "'".$args["rateamount"]."', ";
		$sql .= "'".$args["amount"]."', ";
		$sql .= "'".$args["service_type"]."', ";
		$sql .= "'".$args["service"]."', ";
		$sql .= "'".$args["service_charge"]."', ";
		$sql .= "'".$args["vat_type"]."', ";
		$sql .= "'".$args["vat"]."', ";
		$sql .= "'".$args["vat_charge"]."', ";
		$sql .= "'".$args["gamount"]."', ";				
		$sql .= "'".$args["deposit_charge"]."', ";
		
		$sql .= "'".$args["payment_amount"]."', ";
		$sql .= "'".$args["due_pay"]."', ";		
		$sql .= "'".$args["rate_detail"]."', ";
		$sql .= "'".$args["member_id"]."', ";
		$sql .= "'".$args["member_discount"]."', ";
		$sql .= "'".$args["member_benefits"]."', ";
		$sql .= "'".$args["disc_amount"]."', ";
		$sql .= "'".$args["promotion_code"]."', ";
		$sql .= "'".$args["payment_type"]."', ";
		$sql .= "'".$args["payment_ref"]."', ";		
		$sql .= "'".$args["cancel_day"]."', ";	
		$sql .= "'".$args["cancel_policy"]."', ";
		$sql .= "'', ";
		$sql .= "'".$args["device"]."', ";
		$sql .= "'".$args["device_desc"]."', ";
		$sql .= "'".$args["language_id"]."', ";
		$sql .= "'".$args["device_language"]."', ";						
		$sql .= "'".date("Y-m-d")."', ";
		$sql .= "'0000-00-00', ";
		$sql .= "'".$args["book_status"]."', ";
		$sql .= "'".$args["book_type"]."', ";
		$sql .= "'0', "; // USER VIEW BOOKING
		$sql .= "'0', "; // USER UPDATE BOOKING
		$sql .= "'".date("Y-m-d H:i:s")."' ) ";
		
		mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error()); 
		return $ref;
	} // END FUNCTION
	// FUNCTION : INSERT "Credit Card"
	function insertCc($args)
	{
		
		$sql  = "INSERT INTO Cc VALUES (";
		$sql .= "NULL, ";
		$sql .= "'".$args["cc_booking_id"]."', ";
		$sql .= "'".$args["cc_hotel_sec"]."', ";
		$sql .= "'".$args["cc_type"]."', ";			
		$sql .= "'".$args["cc_no1"]."', ";	
		$sql .= "'".$args["cc_no2"]."', ";	
		$sql .= "'".$args["cc_no3"]."', ";	
		$sql .= "'".$args["cc_no4"]."', ";	
		$sql .= "'".$args["cc_cvv"]."', ";	
		$sql .= "'".$args["cc_holder"]."', ";
		$sql .= "'".$args["cc_country"]."', ";
		$sql .= "'".$args["cc_expire"]."') ";
		
		mysql_query($sql); 
		return $ref;
	} // END FUNCTION
	
// FUNCTION : INSERT "Booking"
	function insertBookingManual($args)
	{
		$ref = md5(uniqid(rand()));
		$ref = strtoupper($ref);
		$sql  = "INSERT INTO booking VALUES (";
		$sql .= "NULL, ";
		$sql .= "'".$args["hotel_id"]."', ";
		$sql .= "'".$args["hotel_sec"]."', ";			
		$sql .= "'".$ref."', ";
		$sql .= "'".$args["contact"]."', ";
		$sql .= "'".$args["title"]."', ";
		$sql .= "'".$args["first"]."', ";
		$sql .= "'".$args["last"]."', ";						
		$sql .= "'".$args["email"]."', ";
		$sql .= "'".$args["telephone"]."', ";
		$sql .= "'".$args["address"]."', ";
		$sql .= "'".$args["city"]."', ";
		$sql .= "'".$args["zipcode"]."', ";
		$sql .= "'".$args["country"]."', ";
		$sql .= "'".$args["national"]."', ";		
		$sql .= "'".$args["transfer_type"]."', ";
		$sql .= "'".$args["flight_no"]."', ";
		$sql .= "'".$args["arr_time"]."', ";
		$sql .= "'".$args["book_request"]."', ";
		
		$sql .= "'".$args["room_id"]."', ";
		$sql .= "'".$args["room_code"]."', ";
		$sql .= "'".$args["room_type"]."', ";
		$sql .= "'".$args["ABF"]."', ";
		$sql .= "'".$args["rooms"]."', ";
		$sql .= "'".$args["checkin"]."', ";
		$sql .= "'".$args["checkout"]."', ";
		$sql .= "'".$args["nights"]."', ";

		$sql .= "'".$args["adult"]."', ";
		$sql .= "'".$args["extra_adult"]."', ";
		$sql .= "'".$args["extra_children"]."', ";

		$sql .= "'".$args["total"]."', ";
		$sql .= "'".$args["extra_adult_charge"]."', ";
		$sql .= "'".$args["extra_children_charge"]."', ";
		$sql .= "'".$args["gala_charge"]."', ";
		$sql .= "'".$args["transfer_charge"]."', ";
		$sql .= "'".$args["book_fee"]."', ";
		$sql .= "'".$args["rateamount"]."', ";
		$sql .= "'".$args["amount"]."', ";
		$sql .= "'".$args["service_type"]."', ";
		$sql .= "'".$args["service"]."', ";
		$sql .= "'".$args["service_charge"]."', ";
		$sql .= "'".$args["vat_type"]."', ";
		$sql .= "'".$args["vat"]."', ";
		$sql .= "'".$args["vat_charge"]."', ";
		$sql .= "'".$args["gamount"]."', ";				
		$sql .= "'".$args["deposit_charge"]."', ";
		
		$sql .= "'".$args["due_pay"]."', ";		
		$sql .= "'".$args["rate_detail"]."', ";
		$sql .= "'".$args["member_id"]."', ";
		$sql .= "'".$args["disc_amount"]."', ";
		$sql .= "'".$args["promotion_code"]."', ";
		$sql .= "'".$args["payment_type"]."', ";
		$sql .= "'".$args["payment_ref"]."', ";
		$sql .= "'".$args["cancel_day"]."', ";	
		$sql .= "'".$args["cancel_policy"]."', ";
		$sql .= "'', ";
		$sql .= "'".$args["device"]."', ";
		$sql .= "'".$args["device_desc"]."', ";
		$sql .= "'".$args["language_id"]."', ";
		$sql .= "'".$args["device_language"]."', ";					
		$sql .= "'".date("Y-m-d")."', ";
		$sql .= "'0000-00-00', ";
		$sql .= "'".$args["book_status"]."', ";
		$sql .= "'0', "; // USER VIEW BOOKING
		$sql .= "'0', "; // USER UPDATE BOOKING
		$sql .= "'".date("Y-m-d H:i:s")."' ) ";
		
		mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error()); 
		return mysql_insert_id();
	} // END FUNCTION	
	

// FUNCTION : INSERT "Extra_charge"		
function insertExtraCharge($args)
	{
		$sql  = "INSERT INTO extra_charge VALUES (";
		$sql .= "NULL, ";		
		$sql .= "'".$args["extra_booking_id"]."', ";
		$sql .= "'".$args["extra_book_ref"]."', ";
		$sql .= "'".$args["extra_type"]."', ";
		$sql .= "'".$args["extra_name"]."', ";
		$sql .= "'".$args["extra_desc"]."', ";
		$sql .= "'".$args["extra_rate"]."', ";
		$sql .= "'".$args["extra_unit"]."', ";
		$sql .= "'".$args["extra_charge"]."', ";
		$sql .= "'".$args["extra_hotel_sec"]."', ";	
		$sql .= "'".$args["extra_user"]."', ";
		$sql .= "'".date("Y-m-d H:i:s")."' ) ";		
		mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error()); 
		return mysql_insert_id();
	} // END FUNCTION
	
// FUNCTION : DELETE "Extra_charge"
	function deleteExtraCharge($extra_id)
	{
		
		$sql = "DELETE FROM extra_charge ";
		$sql .= "WHERE extra_id = '".$extra_id."' ";
		mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error()); 
		return  mysql_affected_rows();
	} // END FUNCTION	
	
// FUNCTION : UPDATE  BOOKING ADMIN
	function updateBookingAdmin($args)
	{

		$sql  = "UPDATE booking SET ";
		$sql .= "contact	= '".$args["title"]." ".$args["first"]." ".$args["last"]."', "; 		
		$sql .= "title	= '".$args["title"]."', ";
		$sql .= "first	= '".$args["first"]."', "; 
		$sql .= "last	= '".$args["last"]."', "; 
		$sql .= "address	= '".$args["address"]."', "; 
		$sql .= "city	= '".$args["city"]."', "; 
		$sql .= "country	= '".$args["country"]."', "; 
		$sql .= "national	= '".$args["national"]."', "; 
		$sql .= "zipcode	= '".$args["zipcode"]."', ";
		$sql .= "email	= '".$args["email"]."', "; 
		$sql .= "telephone	= '".$args["telephone"]."', ";   
		
		$sql .= "checkin	= '".$args["checkin"]."', "; 
		$sql .= "checkout	= '".$args["checkout"]."', "; 
		$sql .= "nights	= '".$args["nights"]."', "; 
		$sql .= "rooms		= '".$args["rooms"]."', "; 
		$sql .= "room_code		= '".$args["room_code"]."', "; 
		$sql .= "room_type		= '".$args["room_type"]."', "; 
		$sql .= "ABF		= '".$args["ABF"]."', "; 
		$sql .= "adult		= '".$args["adult"]."', "; 
		$sql .= "extra_adult	= '".$args["extra_adult"]."', "; 
		$sql .= "extra_children		= '".$args["extra_children"]."', "; 
		$sql .= "transfer_type		= '".$args["transfer_type"]."', "; 
		$sql .= "flight_no		= '".$args["flight_no"]."', "; 
		$sql .= "arr_time		= '".$args["arr_time"]."', "; 		
		$sql .= "rate_detail= '".$args["rate_detail"]."', "; 
		$sql .= "total 		= '".$args["total"]."', "; 
		$sql .= "extra_adult_charge		= '".$args["extra_adult_charge"]."', "; 
		$sql .= "extra_children_charge	= '".$args["extra_children_charge"]."', "; 
		$sql .= "gala_charge	= '".$args["gala_charge"]."', "; 
		$sql .= "transfer_charge= '".$args["transfer_charge"]."', "; 
		$sql .= "book_fee		= '".$args["book_fee"]."', "; 
		$sql .= "rateamount			= '".$args["rateamount"]."', "; 		
		$sql .= "amount			= '".$args["amount"]."', "; 
		$sql .= "disc_amount			= '".$args["disc_amount"]."', "; 
		$sql .= "service_type			= '".$args["service_type"]."', "; 
		$sql .= "service			= '".$args["service"]."', "; 
		$sql .= "service_charge			= '".$args["service_charge"]."', "; 
		$sql .= "vat_type			= '".$args["vat_type"]."', ";
		$sql .= "vat		= '".$args["vat"]."', ";
		$sql .= "vat_charge			= '".$args["vat_charge"]."', "; 
		$sql .= "gamount			= '".$args["gamount"]."', "; 
		$sql .= "deposit_charge	= '".$args["deposit_charge"]."', "; 
		$sql .= "due_pay	= '".$args["due_pay"]."', "; 
		$sql .= "payment_type	= '".$args["payment_type"]."', "; 
		$sql .= "payment_ref	= '".$args["payment_ref"]."', "; 
		$sql .= "payment_amount	= '".$args["payment_amount"]."', "; 						
		$sql .= "book_status	= '".$args["book_status"]."', ";
		$sql .= "user_update	= '".$args["staff_id"]."', "; 
		$sql .= "last_update	= '".date("Y-m-d H:i:s")."' "; 
		$sql .= "WHERE booking_id = '".$args["booking_id"]."' ";
		mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error()); 
		return mysql_affected_rows();
	} // END FUNCTION
	
//OPDATE BOOKING DONE BAY
	function updateBookingCreditGuarantee($book_ref, $payment_amount, $confirm_code)
	{
		$sql  = "UPDATE booking SET ";								
		$sql .= "book_status	= 'D', ";
		$sql .= "issuing_date	= '".date("Y-m-d")."', ";		
		$sql .= "payment_type	= '0', "; 
		$sql .= "payment_ref	= 'Please Settle Credit Card Guarantee', "; 
		$sql .= "payment_amount	= '".$payment_amount."', "; 
		$sql .= "confirm_code	= '".$confirm_code."', "; 			
		$sql .= "last_update	= '".date("Y-m-d H:i:s")."' "; 
		$sql .= "WHERE book_ref = '".$book_ref."' ";
		mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error()); 
		return mysql_affected_rows();
	} // END FUNCTION		
// FUNCTION : UPDATE  BOOKING ADMIN
	function updateBookingExtra($args)
	{
		$sql  = "UPDATE booking SET ";
		$sql .= "amount			= '".$args["amount"]."', ";
		$sql .= "service_charge			= '".$args["service_charge"]."', "; 
		$sql .= "vat_charge			= '".$args["vat_charge"]."', ";  
		$sql .= "gamount			= '".$args["gamount"]."', ";
		$sql .= "last_update	= '".date("Y-m-d H:i:s")."' "; 
		$sql .= "WHERE booking_id = '".$args["booking_id"]."' ";
		mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error()); 
		return mysql_affected_rows();
	} // END FUNCTION	
	
// FUNCTION : UPDATE  BOOKING ADMIN
	function PendingBooking($booking_id)
	{
		$sql  = "UPDATE booking SET ";					
		$sql .= "book_status	= 'P' ";
		$sql .= "WHERE booking_id = '".$_REQUEST["booking_id"]."' ";
		mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error()); 
		return mysql_affected_rows();
	} // END FUNCTION
// FUNCTION : DELETE BOOKING
	function DeleteBooking($booking_id)
	{
		$sql  = "UPDATE booking SET ";					
		$sql .= "book_status	= 'X' ";
		$sql .= "WHERE booking_id = '".$booking_id."' ";
		mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error()); 
		return mysql_affected_rows();
	} // END FUNCTION
	
// FUNCTION : DELETE BOOKING
	function RestoreBooking($booking_id)
	{
		$sql  = "UPDATE booking SET ";					
		$sql .= "book_status	= 'P' ";
		$sql .= "WHERE booking_id = '".$booking_id."' ";
		mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error()); 
		return mysql_affected_rows();
	} // END FUNCTION		
	
// FUNCTION : DELETE BOOKING
	function TurnCateBooking($booking_id)
	{
		$sql  = "DELETE FROM booking ";	
		$sql .= "WHERE booking_id = '".$booking_id."' ";
		mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error()); 
		return mysql_affected_rows();
	} // END FUNCTION				
			
//OPDATE BOOKING DONE BAY
	function updateBookingDone($book_ref, $payment_amount, $confirm_code)
	{
		$sql  = "UPDATE booking SET ";								
		$sql .= "book_status	= 'D', ";
		$sql .= "issuing_date	= '".date("Y-m-d")."', ";		
		$sql .= "payment_type	= '902', "; 
		$sql .= "payment_ref	= 'KRUNGSRI ONLINE PAYMENT', "; 
		$sql .= "payment_amount	= '".$payment_amount."', ";
		$sql .= "confirm_code	= '".$confirm_code."', "; 			
		$sql .= "last_update	= '".date("Y-m-d H:i:s")."' "; 
		$sql .= "WHERE book_ref = '".$book_ref."' ";
		mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error()); 
		return mysql_affected_rows();
	} // END FUNCTION
	
	
	
	function updateBookingPaylater($book_ref)
	{
		$sql  = "UPDATE booking SET ";								
		$sql .= "book_status	= 'D', ";
		$sql .= "confirm_code	= '".$confirm_code."', "; 
		$sql .= "issuing_date	= '".date("Y-m-d")."', ";		 			
		$sql .= "last_update	= '".date("Y-m-d H:i:s")."' "; 
		$sql .= "WHERE book_ref = '".$book_ref."' ";
		mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error()); 
		return mysql_affected_rows();
	} // END FUNCTION
	
	//OPDATE BOOKING DONE BAY
	function updateBalance($book_ref, $payment_amount)
	{
		$sql  = "UPDATE booking SET ";								
		$sql .= "payment_amount	= (payment_amount+".$balance_amount."), ";
		$sql .= "deposit_charge	= (deposit_charge+".$balance_amount."), "; 			
		$sql .= "last_update	= '".date("Y-m-d H:i:s")."' "; 
		$sql .= "WHERE book_ref = '".$book_ref."' ";
		mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error()); 
		return mysql_affected_rows();
	} // END FUNCTION
	
// FUNCTION : UPDATE  LAst Minute Booking
	function updateLastminuteBookingDone($book_ref)
	{
		$sql  = "UPDATE booking SET ";								
		$sql .= "book_status	= 'LD', ";
		$sql .= "issuing_date	= '".date("Y-m-d")."', ";		
		$sql .= "payment_type	= '817', "; 
		$sql .= "payment_ref	= 'KRUNGSRI ONLINE PAYMENT PROCESS', "; 
		$sql .= "last_update	= '".date("Y-m-d H:i:s")."' "; 
		$sql .= "WHERE book_ref = '".$book_ref."' ";
		mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error()); 
		return mysql_affected_rows();
	} // END FUNCTION	
	
// FUNCTION : UPDATE  Booking
	function updateBookingDoneSecond($book_ref)
	{
		$sql  = "UPDATE booking SET ";								
		$sql .= "deposit_charge	= '".$secondpay."', ";		
		$sql .= "last_update	= '".date("Y-m-d H:i:s")."' "; 
		$sql .= "WHERE book_ref = '".$book_ref."' ";
		mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error()); 
		return mysql_affected_rows();
	} // END FUNCTION		
		

// FUNCTION : UPDATE Access Booking
	function accessBooking($booking_id, $user_view)
	{
		$sql  = "UPDATE booking SET ";
		$sql .= "user_view			= '".$user_view."' "; 
		$sql .= "WHERE booking_id 	= '".$booking_id."' ";
		mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error()); 
		return mysql_affected_rows();
	} // END FUNCTION		


// FUNCTION : UPDATE "Booking STATUS"
	function makeVoucherAuto($book_ref)
	{
		$sql  = "UPDATE booking SET ";
		$sql .= "issuing_date	= '".date("Y-m-d")."', ";
		$sql .= "book_status	= 'D'  "; 
		$sql .= "WHERE book_ref = '".$book_ref."' ";
		mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error()); 
		return mysql_affected_rows();
	} // END FUNCTION
	
// FUNCTION : UPDATE "Booking STATUS"
	function makeVoucher($book_ref)
	{
		$sql  = "UPDATE booking SET ";
		$sql .= "issuing_date	= '".date("Y-m-d")."', ";
		$sql .= "book_status	= 'D'  "; 
		$sql .= "WHERE book_ref = '".$book_ref."' ";
		mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error()); 
		return mysql_affected_rows();
	} // END FUNCTION		


// FUNCTION : UPDATE "Booking STATUS"
	function makeVoucherManual($booking_id)
	{
		$sql  = "UPDATE booking SET ";
		$sql .= "issuing_date	= '".date("Y-m-d")."', ";
		$sql .= "book_status	= 'D'  "; 
		$sql .= "WHERE booking_id = '".$booking_id."' ";
		mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error()); 
		return mysql_affected_rows();
	} // END FUNCTION	

// FUNCTION : GET "BOOK"
	function getBooking($book_ref)
	{
		$sql  = "SELECT *, "; 
		$sql .= "DATE_FORMAT(checkin, '%e %M %Y') AS checkin_show, ";
		$sql .= "DATE_FORMAT(checkout, '%e %M %Y') AS checkout_show, ";
		$sql .= "(TO_DAYS(checkout) - TO_DAYS(checkin)) AS nights, ";
		$sql .= "DATE_FORMAT(book_date, '%e %M %Y') AS book_date_show, ";
		$sql .= "DATE_FORMAT(issuing_date, '%e %M %Y') AS issuing_date_show ";
		$sql .= "FROM booking ";
		$sql .= "LEFT JOIN hotel ON booking.hotel_sec = hotel.hotel_sec ";
		$sql .= "WHERE book_ref = '".$book_ref."' ";
		$query = mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error()); 
		return mysql_fetch_array($query);	
	} // END FUNCTION
	
// FUNCTION : GET "BOOK"
	function getTmpBooking($book_ref)
	{
		$sql  = "SELECT * "; 
		$sql .= "FROM tmp_booking ";
		$sql .= "LEFT JOIN hotel ON tmp_booking.hotel_sec = hotel.hotel_sec ";
		$sql .= "WHERE book_ref = '".$book_ref."' ";
		$query = mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error()); 
		return mysql_fetch_array($query);	
	} // END FUNCTION	

// FUNCTION : GET "BOOK"
	function getBookingBay($book_ref)
	{
		$sql  = "SELECT *, "; 
		$sql .= "DATE_FORMAT(checkin, '%e %M %Y') AS checkin_show, ";
		$sql .= "DATE_FORMAT(checkout, '%e %M %Y') AS checkout_show, ";
		$sql .= "(TO_DAYS(checkout) - TO_DAYS(checkin)) AS nights, ";
		$sql .= "DATE_FORMAT(book_date, '%e %M %Y') AS book_date_show, ";
		$sql .= "DATE_FORMAT(issuing_date, '%e %M %Y') AS issuing_date_show ";
		$sql .= "FROM booking ";
		$sql .= "LEFT JOIN hotel ON booking.hotel_sec = hotel.hotel_sec ";
		$sql .= "WHERE book_ref = '".$book_ref."' ";
		$query = mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error()); 
		return mysql_fetch_array($query);	
	} // END FUNCTION	

// FUNCTION : GET "BOOK"
	function getBookingID($booking_id)
	{
		$sql  = "SELECT *, "; 
		$sql .= "DATE_FORMAT(checkin, '%d/%m/%Y') AS checkin_edit, ";
		$sql .= "DATE_FORMAT(checkout, '%d/%m/%Y') AS checkout_edit, ";
		$sql .= "DATE_FORMAT(checkin, '%e %M %Y') AS checkin_show, ";
		$sql .= "DATE_FORMAT(checkout, '%e %M %Y') AS checkout_show, ";

		$sql .= "DATE_FORMAT(book_date, '%e %M %Y') AS book_date_show, ";
		$sql .= "DATE_FORMAT(issuing_date, '%e %M %Y') AS issuing_date_show,";
		$sql .= "DATE_FORMAT(booking.last_update, '%d %M %Y - %r') AS last_update_show ";
		$sql .= "FROM booking ";
		$sql .= "LEFT JOIN hotel ON booking.hotel_sec = hotel.hotel_sec ";
		$sql .= "WHERE booking_id = '".$booking_id."' ";
		$query = mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error()); 
		return mysql_fetch_array($query);	
	} // END FUNCTION
	
// FUNCTION : GET "BOOK"
	function getBookingRef($book_ref)
	{
		$sql  = "SELECT *, "; 
		$sql .= "DATE_FORMAT(checkin, '%d/%m/%Y') AS checkin_edit, ";
		$sql .= "DATE_FORMAT(checkout, '%d/%m/%Y') AS checkout_edit, ";
		$sql .= "DATE_FORMAT(checkin, '%e %M %Y') AS checkin_show, ";
		$sql .= "DATE_FORMAT(checkout, '%e %M %Y') AS checkout_show, ";
		$sql .= "(TO_DAYS(checkout) - TO_DAYS(checkin)) AS nights, ";
		$sql .= "DATE_FORMAT(book_date, '%e %M %Y') AS book_date_show, ";
		$sql .= "DATE_FORMAT(issuing_date, '%e %M %Y') AS issuing_date_show,";
		$sql .= "DATE_FORMAT(booking.last_update, '%d %M %Y - %r') AS last_update_show ";
		$sql .= "FROM booking ";
		$sql .= "LEFT JOIN hotel ON booking.hotel_sec = hotel.hotel_sec ";
		$sql .= "WHERE book_ref = '".$book_ref."' ";
		$query = mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error()); 
		return mysql_fetch_array($query);	
	} // END FUNCTION	
				
// FUNCTION : GET "BOOK"
	function getAllBookingAll($status, $pages, $rows)
	{
		$sql  = "SELECT booking.*, "; 
		$sql .= "DATE_FORMAT(book_date, '%e %b %Y') AS book_date_show, ";
		$sql .= "DATE_FORMAT(checkin, '%e %b %Y') AS checkin_show, ";
		$sql .= "(TO_DAYS(checkout) - TO_DAYS(checkin)) AS nights ";
		$sql .= "FROM booking ";
		$sql .= "WHERE booking.book_status = '".$status."' ";
		$sql .= "ORDER BY booking_id DESC ";
		$sql .= "LIMIT ".(($pages-1)*$rows).", ".$rows." "; 
		$query = mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error()); 
		$i = 0;
		while ($row = mysql_fetch_array($query)) {
			$result[$i]["booking_id"]	= $row["booking_id"];
			$result[$i]["hotel_id"]	= $row["hotel_id"];	
			$result[$i]["hotel_sec"]	= $row["hotel_sec"];			
			$result[$i]["hotel_ref"]	= $row["hotel_ref"];						
			$result[$i]["book_ref"]		= $row["book_ref"];
			$result[$i]["contact"]		= $row["contact"];
			$result[$i]["room_type"]	= $row["room_type"];
			$result[$i]["adult"]	= $row["adult"];
			$result[$i]["extra_adult"]	 = $row["extra_adult"];
			$result[$i]["extra_children"]	= $row["extra_children"];			
			$result[$i]["checkin"]		= $row["checkin"];
			$result[$i]["checkout"]		= $row["checkout"];
			$result[$i]["checkin_show"]	= $row["checkin_show"];
			$result[$i]["room_id"]		= $row["room_id"];
			$result[$i]["rooms"]		= $row["rooms"];
			$result[$i]["nights"]		= $row["nights"];
			$result[$i]["amount"]		= $row["amount"];
			$result[$i]["service_charge"]		= $row["service_charge"];
			$result[$i]["vat_charge"]		= $row["vat_charge"];
			$result[$i]["gamount"]		= $row["gamount"];
			$result[$i]["deposit_charge"] = $row["deposit_charge"];
			$result[$i]["user_view"] 	= $row["user_view"];
			$i++;
		}	
		return $result;	
	} // END FUNCTION
	
// FUNCTION : GET "BOOK"
	function getAllBooking($hotel_sec, $status, $pages, $rows)
	{
		$sql  = "SELECT booking.*, "; 
		$sql .= "DATE_FORMAT(book_date, '%e %b %Y') AS book_date_show, ";
		$sql .= "DATE_FORMAT(checkin, '%e %b %Y') AS checkin_show, ";
		$sql .= "(TO_DAYS(checkout) - TO_DAYS(checkin)) AS nights ";
		$sql .= "FROM booking ";
		$sql .= "WHERE booking.hotel_sec = '".$hotel_sec."' ";
		$sql .= "AND book_status = '".$status."' ";
		$sql .= "ORDER BY booking_id DESC ";
		$sql .= "LIMIT ".(($pages-1)*$rows).", ".$rows." "; 
		$query = mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error()); 
		$i = 0;
		while ($row = mysql_fetch_array($query)) {
			$result[$i]["booking_id"]	= $row["booking_id"];
			$result[$i]["hotel_ref"]		= $row["hotel_ref"];
			$result[$i]["hotel_id"]		= $row["hotel_id"];	
			$result[$i]["hotel_sec"]		= $row["hotel_sec"];									
			$result[$i]["book_ref"]		= $row["book_ref"];
			$result[$i]["contact"]		= $row["contact"];
			$result[$i]["room_type"]	= $row["room_type"];
			$result[$i]["adult"]	= $row["adult"];
			$result[$i]["extra_adult"]	 = $row["extra_adult"];
			$result[$i]["extra_children"]	= $row["extra_children"];			
			$result[$i]["checkin"]		= $row["checkin"];
			$result[$i]["checkout"]		= $row["checkout"];
			$result[$i]["checkin_show"]	= $row["checkin_show"];
			$result[$i]["room_id"]		= $row["room_id"];
			$result[$i]["rooms"]		= $row["rooms"];
			$result[$i]["nights"]		= $row["nights"];
			$result[$i]["amount"]		= $row["amount"];
			$result[$i]["service_charge"]		= $row["service_charge"];
			$result[$i]["vat_charge"]		= $row["vat_charge"];
			$result[$i]["gamount"]		= $row["gamount"];
			$result[$i]["deposit_charge"] = $row["deposit_charge"];
			$result[$i]["user_view"] 	= $row["user_view"];
			$result[$i]["status"] 	= $row["status"];
			$i++;
		}	
		return $result;	
	} // END FUNCTION	
	
// FUNCTION : GET "BOOK"
	function getAllLastminuteBooking($hotel_sec, $pages, $rows)
	{
		$sql  = "SELECT booking.*, "; 
		$sql .= "DATE_FORMAT(book_date, '%e %b %Y') AS book_date_show, ";
		$sql .= "DATE_FORMAT(checkin, '%e %b %Y') AS checkin_show, ";
		$sql .= "(TO_DAYS(checkout) - TO_DAYS(checkin)) AS nights ";
		$sql .= "FROM booking ";
		$sql .= "WHERE booking.hotel_sec = '".$hotel_sec."' ";
		$sql .= "AND book_status = 'L' or book_status = 'LD' ";
		$sql .= "ORDER BY booking_id DESC ";
		$sql .= "LIMIT ".(($pages-1)*$rows).", ".$rows." "; 
		$query = mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error()); 
		$i = 0;
		while ($row = mysql_fetch_array($query)) {
			$result[$i]["booking_id"]	= $row["booking_id"];
			$result[$i]["hotel_ref"]		= $row["hotel_ref"];
			$result[$i]["hotel_id"]		= $row["hotel_id"];	
			$result[$i]["hotel_sec"]		= $row["hotel_sec"];									
			$result[$i]["book_ref"]		= $row["book_ref"];
			$result[$i]["contact"]		= $row["contact"];
			$result[$i]["room_type"]	= $row["room_type"];
			$result[$i]["adult"]	= $row["adult"];
			$result[$i]["extra_adult"]	 = $row["extra_adult"];
			$result[$i]["extra_children"]	= $row["extra_children"];			
			$result[$i]["checkin"]		= $row["checkin"];
			$result[$i]["checkout"]		= $row["checkout"];
			$result[$i]["checkin_show"]	= $row["checkin_show"];
			$result[$i]["room_id"]		= $row["room_id"];
			$result[$i]["rooms"]		= $row["rooms"];
			$result[$i]["nights"]		= $row["nights"];
			$result[$i]["amount"]		= $row["amount"];
			$result[$i]["service_charge"]		= $row["service_charge"];
			$result[$i]["vat_charge"]		= $row["vat_charge"];
			$result[$i]["gamount"]		= $row["gamount"];
			$result[$i]["deposit_charge"] = $row["deposit_charge"];
			$result[$i]["user_view"] 	= $row["user_view"];
			$result[$i]["book_status"] 	= $row["book_status"];
			$result[$i]["promotion_code"] 	= $row["promotion_code"];
			$i++;
		}	
		return $result;	
	} // END FUNCTION	
		
	

// FUNCTION : GET "BOOK"
	function getBookingReport($hotel_sec, $date_type, $valid_from, $valid_to, $status, $country)
	{
		$sql  = "SELECT booking.*, "; 
		$sql .= "DATE_FORMAT(book_date, '%d/%m/%Y') AS date_show, ";
		$sql .= "DATE_FORMAT(checkin, '%d/%m/%Y') AS arrival, ";
		$sql .= "DATE_FORMAT(checkout, '%d/%m/%Y') AS departure, ";
		$sql .= "(TO_DAYS(checkout) - TO_DAYS(checkin)) AS nights ";
		$sql .= "FROM booking ";
		$sql .= "WHERE hotel_sec = '".$hotel_sec."' ";
		$sql .= "AND ".$date_type." >= '".$valid_from."' ";
		$sql .= "AND ".$date_type." <= '".$valid_to."' ";
		if ($status != "All") { $sql .= "AND book_status = '".$status."' "; } 
		if ($country != "All") { $sql .= "AND country = '".$country."' "; } 
		$sql .= "ORDER BY ".$date_type." ASC ";
		$query = mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error()); 
		$i = 0;
		while ($row = mysql_fetch_array($query)) {
			$result[$i]["booking_id"]	= $row["booking_id"];
			$result[$i]["date_type"]	= $row["date)type"];			
			$result[$i]["booking_sec"]	= $row["booking_sec"];			
			$result[$i]["hotel_ref"]	= $row["hotel_ref"];			
			$result[$i]["contact"]		= $row["contact"];
			$result[$i]["room_type"]	= $row["room_type"];
			$result[$i]["adult"]	= $row["adult"];
			$result[$i]["extra_adult"]	 = $row["extra_adult"];
			$result[$i]["extra_children"]	= $row["extra_children"];			
			$result[$i]["arrival"]		= $row["arrival"];
			$result[$i]["departure"]	= $row["departure"];
			$result[$i]["rooms"]		= $row["rooms"];
			$result[$i]["nights"]		= $row["nights"];
			$result[$i]["country"]		= $row["country"];
			$result[$i]["amount"]		= $row["amount"];
			$result[$i]["service"]		= $row["service_charge"];
			$result[$i]["vat"]		= $row["vat_charge"];
			$result[$i]["gamount"]		= $row["gamount"];
			$result[$i]["deposit"] 		= $row["deposit_charge"];
			$result[$i]["book_status"] 		= $row["book_status"];			
			$result[$i]["date_show"]	= $row["date_show"];
			$i++;
		}	
		return $result;	
	} // END FUNCTION	
	
// FUNCTION : GET "DEPOSIT"
	function getDepositReport($hotel_sec, $date_type, $valid_from, $valid_to, $status)
	{
		$sql  = "SELECT booking.*, "; 
		$sql .= "DATE_FORMAT(book_date, '%d/%m/%Y') AS date_show, ";
		$sql .= "DATE_FORMAT(checkin, '%d/%m/%Y') AS arrival, ";
		$sql .= "DATE_FORMAT(checkout, '%d/%m/%Y') AS departure, ";
		$sql .= "(TO_DAYS(checkout) - TO_DAYS(checkin)) AS nights ";
		$sql .= "FROM booking ";
		$sql .= "WHERE hotel_sec = '".$hotel_sec."' ";
		$sql .= "AND ".$date_type." >= '".$valid_from."' ";
		$sql .= "AND ".$date_type." <= '".$valid_to."' ";
		$sql .= "AND book_status = 'D' ";
		$sql .= "ORDER BY ".$date_type." ASC ";
		$query = mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error()); 
		$i = 0;
		while ($row = mysql_fetch_array($query)) {
			$result[$i]["booking_id"]	= $row["booking_id"];
			$result[$i]["date_type"]	= $row["date)type"];			
			$result[$i]["booking_sec"]	= $row["booking_sec"];			
			$result[$i]["hotel_ref"]	= $row["hotel_ref"];			
			$result[$i]["contact"]		= $row["contact"];
			$result[$i]["room_type"]	= $row["room_type"];
			$result[$i]["adult"]	= $row["adult"];
			$result[$i]["extra_adult"]	 = $row["extra_adult"];
			$result[$i]["extra_children"]	= $row["extra_children"];			
			$result[$i]["arrival"]		= $row["arrival"];
			$result[$i]["departure"]	= $row["departure"];
			$result[$i]["rooms"]		= $row["rooms"];
			$result[$i]["nights"]		= $row["nights"];
			$result[$i]["country"]		= $row["country"];
			$result[$i]["amount"]		= $row["amount"];
			$result[$i]["service"]		= $row["service_charge"];
			$result[$i]["vat"]		= $row["vat_charge"];
			$result[$i]["gamount"]		= $row["gamount"];
			$result[$i]["deposit"] 		= $row["deposit_charge"];
			$result[$i]["book_status"] 		= $row["book_status"];			
			$result[$i]["date_show"]	= $row["date_show"];
			$i++;
		}	
		return $result;	
	} // END FUNCTION	
	
// FUNCTION : GET "BOOK"
	function getBookingReportAll($hotel_sec, $date_type, $valid_from, $valid_to, $status)
	{
		$sql  = "SELECT booking.*, "; 
		$sql .= "DATE_FORMAT(book_date, '%d/%m/%Y') AS date_show, ";
		$sql .= "DATE_FORMAT(checkin, '%d/%m/%Y') AS arrival, ";
		$sql .= "DATE_FORMAT(checkout, '%d/%m/%Y') AS departure, ";
		$sql .= "(TO_DAYS(checkout) - TO_DAYS(checkin)) AS nights ";
		$sql .= "FROM booking ";
		$sql .= "WHERE hotel_sec = '".$hotel_sec."' ";			
		$sql .= "AND ".$date_type." >= '".$valid_from."' ";
		$sql .= "AND ".$date_type." <= '".$valid_to."' ";
		$sql .= "AND book_status = 'D' "; 
		$sql .= "ORDER BY ".$date_type." ASC ";
		$query = mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error()); 
		$i = 0;
		while ($row = mysql_fetch_array($query)) {
			$result[$i]["booking_id"]	= $row["booking_id"];
			$result[$i]["hotel_id"]	= $row["hotel_id"];
			$result[$i]["hotel_sec"]	= $row["hotel_sec"];			
			$result[$i]["hotel_ref"]	= $row["hotel_ref"];											
			$result[$i]["contact"]		= $row["contact"];
			$result[$i]["room_type"]	= $row["room_type"];
			$result[$i]["adult"]	= $row["adult"];
			$result[$i]["extra_adult"]	 = $row["extra_adult"];
			$result[$i]["extra_children"]	= $row["extra_children"];			
			$result[$i]["arrival"]		= $row["arrival"];
			$result[$i]["departure"]	= $row["departure"];
			$result[$i]["rooms"]		= $row["rooms"];
			$result[$i]["nights"]		= $row["nights"];
			$result[$i]["country"]		= $row["country"];
			$result[$i]["amount"]		= $row["amount"];
			$result[$i]["service"]		= $row["service_charge"];
			$result[$i]["vat"]		= $row["vat_charge"];
			$result[$i]["gamount"]		= $row["gamount"];
			$result[$i]["deposit"] 		= $row["deposit_charge"];
			$result[$i]["book_status"] 		= $row["book_status"];			
			$result[$i]["date_show"]	= $row["date_show"];
			$i++;
		}	
		return $result;	
	} // END FUNCTION	
		
	// FUNCTION : GET "BOOK"
	function getCountBookingAll($hotel_sec)
	{
		$sql  = "SELECT COUNT(*) AS allbook FROM booking ";
		$sql .= "WHERE booking.hotel_sec = '".$hotel_sec."' ";
		$sql .= "AND book_status = '".$book_status."' ";
		$query = mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error()); 
		$result = mysql_fetch_array($query);
		return $result["allbook"]; // COUNT ALL ROW IN DATABASE
	} // END FUNCTION
	
	
	function getCountBooking($hotel_sec, $status)
	{
		$sql  = "SELECT COUNT(*) AS allbook FROM booking ";
		$sql .= "WHERE booking.hotel_sec = '".$hotel_sec."' ";
		$sql .= "AND book_status = '".$status."' ";
		$query = mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error()); 
		$result = mysql_fetch_array($query);
		return $result["allbook"]; // COUNT ALL ROW IN DATABASE
	} // END FUNCTION
	
	function getCountLastminuteBooking($hotel_sec)
	{
		$sql  = "SELECT COUNT(*) AS allbook FROM booking ";
		$sql .= "WHERE booking.hotel_sec = '".$hotel_sec."' ";
		$sql .= "AND book_status = 'L' or book_status = 'LD'";
		$query = mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error()); 
		$result = mysql_fetch_array($query);
		return $result["allbook"]; // COUNT ALL ROW IN DATABASE
	} // END FUNCTION	
	

	// FUNCTION : GET "BOOK"
	function getCountNewBooking($hotel_sec, $status)
	{
		$sql  = "SELECT COUNT(*) AS allbook FROM booking ";
		$sql .= "WHERE booking.hotel_sec = '".$hotel_sec."' ";
		$sql .= "AND book_status = '".$status."' ";
		$sql .= "AND user_view = '0' ";
		$query = mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error()); 
		$result = mysql_fetch_array($query);
		return $result["allbook"]; // COUNT ALL ROW IN DATABASE
	} // END FUNCTION
	
	// FUNCTION : GET "BOOK"
	function getCountNewBookingAll($status)
	{
		$sql  = "SELECT COUNT(*) AS allbook FROM booking ";
		$sql .= "WHERE booking.book_status = '".$status."' ";
		$sql .= "AND user_view = '0' ";
		$query = mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error()); 
		$result = mysql_fetch_array($query);
		return $result["allbook"]; // COUNT ALL ROW IN DATABASE
	} // END FUNCTION	
	

// FUNCTION : Get All "Country"
	function getAllCountry($COUNTRY_CODE)
	{
		$sql  = "SELECT * FROM country ";
		$sql .= "ORDER BY country_name";
		$query = mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error()); 
		$i = 0;
		while ($row = mysql_fetch_array($query)) {
			$result[$i]["ROWIDS"]			= $row["ROWIDS"];
			$result[$i]["COUNTRY_CODE"]		= $row["COUNTRY_CODE"];
			$result[$i]["COUNTRY_NAME"]		= $row["COUNTRY_NAME"];	
			$result[$i]["ZONECODE"]			= $row["ZONECODE"];
			$i++;	
		}
		return $result;
		} // END FUNCTION
		
// FUNCTION : Get All "Country"
	function getAllCountrycwc($COUNTRY_CODE)
	{
		$sql  = "SELECT * FROM country_cwc ";
		$sql .= "ORDER BY country_name";
		$query = mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error()); 
		$i = 0;
		while ($row = mysql_fetch_array($query)) {
			$result[$i]["ROWIDS"]			= $row["ROWIDS"];
			$result[$i]["COUNTRY_CODE"]		= $row["COUNTRY_CODE"];
			$result[$i]["COUNTRY_NAME"]		= $row["COUNTRY_NAME"];	
			$result[$i]["ZONECODE"]			= $row["ZONECODE"];
			$i++;	
		}
		return $result;
		} // END FUNCTION			
		
// FUNCTION : Get All "National"
	function getAllNational($national_CODE)
	{
		$sql  = "SELECT * FROM national ";
		$sql .= "ORDER BY national_NAME";
		$query = mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error()); 
		$i = 0;
		while ($row = mysql_fetch_array($query)) {
			$result[$i]["ROWIDS"]			= $row["ROWIDS"];
			$result[$i]["national_CODE"]		= $row["national_CODE"];
			$result[$i]["national_NAME"]		= $row["national_NAME"];	
			$result[$i]["ZONECODE"]			= $row["ZONECODE"];
			$i++;	
		}
		return $result;
		} // END FUNCTION	
		
// FUNCTION : Get All "National"
	function getAllNationalcwc($national_CODE)
	{
		$sql  = "SELECT * FROM national_cwc ";
		$sql .= "ORDER BY national_NAME";
		$query = mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error()); 
		$i = 0;
		while ($row = mysql_fetch_array($query)) {
			$result[$i]["ROWIDS"]			= $row["ROWIDS"];
			$result[$i]["national_CODE"]		= $row["national_CODE"];
			$result[$i]["national_NAME"]		= $row["national_NAME"];	
			$result[$i]["ZONECODE"]			= $row["ZONECODE"];
			$i++;	
		}
		return $result;
		} // END FUNCTION				

	// FUNCTION : INSERT "TMP Payment"
	function insertTmpPay($ref_no)
	{
		$sql  = "INSERT INTO tmppayment VALUES ( ";
		$sql .= "NULL, ";
		$sql .= "'".$ref_no."', ";
		$sql .= "'getcode', ";
		$sql .= "'".date("Y-m-d H:i:s")."')";
		mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error());  
		return mysql_insert_id(); // RETURN ID
	} // END FUNCTION


	// FUNCTION : INSERT "TMP Payment"
	function updateTmpPay($tmp_id, $response)
	{
		$sql  = "UPDATE tmppayment SET ";
		$sql .= "response 		= '".$response."' ";
		$sql .= "WHERE tmp_id	= '".$tmp_id."' ";
		mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error());  
		return mysql_affected_rows();
	} // END FUNCTION
	
	// FUNCTION : INSERT "TMP Payment BBL"
	function insertTmpPaySuccess($ref_no)
	{
		$sql  = "INSERT INTO tmppayment VALUES ( ";
		$sql .= "NULL, ";
		$sql .= "'".$_GET["Ref"]."', ";
		$sql .= "'approved', ";
		$sql .= "'".date("Y-m-d H:i:s")."')";
		mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error());  
		return mysql_insert_id(); // RETURN ID
	} // END FUNCTION
	
	// FUNCTION : INSERT "TMP Payment BBL"
	function insertTmpPayFail($ref_no)
	{
		$sql  = "INSERT INTO tmppayment VALUES ( ";
		$sql .= "NULL, ";
		$sql .= "'".$_GET["Ref"]."', ";
		$sql .= "'fail', ";
		$sql .= "'".date("Y-m-d H:i:s")."')";
		mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error());  
		return mysql_insert_id(); // RETURN ID
	} // END FUNCTION
	
	// FUNCTION : INSERT "TMP Payment BBL"
	function insertTmpPayCancel($ref_no)
	{
		$sql  = "INSERT INTO tmppayment VALUES ( ";
		$sql .= "NULL, ";
		$sql .= "'".$_GET["Ref"]."', ";
		$sql .= "'cancel', ";
		$sql .= "'".date("Y-m-d H:i:s")."')";
		mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error());  
		return mysql_insert_id(); // RETURN ID
	} // END FUNCTION	
	
	// FUNCTION : UPDATE "TMP PAYMENT BBL SUCCESS"
	function updateTmpPaySuccess($tmp_id, $response)
	{
		$sql  = "UPDATE tmppayment SET ";
		$sql .= "response 		= 'approved' ";
		$sql .= "WHERE tmp_id	= '".$tmp_id."' ";
		mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error());  
		return mysql_affected_rows();
	} // END FUNCTION
	
	// FUNCTION : UPDATE "TMP PAYMENT BBL CANCEL"
	function updateTmpPayCancel($tmp_id, $response)
	{
		$sql  = "UPDATE tmppayment SET ";
		$sql .= "response 		= 'cancel' ";
		$sql .= "WHERE tmp_id	= '".$tmp_id."' ";
		mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error());  
		return mysql_affected_rows();
	} // END FUNCTION	
	
	// FUNCTION : UPDATE "TMP PAYMENT BBL FAIL"
	function updateTmpPayFail($tmp_id, $response)
	{
		$sql  = "UPDATE tmppayment SET ";
		$sql .= "response 		= 'fail' ";
		$sql .= "WHERE tmp_id	= '".$tmp_id."' ";
		mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error());  
		return mysql_affected_rows();
	} // END FUNCTION
		
	// FUNCTION : INSERT "TMP Payment BAY"
	function insertTmpPayBay($ref_no)
	{
		$sql  = "INSERT INTO tmppayment VALUES ( ";
		$sql .= "NULL, ";
		$sql .= "'".$_GET["REF1"]."".$_GET["REF2"]."', ";
		$sql .= "'".$_GET["RESPCODE"]."', ";
		$sql .= "'".date("Y-m-d H:i:s")."')";
		mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error());  
		return mysql_insert_id(); // RETURN ID
	} // END FUNCTION
	
	// FUNCTION : UPDATE "TMP PAYMENT BAY"
	function updateTmpPayBay($tmp_id, $response)
	{
		$sql  = "UPDATE tmppayment SET ";
		$sql .= "response 		= '".$RESPCODE."' ";
		$sql .= "WHERE tmp_id	= '".$tmp_id."' ";
		mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error());  
		return mysql_affected_rows();
	} // END FUNCTION					
		

} // END OF CLASS 
?>