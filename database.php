<?php
//Filename: database.php
//Author: Sam Teeter
//Content: Scripts creates a mysqli instance and connects it to the ride_share database

//change localhost to ip address to test/get access to database
$mysqli = new mysqli('localhost', 'ride_share', 'ride_share_pass', 'ride_share');

if($mysqli->connect_errno){
    printf("Could not connect to database: %s\n", $mysqli->connect_error);
    exit;
}

//utility function to check that user is logged in
function login_check(){
    if(!isset($_SESSION['username'])){
        header("Location:http://".$_SERVER['SERVER_NAME']."/~cse437/login.html");
    }
}

?>