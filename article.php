<?php
/*  Файл "Статья".
 *  Название: article.php
 *  Краткое описание:
 *  Выводит содержимое статьи.
 */
session_start();
$root = $_SERVER['DOCUMENT_ROOT'];
require_once $root."/functions/functions.php";
$id = $_GET["id"];
settype($id, 'integer');
if ($id < 1) header("Location: http://".$_SERVER['HTTP_HOST']);
#добавление комментария и очищение POST-данных
if(isset($_POST['comment'])){
addComment(str_replace("\n", "<br/>",$_POST['comment']), $id, $_SESSION['userId']);
header("Location: ".getUrl());
}
?>
<!DOCTYPE html>
<html>
<!--заголовки-->
<head>
	<?php
		$title = "Ольга Смирнова";
		require_once "blocks/head.php";
		
		$articles = getArticles($id);
		$comments = getComments($id);
				echo $_SESSION['userName'];
	?>

</head>
<!-- шапка-->
	<?php
		require_once "blocks/header.php"
	?>
<!-- тело-->
	<body>
	<div id = "bodyBlock" style = "display:table">
	<?php
	#вывод текста статьи
		echo "<div class = 'articleTitle'>
		<strong>".$articles["title"]."</strong><hr style = 'margin-top:30px'>
		</div>
		<div class = 'article'>
		".$articles["full_text"].'
		</div>
		<br><br>';
	?>
	</div>
	<div id = "commentsBlock">
		Комментарии
		<!-- вывод комментариев -->
		<?php
		if ($_SESSION['userExist'] == 1){
			echo '
			<form method = "post" action = "">
				<textarea name = "comment" cols = 80 rows = 5></textarea><br>
				<input type = "submit" value = "Отправить">
			</form>';
		}
		else
			echo '<br><br><strong> Войдите, чтобы оставить комментарий </strong>';
		?>
		<br>
		<br>
		<?php
			for ($i = 0; $i < count($comments); $i++){
				echo "<div class = 'comment'> 
				<div class = 'commentHead'>
				<div class = 'nickname'><strong>
				".$comments[$i]['nickname']."
				</strong></div>
				<div class = 'date'>
				".$comments[$i]['date']."
				</div>
				</div>
				<br><br>
				".$comments[$i]['text']."</div><br>";
			}
		?>
	</div>
<!-- футер -->
	<?php
		require_once "blocks/footer.php"
	?>
</body>
</html>