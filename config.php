<?php
//db connection function
function dbConnect(){
    $hostname = "localhost";
    $username = "root";
    $password = "";
    $database = "todo_list";
    
    $conn = mysqli_connect($hostname, $username, $password, $database) or die("Database connection failed!");
return $conn;
}

//declar conexiunea ca sa o folosesc
$conn = dbConnect();

//check username is valid or not
function usernameIsValid($username){
    $conn = dbConnect();
    $sql = "SELECT username FROM users WHERE username = '$username'";
    $result = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($result);
        if ($count > 0) {
            return true; 
        }else {
            return false;
        }
}

// check login details is valid or not
function checkLogin($username, $password){
    $conn = dbConnect();
    $sql = "SELECT username FROM users WHERE username = '$username' AND password = '$password'";
    $result = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($result);
        if ($count > 0) {
            return true; 
        }else {
            return false;
        }
}


//create user 
function createUser($username, $password){
    $conn = dbConnect();
    $sql = "INSERT INTO users (username, password) VALUES ('$username', '$password')";
    $result = mysqli_query($conn, $sql);
      return $result;

}