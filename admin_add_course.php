<?php
if (isset($_POST['CourseName']) && isset($_POST['Price']) && isset($_POST['CourseDescription'])
	&& isset($_POST['IconLink']) && isset($_POST['StartDate']) && isset($_POST['FinishDate'])){
	
	//Переданные формой переменные
	$CourseName = $_POST['CourseName'];
	$Price = $_POST['Price'];
	$CourseDescription = $_POST['CourseDescription'];
	$IconLink = $_POST['IconLink'];
	$StartDate = $_POST['StartDate'];
	$FinishDate = $_POST['FinishDate'];
	
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
	
	//CourseName и Price пришли с POST
	//id auto increment
	$result = $connection->query("INSERT INTO `test`.`courses` 
	(`CourseName`,`Price`, `CourseDescription`, `IconLink`, `StartDate`, `FinishDate`) 
	VALUES 
	('$CourseName','$Price', '$CourseDescription', '$IconLink', '$StartDate', '$FinishDate')");
	
	//Проверка выполнения запроса
	if ($result == true){
		echo "Курс занесен в базу данных";
	}else{
		echo "Курс не занесен в базу данных. Ошибка при выполнении запроса";
	}
	$connection->close();
}
else { 
	echo "Курс не занесен в базу данных. Некорректные исходные данные";
}
?>
<html>
	<body>
		<br>
		<a href="admin_form_add_course.php"> Добавить еще один курс</a>
		<br>
		<a href="admin_courses_list.php">Вернуться к списку курсов</a>
	</body>
</html>