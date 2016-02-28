<?php
//Filename: login.php
//Author: Sam Teeter
//Content: login script
    require("database.php");
    session_start();
    
    if(!isset($_POST['username']) || !isset($_POST['password'])){
        error_log("Login called without proper fields");
        echo "Error: fields not set";
        exit;
    }
    
    $login_username = $_POST['username'];
    $login_password = $_POST['password'];
    
    $password_query = $mysqli->prepare("select count(*), salted_password from users where username=?");
    $password_query->bind_param("s", $login_username);
    $password_query->execute();
    
    $password_query->bind_result($count, $salted_password);
    $password_query->fetch();
    
    if($count == 1 && crypt($login_password, $salted_password) == $salted_password){
        //Login successful. Set session variables and go to homepage
        $_SESSION['username'] = $login_username;
        header("Location:home.php");
    }
    else{
        header("Location:http://".$_SERVER['SERVER_NAME']."/~cse437/HTML/login.html");
    }
?>