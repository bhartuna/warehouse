<?php

include_once 'UniversalConnect.php';

class Category{
	
	private $conn;
	private $name;
	private $query_s;
	private $query_i;
	private $query_d;

	public function __construct(){
		$this->conn = UniversalConnect::doConnect();
	}

	public function __destruct(){
		$this->conn->close();
	}

	public function setName($name){
		$this->name = $name;
	}
	
	public function select(){
		if($this->conn == false){
			return 'err_1';
		}
		else{
			$this->query_s = "SELECT c.name AS name, IFNULL(SUM(p.count_product), 0) AS count FROM pw_category AS c LEFT JOIN pw_product AS p ON c.id = p.category_id GROUP BY c.name";
			$result = $this->conn->query($this->query_s);
			if ($result->num_rows > 0) {
				while($row = $result->fetch_assoc()) {
       				$cat_array[$row['name']] = $row['count'];
   				}
				return $cat_array;
				$this->query_s->close();
			}
		}
	}

	public function insert(){
		$this->query_i = $this->conn->prepare("INSERT INTO pw_category (id, name) VALUES (NULL, ?)");
		$this->query_i->bind_param("s", $this->name);
		if($this->query_i->execute()){
			return true;
		}
		else{
			return false;
		}
		$this->query_i->close();
	}

	public function delete(){
		$this->query_d = $this->conn->prepare("DELETE FROM pw_category WHERE name = ?");
		$this->query_d->bind_param("s", $this->name);
		if($this->query_d->execute()){
			return true;
		}
		else{
			return false;
		}
		$this->query_d->close();
	}

}

?>