<?php 

session_start();

include_once '../../functions/Category.php';

$new_category = $_GET['category'];

$category = new Category();
$category->setName($new_category);
if($category->insert()){
	$_SESSION['statement'] = 'Pomyślnie dodano kategorię';
}
else{
	$_SESSION['error'] = 'err_5';
}

header('Location: /panel.php');
exit();

?>