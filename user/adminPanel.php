<?php 
$root = $_SERVER['DOCUMENT_ROOT'];
require_once $root."/functions/functions.php";
?>
<div style = "width:100%"><hr style = "color: silver; margin-bottom:20px;"></div>
<div style = "margin:auto; width: 500px; text-align:center">
<h2>Статистика</h2>
<br>
<p><a href = "?interval=1" style = "color: blue">За сегодня</a></p>
<br>
<p><a href = "?interval=7" style = "color: blue">За неделю</a></p>
<br>
<table style = "border: 1px solid silver; margin: auto">



<?php

if ($_GET['interval'])
{
	$interval = $_GET['interval'];
	
	if (!is_numeric($interval))
	{
		echo '<p style = "color:red"><b>Недопустимый параметр!</b></p>';
	}
	
	connectDB();
	$result = $mysqli->query("SELECT * FROM `visits` ORDER BY `date` DESC LIMIT $interval");
	
	while ($row = $result->fetch_assoc())
	{
		echo '
		<tr>
			<td style = "border: 1px solid silver">Дата</td>
			<td style = "border: 1px solid silver">Уникальные просмотры</td>
			<td style = "border: 1px solid silver">Просмотры</td>
		</tr>
		<tr>
			<td style = "border: 1px solid silver">'.$row['date'].'</td>
			<td style = "border: 1px solid silver">'.$row['hosts'].'</td>
			<td style = "border: 1px solid silver">'.$row['views'].'</td>
		</tr>';
	}
}
?>
</table>
</div>