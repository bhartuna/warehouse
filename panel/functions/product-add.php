<?php

include_once '../../functions/Product.php';

$new_product = $_GET['product'];
$count = $_GET['count'];
$select = $_GET['categorySelect'];

$product = new Product();
$product->setCategory($select);
$product->setName($count, $new_product);
if($product->insert()){
	$_SESSION['statement'] = 'Pomyślnie dodano produkt';
}
else{
	$_SESSION['error'] = 'err_999';
}

header('Location: /panel.php');
exit();

?>