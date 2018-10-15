<?PHP

class DbConn{ 

	var $conn;

	function DbConn($config){

		$this->conn = mysql_connect($config["hostname"], $config["username"], $config["password"]) or die(mysql_error());
		mysql_select_db($config["dbname"]) or die(mysql_error());
		mysql_query("SET NAMES 'UTF8'");
		mysql_query("SET character_set_results='UTF8'");


		

	}

	

	function closeDb() {

		mysql_close($this->conn);

	}

}

?>