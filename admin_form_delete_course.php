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
	
	$coursequery = 'SELECT CourseName FROM courses WHERE id="'.$id.'"';
	$courseresult = $connection->query($coursequery);
	$courserow = $courseresult->fetch_assoc();
	
	$modulequery = 'SELECT ModuleName FROM modules WHERE Courseid="'.$id.'"';
	$moduleresult = $connection->query($modulequery);
	
	echo 'Вы хотите удалить курс <b>'.$courserow["CourseName"].'</b> из базы данных<br><br>';
	if($moduleresult->num_rows > 0){
		echo 'Входящие в этот курс модули также будут удалены:<br><br><b>';
		while($modulerow = $moduleresult->fetch_assoc()){
			echo '- '.$modulerow["ModuleName"].'<br>';			
		}
		echo '</b><br>';
	}
	echo 'Вы уверены, что хотите продолжить?<br><br>
	
	<form method="POST" action="admin_delete_course.php">
		<input type="hidden" name="id" value="'.$id.'"/>
		<button type="submit" class="btn btn-sm btn-outline-secondary">Да (удалить курс и все модули)</button>
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