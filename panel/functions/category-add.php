<?php 

include_once '../../functions/Category.php';

$new_category = $_GET['category'];

$category = new Category();
$category->setName($new_category);
$category->insert();

header('Location: /panel.php');
exit();

?>