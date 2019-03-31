<?php
 
error_reporting(0);

session_start();
if(!isset($_SESSION['login'])){
	header('Location: /');
	exit();
}

include_once 'functions/Category.php';

echo 'Witaj ' . $_SESSION['login'];

?>

<!DOCTYPE html>
<html>
<head>
	<title>Panel</title>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
	<link href="panel/style.css" rel="stylesheet" type="text/css" media="all" />
	<script src="panel/script.js" defer></script>
</head>
<body>
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
			<div class="category__show"></div>
			<div class="category__edit"></div>
			<div class="category__delete"></div>
		</div>
		<?php
		
		}
		
		?>
		<form method="get" action="panel/functions/category-add.php">
			<label>Nazwa: <input type="text" name="category"></label>
			<input type="submit" name="submit" value="Zapisz">
		</form>
	</div>
</body>
</html>

