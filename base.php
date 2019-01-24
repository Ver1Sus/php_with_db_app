<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$connection = mysqli_connect('localhost', 'root','rjkz');
$base = mysqli_select_db($connection, "Moiseeva");

if   (!$connection ){
	echo "Error when connect to DB";
}




class UserClass{
	// $userConnection = mysql_connect('localhost', 'root','1234');
	// mysql_select_db('Users', $userConnection);
	

	function testAuth($conn, $login, $passw){
		$res = mysqli_query($conn, "SELECT * FROM users where user_login='".$login."'");
		$row = mysqli_fetch_array($res);
		echo $login." ".$passw;
		IF ($row['user_password'] == $passw)	return 1;
		else return 0;
	}

}

?>
