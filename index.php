<?php

// Wyłączenie wyświetlania błędów

// error_reporting(0);

session_start();
if(isset($_SESSION['login'])){
	header('Location: /panel.php');
	exit();
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Product warehouse</title>
	<meta charset="utf-8" />
</head>
<body>
	<div class="container">
		<?php 

		if(isset($_SESSION['error'])){ 
			echo '<p>' . $_SESSION['error'] . '</p>';
			unset($_SESSION['error']); 
		}

		?>
		<form method="post" action="login.php">
			<label>Login: <input type="text" name="login"></label>
			<label>Hasło: <input type="text" name="password"></label>
			<input type="submit" name="submit" value="Zaloguj">
		</form>
	</div>
</body>
</html>