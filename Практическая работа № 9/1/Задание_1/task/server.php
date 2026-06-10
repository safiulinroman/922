<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<title>Программирование на языке PHP</title>
</head>
<body>

	<h1>Отправка данных на сервер</h1>
	<h2>Загрузка файлов</h2>
	<hr>
	<h2>Скрипт-обработчик формы</h2>

	<?php
		// скрипт используется только как обработчик формы
		if (isset($_POST['loader'])) {
			
			echo "<h2>На сервере приняты данные формы</h2>";
			
			// выводим информацию о данных формы
			printf ("
				<i>Название группы:</i> <b>%s</b>, <p>
				<i>Алиасное имя:</i> <b>%s</b>, <p>
				<i>Страна:</i> <b>%s</b>, <p>
				<i>Стиль:</i> <b>%s</b>, <p>
				<i>Контент:</i> <b>%s</b>

			",
				$_POST['name'],
				$_POST['alias'],
				$_POST['country'],
				$_POST['style'],
				$_POST['content'] 
			);
			
			if ($_FILES['image']["error"] == UPLOAD_ERR_OK) {
				
				echo "<h2>Пользователь пытается загрузить файл</h2>";
				
				// выводим информацию о загружаемом файле
				printf ("
					<i>Имя файла:</i> <b>%s</b>, <p>
					<i>Размер файла:</i> <b>%s</b> байт, <p>
					<i>Тип содержимого файла:</i> <b>%s</b>, <p>
					<i>Имя временного файла:</i> <b>%s</b>, <p>
					<i>Код ошибки:</i> <b>%s</b>.

				",
					$_FILES["image"]["name"],
					$_FILES["image"]["size"],
					$_FILES["image"]["type"],
					$_FILES["image"]["tmp_name"],
					$_FILES["image"]["error"] 
				);	

				// генерируем уникальное имя файла
				$filename = md5(uniqid());
				
				// получаем расширение загружаемого файла
				$ext = pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION);

				// текущая временная директория
				$current_path = $_FILES["image"]["tmp_name"];
				
				// директория постоянного хранения
				$new_path = __DIR__ . '/images/' . $filename . "." . $ext;

				// перемещаем файл в директорию постоянного хранения
				move_uploaded_file($current_path, $new_path);
			 
			}
		} else {
			
			echo "<h3>Заполните, пожалуйста форму!</h3>";	
		}
	?>
	

</body>
</html>