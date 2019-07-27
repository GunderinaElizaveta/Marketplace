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
		die("Error: Connection failed: " . $connection->connect_error);
	} 

	$Cquery = "SELECT * FROM courses";
	$Cresult = $connection->query($Cquery);

	$Mquery = 'SELECT id, ModuleName FROM modules WHERE Courseid="'.$id.'"';
	$Mresult = $connection->query($Mquery);
	
	if ($Cresult->num_rows > 0) {	
		echo '<table border="2" width="100%">
			<tr>
				<td width="45%">Course Name</td>
				<td width="40%">Description</td>
				<td>Price</td>
				<td>Icon</td>
				<td width="50">Dates</td>
				<td width="20"></td>
				
			</tr>';
			
			while($Crow = $Cresult->fetch_assoc()) {
				echo '<tr>
						<td>'.$Crow["CourseName"]; //начало ячейки CourseName				
							//если номер того самого курса, который надо развернуть и запрос по модулям не пуст
							if(($Crow["id"] == $id)/* && ($Mresult->num_rows > 0)*/) {
								//отрисовка таблицы	
								echo '<center><table border="1">';
								while($Mrow = $Mresult->fetch_assoc()){
									echo '<tr>
											<td>'.$Mrow["ModuleName"].'</td>
											<td width="20">
												<form method="POST" action="admin_form_delete_module.php">
													<input type="hidden" name="id" value="'.$Mrow["id"].'"/>
													<button type="submit" class="btn btn-sm btn-outline-secondary">
														<img src="icon_delete.jpg" width="15" height="15" alt="Удалить модуль">
													</button>
												</form>
											</td>
										</tr>';
								}
								//Добавление модуля	
								echo '<tr>
										<td>
											<form method="POST" action="admin_form_add_module.php">
												<input type="hidden" name="CourseName" value="'.$Crow["CourseName"].'"/>
												<button type="submit" class="btn btn-sm btn-outline-secondary"><img src="icon_add.png" width="15" height="15" alt="Добавить модуль"></button>
											</form>
										</td>
										<td></td>
									</tr>';
								echo '</table></center>';
								//отрисовка стрелочки вверх
								echo '<form method="POST" action="admin_courses_list.php">
										<button type="submit" class="btn btn-sm btn-outline-secondary">
											<img src="icon_up.jpg" width="15" height="15" alt="Закрыть список модулей">
										</button>
									</form>';
								
							}
							else { //остальные курсы или нет модулей (пустой курс)
								//отрисовка стрелочки вниз
								echo '<form method="POST" action="admin_courses_list_modules.php">
										<input type="hidden" name="id" value="'.$Crow["id"].'"/>
										<button type="submit" class="btn btn-sm btn-outline-secondary">
											<img src="icon_dn.jpg" width="15" height="15" alt="Открыть список модулей">
										</button>
									</form>';
							}
						echo '</td>'; //конец ячейки CourseName				
						
						echo '<td>'.$Crow["CourseDescription"].'</td>
						<td>'.$Crow["Price"].'</td>
						<td><img src="'.$Crow["IconLink"].'" width="50" height="50"></td>
						<td>'.$Crow["StartDate"].' - '.$Crow["FinishDate"].'</td>
						<td>			
							<form method="POST" action="admin_form_delete_course.php">
								<input type="hidden" name="id" value="'.$Crow["id"].'"/>
								<button type="submit" class="btn btn-sm btn-outline-secondary">
									<img src="icon_delete.jpg" width="15" height="15" alt="Удалить курс">
								</button>
							</form>
						</td>
					</tr>';
			}
			echo '<tr>
					<td>
						<form method="POST" action="admin_form_add_course.php">
							<button type="submit" class="btn btn-sm btn-outline-secondary"><img src="icon_add.png" width="15" height="15" alt="Добавить курс"></button>
						</form>
					</td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
				</tr>';
			echo '</table>';

		} else {
			echo "Error: No query results";
		}	
	$connection->close();
}
else{
	echo "Error";
}
?>