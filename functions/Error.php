<?php

class Error{
	
	private $error;
	private $result;

	public function __construct($error){
		$this->error = $error;
	}

	public function show(){
		switch($this->error){
			case 'err_1':
				$this->result = 'Błąd połączenia z bazą danych';
				break;
			case 'err_2':
				$this->result = 'Uzupełnij wymagane pola';
				break;
			case 'err_3':
				$this->result = 'Błędne dane logowania';
				break;
			case 'err_4':
				$this->result = 'Błąd podczas wyszukiwania danych';
				break;
			default:
				$this->result = 'Nieznany błąd';
		}
		return $this->result;
	}

}

?>