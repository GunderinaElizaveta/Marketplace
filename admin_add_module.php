<?php
if (isset($_POST['ModuleName']) && isset($_POST['CourseName'])){
	
	//Переданные формой переменные
	$ModuleName = $_POST['ModuleName'];
	$CourseName = $_POST['CourseName'];
	
	$servername = "localhost";
	$username = "root";
	$password = "lisa12";
	$dbname = "test";
	$dbtable = "courses";

	//Создание соединения
	$connection = new mysqli($servername, $username, $password, $dbname);
	$connection->set_charset("utf8");
	//Проверка соединения
	if ($connection->connect_error) {
		echo "Курс не занесен в базу данных. Соединение с базой данных не установлено";
	} 
	
	//ModuleName и CourseName пришли с POST
	//id auto increment
	//чтобы добавить нужно узнать id курса, вычислим его через CourseName
	
	$Cquery = 'SELECT id FROM courses WHERE CourseName="'.$CourseName.'"';
	$Cresult = $connection->query($Cquery);
	$Courseid = ($Cresult->fetch_assoc())["id"];
	$result = $connection->query("INSERT INTO `test`.`modules`
	(`ModuleName`,`Courseid`)
	VALUES 
	('$ModuleName','$Courseid')");
	
	//Проверка выполнения запроса
	if ($result == true){
		echo "Модуль занесен в базу данных";
	}else{
		echo "Модуль не занесен в базу данных. Ошибка при выполнении запроса";
	}
	
	$connection->close();
}
else { 
	echo "Модуль не занесен в базу данных. Некорректные исходные данные";
}
?>
<html>
	<body>
		<br>
		<a href="admin_form_add_module.php"> Добавить еще один модуль</a>
		<br>
		<a href="admin_courses_list.php">Вернуться к списку курсов</a>
	</body>
</html>