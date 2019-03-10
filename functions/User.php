<?php

include_once 'UniversalConnect.php';

class User{

	private $connect;
	private $login;
	private $object;
	private $password;
	private $query;

	public function __construct($login, $password){
		$this->login = $login;
		$this->password = $password;
		$this->object = new UniversalConnect();
		$this->connect = $this->object->doConnect();
	}

	public function login(){
		if($this->connect == false){
			return 'err_1';
		}
		else{
			$this->query = $this->connect->prepare("SELECT id, login, role FROM pw_user WHERE login = ? AND password = MD5(?) LIMIT 1");	
			$this->query->bind_param("ss", $this->login, $this->password);
			$this->query->execute();
			$this->query->bind_result($s_id, $s_login, $s_role);
			$this->query->fetch();
			if(isset($s_id)){
				return array(true, $s_id, $s_login, $s_role);
			}
			else{
				return 'err_3';
			}
			$this->query->close();
		}	
		$this->connect->close();
	}

}

?>