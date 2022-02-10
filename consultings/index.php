<?php
/*  Файл "Консультации".
 *  Название: consultings.php
 *  Краткое описание:
 *  Страница с информацией о консультациях.
 */
session_start();
?>
<!DOCTYPE html>
<html>
<!--заголовки-->
<head>
	<?php
		$title = "Консультации";
		$root = $_SERVER['DOCUMENT_ROOT'];
		require_once $root."/blocks/head.php";
	?>
	<script src = "http://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
<!-- 
передача данных 
из формы для заявки
в файл для последующей 
отправки на почту -->

	<script>
		$(document).ready (function () {
			<!-- нажатие на кнопку "отправить"-->
			$("#done").click (function () {
				<!-- подготовка данных-->
				var name = $("#name").val ();
				var contacts = $("#contacts").val ();
				var description = $("#description").val ();
				
				var errMsg;
				var dataIsCorrect = true;
				var pattern  = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
				var rightEmail = pattern .test(String(contacts).toLowerCase());
				
				if (!rightEmail) {errMsg = 'Неверный формат электронной почты'; dataIsCorrect = false;}
				if (description == '') {errMsg = 'Опишите проблему'; dataIsCorrect = false;}
				if (contacts == '') {errMsg = 'Введите вашу электронную почту' + 'safsf'; dataIsCorrect = false;}
				if (name == '') {errMsg = 'Введите имя'; dataIsCorrect = false;}
				
				<!-- формирование запроса для передачи в файл с помощью технологии AJAX-->
				if (dataIsCorrect){
				$.ajax ({
					url: '/ajax/request.php',
					type: 'POST',
					cache: false,
					data: {'name':name, 'contacts':contacts, 'description':description},
					dataType: 'html',
					success: function(data){
						$("#messageShow").html (data);
						$("#messageShow").show ();
					}
				});	
				}
				else{
					$("#messageShow").html(errMsg);
				}
				
			});
		});
	</script>
</head>
<!-- шапка-->
	<?php
		require_once $root."/blocks/header.php"
	?>
<!-- тело-->
	<body>
<!-- форма для заявки на консультацию-->
	<div id = "bodyBlock" style = "display:table">
	<div id = "mainText">
	<?php require_once "Info.php" ?>
	
	<div id = "Form" style = "float:left;">
	<h1>Форма для заявки</h1>
		<input type = "text" placeholder = "Ваше имя" id = "name" name = "name"><br>
		<input type = "text" placeholder = "Описание проблемы" id = "description" name = "Описание"><br>
		<input type = "text" placeholder = "Контактные данные" id = "contacts" name = "Контакты"><br>
		<input type = "button" name = "done" id = "done" value = "Отправить"><br>
		<div id = "messageShow"></div>
	</div>
	<div class = "clear"></div>
	<?php require_once "info2.php" ?>
	</div>
	</div>
<!-- футер-->	
	<?php
		require_once "/../blocks/footer.php"
	?>
</body>
</html>