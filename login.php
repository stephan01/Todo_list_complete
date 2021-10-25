<?php
include "includes/config.php";
session_start();

//Check if method=post din index.php is set or not
//La fiecare copiez name=""
if (isset($_SESSION["username"])) {
    header("location: todos.php");
    die();
}

if (isset($_POST["submit"])) {
    $username = mysqli_real_escape_string($conn, $_POST["username"]);
    $password = mysqli_real_escape_string($conn, md5($_POST["password"]));

if (usernameIsValid($username)) {
        if(checkLogin($username, $password)) {
            $_SESSION["username"] = $username;
            header("location: todos.php"); 
            die ();
        }else{
            echo "<script>alert('Username already used! Please try another username!');window.location.replace('index.php');</script>";
        }
}else{     
    $user_registration = createUser($username, $password);
    if ($user_registration) {
        $_SESSION["username"] = $username;    
        header("location: todos.php");   
        die();     
    }else{
        echo "User registration failed!";
        die();
    }
    
}
}else {
    header("location: index.php");
    die();
}