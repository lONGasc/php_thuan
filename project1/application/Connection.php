
<?php 
/**
 * 
 */
class Connection
{
	
	public static function getInstance(){
		$host = "localhost";
		$database = "php60_database";
		$user ="root";
		$pass = "";
		$db = new PDO("mysql:host=$host;dbname=$database;","$user","$pass");
		return $db;
	}
}

 ?>