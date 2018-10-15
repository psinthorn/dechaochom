<?PHP
require_once("iclass/sys.configs.php");
require_once("iclass/class.dbconn.php");
require_once("iclass/class.hotel.php");
require_once("iclass/class.room.php");
require_once("iclass/class.company.php");
require_once("iclass/class.guest.php");
require_once("iclass/class.member.php");

$dbConn		= new DbConn($config);
$hotel		= new Hotel();
$room		= new Room();
$company	= new company();
$guest		= new Guest();
$member	= new Member();

$hotel_sec = "665291302B4610DA7FB58E4DA81F6D39"; 

$allroom 	= $room->getAllRoom($hotel_sec);
$allsocial = $hotel->getAllSocial($hotel_sec);
$thishotel 	= $hotel->getHotel($hotel_sec);
$thiscomp = $company->getCompany($thishotel["hotel_chain_id"]);


	
//Multi Language
$lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
$lang_lg = $_SERVER['HTTP_ACCEPT_LANGUAGE'];

//Multi Language
if(!$_REQUEST["language_id"]){
$sql  = "SELECT * FROM hotel_language WHERE hotel_sec = '".$thishotel["hotel_sec"]."' AND ISO639_1 = '".$lang."' ";
$query = mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error());
$language = mysql_fetch_array($query);	
$language_id = $language["ID"];

if($language_id <> ''){	
$language_id = $language_id;
}
else {
$sql  = "SELECT * FROM hotel_language WHERE hotel_sec = '".$thishotel["hotel_sec"]."' AND language_default = 'YES' ";
$query = mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error());
$thislanguage = mysql_fetch_array($query);	
$language_id = $thislanguage["ID"];			
}

}
else {
$language_id = $_REQUEST["language_id"];	
}

$sql  = "SELECT *, hotel_language.ISO639_1, hotel_language.Name, hotel_language.NativeName  FROM hotel_language LEFT JOIN icontrol_language ON hotel_language.hotel_sec = icontrol_language.hotel_sec AND hotel_language.ID = icontrol_language.ID WHERE hotel_language.hotel_sec = '".$thishotel["hotel_sec"]."' AND hotel_language.ID = '".$language_id."' ";
$query = mysql_query($sql) or die("SQL : ".$sql."<br>ERROR : ". mysql_error());
$thismenu = mysql_fetch_array($query);
$flag = "".$thiscomp["engine_path"]."/img-server/flags_iso/24/".$thismenu["ISO639_1"].".png";
$thisflag = "<img src=\"".$flag."\" style=\"height:22px;\">";
$thisflag_mobile = "<img src=\"".$flag."\" style=\"height:25px;\">";	
$thislanguage = $thismenu["NativeName"];
?>