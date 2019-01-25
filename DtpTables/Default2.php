<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

//--- запускаем сессию чтобы получить сохраненные ранее данные
session_start();

//-- Если сессия существует - дать доступ
if(isset($_SESSION['login']))
{
?>

<!DOCTYPE HTML>
<HTML>
<HEAD>

	<title>ДТП</title>
	
	<link rel="stylesheet" type="text/css" href="./lib/style.css">
	<script src="./lib/script.js"></script>
	<script src="./lib/jQuery-1.8.js"></script>
	<meta charset="utf-8">
	<script>

	
	</script>
	

</HEAD>
<BODY style="background-color: #ddffdd;">

	<a href='./Default.php?info=""'>Ссылка на пхп</a>
	
	<!--- LogOut - разрыв сессии -->
	<form action="authorize.php" method="POST">
		<input type="hidden" name="destroy_session" />
		<input type="submit" name="send" value="Выйти"/>
	</form>
		
	<br>
	<h1> Инспектор</h1>
	<table id='Inspector' border="1px">
	<tr>
		<th>id</th>
		<th>Имя</th>
		<th>Фамилия </th>
		<th>Удалить </th>		
	</tr>	
	<tr>
		<td>
			<input type='button' onclick="sendToBase('Inspector')" value='Добавить'/>
		</td>
		<td>
			<inputid="inspector_first_name" value='name' size='8'/> 
		</td>
		<td>
			<input id="inspector_last_name" size='8'/> 
		</td>
		<td></td>
	</tr>	
		<!-- Здесь данные добвалются через Ajax при загрузке страницы -->
	</table>


	<h1> Трансорт</h1>
	<table id='Transport' border="1px">
	<tr>
		<th>id</th>
		<th>Номер</th>
		<th>Марка </th>
		<th>Удалить </th>		
	</tr>	
	<tr>
		<td>
			<input type='button' onclick="sendToBase('Transport')" value='Добавить'/>
		</td>
		<td>
			<input id="number" value='number' size='8'/> 
		</td>
		<td>
			<input id="marka" size='8'/> 
		</td>
		<td></td>
	</tr>	
	</table>


	<h1> Участники</h1>
	<table id='Uchastniki' border="1px">
	<tr>
		<th>id</th>
		<th>Имя</th>
		<th>Фамилия </th>
		<th>Удалить </th>		
	</tr>	
	<tr>
		<td>
			<input type='button' onclick="sendToBase('Uchastniki')" value='Добавить'/>
		</td>
		<td>
			<input id="uchastnik_first_name" value='number' size='8'/> 
		</td>
		<td>
			<input id="uchastnik_last_name" size='8'/> 
		</td>
		<td></td>
	</tr>	
	</table>


	<h1> Сведения о ДТП</h1>
	<table id='Svedenia_DTP' border="1px">
	<tr>
		<th>id</th>
		<th>Дата</th>
		<th>Время </th>
		<th>Место </th>
		<th>Инспектор </th>
		<th>Удалить </th>		
	</tr>	
	<tr>
		<td>
			<input type='button' onclick="sendToBase('Svedenia_DTP')" value='Добавить'/>
		</td>
		<td>
			<input id="svedenia_data" value='2012-08-25' size='8'/> 
		</td>
		<td>
			<input id="svedenia_time" value='18:26:10' size='8'/> 
		</td>
		<td>
			<input id="svedenia_mesto" value='XXX' size='8'/> 
		</td>
		<td>
			<!-- Тут должен быть раскрывающийся список-->
			<input id="svedenia_inspector_id" value='3' size='8'/> 
		</td>
		<td></td>
	</tr>	
	</table>


	<h1> Свидетели</h1>
	<table id='Svideteli' border="1px">
	<tr>
		<th>id</th>
		<th>Имя</th>
		<th>Фамилия </th>
		<th>Удалить </th>		
	</tr>	
	<tr>
		<td>
			<input type='button' onclick="sendToBase('Svideteli')" value='Добавить'/>
		</td>
		<td>
			<input id="svidetel_first_name" value='number' size='8'/> 
		</td>
		<td>
			<input id="svidetel_last_name" size='8'/> 
		</td>
		<td></td>
	</tr>	
	</table>


	<h1> Пострадавшие</h1>
	<table id='Postradavshie' border="1px">
	<tr>
		<th>id</th>
		<th>Имя</th>
		<th>Фамилия </th>
		<th>Удалить </th>		
	</tr>	
	<tr>
		<td>
			<input type='button' onclick="sendToBase('Postradavshie')" value='Добавить'/>
		</td>
		<td>
			<input id="postradavshie_first_name" value='number' size='8'/> 
		</td>
		<td>
			<input id="postradavshie_last_name" size='8'/> 
		</td>
		<td></td>
	</tr>	
	</table>

</BODY>
</HTML>

<?php
}
//--- иначе, если сессии нет - сообщить что авторизация не прошла
else{
?>
	<h1>Вы не авторизованы</h1>
		<a href="http://188.234.107.152:6550/DtpTables/authorize.php">Авторизация</a>

<?php
}

?>