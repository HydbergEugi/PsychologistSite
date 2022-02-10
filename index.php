<?php
# Сайт smibk.ru
# Дипломный проект на тему: 
# «Разработка веб-сайта для предоставления консультаций психолога»
# Специальность: 09.02.03 Программирование в компьютерных системах
# Разработал: Фуфарев Никита Радиславович
# Дата: 05.06.2020
# Программа написана на языках HTML, CSS, PHP
# Задание:
#   Разработать сайт, предоставляющий информацию о психологе и его услугах
# Сайт должен выполнять следующие функции:
# - предоставление информации о психологе;
# - считывание и корректная обработка данных пользователя и информационной базы.

/*  Файл "Главная страница".
 *  Название: index.php
 *  Краткое описание:
 *  Содержит главную информацию о психологе и его деятельности.
 */
session_start();
?>
<!DOCTYPE html>
<html>
<!--заголовки-->
<head>
	<?php
		$title = "Ольга Смирнова";
		require_once "blocks/head.php";
	?>
</head>
<!-- шапка сайта-->
<?php
		require_once "blocks/header.php"
?>
<!-- тело сайта-->
<body>
	<div id = "bodyBlock" style = "display:table">
	<div id = "mainText">
	<?php
		#основной текст веб-документа
		require_once "mainInfo.php"
	?>
	</div>
	</div>
<!-- футер сайта-->
	<?php
		require_once "blocks/footer.php"
	?>
</body>
</html>