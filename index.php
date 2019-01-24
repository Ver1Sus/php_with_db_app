<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
echo "lol";
echo "string";

include_once "authorize.php";

include_once "./base/base.php";

IF(ISSET($_POST['user_login']) and ISSET($_POST['user_password']))
{
	$Base = new UserClass;
	$pass = substr(hash("sha256", $_POST['user_password']), 0, 32);
	$Auth = $Base->testAuth($connection, $_POST['user_login'], $pass);
	
	IF( $Auth )
	{

	$query = 'SELECT * FROM Uchastniki';
		
		$res = mysqli_query($connection, $query);

		$row = mysqli_fetch_array($res);

		echo $row['id_uchastnika'];

		echo "<br>";
		$hash = hash("sha256", "zero");
		echo $hash."<br>";
		echo substr($hash, 0, 32);


	$query2 = 'SELECT * FROM users WHERE user_login = "root"';
	$query2 = 'SELECT * FROM users';
		$res = mysqli_query($connection, $query2);

		$row = mysqli_fetch_array($res);

		echo "<br>".$row['user_password'];

	$connection;
	}
	else
	{
		echo "<H1>Bad login/password</h1>";
	}
}
mysqli_close($connection);
?>
