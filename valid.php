<?php
if(isset($_POST['vhod'])){
	
$dbc = mysqli_connect('localhost', 'root', '', 'lesson');/*подключение к БД хост, логин, пароль, БД*/
if (!$dbc) { 
   printf("Невозможно подключиться к базе данных. Код ошибки: %s\n", mysqli_connect_error()); /*ошибка подключения*/
   exit; 
} 

	$username = mysqli_real_escape_string($dbc, trim($_POST['username']));
	$password1 = mysqli_real_escape_string($dbc, trim($_POST['password1']));
	$password2 = mysqli_real_escape_string($dbc, trim($_POST['password2']));
	if(!empty($username) && !empty($password1) && !empty($password2) && ($password1 == $password2)) {
		$query = "SELECT * FROM `signup` WHERE username = '$username'";
		$data = mysqli_query($dbc, $query);
		if(mysqli_num_rows($data) == 0) {
			$query ="INSERT INTO `signup` (username, password) VALUES ('$username', SHA('$password2'))";
			mysqli_query($dbc,$query);
			echo 'Всё готово, можете авторизоваться';
			mysqli_close($dbc);
			exit();
		}
		else {
			echo 'Логин уже существует';
		}

	}
}
?>