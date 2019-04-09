<?php

include_once 'UniversalConnect.php';

class Product{

	private $category;
	private $count;
	private $name;
	private $query_i;
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

	public function setName($count, $name){
		$this->count = $count;
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
		$this->query_i = $this->conn->prepare("INSERT INTO pw_product (id, name, count_product, category_id) VALUES (NULL, ?, ?, (SELECT id FROM pw_category WHERE name = ?))");
		$this->query_i->bind_param("sis", $this->name, $this->count, $this->category);
		if($this->query_i->execute()){
			return true;
		}
		else{
			return false;
		}
		$this->query_i->close();
	}

	public function update(){

	}

	public function delete(){

	}

}

?>