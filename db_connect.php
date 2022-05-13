<?php
    require "ORM/rb.php";

    // Подключаемся к БД
    R::setup( 'mysql:host=localhost;dbname=TZ', 'root', '');
    session_start();
