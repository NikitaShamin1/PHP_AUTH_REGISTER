<?php  
    require "db_connect.php";

    // Считываем все данные из POST в массив data
    $data = $_POST;

    // Если нажата кнопка Регистрация
    if(isset($data['do_signup']))
    {
        // Создаем массив с ошибками
        $errors = array();

        // Проверяем на то, введены ли все значения у полей
        if (trim($data['login']) == '')
        {
            $errors[] = 'Введите логин!';
        }

        if ($data['email'] == '')
        {
            $errors[] = 'Введите email!';
        }

        if ($data['password'] == '')
        {
            $errors[] = 'Введите пароль!';
        }

        if ($data['сonfirm_password'] != $data['password'])
        {
            $errors[] = 'Пароли не совпадают!';
        }

        // Проверяем на дубликаты логина и почты в БД
        if (R::count('users', "login = ?", array($data['login'])) > 0)
        {
            $errors[] = 'Пользователь с таким Логином существует!';
        }

        if (R::count('users', "email = ?", array($data['email'])) > 0)
        {
            $errors[] = 'Пользователь с таким email существует!';
        }

        // Если не было обнаружено ошибок, то регистрируем пользователя
        if (empty($errors))
        {
            // Заполняем все поля в БД
            $user = R::dispense('users');
            $user->login = $data['login'];
            $user->email = $data['email'];
            $user->password = password_hash($data['password'], PASSWORD_DEFAULT);
            $user->join_date = time();
            R::store($user);

            // После добавления нового пользователя выводим пользователю об этом сообщение
            echo '<div style = "color: green;">Вы успешно зарегистрированы! </div><hr>';
        }
        else
        {
            // Если есть ошибки, то выводим их пользователю
            echo'<div id="errors">'.array_shift($errors). '</div><hr>';
        }
    }
?>

<form action="/pages/signup.php" method="POST">
	<p>
		<p><strong>Ваш Логин:</strong></p>	
		<input type="text" name="login" value = "<?php echo @$data['login'];?>">
	</p>
	<p>
		<p><strong>Ваш Email:</strong></p>	
		<input type="email" name="email" value = "<?php echo @$data['email'];?>">
	</p>
	<p>
		<p><strong>Ваш Пароль:</strong></p>	
		<input type="password" name="password" value = "<?php echo @$data['password'];?>">
	</p>
	<p>
		<p><strong>Повторите Пароль:</strong></p>	
		<input type="password" name="сonfirm_password" value = "<?php echo @$data['confirm_password'];?>">
	</p>
	<p>
		<button type="submit" name="do_signup">Зарегистрироваться</button>
	</p>
</form>