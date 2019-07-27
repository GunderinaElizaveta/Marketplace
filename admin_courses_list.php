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

$sqlquery = "SELECT * FROM courses";
$result = $connection->query($sqlquery);

if ($result->num_rows > 0) {	

echo '<table border="2" width="100%">
	<tr>
        <td width="45%">Course Name</td>
        <td width="40%">Description</td>
        <td>Price</td>
		<td>Icon</td>
		<td width="50">Dates</td>
		<td width="20"></td>
		
    </tr>';
	
	while($row = $result->fetch_assoc()) {
		echo '<tr>
				<td>'.$row["CourseName"].'
					<form method="POST" action="admin_courses_list_modules.php">
						<input type="hidden" name="id" value="'.$row["id"].'"/>
						<button type="submit" class="btn btn-sm btn-outline-secondary">
							<img src="icon_dn.jpg" width="15" height="15" alt="Открыть список модулей">
						</button>
					</form>
				</td>
				<td>'.$row["CourseDescription"].'</td>
				<td>'.$row["Price"].'</td>
				<td><img src="'.$row["IconLink"].'" width="50" height="50"></td>
				<td>'.$row["StartDate"].' - '.$row["FinishDate"].'</td>
				<td>			
					<form method="POST" action="admin_form_delete_course.php">
						<input type="hidden" name="id" value="'.$row["id"].'"/>
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
?>