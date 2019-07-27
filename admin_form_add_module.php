<html>
	<body>
		Добавление модуля в базу данных<br>
		Укажите название модуля и в какой курс он будет включен
		<br><br>
		<form method="POST" action="admin_add_module.php">
			<input name="ModuleName" type="text" placeholder="Название модуля"/>
			<?php
				$servername = "localhost";
				$username = "root";
				$password = "lisa12";
				$dbname = "test";
				// Create connection
				$connection = new mysqli($servername, $username, $password, $dbname);
				$connection->set_charset("utf8");
				// Check connection
				if ($connection->connect_error) {
					die("Error: Connection failed: " . $connection->connect_error);
				} 
				$Cquery = "SELECT CourseName FROM courses";
				$Cresult = $connection->query($Cquery);
				
				if ($Cresult->num_rows > 0) {
					echo '<select name="CourseName">';
					
					if (isset($_POST['CourseName'])){
						//если запрос пришел оттуда, где конктретно указали курс, к которому добавить модуль
						while($Crow = $Cresult->fetch_assoc()){
							if($Crow["CourseName"] == $_POST['CourseName'])
								echo '<option>'.$Crow["CourseName"].'</option>';
							else
								echo '<option disabled>'.$Crow["CourseName"].'</option>';
						}
					}
					else {
						//иначе - пришли из обычного списка
						while($Crow = $Cresult->fetch_assoc()){
							echo '<option>'.$Crow["CourseName"].'</option>';
						}
					}
					echo '</select>';
				}
				else{
					echo 'Error';
				}
		
			?>
			<input type="submit" value="Добавить модуль"/>
		</form>
		<a href="admin_courses_list.php">Вернуться к списку курсов</a>
	</body>
</html>