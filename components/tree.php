<?php

$query = "SELECT DISTINCT IFNULL(parent_id, 0) parent_id FROM objects";
$result = mysqli_query($link, $query);
$parents = [];
if (!$result) {
    $_SESSION['mysql_error'] = mysqli_error($link);
    exit();
}

while ($parent = mysqli_fetch_assoc($result)) {
    foreach ($objects as $object) {
        if ($object['parent_id'] === $parent['parent_id']) {
            $parents[$parent['parent_id']][$object['id']] = $object;
        }
    }
}

function printTree($parents, $parent_id)
{
    if (isset($parents[$parent_id])) {
        echo '<ul>';
        foreach ($parents[$parent_id] as $parent) {
            echo '<li>|_<span class="tree__leaf">';
            echo '<span class="tree__desc hidden">' . $parent['description'] . '</span>';
            if (array_key_exists($parent['id'], $parents)) {
                echo '<span class="tree__plus">&#10010;</span>';
            }
            echo $parent['title'] . '</span>';
            printTree($parents, $parent['id']);
            echo '</li>';
        }
        echo '</ul>';
    } else
        return null;
}

?>

<div class="tree">
    <?php
    printTree($parents, 0);
    ?>
</div>



