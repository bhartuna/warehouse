<?php

include_once 'UniversalConnect.php';

class Category{
	
	private $name;
	private $connect;
	private $object;
	private $query;

	public function __construct($name){
		$this->name = $name;
	}

	public function insert(){
		$this->object = new UniversalConnect();
		$this->connect = $this->object->doConnect();
		if($this->connect == false){
			return 'Błąd połączenia z bazą danych';
		}
		else{
			$this->query = $this->connect->prepare("INSERT INTO pw_category (id, name) VALUES (NULL, ?)");
			$this->query->bind_param("s", $this->name);
			if($this->query->execute() == false){
				return 'Błąd podczas wprowadzania danych';
			}
			else{
				return 'Dane zostały wprowadzone';
			}
			$this->query->close();
			$this->connect->close();
		}
		
	}

	public function delete(){
		$this->object = new UniversalConnect();
		$this->connect = $this->object->doConnect();
		if($this->connect == false){
			return 'Błąd połączenia z bazą danych';
		}
		else{
			$this->query = $this->connect->prepare("DELETE FROM pw_category WHERE name = ?");
			$this->query->bind_param("s", $this->name);
			if($this->query->execute() == false){
				return 'Błąd podczas usuwania danych';
			}
			else{
				return 'Dane zostały usunięte';
			}
			$this->query->close();
			$this->connect->close();	
		}
	}

}

?>