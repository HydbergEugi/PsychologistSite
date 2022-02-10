<?php
/*  Файл "Выход".
*  Название: exit.php
*  Краткое описание:
*  Скрипт для выхода из профиля.
*/
session_start();
$_SESSION['userExist'] = null;
$_SESSION['userName'] = null;
header("Location: http://".$_SERVER['HTTP_HOST']);
?>