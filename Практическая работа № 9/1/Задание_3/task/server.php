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
		// проверим, что скрипт выполняется как обработчик формы
		if (isset ($_POST["loader"])) {
			
			// проверим загрузку на наличие ошибок
			if ($_FILES['image']["error"] == UPLOAD_ERR_OK or $_FILES['image']["error"] == UPLOAD_ERR_NO_FILE) {

				// если изображение не было ззагружено
				if ($_FILES['image']["error"] == UPLOAD_ERR_NO_FILE) {
					// выводим плейсхолдер
					$img = 'no-photo.jpg';
				} else {
					// если изображение загружено, проделываем стандартные операции по его перемещению

					// генерируем уникальное имя изображения
					$filename = md5(uniqid());
					
					// получаем формат изображения
					$ext = pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION);

					// текущая временная директория
					$current_path = $_FILES["image"]["tmp_name"];
					
					// директория постоянного хранения
					$new_path = __DIR__ . '/images/' . $filename . "." . $ext;

					// перемещаем изображение в директорию постоянного хранения
					if (move_uploaded_file($current_path, $new_path)) {
						// если файл изображения загружен
						$img = $filename . "." . $ext;
					};
				}

				// выводим данные формы
				printf("
					<h2>%s %s %s</h2>
					Должность: <b>%s</b><p>
					Категория: <b>%s</b><p>
					Стаж в техникуме: <b>%s</b> (лет)<p>
					Фотография: <br />
					<img src='images/%s' width='300px'>
					",
					$_POST["surname"],
					$_POST["name"],
					$_POST["patronymic"],
					$_POST["post"],
					$_POST["category"],
					$_POST["experience_college"],
					$img
				);	
    
			} else {
			   // если при загрузке произошла ошибка, выводим информацию о ней
				switch ($_FILES['image']['error']) {
			        case UPLOAD_ERR_INI_SIZE:
			            echo "<h3>Размер принятого файла превысил максимально допустимый размер, который задан директивой upload_max_filesize конфигурационного файла php.ini (код ошибки: 1)</h3>";
						break;
			        case UPLOAD_ERR_FORM_SIZE:
			        	echo "<h3>Размер загружаемого файла превысил значение MAX_FILE_SIZE, указанное в HTML-форме (код ошибки: 2)</h3>";
						break;
			        case UPLOAD_ERR_PARTIAL:
			            echo "<h3>Загружаемый файл был получен только частично (код ошибки: 3)</h3>";
						break;
			        default:
			        	echo "<h3>Нам жаль, но что-то пошло не так...</h3>";
				}
			}			
		} else {

			echo "<h3>Заполните, пожалуйста, форму</h3>";
		};
	?>


</body>
</html>