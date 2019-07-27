<?php
if (isset($_POST['id'])){
	$deletecourseid = $_POST['id'];

	$servername = "localhost";
	$username = "root";
	$password = "lisa12";
	$dbname = "test";

	// Create connection
	$connection = new mysqli($servername, $username, $password, $dbname);
	$connection->set_charset("utf8");
	// Check connection
	if ($connection->connect_error) {
		die("Connection failed: " . $connection->connect_error);
	}
	
	//DELETE FROM `test`.`modules` WHERE `id`='10';
	
	//удалить модули, если они есть!
	//селектом выбираем все модули, которые надо удалить, у которых курс id совпадает с выданным
	//в цикле удаляем модули
	
	$modulequery = 'SELECT id, ModuleName FROM modules WHERE Courseid="'.$deletecourseid.'"';
	$moduleresult = $connection->query($modulequery);
	
	if($moduleresult->num_rows > 0){		
		echo "Удаление модулей<br><br>";
		
		while($modulerow = $moduleresult->fetch_assoc()){
			echo "Модуль ".$modulerow["ModuleName"];
			
			$deletemodulequery = "DELETE FROM `test`.`modules` WHERE `id`='".$modulerow["id"]."'";
			$deletemoduleresult = $connection->query($deletemodulequery);
			
			if ($deletemoduleresult == true){
				echo " успешно уделен<br>";
			} else {
				echo " не был удален<br>";
			}	
		}
	}
	
	echo "Удаление курса<br><br>";
	echo "Курс ";
	
	$deletecoursequery = "DELETE FROM `test`.`courses` WHERE `id`='".$deletecourseid."'";
	$deletecourseresult = $connection->query($deletecoursequery);
	if ($deletecourseresult == true){
		echo " успешно уделен<br>";
	} else {
		echo " не был удален<br>";
	}

	echo '<br><a href="admin_courses_list.php">Вернуться к списку курсов</a>';

	$connection->close();
}
else{
	echo 'Error';
}
?>