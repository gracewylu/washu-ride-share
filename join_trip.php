<!doctype html>
<?php

//Filename: join_event.php
//Authors: Grace Lu and Joey Woodson 
//Content: way to join the user to the trip at the moment 

	require('database.php');
	session_start();

	$trip_id = $_POST['id'];
	$username = $_SESSION['username'];
	//decrease seats available by one 
	$join_query = $mysqli->prepare('update trips set number_going = number_going+1 where id = ?;
								    insert into trips2users(trip_id, username, driving) values (?, ?, ?);');
	if(!$join_query){
		echo json_encode(array(
			"success" => false,
			"message" => $mysqli->error
		));
	}
	$join_query->bind_param('iisi', $trip_id, $trip_id, $username, 0);
	$join_query->execute();
	$join_query->close();
	
	echo json_encode(array(
		"success"=>true
	));
?>