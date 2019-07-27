<?php
if (isset($_POST['id'])){
	$id = $_POST['id'];

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
		
	//удалить курс
	$modulequery = 'SELECT ModuleName FROM modules WHERE id="'.$id.'"';
	$moduleresult = $connection->query($modulequery);
	$modulerow = $moduleresult->fetch_assoc();
	
	echo 'Вы хотите удалить модуль <b>'.$modulerow["ModuleName"].'</b> из базы данных<br><br>';
	echo 'Вы уверены, что хотите продолжить?<br><br>
	
	<form method="POST" action="admin_delete_module.php">
		<input type="hidden" name="id" value="'.$id.'"/>
		<button type="submit" class="btn btn-sm btn-outline-secondary">Да (удалить модуль)</button>
	</form>
	<form method="POST" action="admin_courses_list.php">
		<button type="submit" class="btn btn-sm btn-outline-secondary">Нет (вернуться к списку курсов)</button>
	</form>';
	$connection->close();
}
else{
	echo 'Error';
}
?>