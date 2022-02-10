<?php
/*  Файл "Редактирование профиля".
 *  Название: user.php
 *  Краткое описание:
 *  Страница редактирования информации пользователя.
 */
session_start();
$root = $_SERVER['DOCUMENT_ROOT'];
require_once $root."/functions/functions.php";
$user = getUser($_SESSION['authId']);
#очищение POST-данных
#и проверка данных пользователя
if(isset($_POST['name'])||isset($_POST['newPassword'])){
	$flag = true;
			
	if ($_POST['newPassword']!=""&&$_POST['oldPassword']==""){
		$_SESSION['answer'] = "Для смены пароля введите старый пароль";
		$flag = false;
	}
	if ($_POST['newPassword']!=""&&$_POST['oldPassword']!=""){
		$flag = checkPass($_POST['oldPassword'], $user['authFK']);
	}
	if($flag){
		connectDB();
		$mysqli->query("UPDATE `authentication` SET `password` = '".$_POST['newPassword']."'");
		$mysqli->query("UPDATE `users` SET `nickname` = '".$_POST['name']."' WHERE `authFK` = ".$user['authFK']);
		closeDB();
		$_SESSION['answer'] = "Succsafes";
		header("Location: ".getUrl());
	}
}
?>
<!DOCTYPE html>
<html>
<!--заголовки-->
<head>
<?php
		$root = $_SERVER['DOCUMENT_ROOT'];
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
	<div id = "bodyBlock" style = " display:table">
	<h1>Редактирование профиля</h1>
		<div id = "Form">
			<form  method = "post">
				<input type = "text" id = "name" name = "name" value = <?php echo $_SESSION['userName'] ?>><br>
				<input type = "text" placeholder = "Старый пароль" id = "oldPassword" name = "oldPassword"><br>
				<input type = "text" placeholder = "Новый пароль" id = "newPassword" name = "newPassword"><br>
				<input type = "submit" value = "Изменить"/>
			</form>
			<?php
				echo $_SESSION['answer'];
				if(!isset($_POST['name'])&&!isset($_POST['newPassword']))
					#$_SESSION['answer'] = "";
			?>
		</div>
		<br><br>
		<?php
			require_once "adminPanel.php"
		?>
	</div>
<!-- футер-->	
	<?php
		require_once $root."/blocks/footer.php"
	?>
</body>
</html>