<?php 

error_reporting(E_ALL);
ini_set('display_errors', 1);

include './lib/MySQL.php';




//----get запрос с тестовым выводом инфы
if(isset($_GET['info'])){
	echo "This is PHP page to test MySQL </br>";
	
	//echo "To add: 'INSERT INTO FoodList (id, name, comment) VALUES(2, 'salo', 'slava ukraini');</br>";

		
	if ($connection){
		echo "Connection is good<br>";
	}
	else{
		echo "BAD CONNECT!";
	}	

	$res = mysqli_query($connection, "SELECT * FROM users ");

	
	$count = mysqli_query($connection, "SELECT COUNT(1) FROM users");
	$count = mysqli_fetch_array($count);
	echo "</br>Count: ".$count[0];
	
	
	
	$row = mysqli_fetch_array($res);
	
	echo "</br>User: ".$row['user_login'];
	
	$table_name=$_GET['info'];

	$id_of_tables = [
	    "Inspector" => "inspector_id",
	    "Transport" => ["id_transp", "Transport_DTP"],
	    "Uchastniki" => "id_uchastnika",
	    "Svedenia_DTP" => "dtp_id",
	    "Svideteli" => "id_svideteley",
	    "Postradavshie" => "id_postradavshego",
	];

	$ids_of_all_tables = [
	    "Inspector" => ["inspector_id", ""],
	    "Transport" => ["id_transp", "Transport_DTP"],
	    "Uchastniki" => ["id_uchastnika", "Uchastniki_DTP"],
	    "Svedenia_DTP" => ["dtp_id", "Transport_DTP"],
	    "Svideteli" => ["id_svideteley", "Svideteli_DTP"],
	    "Postradavshie" => ["id_postradavshego", "Postradavshie_DTP"],
	];


	$id = $id_of_tables["Transport"][0];
	$ref_table = $ids_of_all_tables["Transport"][1];

	$query = 'SELECT * FROM '.$ref_table.' WHERE '.$id.'=9';
	$res = mysqli_query($connection, $query);
	$row = mysqli_fetch_array($res);
	echo "<br>".$row[0];

	
	echo $id_of_tables[$table_name];


	$max_id = get_max_id($connection, $id_of_tables[$table_name], $table_name);
	echo $max_id;
	
	
	// mysqli_close($connection);
	
}

//--- Добавить новую запись в указанную таблицу
if(isset($_POST['table_name']) && isset($_POST['param1']) && isset($_POST['param2'])){

	$table_name = $_POST['table_name'];
	$param1 = $_POST['param1'];
	$param2 = $_POST['param2'];

	//--- в зависимости от переданной таблицы собираем нужный INSERT
	switch($table_name){
		case 'Inspector':
			//--- у каждой таблицы свое имя для поля id - вставляем его в INSERT
			$id_of_table = 'inspector_id';

			//-- Найти макс. id чтобы сделать запись id+1
			$max_id = get_max_id($connection, $id_of_table, $table_name);
			
			//-- создаем запрос
			$query = "INSERT INTO ".$table_name." (".$id_of_table.", first_name, last_name) VALUES(".($max_id+1).", '".$param1."', '".$param2."')";
			break;

		case 'Transport':
			$id_of_table = 'id_transp';
			$max_id = get_max_id($connection, $id_of_table, $table_name);

			$query = "INSERT INTO ".$table_name." (".$id_of_table.", number, marka) VALUES(".($max_id+1).", '".$param1."', '".$param2."')";
			break;

		case 'Uchastniki':
			$id_of_table = 'id_uchastnika';
			$max_id = get_max_id($connection, $id_of_table, $table_name);

			$query = "INSERT INTO ".$table_name." (".$id_of_table.", first_name, last_name)  VALUES(".($max_id+1).", '".$param1."', '".$param2."')";
			break;

		case 'Svedenia_DTP':
			$id_of_table = 'dtp_id';
			$data = $param1;
			$time = $param2;
			//--- у этой таблицы дополнительные поля, указываем их
			$mesto = $_POST['param3'];
			$inspector_id = $_POST['param4'];
			$max_id = get_max_id($connection, $id_of_table, $table_name);

			$query = "INSERT INTO ".$table_name." (".$id_of_table.", data_dtp, time, mesto, inspector_id)  VALUES(".($max_id+1).", '".$data."', '".$time."', '".$mesto."', '".$inspector_id."')";
			break;

		case 'Svideteli':
			$id_of_table = 'id_svideteley';
			$max_id = get_max_id($connection, $id_of_table, $table_name);

			$query = "INSERT INTO ".$table_name." (".$id_of_table.", first_name, last_name)  VALUES(".($max_id+1).", '".$param1."', '".$param2."')";
			break;

		case 'Postradavshie':
			$id_of_table = 'id_postradavshego';
			$max_id = get_max_id($connection, $id_of_table, $table_name);

			$query = "INSERT INTO ".$table_name." (".$id_of_table.", first_name, last_name)  VALUES(".($max_id+1).", '".$param1."', '".$param2."')";
			break;
	}
		
	//--- выполням собранный выше запрос
	mysqli_query($connection, $query);
	echo $query;
	
}



