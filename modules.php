<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="description" content="">
		<meta name="author" content="Elizaveta Gunderina">
		<meta name="generator" content="">
		<title>Marketplace</title>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
		<link rel="canonical" href="">
		<!-- Bootstrap core CSS -->
		<link href="/docs/4.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

		<style>
		.bd-placeholder-img {
			font-size: 1.125rem;
			text-anchor: middle;
			-webkit-user-select: none;
			-moz-user-select: none;
			-ms-user-select: none;
			user-select: none;
		}

		.container{
		}
		
		@media (min-width: 768px) {
			.bd-placeholder-img-lg {
				font-size: 3.5rem;
			}
		}
		</style>
		<!-- Custom styles for this template -->
		<link href="album.css" rel="stylesheet">
	</head>
	
	<body>

		<header>
			<div class="navbar navbar-dark bg-dark shadow-sm">
				<div class="container d-flex justify-content-between">
					<div class="navbar-brand d-flex align-items-center">
						<strong>About</strong>
					</div>
				</div>
			</div>
		</header>

		
</html>
  
<?php

$courseid = $_GET["id"];
//echo $courseid;


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

$sqlquery = "SELECT * FROM courses WHERE id=".$courseid;
$result = $connection->query($sqlquery);
$sqlmodulesquery = "SELECT * FROM modules WHERE Courseid=".$courseid;
$modulesresult = $connection->query($sqlmodulesquery);

if ($result->num_rows > 0) {
	$row = $result->fetch_assoc();
	echo "<main role=\"main\"><section class=\"jumbotron text-center\">";
	if(isset($row["IconLink"])) {
		echo "<img src=\"".$row["IconLink"]."\" alt=\"CourseName1\">";
	}				
	echo "<div class=\"container\"><h1 class=\"jumbotron-heading\">".$row["CourseName"]."</h1>";
	echo "<p class=\"lead text-muted\">".$row["CourseDescription"]."</p>";
	if($row["Price"] != 0){
		echo"<p>Стоимость курса: ".$row["Price"]."</p>";
	}
	echo "<p>".$row["StartDate"]." - ".$row["FinishDate"]."</p></div>";
	
	echo "<div class=\"container\"><p><big><big><b>Программа курса</b></big></big></p>
	<form action=\"add_modules.php\" method=\"GET\"><p>";
		echo '<input type="hidden" name="courseid" value="'.$courseid.'">';
		while($rowmodule = $modulesresult->fetch_assoc()){
			echo "<input type=\"checkbox\" name=\"option".$rowmodule["id"]."\" 
						value=\"".$rowmodule["id"]."\">  ".$rowmodule["ModuleName"]."<Br>";
		}
		echo "</p><p><input type=\"submit\" value=\"Добавить модули в персональный план\">";
		echo '<br><a href="courses.php">Вернуться на страницу курсов</a>';
	echo "</p></form></div>";
	
	echo "</section>";
	
	
	echo "</main>";
	$connection->close();
} else {
echo "No results";
}

?>