<?php
session_start();
include "includes/config.php";
echo '<h2 id="username">' . "hello, " . $_SESSION['username'] . '</h2>';

if (!isset($_SESSION["username"])) {
    header("location: index.php");
    die();
}

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
    $sql = "INSERT INTO todos (task_description, user_id) VALUES ('$desc', '$user_id')";
    $res = mysqli_query($conn, $sql);
        if ($res) {
            $_POST["description"] = "";
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
    <?php
     $sql =  "SELECT user_id FROM users WHERE username = '{$_SESSION['username']}'";
     $res = mysqli_query($conn, $sql);
     $count = mysqli_num_rows($res);
         if($count > 0){
             $row = mysqli_fetch_assoc($res);
             $user_id = $row['user_id'];
         }else {
             $user_id= 0;
         }
    $sql1 = "SELECT * FROM todos WHERE user_id = '{$user_id}' ORDER BY task_id DESC";
    $res1 = mysqli_query($conn, $sql1);
        
        foreach($res1 as $row) {
            ?>
            <div class='task_container'>
                <p> <?php echo $row['task_description'] ?> </p>
                <a href="delete.php?del_task= <?php echo $row['task_id'] ?>">Delete</a>
              
            </div>
            <?php
        }
        

?>
</body>
</html>