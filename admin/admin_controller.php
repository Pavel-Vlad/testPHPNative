<?php
if (empty($_SESSION['auth'])) {
    header("Location: /");
}

$query_form = '';

if (!empty($_POST['method']) && $_POST['method'] === 'post') {

    $parent_id = mysqli_real_escape_string($link, $_POST['parent_id']);
    $title = mysqli_real_escape_string($link, $_POST['title']);
    $description = mysqli_real_escape_string($link, $_POST['description']);
    if (!is_numeric($parent_id)) {
        $query_form = "INSERT INTO objects (title, description) VALUES ('$title', '$description')";
    } else {
        $query_form = "INSERT INTO objects (title, description, parent_id) VALUES ('$title', '$description', '$parent_id')";
    }


} elseif (!empty($_POST['method']) && $_POST['method'] === 'delete') {

    $id = mysqli_real_escape_string($link, $_POST['parent_id']);
    $query_form = "DELETE FROM objects WHERE id = '$id' OR parent_id = '$id'";


} elseif (!empty($_POST['method']) && $_POST['method'] === 'put') {

    $title = mysqli_real_escape_string($link, $_POST['title']);
    $description = mysqli_real_escape_string($link, $_POST['description']);
    $parent_id = mysqli_real_escape_string($link, $_POST['parent_id']);
    $object_id = mysqli_real_escape_string($link, $_POST['object_id']);

    // проверки выбранных объектов
    if (!$object_id) {
        $_SESSION['mysql_error'] = 'Необходимо указать изменяемый элемент!';
        header('Location: ' . $_SERVER['REQUEST_URI']);
        exit();
    } elseif ($parent_id === $object_id) {
        $_SESSION['mysql_error'] = 'Объект не может быть сам себе родителем!';
        header('Location: ' . $_SERVER['REQUEST_URI']);
        exit();
    }

    // предотвращение выбора ребенка новым родителем
    $query_form = "SELECT id FROM objects where parent_id = '$object_id'";
    $result = mysqli_query($link, $query_form);
    if (!$result) {
        $_SESSION['mysql_error'] = mysqli_error($link);
    }
    while ($child = mysqli_fetch_assoc($result)) {
        if ($child['id'] == $parent_id) {
            $_SESSION['mysql_error'] = 'Операция невозможна попробуйте выбрать другого родителя!';
            header('Location: ' . $_SERVER['REQUEST_URI']);
            exit();
        }
    }

    if ($parent_id == '0' || !is_numeric($parent_id)) {
        $query_form = "UPDATE objects SET title = '$title', description = '$description', parent_id = DEFAULT WHERE id = '$object_id'";
    } else {
        $query_form = "UPDATE objects SET title = '$title', description = '$description', parent_id = '$parent_id' WHERE id = '$object_id'";
    }

}

if (!empty($query_form)) {
    $result = mysqli_query($link, $query_form);

    if (!$result) {
        $_SESSION['mysql_error'] = mysqli_error($link);
    }
    header('Location: ' . $_SERVER['REQUEST_URI']);
}