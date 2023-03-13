<?php

include $_SERVER['DOCUMENT_ROOT'] . '/include/__configs.php';

session_start();

$error_message = '';
$link = mysqli_connect($DB['server'], $DB['username'], $DB['password'], $DB['db']);

// аутентификация
if (!empty($_POST['password']) && !empty($_POST['login'])) {

    $login = $_POST['login'];
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE login = '$login'";

    $result = mysqli_query($link, $query);

    if (!$result) {
        $error_message = 'Ошибка БД!';
    } else {
        $user = mysqli_fetch_assoc($result);
        if (!empty($user)) {
            $hash = $user['password'];
            if (password_verify($_POST['password'], $hash)) {
                $_SESSION['auth'] = true;
            } else {
                $error_message = 'Пароль не подошел!';
            }
        } else {
            $error_message = 'Пользователя с таким логином нет!';
        }
    }
}

// логаут
if (!empty($_GET['logout']) && $_GET['logout'] === 'true') {
    $_SESSION['auth'] = null;
    header("Location: /");
}

// получаем объекты для построения дерева
$query = "SELECT id, title, description, IFNULL(parent_id, 0) parent_id FROM objects ORDER BY parent_id";

$result = mysqli_query($link, $query);

if (!$result) {
    $error_message = 'Ошибка БД!';
} else {
    $objects = mysqli_fetch_all($result, MYSQLI_ASSOC);
    if (empty($objects)) {
        $error_message = 'Записей не найдено!';
    }
}

// получаем ошибки БД
if (!empty($_SESSION['mysql_error'])) {
    $error_message = $_SESSION['mysql_error'];
    $_SESSION['mysql_error'] = null;
}


