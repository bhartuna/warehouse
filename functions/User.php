<?php

include_once 'UniversalConnect.php';

class User{

	private $connect;
	private $login;
	private $object;
	private $password;
	private $result;
	private $role;
	private $row;
	private $query;

	public function __construct($login, $password){
		$this->login = $login;
		$this->password = $password;
	}

	public function login(){
		$this->object = new UniversalConnect();
		$this->connect = $this->object->doConnect();
		if($this->connect == false){
			return 'Błąd połączenia z bazą danych';
		}
		else{
			$this->query = $this->connect->prepare("SELECT id, login, role FROM pw_user WHERE login = ? AND password = MD5(?)");	
			$this->query->bind_param("ss", $this->login, $this->password);
			if($this->query->execute() == false){
				return 'Błąd podczas wyszukiwania danych';
			}
			else{
				$this->result = $this->query->get_result();
				if($this->result->num_rows == 1){
					$this->row = $this->result->fetch_assoc();
					return array(true, $this->row['id'], $this->row['login'], $this->row['role']);
				}
				else{
					return 'Błędne dane logowania';
				}
			}
			$this->query->close();
			$this->connect->close();
		}	
	}

}

?>