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

		<main role="main">

		<section class="jumbotron text-center">
			<div class="container">
				<h1 class="jumbotron-heading">Каталог курсов</h1>
				<p class="lead text-muted">На этой странице Вы можете просмотреть курсы и записаться на них. Также Вы можете ознакомиться со списком тем, что включают в себя предложенные курсы.</p>
			</div>
		</section>
</html>
  
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
	die("Connection failed: " . $connection->connect_error);
} 

$sqlquery = "SELECT id, CourseName, Price, IconLink FROM courses";
$result = $connection->query($sqlquery);


if ($result->num_rows > 0) {
	echo "<div class=\"album py-5 bg-light\"><div class=\"container\"><div class=\"row\">";
	while($row = $result->fetch_assoc()) {
		echo "<div class=\"col-md-4\"><div class=\"card mb-4 shadow-sm\">";
		if(isset($row["IconLink"])) {
			echo "<img src=\"".$row["IconLink"]."\" alt=\"CourseName1\">";
		}
		echo "<div class=\"card-body\"><p class=\"card-text\"><b>".$row["CourseName"]."</b></p>
		<small class=\"text-muted\">Стоимость курса: ".$row["Price"]."</small><br><br>
		<div class=\"d-flex justify-content-between align-items-center\"><div class=\"btn-group\">
		<form action=\"signupcourse.php\" method=\"GET\">
			<input type=\"hidden\" name=\"id\" value=\"".$row["id"]."\">
			<button type=\"button\" class=\"btn btn-sm btn-outline-secondary\">Записаться на курс</button>
		</form>
		<form action=\"modules.php\" method=\"GET\">
			<input type=\"hidden\" name=\"id\" value=\"".$row["id"]."\">
			<button type=\"submit\" class=\"btn btn-sm btn-outline-secondary\">Просмотреть темы курса</button>
		</form>
		</div></div></div></div></div>";
		//echo "";
	}
	echo "</div></div></div>";
} else {
echo "No results";
}

$connection->close();

?>