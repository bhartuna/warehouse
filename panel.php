<?php
 
error_reporting(0);

session_start();
if(!isset($_SESSION['login'])){
	header('Location: /');
	exit();
}

include_once 'functions/Error.php';
include_once 'functions/Category.php';
include_once 'functions/Product.php';

?>

<!DOCTYPE html>
<html>
<head>
	<title>Panel</title>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
	<link href="/panel/style.css" rel="stylesheet" type="text/css" media="all" />
	<script src="/panel/script.js" defer></script>
</head>
<body>
	<?php

	echo 'Witaj ' . $_SESSION['login'];

	?>
	<a href="logout.php"><button>Wyloguj</button></a>
	<div class="container">
		<div class="deleteBox">
			<p></p>
			<a href="#"><div class="deleteCategory">Tak</div></a>
			<div class="cancelDelete">Nie</div>
		</div>
		<?php 

		$category = new Category();
		$cat_list = $category->select();
		foreach($cat_list as $key => $value){
		
		?>
		<div class="category">
			<div class="category__name">
				<p><?php echo $key; ?> (<?php echo $value; ?>)</p>
			</div>
			<a <?php  echo 'href="/panel.php/?showCategory=' . $key . '"'; ?>><div class="category__show"></div></a>
			<div class="category__edit"></div>
			<div class="category__delete"></div>
		</div>
		<?php
		
			if($_GET['showCategory'] == $key){

				$product = new Product();
				$prod_list = $product->setCategory($_GET['showCategory']);
				$prod_list = $product->select();
				foreach($prod_list as $prod_key => $prod_value){

		?>		
		<p><?php echo $prod_key; ?> (<?php echo $prod_value; ?>)</p>
		<?php

				}
			}
		}
		
		?>
		
		<p><?php if(isset($_SESSION['error'])){ $error = new Error($_SESSION['error']); echo $error->show(); unset($_SESSION['error']); } else if(isset($_SESSION['statement'])){ echo $_SESSION['statement']; unset($_SESSION['statement']); } ?></p>
		<form method="get" action="/panel/functions/category-add.php">
			<label>Nazwa: <input type="text" name="category"></label>
			<input type="submit" name="submit" value="Dodaj">
		</form>
		<form method="get" action="/panel/functions/product-add.php">
			<label>Nazwa: <input type="text" name="product"></label>
			<label>Ilość: <input type="number" name="count"></label>
			<select name="categorySelect">
			<?php

			foreach($cat_list as $key => $value){

			?>
				<option><?php echo $key; ?></option>
			<?php

			}

			?>	
			</select>
			<input type="submit" name="submit" value="Dodaj">
		</form>
	</div>
</body>
</html>

