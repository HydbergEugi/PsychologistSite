<?php
/*  Файл "Авторизация".
 *  Название: auth.php
 *  Краткое описание:
 *  Страница с авторизацией.
 */
session_start();
$root = $_SERVER['DOCUMENT_ROOT'];
require_once $root."/functions/functions.php";
$authSuccess = false;
#авторизация пользователя и перенаправление на страницу профиля
if ($_POST['login'] != null)
{
	$id = checkAuthDataForExit($_POST['login'], $_POST['password']);
	if ($id){
		$authSuccess = true;
		$_SESSION['userExist'] = 1;
		$user = getUser($id);
		$_SESSION['userName'] = $user['nickname'];
		$_SESSION['authId'] = $id;
		$_SESSION['userId'] = $user['id'];
		header("Location: http://".$_SERVER['SERVER_NAME']);
	}
	else{
				
		$_SESSION['authAnswer'] = "Неправильный логин или пароль";
	}	
}
#очищение POST-данных
if(isset($_POST['login'])&&!$authSuccess){
header("Location: ".getUrl());
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
<!-- форма авторизации-->
	<div id = "bodyBlock" style = "height:50%">
	<h1>Авторизация</h1>
	<div id = "Form">
		<form  method = "post">
			<input type = "text" placeholder = "Ваше имя" id = "login" name = "login"><br>
			<input type = "text" placeholder = "Описание проблемы" id = "password" name = "password"><br>
			<input type = "submit" value = "Войти"/>
		</form>
		<div id = "messageShow">
		<?php
			echo $_SESSION['authAnswer'];
			if(!isset($_POST['login']))
				$_SESSION['authAnswer'] = "";
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