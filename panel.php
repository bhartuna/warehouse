<?php

session_start();
if(!isset($_SESSION['login'])){
	header('Location: /');
	exit();
}

echo 'Witaj ' . $_SESSION['login'];

?>
<a href="logout.php"><button>Wyloguj</button></a>