<?php
	require_once('init.php');
	$message = "";
	if(isset($_POST["register"])){
			if(!empty($_POST['name']) && !empty($_POST['password1']) && !empty($_POST['password2'])) {
				if($_POST['password1'] == $_POST['password2']) {
					if(strlen($_POST['password1']) > 2) {
						$name= htmlspecialchars($_POST['name']);
						$password1=htmlspecialchars($_POST['password1']);
						$password2=htmlspecialchars($_POST['password2']);
						$result = getUserByName($name);
						$token = uniqid();
						if ($result) {
							$message = "Это имя пользователя уже существует! Пожалуйста попробуйте другое.";
						} else {
							if (addUser($name, md5($password1), $token)) {
								$message = "Account успешно создан.";
								setcookie('token', $token, time() + 60 * 60 * 24 * 30);	
								header('Location: ' . '/');
								exit();
							} else {$message = "Не удалось добавить информацию!";}
						}
					} else {$message = "Пароль должен содержать как минимум 3 символов";}
				} else {$message = "Пароли не совпадают. Пожалуйста, попробуйте снова.";}
			} else {$message = "Все поля обязательны для заполнения";}
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
		<div class="container mregister">
			<div id="login">
				<h1>Регистрация</h1>
				<form action="register.php" id="registerform" method="post"name="registerform">
					<p><label for="user_login">ФИО<br>
					<input class="input" id="name" name="name"size="32"  type="text" value=""></label></p>
					<p><label for="user_pass">Пароль<br>
					<input class="input" id="password1" name="password1"size="32" type="password" value=""></label></p>
					<p><label for="user_pass_2">Введите пароль еще раз<br>
					<input class="input" id="password2" name="password2"size="20" type="password" value=""></label></p> 
					<p class="submit"><input class="button" id="register" name= "register" type="submit" value="Зарегистрироваться"></p>
					<p class="regtext">Уже зарегистрированы?  <a href= "login.php">Введите имя пользователя</a>!</p>
				</form>
			</div>
		</div>
		<?php 
			if (!empty($message)) {
				echo '<p class="error"'.">" . "Сообщение: ". $message . "</p>";
			} 
		?>

	</body>
</html>