<?php

include_once 'UniversalConnect.php';

class Log{

	private $ip;
	private $login;
	private $status;

	public function __construct($login, $status){
		$this->ip = $_SERVER['REMOTE_ADDR'];
		$this->login = $login;
		if($status){
			$this->status = 1;
		}
		else{
			$this->status = 0;
		}
	}

	public function save(){
		$this->object = new UniversalConnect();
		$this->connect = $this->object->doConnect();
		$this->query = $this->connect->prepare("INSERT INTO pw_log (id, login, ip, status) VALUES (NULL, ?, ?, ?)");
		$this->query->bind_param("ssi", $this->login, $this->ip, $this->status);
		$this->query->execute();
		$this->query->close();
		$this->connect->close();
	}

}

?>