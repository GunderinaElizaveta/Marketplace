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
						<strong>
						<?php
						$professorid = 2; //можно передавать с помощью GET со страницы авторизации
						
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
						
						$professorquery = 'SELECT * FROM professors WHERE id="'.$professorid.'"';
						$professorresult = $connection->query($professorquery);
						$professorrow = $professorresult->fetch_assoc();
						echo "Добро пожаловать в личный кабинет<br>".$professorrow["ProfessorName"]." ".$professorrow["ProfessorSurname"];
						?>
						</strong>
					</div>
				</div>
			</div>
		</header>

		
</html>
  
<?php

echo "<main role=\"main\"><section class=\"jumbotron text-center\">";
echo "<h1 class=\"jumbotron-heading\">Персональная траектория</h1>";

//запрос в траекториях - что добавлено в персональный план, что отображать
//отсортированный по курсам
$Tquery = 'SELECT * FROM trajectory WHERE Professorid="'.$professorid.'" ORDER BY "Courseid"';
$Tresult = $connection->query($Tquery);
echo '<div class="album py-5 bg-light">
    <div class="container">
      <div class="row">';
while($Trow = $Tresult->fetch_assoc()){
	
	//достать имя курса
	$Cquery = 'SELECT CourseName FROM courses WHERE id="'.$Trow["Courseid"].'"';
	$Cresult = $connection->query($Cquery);
	$CourseName = ($Cresult->fetch_assoc())["CourseName"];
	//достать имя модуля
	$Mquery = 'SELECT ModuleName FROM modules WHERE id="'.$Trow["Moduleid"].'"';
	$Mresult = $connection->query($Mquery);
	$ModuleName = ($Mresult->fetch_assoc())["ModuleName"];
	
	echo '<div class="col-md-4">
          <div class="card mb-4 shadow-sm" >
			
			<text x="50%" y="50%" fill="#eceeef" dy=".3em"><b>'.$CourseName.'</b></text>

            <div class="card-body">
              <p class="card-text">Модуль: '.$ModuleName.'</p>';
			  if($Trow["Progress"] < 33){
				  echo 'Прогресс: '.$Trow["Progress"].' %<br>
				  <div id="rectangle" style="width:'.$Trow["Progress"].'; height:15; background-color:#ff3303"></div>';
			  }elseif($Trow["Progress"] < 66){
				  echo 'Прогресс: '.$Trow["Progress"].' %<br>
				  <div id="rectangle" style="width:'.$Trow["Progress"].'; height:15; background-color:#feff00"></div>';
			  }else{
				  echo 'Прогресс: '.$Trow["Progress"].' %<br>
				  <div id="rectangle" style="width:'.$Trow["Progress"].'; height:15; background-color:#08fc00"></div>';
			  }
			  
			  //Прогресс: <img src="g.png" height = "15" width="'.$Trow["Progress"].'%"> '.$Trow["Progress"].'%
			  //<div id="rectangle" style="width:150; height:30; background-color:#f2f3f4">Прогресс 10%</div>
			  //<div id="rectangle" style="width:15; height:30; background-color:green"></div>
            echo '</div>
          </div>
        </div>';
	
}
echo ' </div>
    </div>
  </div>';

echo '<a href="courses.php">На страницу курсов</a>';
echo '</main>';

$connection->close();
?>