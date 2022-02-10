<?php
/*  Файл "Функции".
 *  Название: functions.php
 *  Краткое описание:
 *  Содержит определение функций.
 */
	$mysqli = false;
	/*============================================================
	* connectDB () – соединение с базой данных.
	* ============================================================
	* Формальные параметры:
	* float** matr - входная матрица;
	* int col – проверяемый столбец.
	* ============================================================
	* Локальные переменные:
	* int i – счетчик;
	* bool flag – флаг.
	* ============================================================*/

	function connectDB () {
		global $mysqli;
		#$mysqli = new mysqli("u1075645_default", "u1075645_default","_xH5mQzp","u1075645_default");
		$mysqli = new mysqli("localhost", "root","","psycholog_base");
		$mysqli->query("SET NAMES 'UTF-8'");
	}
	#закрытие соединения
	function closeDB () {
		global $mysqli;
		$mysqli->close ();
	}
	
	/*============================================================
	* getArticles ($id = 0) – получение списка статей.
	* ============================================================
	* Формальные параметры:
	* $id - идентификатор статьи.
	* ============================================================
	* Локальные переменные:
	* $where - составная часть запроса базы данных;
	* $result - результат запроса.
	* ============================================================*/
	function getArticles ($id = 0) {
		global $mysqli;
		connectDB();
		$where = "";
		if ($id != 0)
			$where = 'WHERE `id` = '.$id;
		$result = $mysqli->query("SELECT * FROM `articles` $where");
		closeDB();
		if ($id == 0)
			return resultToArray($result);
		else
			return $result->fetch_assoc();
	}
	
	/*============================================================
	* getAuthData () – получение данных для авторизации.
	* ============================================================
	* Локальные переменные:
	* $result - результат запроса.
	* ============================================================*/
	function getAuthData () {
		global $mysqli;
		connectDB();
		$result = $mysqli->query("SELECT * FROM `authentication`");
		closeDB();
		return resultToArray($result);
	}
	
	/*============================================================
	* checkRegDataForExit ($login, $pass) – проверка данных для 
	*										регистрации.
	* ============================================================
	* Формальные параметры:
	* $login - логин;
	* $pass - пароль.
	* ============================================================
	* Локальные переменные:
	* $authData - данные авторизации;
	* $flag - флаг;
	* $i - счётчик.
	* ============================================================*/
	function checkRegDataForExit ($login, $pass) { 
		$authData = array();
		$authData = getAuthData();
		$flag = false;
		for ( $i = 0; $i < count($authData); $i++){
			if ($authData[$i]['login'] == $login){
				$flag = true;
			}
		}
		if($flag){
			return true;
		}
		else{
			return false;
		}
	}
	
	/*============================================================
	* checkAuthDataForExit ($login, $pass) – проверка данных 
	* 										 для авторизации.
	* ============================================================
	* Формальные параметры:
	* $login - логин;
	* $pass - пароль.
	* ============================================================
	* Локальные переменные:
	* $authData - данные авторизации;
	* $flag - флаг;
	* $i - счётчик.
	* ============================================================*/
	function checkAuthDataForExit ($login, $pass) { 
		$authData = array();
		$authData = getAuthData();
		$flag = false;
		for ( $i = 0; $i < count($authData); $i++){
			if (($authData[$i]['login'] == $login)&&($authData[$i]['password'] == $pass)){
				$flag = true;
				$id = $authData[$i]['id'];
			}
		}
		if($flag){
			return $id;
		}
		else{
			return false;
		}
	}
	
	/*============================================================
	* insertAuthData($login, $pass) – ввод данных данных авторизации.
	* ============================================================
	* Формальные параметры:
	* $login - логин;
	* $pass - пароль.
	* ============================================================*/
	function insertAuthData($login, $pass) {
		global $mysqli;
		connectDB();
		$mysqli->query("INSERT INTO `authentication`(`login`, `password`) VALUES ('".$login."', '".$pass."')");
		$mysqli->query("INSERT INTO `users`(`nickname`, `authFK`) VALUES ('".$login."', (SELECT `id` FROM `authentication` WHERE `login` = '".$login."'))");
		closeDB();
	}
	
	/*============================================================
	* resultToArray($result) – приведение результата запроса 
	*                          к ассоциативному массиву.
	* ============================================================
	* Формальные параметры:
	* $result - результат запроса к базе данных.
	* ============================================================
	* Локальные переменные:
	* $array - временный массив;
	* $row - строка массива.
	* ============================================================*/
	function resultToArray($result){
		$array = array ();
		while (($row = $result->fetch_assoc())!=false){
			$array[]=$row;
		}
		return $array;
	}
	
	/*============================================================
	* getUrl() – получение текущего URL страницы.
	* ============================================================
	* Локальные переменные:
	* $url - текущий адрес страницы.
	* ============================================================*/
	function getUrl() {
		$url  = @( $_SERVER["HTTPS"] != 'on' ) ? 'http://'.$_SERVER["SERVER_NAME"] :  'https://'.$_SERVER["SERVER_NAME"];
		$url .= ( $_SERVER["SERVER_PORT"] != 80 ) ? ":".$_SERVER["SERVER_PORT"] : "";
		$url .= $_SERVER["REQUEST_URI"];
		return $url;
	}
	
	/*============================================================
	* getUser($id) – получение данных пользователя.
	* ============================================================
	* Формальные параметры:
	* $id - идентификатор пользователя.
	* ============================================================
	* Локальные переменные:
	* $where - составная часть запроса базы данных;
	* $result - результат запроса.
	* ============================================================*/
	function getUser($id)
	{
		global $mysqli;
		connectDB();
		$where = "WHERE `authFK` = '".$id."'";
		$result = $mysqli->query("SELECT * FROM `users` $where");
		closeDB();
		return $result->fetch_assoc();
	}
	
	/*============================================================
	* getComments($articleId) – получение списка комментариев.
	* ============================================================
	* Формальные параметры:
	* $articleId - идентификатор статьи.
	* ============================================================
	* Локальные переменные:
	* $where - составная часть запроса базы данных;
	* $result - результат запроса.
	* ============================================================*/
	function getComments($articleId){
		global $mysqli;
		connectDB();
		$where = "WHERE `articleFK` = '".$articleId."'";
		$result = $mysqli->query("SELECT `users`.`nickname`, `comments`.`text`, `comments`.`date` FROM `comments` JOIN `users` ON `comments`.`userId` = `users`.`id` $where");
		closeDB();
		return resultToArray($result);
	}
	
	/*============================================================
	* addComment($comment, $articleId, $userId) – добавление
	* 											  комментариев.
	* ============================================================
	* Формальные параметры:
	* $comment - текст комментария;
	* $articleId - идентификатор статьи;
	* $userId - идентификатор пользователя.
	* ============================================================*/
	function addComment($comment, $articleId, $userId){
		global $mysqli;
		connectDB();
		if ($userId == null) $userId = 0;
		$mysqli->query("INSERT INTO `comments`(`text`, `articleFK`,`userId`,`date`) VALUES ('".$comment."', ".$articleId.", ".$userId.", NOW() )");
		closeDB();
	}
	/*============================================================
	* valid($str, &$error) – проверка правильности пароля.
	* ============================================================
	* Формальные параметры:
	* $str - строка проля;
	* $error - сообщение с ошибкой.
	* ============================================================*/
	function valid($str, &$error)
	{
		if (strlen($str) < 8)
		{
			$error = "Длина пароля менее 8 символов";
			return false;
		}
		if (!preg_match("/^[ЁА-яA-z0-9]+$/",$str))
		{
			$error = "Пароль должен состоять только из букв и цифр";
			return false;
		}
		if (!preg_match("/[ЁА-ЯA-Z]+/",$str))
		{
			$error = "Пароль должен содержать хотябы 1 заглавную букву";
			return false;
		}
		return true;
	} 
	/*============================================================
	* checkPass($pass, $authId) – поиск пароля в базе данных.
	* ============================================================
	* Формальные параметры:
	* $pass - пароль;
	* $authId - идентификатор пользователя.
	* ============================================================
	* Локальные переменные:
	* $where - составная часть запроса базы данных;
	* $result - результат запроса.
	* ============================================================*/
	function checkPass($pass, $authId){
		global $mysqli;
		connectDB();
		$resultPass = $mysqli->query("SELECT `password` FROM `authentication` WHERE `id` = ".$authId);
		closeDB();
		if ($resultPass == $pass)
			return true;
		else
			return false;
	}

	function visitsCount(){
		global $mysqli;
		connectDB();
		$visitor_ip = $_SERVER['REMOTE_ADDR'];
		$date = date("Y-m-d");
		
		$result = $mysqli->query("SELECT `id` FROM `visits` WHERE `date` = '$date'");
		
		if ($result->num_rows == 0){
			$mysqli->query("DELETE FROM `ips`");
			$mysqli->query("INSERT INTO `ips` SET `ip_address` = '$visitor_ip'");
			$res_count = $mysqli->query("INSERT INTO `visits` SET `date` = '$date', `hosts` = 1, `views` = 1");
		}
		else{
			$current_ip = $mysqli->query("SELECT `id` FROM `ips` WHERE `ip_address` = '$visitor_ip'");
			if ($current_ip->num_rows == 1){
				$mysqli->query("UPDATE `visits` SET `views` = `views` + 1 WHERE `date` = '$date'");
			}
			else{
				$current_ip = $current_ip->fetch_assoc();
				$mysqli->query("INSERT INTO `ips` SET `ip_address` = '$visitor_ip'");
				$mysqli->query("UPDATE `visits` SET `hosts` = `hosts` + 1, `views` = `views` + 1 WHERE `date` = '$date'");
			}
		}
		closeDB();
	}
?>