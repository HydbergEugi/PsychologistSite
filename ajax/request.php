<?php
/*  Файл "Запрос на отправление письма".
 *  Название: request.php
 *  Краткое описание:
 *  Отправляет письмо на электронную почту.
 */
#подготовка данных для отправки на почту
	$name = htmlspecialchars($_POST['name']);
	$description = htmlspecialchars($_POST['description']);
	$contacts = htmlspecialchars($_POST['contacts']);
	
	$subject = "=?utf-8?B?".base64_encode($name)."?=";
	$headers = "From: $contacts\r\nReply-to: $contacts\r\nContent-type: text/html; charset=utf-8\r\n";
	#отправление письма на электронную почту
	if(mail("006deidaraa600@gmail.com",$subject, $description, $headers)){
    echo 'Сообщение отправлено!';
}
else{
    echo 'Ошибка отправки сообщения.';
}
?>