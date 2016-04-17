<?php
//Filename: leave_trip.php
//Author: Sam Teeter
//Content: script for removing user from trip when leave button is clicked

//configure page to accept json data
	header("Content-Type: application/json");

	require('database.php');
	session_start();
			
	$trip_id = $_POST['trip_id'];
	$username = $_SESSION['username'];
    
    $query = $mysqli->prepare("delete from trips2users where trip_id=? and username=?");
    if (!$query){
        echo json_encode(array(
            "success"=>false,
            "message"=>$mysqli->error
        ));
        exit;
    }
    $query->bind_param("is", $trip_id, $username);
    if($query->execute()){
        echo json_encode(array(
            "success"=>true,
            "left_trip_id"=>$trip_id
        ));
    }
    else{
        echo json_encode(array(
            "success"=>false,
            "message"=>$mysqli->error
        ));
    }
    
?>