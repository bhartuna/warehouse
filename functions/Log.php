
<?php

include_once 'UniversalConnect.php';

class Log{

	private $conn;
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
		$this->conn = UniversalConnect::doConnect();
	}

	public function __destruct(){
		$this->conn->close();
	}

	public function select(){
		$this->query_s = $this->conn->prepare("SELECT login FROM pw_user WHERE login = ? LIMIT 1");
		$this->query_s->bind_param("s", $this->login);
		$this->query_s->execute();
		$this->query_s->bind_result($s_login);
		$this->query_s->fetch();
		if(isset($s_login)){
			$this->login = $s_login;
		}
		else{
			$this->login = NULL;
		}
		$this->query_s->close();
		$this->insert();
	}

	public function insert(){
		$this->query_i = $this->conn->prepare("INSERT INTO pw_log (id, login, ip, date_log, time_log, status_log) VALUES (NULL, ?, ?, ?, ?, ?)");
		$this->query_i->bind_param("ssssi", $this->login, $this->ip, DATE('Y-m-d'), DATE('H:i:s'), $this->status);
		$this->query_i->execute();
		$this->query_i->close();
	}

}

?>