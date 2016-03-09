<?php
//Filename: login.php
//Author: Joey Woodson
//Content: logout script
	session_start();
	session_destroy();
	header("Location:http://".$_SERVER['SERVER_NAME']."/~cse437/login.html");
?>