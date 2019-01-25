<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

//-- старт сесии для проверки, авторизован ли уже пользователь
session_start();

//--- Если нажата кнопка "Выйти" - забыть сессию
IF(ISSET($_POST['destroy_session']))
{
	session_unset();
	session_destroy();
}

//-- если передан логин и пароль, начать проверку
IF((ISSET($_POST['user_login']) and ISSET($_POST['user_password'])) )
{
	include_once "./lib/MySQL.php";
	//--- в БД логин хранится зашифрованным, чтобы злоумышленник его не вытащил
	$pass = substr(hash("sha256", $_POST['user_password']), 0, 32);
	//--- функция проверки авторизации 
	$Auth = auth($connection, $_POST['user_login'], $pass);
	
	//--- если авторизация успешна - запоминаем сессию и переходим на страницу с данными
		//-- туда же передается сессия, если просто зайти на Default2.php - сессия не будет активна 
	IF( $Auth )
	{
    	$_SESSION['login'] = 'admin';

		header('Location: http://188.234.107.152:6550/DtpTables/Default2.php');
	}
	else
	{
		echo "<H1>Bad login/password</h1>";
	}
	mysqli_close($connection);

}

?>

<!--- форма для авторизации -->
<form action="authorize.php" method="POST">
	Login: <input type="text" name="user_login" />
	<br />
	password: <input type="text" name="user_password" />
	<input type="submit" name="send" />
</form>


<!--- LogOut - разрыв сессии -->
<form action="authorize.php" method="POST">
	<input type="hidden" name="destroy_session" />
	<input type="submit" name="send" value="Выйти"/>
</form>



