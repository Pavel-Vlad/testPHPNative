<?php

include '__configs.php';

$link = mysqli_connect($DB['server'], $DB['username'], $DB['password'], $DB['db']);
if (!$link) {
    exit(mysqli_connect_error());
}

$query = mysqli_query(
    $link,
    "CREATE TABLE IF NOT EXISTS users
(
    `id`       int auto_increment primary key,
    `login`    varchar(60) not null unique,
    `password` varchar(60) not null
)");
if (!$query) {
    exit(mysqli_error($link));
}

$query = mysqli_query(
    $link,
    "INSERT INTO users(login, password) VALUES ('$LOGIN', '$PASSWORD')");
if (!$query) {
    exit(mysqli_error($link));
}

$query = mysqli_query(
    $link,
    "CREATE TABLE IF NOT EXISTS objects
(
    id          int auto_increment PRIMARY KEY,
    title       varchar(255) not null unique,
    description text,
    parent_id   int default null,
    FOREIGN KEY (parent_id) REFERENCES objects (id)
        ON DELETE CASCADE
)");
if (!$query) {
    exit(mysqli_error($link));
}
