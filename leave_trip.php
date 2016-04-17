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
    
    //add to trips2users
    $query = $mysqli->prepare("delete from trips2users where trip_id=? and username=?");
    if (!$query){
        echo json_encode(array(
            "success"=>false,
            "message"=>$mysqli->error
        ));
        exit;
    }
    $query->bind_param("is", $trip_id, $username);
    if(!$query->execute()){
        echo json_encode(array(
            "success"=>false,
            "message"=>$mysqli->error
        ));
    }
    $query->close();
    
    //decrement number going
    $query2 = $mysqli->prepare("update trips set number_going = number_going-1 where id=?");
    if (!$query2){
        echo json_encode(array(
            "success"=>false,
            "message"=>$mysqli->error
        ));
        exit;
    }
    $query2->bind_param("i", $trip_id);
    if(!$query2->execute()){
        echo json_encode(array(
            "success"=>false,
            "message"=>$mysqli->error
        ));
    }
    else{
        echo json_encode(array(
            "success"=>true,
            "left_trip_id"=>$trip_id
        ));
    }
?>