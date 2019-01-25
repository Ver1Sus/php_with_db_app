<?php
$connection = mysqli_connect('localhost', 'root','rjkz');
mysqli_set_charset($connection, "utf8");
mysqli_select_db($connection, 'Moiseeva');

function auth($conn, $login, $passw){
		$res = mysqli_query($conn, "SELECT * FROM users where user_login='".$login."'");
		$row = mysqli_fetch_array($res);
		IF ($row['user_password'] == $passw)	return 1;
		else return 0;
	}


?>