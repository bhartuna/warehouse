<?php

include_once 'IConnectInfo.php';

class UniversalConnect implements IConnectInfo{

	private static $host = IConnectInfo::HOST;
	private static $user = IConnectInfo::USER;
	private static $pass = IConnectInfo::PASS;
	private static $dbname = IConnectInfo::DBNAME;
	private static $connect;
	
	public function doConnect(){
		self::$connect = new mysqli(self::$host, self::$user, self::$pass, self::$dbname);	
		if(self::$connect){
			return self::$connect;	
		}
		else{
			return false;
		}
	}

}

?>