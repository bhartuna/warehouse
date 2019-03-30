<?php
 
error_reporting(0);

session_start();
if(!isset($_SESSION['login'])){
	header('Location: /');
	exit();
}

include_once 'functions/Category.php';

$category = new Category();
$cat_list = $category->select();
print_r($cat_list);

echo 'Witaj ' . $_SESSION['login'];

?>
<a href="logout.php"><button>Wyloguj</button></a>