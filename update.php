<?php
session_start();
include "includes/config.php";
echo '<h2 id="username">' . "hello, " . $_SESSION['username'] . '</h2>';

if (!isset($_SESSION["username"])) {
    header("location: index.php");
    die();
}

$todoId = mysqli_real_escape_string($conn, $_GET["update_task"]);

if (isset($_POST['add_todo'])){
    $desc = mysqli_real_escape_string($conn, $_POST["description"]);
    //declar user_id in baza username
    $sql =  "SELECT user_id FROM users WHERE username = '{$_SESSION['username']}'";
    $res = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($res);
        if($count > 0){
            $row = mysqli_fetch_assoc($res);
            $user_id = $row['user_id'];
        }else {
            $user_id= 0;
        }

    $sql = null;
    //am declarat-o null sa o folosim mai jos
    $sql = "UPDATE todos SET task_id='{$todoId}', task_description = '{$desc}' WHERE task_id='{$todoId}'";
    $res = mysqli_query($conn, $sql);
        if ($res) {
            echo"Task update successfully!";
        }else{
            die(mysqli_error($conn));
        }
       
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Update Task</title>
</head>
<body>
<header>
        <a href="logout.php" id='logout_btn'>Log out</a>
    </header>
<form action="" method="POST" >
		<input type="text" name="description" class="description" placeholder='Update Task ' required value="<?php if (isset($_POST['add_todo'])) { echo $_POST["description"];} ?>" >
		<input type="submit" value='Update Task' name='add_todo'>
        <input type="button" value="Go back" class="homebutton" id="btnHome" 
onClick="document.location.href='add_todo.php'" />
        
	</form>
 
</body>
</html>