
window.onload = function(){
	
	//-- при загрузке страницы - запускаем функцию, которая наполняет все таблицы даннми из БД
	showAllTable();

};

//---дополнить таблицу в html записями из БД. 
	//--Выходная форма таблицы формируеся в Default.php
function showAllTable(){
	showTable('Inspector')

	showTable('Transport')

	showTable('Uchastniki')

	showTable('Svedenia_DTP')

	showTable('Svideteli')

	showTable('Postradavshie')
	
}

//--- отпраяем запрос на PHP сервер с параметрами table=table_name чтобы 
	//получить ответ и в нужную таблицу в конец вписать результат
function showTable(table_name){
	//--- инициируем ajax
	$.ajax({
		type:'GET',  //--- тип передачи - GET
		url: 'Default.php',  //--- ссылка на php скрипт
		data: 'table='+table_name, //--- данные, которые передаем

		//---- если все хорошо, в переменную data запишется результат, который вернул php скрипт
		success: function(data){
			//--- т.к. php возвращает уже сгенерированную html-таблицу, 
				//то просто вставляем эти строки в конец указанной таблицы
			$('#'+table_name+' > tbody:last').append(data);
		}		
	});
}


//--- отправляем в БД данные
function sendToBase(table_name){

	//--- определяем, данные из какой таблицы нужно отправить
	switch(table_name){
		case 'Inspector' : 
			//-- получаем значения из полей по его id 
			var first_name = $('#inspector_first_name').val();
			var last_name = $('#inspector_last_name').val();
			//-- генерируем строку данных, которые будем отправлять на сервер
			sended_data = 'table_name='+table_name+'&param1='+first_name+'&param2='+last_name
			break

		case 'Transport':					
			var number = $('#number').val();
			var marka = $('#marka').val();
			sended_data = 'table_name='+table_name+'&param1='+number+'&param2='+marka
			break

		case 'Uchastniki':		
			var first_name = $('#uchastnik_first_name').val();
			var last_name = $('#uchastnik_last_name').val();
			sended_data = 'table_name='+table_name+'&param1='+first_name+'&param2='+last_name
			break

		case 'Svedenia_DTP':		
			var data = $('#svedenia_data').val();
			var time = $('#svedenia_time').val();
			var mesto = $('#svedenia_mesto').val();
			var inspector_id = $('#svedenia_inspector_id').val();
			sended_data = 'table_name='+table_name+'&param1='+data+'&param2='+time+'&param3='+mesto+'&param4='+inspector_id
			break

		case 'Svideteli':	
			var first_name = $('#svidetel_first_name').val();
			var last_name = $('#svidetel_last_name').val();
			sended_data = 'table_name='+table_name+'&param1='+first_name+'&param2='+last_name
			break

		case 'Postradavshie':		
			var first_name = $('#postradavshie_first_name').val();
			var last_name = $('#postradavshie_last_name').val();
			sended_data = 'table_name='+table_name+'&param1='+first_name+'&param2='+last_name
			break			
	}
	
	///---- отправляем данные на сервер
	$.ajax({
		type : 'POST',
		url: 'Default.php',
		data: sended_data,
		success: function(data){
			//--- показать что вернул php - можно отключить
			alert(data);
			// //----just refresh
			location.reload();
		}
	});
}


//----удалить запись из базы для указанной таблицы и указанного id
function deleteRow(table_name, rowID){
	$.ajax({
		type:'POST',
		url: 'Default.php',
		data: 'table_name='+table_name+'&deleted_id='+rowID,
		success: function(data){
			//--- показать что вернул php - можно отключить
			alert(data);
			location.reload();
			
		}		
	});	
}

