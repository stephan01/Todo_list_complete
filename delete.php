<?php
include "includes/config.php";
session_start();
if (!isset($_SESSION["username"])) {
    header("Location: index.php");
    die();
}

if (isset($_GET["del_task"])) {
    $todoId = mysqli_real_escape_string($conn, $_GET["del_task"]);

    // Get User Id based on user email
    $sql = "SELECT user_id FROM users WHERE username='{$_SESSION["username"]}'";
    $res = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($res);
    if ($count > 0) {
        $row = mysqli_fetch_assoc($res);
        $user_id = $row["user_id"];
    } else {
        $user_id = 0;
    }

    $sql = "DELETE FROM todos WHERE task_id='{$todoId}' AND user_id='{$user_id}'";
    mysqli_query($conn, $sql);
    header("Location: add_todo.php");
} else {
    header("Location: add_todo.php");
}

?>