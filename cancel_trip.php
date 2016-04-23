<?php
//Filename: cancel_trip.php
//Author: Sam Teeter
//Content: script for deleting trip when cancel button is clicked

//configure page to accept json data
	header("Content-Type: application/json");

	require('database.php');
	session_start();
			
	$trip_id = $_POST['trip_id'];
	$username = $_SESSION['username'];
    
    //query in such a way that we double-check ownership of the trip
    $query = $mysqli->prepare("delete t2u from trips t join trips2users t2u on (t.id = t2u.trip_id) where t.owner=? and t2u.trip_id=?");
    if(!$query){
        echo json_encode(array(
            "success"=>false,
            "message"=>$mysqli->error
        ));
        exit;
    }
    $query->bind_param("si", $username, $trip_id);
    if(!$query->execute()){
        echo json_encode(array(
            "success"=>false,
            "message"=>$mysqli->error
        ));
        $query->close();
        exit;
    }
    $query->close();
    //if that query went through, go ahead and delete from the trips table too
    $query = $mysqli->prepare("delete from trips where id=?");
    $query->bind_param("i",$trip_id);
    if(!$query->execute()){
        echo json_encode(array(
            "success"=>false,
            "message"=>$mysqli->error
        ));
        $query->close();
        exit;
    }
    echo json_encode(array(
        "success"=>true,
        "left_trip_id"=>$trip_id
    ));
?>