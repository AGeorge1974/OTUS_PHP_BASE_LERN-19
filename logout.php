<?php
	setcookie('token', '', time() - 3600, '/');
	session_start();
	unset($_SESSION['token']);
	session_destroy();
//	header("location:login.php");
	header("location: /");
?>
