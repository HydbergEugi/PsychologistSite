<?php
/*  Файл "Заголовки".
 *  Название: head.php
 *  Краткое описание:
 *  Содержит заголовочную информацию сайта.
 */
#подключение файла с функциями
	$root = $_SERVER['DOCUMENT_ROOT'];
	require_once $root."/functions/functions.php";
	visitsCount();
?>
<!-- установка кодировки, заголовка и таблицы стилей-->
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta charset = "utf-8">
<title><?php echo $title ?></title>
<link href="/css/style.css" rel="stylesheet" type="text/css">