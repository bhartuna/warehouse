<?php

include_once 'UniversalConnect.php';

class User{

	private $conn;
	private $login;
	private $object;
	private $password;
	private $query_s;

	public function __construct($login, $password){
		$this->login = $login;
		$this->password = $password;
		$this->conn = UniversalConnect::doConnect();
	}

	public function __destruct(){
		$this->conn->close();
	}

	public function select(){
		if($this->conn == false){
			return 'err_1';
		}
		else{
			$this->query_s = $this->conn->prepare("SELECT id, login, role FROM pw_user WHERE login = ? AND password_user = MD5(?) LIMIT 1");	
			$this->query_s->bind_param("ss", $this->login, $this->password);
			$this->query_s->execute();
			$this->query_s->bind_result($s_id, $s_login, $s_role);
			$this->query_s->fetch();
			if(isset($s_id)){
				return array(true, $s_id, $s_login, $s_role);
			}
			else{
				return 'err_3';
			}
			$this->query_s->close();
		}	
	}

}

?>