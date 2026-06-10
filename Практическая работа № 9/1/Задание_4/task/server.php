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
			
			// создаем короткую ссылку на файл
			$file = $_FILES["myfile"];
		
			// определяем количество принятых файлов
			$count = count($file);
			
			// запустим цикл по массиву файлов
			for ($i=0; $i <= $count; $i++) {

				// текущая временная директория
				$current_path = $file["tmp_name"][$i];

				// генерируем уникальное имя для файла
				$filename = md5(uniqid());
				
				// заберем расширение файла
				$ext = pathinfo($file["name"][$i], PATHINFO_EXTENSION);

				// текущая временная директория
				$current_path = $file["tmp_name"][$i];
				
				// директория постоянного хранения
				$new_path = __DIR__ . '/upload/' . $filename . "." . $ext;

				// перемещение файла
				move_uploaded_file($current_path, $new_path);
			}     
				
		} else {

			echo "<h3>Заполните, пожалуйста, форму</h3>";
		};
	?>
	

</body>
</html>