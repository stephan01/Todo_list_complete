<?php   
include "includes/config.php";
session_start();

//Check if method=post din index.php is set or not
//La fiecare copiez name=""
if (isset($_SESSION["username"])) {
    header("location: todos.php");
    die();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Authentication</title>
</head>
<body>
    <header>
        <a class="app_name" href="#">Welcome to your Todo List</a>
    </header>

    <form action="login.php" method="POST">
        <div class="login">
            <label for="username">Username: </label>
                <input type="text" name="username" placeholder="Choose a Username">
                <br>
            <label for="password">Password: </label>
                <input type="password" name="password" placeholder="Choose a password">
                <br>
                <button type="submit" name="submit">Continue</button>
        </div>
    </form>
</body>
</html>