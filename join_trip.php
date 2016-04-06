<!doctype html>
<?php

//Filename: join_event.php
//Authors: Grace Lu and Joey Woodson 
//Content: way to join the user to the trip at the moment 

	require('database.php');
	session_start();

	$trip_id = $_POST['id'];
	$username = $_SESSION['username'];
	
	$join_query1 = $mysqli->prepare('update trips set number_going = number_going+1 where id = ?');
	if(!$join_query1) {
	    echo json_encode(array(
			"success" => false,
			"message" => $mysqli->error
		));
	}
	
	$join_query2 = $mysqli->prepare('insert into trips2users(trip_id, username, driving) values (?, ?, ?)');
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
		"success"=>true
	));
?>
