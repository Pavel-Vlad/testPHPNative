<?php

if (empty($_SESSION['auth'])) {
    header("Location: /");
}

if (!empty($_GET['select']) && is_numeric($_GET['select'])) {

    include $_SERVER['DOCUMENT_ROOT'] . '/include/__configs.php';

    $link = mysqli_connect($DB['server'], $DB['username'], $DB['password'], $DB['db']);
    $query = sprintf("SELECT * FROM objects where id = %s",
        mysqli_real_escape_string($link, intval($_GET['select']))
    );
    $responce = [];

    $result = mysqli_query($link, $query);

    if (!$result) {
        $responce['error'] = 'Ошибка БД!';
    } else {
        $responce['data'] = mysqli_fetch_all($result, MYSQLI_ASSOC);
    }
    echo json_encode($responce);
    exit();
}