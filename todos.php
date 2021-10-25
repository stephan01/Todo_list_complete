<?php
session_start();
include "includes/config.php";
echo '<h2 id="username">' . "hello, " . $_SESSION['username'] . '</h2>';

if (!isset($_SESSION["username"])) {
    header("location: index.php");
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
    <title>Todo List</title>
</head>
<body>
<header>
        <a href="logout.php" id='logout_btn'>Log out</a>
    </header>
<form action="add_todo.php" method="POST" >
		<input type="text" name="description" class="description" placeholder='Task Description' required value="<?php if (isset($_POST['add_todo'])) { echo $_POST["description"];} ?>" >
		<input type="submit" value='Add Task' name='add_todo'>
        
	</form>
 
</body>
</html>