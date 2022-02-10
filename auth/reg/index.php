<?php
/*  Файл "Регистрация".
 *  Название: reg.php
 *  Краткое описание:
 *  Страница регистрации пользователя.
 */
session_start();
$root = $_SERVER['DOCUMENT_ROOT'];
require_once $root."/functions/functions.php";

#очищение POST-данных 
#и проверка регистрации

if(isset($_POST['login'])||isset($_POST['password'])){
	$valid = valid($_POST['password'], $error);
	if($valid){	
		if (!checkRegDataForExit($_POST['login'], $_POST['password'])){
			insertAuthData($_POST['login'], $_POST['password']);
			$_SESSION['regAnswer'] = "Регистрация прошла успешна";
		}
		else{
				
			$_SESSION['regAnswer'] = "Данный пользователь уже существует";
		}	
		header("Location: ".getUrl());
	}
	else{
		$_SESSION['regAnswer'] = $error;
		header("Location: ".getUrl());
	}
}
?>
<!DOCTYPE html>
<html>
<!--заголовки-->
<head>
<?php

		$title = "Консультации";
		require_once $root."/blocks/head.php";
?>
</head>
<!-- шапка-->	
	<?php
		require_once $root."/blocks/header.php"
	?>
<!-- тело-->
	<body>
<!-- форма для регистрации-->
	<div id = "bodyBlock" style = "height:50%">
	<h1>Регистрация</h1>
	<div id = "Form">
		<form  method = "post">
			<input type = "text" placeholder = "Логин" id = "login" name = "login"><br>
			<input type = "text" placeholder = "Пароль" id = "password" name = "password"><br>
			<input type = "submit" value = "Зарегистрироваться"/>
		</form>
		<div id = "messageShow">
		<?php
			echo $_SESSION['regAnswer'];
		?>
		</div>
	</div>
	</div>
<!-- футер-->	
	<?php
		require_once $root."./blocks/footer.php"
	?>
</body>
</html>