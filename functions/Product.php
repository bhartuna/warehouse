<?php

include_once 'UniversalConnect.php';

class Product{

	private $category;
	private $name;
	private $query_s;

	public function __construct(){
		$this->conn = UniversalConnect::doConnect();
	}

	public function __destruct(){
		$this->conn->close();
	}

	public function setCategory($category){
		$this->category = $category;
	}

	public function setName($name){
		$this->name = $name;
	}

	public function select(){
		if($this->conn == false){
			return 'err_1';
		}
		else{
			$this->query_s = "SELECT p.name AS name, p.count_product AS count FROM pw_product AS p INNER JOIN pw_category AS c ON c.id = p.category_id WHERE c.name = \"$this->category\"";
			$result = $this->conn->query($this->query_s);
			if ($result->num_rows > 0) {
				while($row = $result->fetch_assoc()) {
       				$prod_array[$row['name']] = $row['count'];
   				}
				return $prod_array;
				$this->query_s->close();
			}
		}
	}

	public function insert(){

	}

	public function update(){

	}

	public function delete(){

	}

}

?>