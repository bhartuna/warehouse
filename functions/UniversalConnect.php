<?php

include_once 'IConnectInfo.php';

class UniversalConnect implements IConnectInfo{

	private $host = IConnectInfo::HOST;
	private $user = IConnectInfo::USER;
	private $pass = IConnectInfo::PASS;
	private $dbname = IConnectInfo::DBNAME;
	private $connect;
	
	public function doConnect(){
		$this->connect = new mysqli($this->host, $this->user, $this->pass, $this->dbname);	
		if(mysqli_connect_errno()){
			return false;	
		}
		else{
			return $this->connect;
		}	

	}

}

?>