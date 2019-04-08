<?php 

session_start();

include_once '../../functions/Category.php';

$delete_category = $_GET['name'];

$category = new Category();
$category->setName($delete_category);
if($category->delete()){
	$_SESSION['statement'] = 'Usunięto kategorię i jej produkty';
}
else{
	$_SESSION['error'] = 'err_6';
}

header('Location: /panel.php');
exit();

?>