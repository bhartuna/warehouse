<?php

error_reporting(0);

session_start();
if(isset($_SESSION['login'])){
	header('Location: /panel.php');
	exit();
}

include_once 'functions/Error.php';

?>
<!DOCTYPE html>
<html>
<head>
	<title>Product warehouse</title>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<link href="style.css" rel="stylesheet" type="text/css" media="all" />
	<script src="script.js" defer></script>
</head>
<body>
	<div class="container">
		<div class="error">
			<p><?php if(isset($_SESSION['error'])){ $error = new Error($_SESSION['error']); echo $error->show(); unset($_SESSION['error']); } ?></p>
		</div>
		<p><?php echo phpversion(); ?></p>
		<form class="form" method="post" action="login.php">
			<label>Login: <input class="form__login" type="text" name="login"></label>
			<label>Hasło: <input class="form__password" type="password" name="password"></label>
			<input type="submit" name="submit" value="Zaloguj">
		</form>
	</div>
</body>
</html>