//-- сгенерировать HTML-код таблицы, имя которой было переданно, чтобы добавить на страницу
if (isset($_GET['table'])){
	$table_name = $_GET['table'];
	$query = "SELECT * FROM ".$table_name;
	$res = mysqli_query($connection, $query);
	$rows = mysqli_fetch_all($res);

	//--- для таблицы Сведений - больше полей 
	if ($table_name == 'Svedenia_DTP'){
		foreach ($rows as $value){
		echo "<tr>
			<td>".$value[0]."</td>
			<td>".$value[1]."</td>
			<td>".$value[2]."</td>
			<td>".$value[3]."</td>
			<td>".$value[4]."</td>
			<td class='elem' onclick='deleteRow(\"".$table_name."\", ".$value[0].")'>
				Удалить
			</td>
		</tr>";
		}
	}
	//--- для остальных - стандартно 3 столбца
	else{
		foreach ($rows as $value){
		echo "<tr>
			<td>".$value[0]."</td>
			<td>".$value[1]."</td>
			<td>".$value[2]."</td>
			<td class='elem' onclick='deleteRow(\"".$table_name."\", ".$value[0].")'>
				Удалить
			</td>
		</tr>";
		}
	}	
}



//--- удаляем запись из указанной таблицы с указанным id
if (isset($_POST['table_name']) && isset($_POST['deleted_id']))
{
	$table_name = $_POST['table_name'];
	$rowId = $_POST['deleted_id'];

	//--- также как и для INSERT - у каждой таблицы свое имя столбца ID, чтобы составить верный запрос WHERE добавляем это имя
	$ids_of_all_tables = [
	    "Inspector" => ["inspector_id", "", ""],
	    "Transport" => ["id_transp", "Transport_DTP", "IDT"],
	    "Uchastniki" => ["id_uchastnika", "Uchastniki_DTP" , "IDU"],
	    "Svedenia_DTP" => ["dtp_id", "Transport_DTP",  "IDT"],
	    "Svideteli" => ["id_svideteley", "Svideteli_DTP", "IDS"],
	    "Postradavshie" => ["id_postradavshego", "Postradavshie_DTP", "IDP"],
	];

	$id_of_table = $ids_of_all_tables[$table_name][0];
	$ref_table = $ids_of_all_tables[$table_name][1];
	$ref_id_name = $ids_of_all_tables[$table_name][2];

	$query = 'SELECT * FROM '.$ref_table.' WHERE '.$id_of_table.'='.$rowId;
	echo $query;
	$res = mysqli_query($connection, $query);
	$row = mysqli_fetch_array($res);
	$ref_id = $row[0];

	
	$query = 'DELETE FROM '.$ref_table.' WHERE '.$ref_id_name.'='.$ref_id;
	echo $query;
	$res = mysqli_query($connection, $query);	

	$query = 'DELETE FROM '.$table_name.' WHERE '.$id_of_table.'='.$rowId;
	echo $query;
	$res = mysqli_query($connection, $query);	
}


//--- получаем максимальный ID у заданный таблицы
function get_max_id($connection, $id_of_table, $table_name)
{

	$res = mysqli_query($connection, 'select max('.$id_of_table.') from '.$table_name);
	$row = mysqli_fetch_array($res);
	$maxID = $row[0];

	return $maxID;
}

?>
