<?php

//Filename: join_event.php
//Authors: Grace Lu and Joey Woodson 
//Content: way to join the user to the trip at the moment

	//configure page to accept json data
	header("Content-Type: application/json");

	require('database.php');
	session_start();
			
	$trip_id = $_POST['id'];
	$username = $_SESSION['username'];
	
	//check that the user is not already on this trip
	$check_dup = $mysqli->prepare("select exists (select 1 from trips2users where trip_id=? and username=?)");
	if(!$check_dup) {
	    echo json_encode(array(
			"success" => false,
			"message" => $mysqli->error
		));
	}
	$check_dup->bind_param("is", $trip_id, $username);
	$check_dup->execute();
	$check_dup->bind_result($exists);
	$check_dup->fetch();
	if($exists){
		echo json_encode(array(
			"success"=>false,
			"message"=>"User is already on this trip"
		));
		$check_dup->close();
		exit;
	}
	$check_dup->close();
	
	
	$join_query1 = $mysqli->prepare('update trips set number_going = number_going+1 where id = ?');
	if(!$join_query1) {
	    echo json_encode(array(
			"success" => false,
			"message" => $mysqli->error
		));
	}
	
	$join_query2 = $mysqli->prepare('insert ignore into trips2users(trip_id, username, driving) values (?, ?, ?)');
	if(!$join_query2) {
	    echo json_encode(array(
			"success" => false,
			"message" => $mysqli->error
		));
	}
	$temp=0; //Hack to keep the "not a variable" error away
	
	$join_query1->bind_param('i', $trip_id);
	$join_query1->execute();
	$join_query1->close();
	$join_query2->bind_param('isi', $trip_id, $username, $temp);
	$join_query2->execute();
	$join_query2->close();
	
	echo json_encode(array(
		"success"=>true,
		"joined_trip_id"=>$trip_id
	));
	
?>
