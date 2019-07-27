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
$professorid = 2;

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

$courseid = $_GET["courseid"];

echo "<main role=\"main\"><section class=\"jumbotron text-center\">";
//выбираем все модули, которые относятся к курсу, индекс которого пришел
$sqlquery = "SELECT * FROM modules WHERE Courseid=".$courseid;
$result = $connection->query($sqlquery);
if ($result->num_rows > 0) {
	while($row = $result->fetch_assoc()){
		if(!empty($_GET["option".$row["id"]])){
			//добавление модуля в траекторию
			$addquery = "INSERT INTO `test`.`trajectory` 
			(`Progress`, `Professorid`, `Courseid`, `Moduleid`) 
			VALUES
			('0', '".$professorid."', '".$courseid."', '".$row["id"]."')";
			$addresult = $connection->query($addquery);
			if ($addresult == true){
				echo "Модуль успешно добавлен в персональную траекторию<br>";
			} else {
				echo "Модуль не был добавлен<br>";
			}	
		}
	}
}
echo '<a href="courses.php">Вернуться на страницу курсов</a>';
echo '</main>';

$connection->close();
?>