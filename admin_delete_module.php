<?php
if (isset($_POST['id'])){
	$deletemoduleid = $_POST['id'];

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
	
	$query = "SELECT ModuleName FROM `test`.`modules` WHERE `id`='".$deletemoduleid."'";
	$result = $connection->query($query);
	$row = $result->fetch_assoc();
	//DELETE FROM `test`.`modules` WHERE `id`='10';
	echo 'Модуль '.$row["ModuleName"];
	$deletemodulequery = "DELETE FROM `test`.`modules` WHERE `id`='".$deletemoduleid."'";
	$deletemoduleresult = $connection->query($deletemodulequery);

	if ($deletemoduleresult == true){
		echo " успешно уделен<br>";
	} else {
		echo " не был удален<br>";
	}
	$connection->close();
	
	echo '<br><a href="admin_courses_list.php">Вернуться к списку курсов</a>';
}
else{
	echo 'Error';
}
?>