<?php

include_once 'UniversalConnect.php';

class Category{
	
	private $conn;
	private $query_s;

	public function __construct(){
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
			$this->query_s = "SELECT c.name AS name, IFNULL(SUM(p.count_product), 0) AS count FROM pw_category AS c LEFT JOIN pw_product AS p ON c.id = p.category_id GROUP BY p.category_id";
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

}

?>