<?php
include $_SERVER['DOCUMENT_ROOT'] . '/main_controller.php';
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>testPHPNative</title>
    <link rel="stylesheet" href="/assets/style.css">
</head>
<body>
<header>
    <div class="header-line">
        <ul class="main-menu">
            <li><a class="btn" href="/">Главная</a></li>
            <?php
            if (!empty($_SESSION['auth'])) {
                ?>
                <li><a class="btn" href="/admin">Админка</a></li>
                <?php
            }
            ?>
        </ul>
        <div>
            <?php
            if (!empty($_SESSION['auth'])) {
                ?>
                <a class="btn" href="/?logout=true">Выйти</a>
                <?php
            } else {
                ?>
                <a href="##" class="btn open-hidlayer">Войти</a>
                <?php
            }
            ?>
        </div>
    </div>
    <?php
    if (!empty($error_message)) {
        ?>
        <p class="error">
            <?= $error_message ?>
        </p>
        <?php
    }
    ?>
</header>

