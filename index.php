<?php require "db_connect.php"; ?>

<!-- Если сессия для пользователя запущена, то выводим его логин -->
<?php if (isset($_SESSION['logged_user'])) : ?>

    <h2>Авторизован пользователь -  <?php echo $_SESSION['logged_user']->login; ?>.</h2>
	<hr>
	<a href = "/scripts/logout.php">Выйти</a>

<!-- Иначе - выводим ссылки на авторизацию и регистрацию -->
<?php else : ?>
	<a href="pages/login.php">Авторизация</a><br>
	<a href="pages/signup.php">Регистрация</a>
<?php endif;  ?>