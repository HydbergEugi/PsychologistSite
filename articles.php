<?php
/*  Файл "Список статей".
 *  Название: articles.php
 *  Краткое описание:
 *  Выводит список статей.
 */
session_start();
?>
<!DOCTYPE html>
<html>
<!--заголовки-->
<head>
	<?php
		$title = "Статьи";
		require_once "blocks/head.php";
		$articles = getArticles();
	?>
</head>
<!-- шапка -->
<?php
	require_once "blocks/header.php"
?>
<!-- тело -->
<body>
	<div id = "bodyBlock">
	<?php
		#вывод списка статей
		for  ($i = 0; $i < count($articles); $i++){
			echo '<div class = "articlePreview">';	
			
			echo '<div class = "articleImg">';
			echo '<img src = "/img/articles/'.$articles[$i]["id"].'.jpg"><br>';
			echo '</div>';
			
			echo '<div class = "previewTitle"><h3>';
			echo '<a href = "/article.php?id='.$articles[$i]["id"].'">'.$articles[$i]["title"].'</h3></a><br>';
			echo '</div>';
			echo '<hr style = "color: #DCDCDC">';
			
			echo '<div class = "previewIntro">';
			echo $articles[$i]["intro_text"].'<br>';
			echo '</div>';

			echo '</div>';
			if ($i%2==1) echo '<div class = "clear" style = "margin-bottom: 25px"></div>';
		}
	?>
	</div>
<!-- футер -->
	<?php
		require_once "blocks/footer.php"
	?>
</body>
</html>