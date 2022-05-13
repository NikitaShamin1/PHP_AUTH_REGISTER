<?php 
    require "db_connect.php";

    // Убираем данные о текущем пользователи из сессии
    unset($_SESSION['logged_user']);

    // И перенаправляем на главную страницу
    header('Location: /');