<!DOCTYPE html>
<html>
<head>
	<title>Product warehouse</title>
	<meta charset="utf-8" />
</head>
<body>
<?php

// Tymczasowy plik, docelowo ekran logowania

// Wyłączenie wyświetlania błędów

error_reporting(0);

include_once 'functions/Category.php';

$category = new Category('benke');
echo $category->insert();

?>
</body>
</html>