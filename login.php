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
$submit = $_POST['submit'];

if(isset($submit)){
	$user = new User($login, $password);
	$result = $user->login();
	if($result[0] === true){
		$_SESSION['login'] = $result[2];
		$log = new Log($login, true);
		$log->save();
		header('Location: /panel.php');
		exit();
	}
	else{
		$_SESSION['error'] = $result;
		$log = new Log($login, false);
		$log->save();
		header('Location: /');
		exit();
	}
}

?>