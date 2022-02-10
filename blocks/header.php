<?php
/*  Файл "Шапка сайта".
 *  Название: header.php
 *  Краткое описание:
 *  Содержит разметку шапки сайта.
 */
 
#вывод анимированной картинки и шапки
echo '
<div id = "mainPhoto">
		<img src = "/img/forest.jpg" alt = "Лес">
</div>
<header>
		<div style = "display:inline-block;margin-right:10%">
		<div id = "News">
		<a href = "/articles.php"><strong><span id = "myheader">С</span></strong>татьи</a>
		</div>
		<div id = "Consulting"> 
		<a href = "/consultings"><strong><span id = "myheader">К</span></strong>онсультации</a>
		</div>
		</div>
		<div style = "display:inline-block">
		<div id = "About">
		<a href = "/index.php">Психолог-консультант<br>Ольга Смирнова</a>
		</div>
		</div>';
		
#если пользователь авторизован, то произвести вывод вкладки "Профиль"
if ($_SESSION['userExist'] == 1){
		echo '
		<div style = "display:inline-block; width:350px;">
		<div id = "User">
		<a href = "/user/"><strong><span id = "myheader">Р</span></strong>едактировать рофиль</a>
		</div>
		<div style = "display:inline-block">
		|
		</div>
		<div id = "SignUp">
		<a href = "/user/exit.php"><strong><span id = "myheader">В</span></strong>ыход</a>
		</div>
		</div>
		';
}
#иначе вывод вкладок регистрации и входа
else{
		echo '
		<div style = "display:inline-block;margin-left:10%">
		<div id = "Registration">
		<a href = "/auth/reg"><strong><span id = "myheader">Р</span></strong>егистрация</a>
		</div>
		<div style = "display:inline-block">
		|
		</div>
		<div id = "SignUp">
		<a href = "/auth"><strong><span id = "myheader">В</span></strong>ход</a>
		</div>
		</div>';
}
echo '
</header>
';
?>