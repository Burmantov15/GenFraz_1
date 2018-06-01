<?php
if(isset($_POST['GenPhrase'])){
	
/* Подключение к серверу MySQL */ 
$link = mysqli_connect( 
            'localhost',  /* Хост, к которому мы подключаемся */ 
            'root',       /* Имя пользователя */ 
            '',   /* Используемый пароль */ 
            'webproject');     /* База данных для запросов по умолчанию */ 

if (!$link) { 
   printf("Невозможно подключиться к базе данных. Код ошибки: %s\n", mysqli_connect_error()); 
   exit; 
} 


/* Получаем количество записей в таблице */ 
$result = mysqli_query($link, 'SELECT * FROM mytable');
$count_rows = $result->num_rows;


// Получаем случайное число
$random = rand(0, $count_rows-1);


// Посылаем SQL запрос для выбора одной случайной записи из таблицы. LIMIT значит с какого номера мы будем выбирать, 1 - это то что одну запись
$result = mysqli_query($link, 'SELECT * FROM mytable LIMIT '.$random.',1');

// Если бы строк было много, то это читалось бы как "Пока получаем строки из выборки, то выводим на экран". На каждой итерации цикла $row будет иметь следующую строку с данными. Но в нашем случае строка всегда одна, так что можно даже убрать цикл while и написать просто $row = mysqli_fetch_assoc($result);
while($row = mysqli_fetch_assoc($result)){ 
		echo $row['name'];
} 
/* Освобождаем используемую память */ 
mysqli_free_result($result); 


/* Закрываем соединение */ 
mysqli_close($link); 
}
?>


