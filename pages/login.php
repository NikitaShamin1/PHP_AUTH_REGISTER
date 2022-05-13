<?php
    require "db_connect.php";

    // Считываем все данные с POST в массив data
    $data = $_POST;

    // Если была нажата кнопка Войти...
	if(isset($data['do_login']))
	{
        // Массив с ошибками
		$errors = array();

		$user = R::findOne('users', 'login = ?', array($data['login']));

        // Если пользователь с данным логином уже есть в БД
		if($user)
		{
			// И введенный пароль соответствует тому, что лежит в БД
			if(password_verify($data['password'], $user->password))
			{
                // То заносим в сессию данные пользователя
				$_SESSION['logged_user'] = $user;

                // И выводим ссылку на переход на главную страницу
				echo '<div style = "color: green;">Вы Авторизованы!<br/>';
                echo 'Вы можете перейти на <a href="/index.php">главную страницу!</a></div><hr>';

			}
            // В ветках else, если присутствуют ошибки, то добавлем их в массив errors
            else
            {
				$errors[] = 'Пароль неправильно введен';
			}
		}
        else
		{
			$errors[] = 'Пользователь не найден!';
		}

        // Если массив с ошибками не пустой, то выводим его пользователю
		if (!empty($errors))
        {
			echo'<div style="color:red;">'.array_shift($errors).'</div><hr>';
		}
	}
	?>

	<form action="login.php" method="POST">
		<p>
			<p><strong>Логин:</strong></p>
			<input type="text" name="login" value = "<?php echo @$data['login'];?>">
		</p>
		<p>
			<p><strong>Пароль:</strong></p>
			<input type="password" name="password" value = "<?php echo @$data['password'];?>">
		</p>
		<p>
			<button type="submit" name = "do_login">Войти</button>
		</p>
	</form>