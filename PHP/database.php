<?php
//Filename: database.php
//Author: Sam Teeter
//Content: Scripts creates a mysqli instance and connects it to the ride_share database

$mysqli = new mysqli('localhost', 'ride_share', 'ride_share_pass', 'ride_share');

if($mysqli->connect_errno){
    printf("Could not connect to database: %s\n", $mysqli->connect_error);
    exit;
}

?>