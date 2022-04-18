<?php
	include_once('init.php');
	$message = "";
	if(isset($_POST["btLogin"])){
		$login=htmlspecialchars($_POST['login']);
		$password=htmlspecialchars($_POST['password']);
		if($login != '' && $password != '') {
			$idUser = authenticate($login, $password);
			if($idUser !== 0) {
				$_SESSION['userId'] = $idUser;
				$_SESSION['userName'] = $login;
				$token = uniqid();
				setcookie('token', $token, time() + 60 * 60 * 24 * 30);	
				header('Location: ' . '/');
				exit();
			} else {echo "Не известный пользователь, или пароль указан не верно";}
		} else {echo "Все поля обязательны для заполнения!";
		} 
	}
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Lesson-19</title>
		<link rel="stylesheet" href="bootstrap/css/bootstrap-grid.min.css">
		<link rel="stylesheet" href="css/normalize.css">
		<link rel="stylesheet" href="css/style.css">
	</head>
	<body>
		<div class="container mlogin">
			<div id="login">
				<h1>Вход</h1>
				<form action="" id="loginform" method="post"name="loginform">
					<p><label for="user_login">Имя пользователя<br>
					<input class="input" id="login" name="login"size="20" type="text" value=""></label></p>
					<p><label for="user_pass">Пароль<br>
					<input class="input" id="password" name="password"size="20" type="password" value=""></label></p> 
					<p class="submit"><input class="button" name="btLogin" type="submit" value="Войти"></p>
					<p class="regtext">Еще не зарегистрированы?<a href= "register.php">Регистрация</a>!</p>
				</form>
			</div>
		</div>
	</body>
</html>

