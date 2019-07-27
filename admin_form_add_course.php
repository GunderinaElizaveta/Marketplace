<html>
	<body>
		Добавление курса в базу данных
		<br><br>
		<form method="POST" action="admin_add_course.php">
			<input name="CourseName" type="text" placeholder="Название курса"/>
			<input name="CourseDescription" type="text" placeholder="Описание курса"/>
			<input name="Price" type="int" placeholder="Стоимость курса"/>
			<input name="IconLink" type="text" placeholder="Ссылка на иконку"/>
			<br><br>
			Даты начала и окончания курса
			<input name="StartDate" type="date" placeholder="Начало курса"/>
			 - 
			<input name="FinishDate" type="date" placeholder="Окончание курса"/>
			<br>
			<input type="submit" value="Добавить курс"/>
		</form>
		<a href="admin_courses_list.php">Вернуться к списку курсов</a>
	</body>
</html>