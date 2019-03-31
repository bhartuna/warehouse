<?php 

include_once '../../functions/Category.php';

$delete_category = $_GET['name'];

$category = new Category();
$category->setName($delete_category);
$category->delete();

header('Location: /panel.php');
exit();

?>