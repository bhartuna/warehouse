<?php

include_once 'UniversalConnect.php';

class Log{

	private $ip;
	private $login;
	private $status;
	private $query_s;
	private $query_i;

	public function __construct($login, $status){
		$this->ip = $_SERVER['REMOTE_ADDR'];
		$this->login = $login;
		if($status){
			$this->status = 1;
		}
		else{
			$this->status = 0;
		}
		$this->object = new UniversalConnect();
		$this->connect = $this->object->doConnect();
	}

	public function __destruct(){
		$query_i->close();
		$this->connect->close();
	}

	public function save(){
		$query_s = $this->connect->prepare("SELECT login FROM pw_user WHERE login = ? LIMIT 1");
		$query_s->bind_param("s", $this->login);
		$query_s->execute();
		$query_s->bind_result($s_login);
		$query_s->fetch();
		if(isset($s_login)){
			$this->login = $s_login;
		}
		else{
			$this->login = NULL;
		}
		$query_s->close();
		$query_i = $this->connect->prepare("INSERT INTO pw_log (id, login, ip, date_log, status_log) VALUES (NULL, ?, ?, ?, ?)");
		$query_i->bind_param("sssi", $this->login, $this->ip, DATE('Y-m-d'), $this->status);
		$query_i->execute();
	}

}

?>