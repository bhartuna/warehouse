<?php 

session_start();
if(isset($_SESSION['login'])){
	header('Location: /panel.php');
	exit();
}
else if(!isset($_POST['login']) || !isset($_POST['password'])){
	header('Location: /');
	exit();
}

include_once 'functions/User.php';
include_once 'functions/Log.php';

$login = $_POST['login'];
$password = $_POST['password'];

if($login == '' || $password == ''){
	$_SESSION['error'] = 'err_2';
	header('Location: /');
	exit();
}

if($_SERVER['REQUEST_METHOD'] == 'POST'){
	$user = new User($login, $password);
	$result = $user->login();
	if($result == 'err_1'){
		$_SESSION['error'] = 'err_1';
		header('Location: /');
		exit();
	}
	else if($result == 'err_3'){
		$_SESSION['error'] = 'err_3';
		$log = new Log($login, false);
		$log->save();
		header('Location: /');
		exit();
	}
	else{
		$_SESSION['login'] = $result[2];
		$log = new Log($login, true);
		$log->save();
		header('Location: /panel.php');
		exit();
	}
}

?>