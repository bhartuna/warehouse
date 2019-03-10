<?php

include_once 'UniversalConnect.php';

class Category{
	
	private $name;
	private $connect;
	private $object;
	private $query;

	public function __construct($name){
		$this->name = $name;
		$this->object = new UniversalConnect();
		$this->connect = $this->object->doConnect();	
	}

	public function __destruct(){
		$this->connect->close();
	}

	public function add(){
		if($this->connect == false){
			return 'Błąd połączenia z bazą danych';
		}
		else{
			$this->query = $this->connect->prepare("INSERT INTO pw_category (id, name) VALUES (NULL, ?)");
			$this->query->bind_param("s", $this->name);
			if($this->query->execute() == false){
				return 'Błąd podczas wykonywania komendy';
			}
			else{
				return 'Dane zostały wprowadzone';
			}
			$this->query->close();
		}
	}

	public function delete(){
		if($this->connect == false){
			return 'Błąd połączenia z bazą danych';
		}
		else{
			$this->query = $this->connect->prepare("DELETE FROM pw_category WHERE name = ?");
			$this->query->bind_param("s", $this->name);
			if($this->query->execute() == false){
				return 'Błąd podczas wykonywania komendy';
			}
			else{
				return 'Dane zostały usunięte';
			}
			$this->query->close();
		}
	}

}

?>