<?php
	require('database.php');

	$pick_up_location = $_POST['pick_up_location'];
	$drop_off_location = $_POST['drop_off_location'];

	if($pick_up_location != null && $drop_off_location == null){
		//figure out a way to ignore capitalization later 
		$suggested_trips = $mysqli->prepare('select id, depart_time, arrive_time, drop_off_location from trips where pick_up_location="'.$pick_up_location.'";');
		if(!$suggested_trips){
			echo "Failed to find suggested trips";
			exit;
		}
		$suggested_trips->execute(); 
		$suggested_trips->bind_result($id, $depart_time, $arrive_time, $drop_off_loc);
		$trips=array();

		while($suggested_trips->fetch()){
			$trip = array(
				"id" => $id, 
				"depart_time" => $depart_time, 
				"drop_off_location" =>$drop_off_loc, 
				"pick_up_location" => $pick_up_location
			); 
			$trips[] = $trip;
		}
		echo json_encode($trips);
		$suggested_trips->close();
	} else{
		$suggested_trips = $mysqli->prepare('select id, depart_time, arrive_time, pick_up_location from trips where drop_off_location="'.$drop_off_location.'";');
		if(!$suggested_trips){
			echo "Failed to find suggested trips";
			exit;
		}
		$suggested_trips->execute(); 
		$suggested_trips->bind_result($id, $depart_time, $arrive_time, $pick_up_loc);
		$trips=array();

		while($suggested_trips->fetch()){
			$trip = array(
				"id" => $id, 
				"depart_time" => $depart_time, 
				"drop_off_location" =>$drop_off_location, 
				"pick_up_location" => $pick_up_loc
			); 
			$trips[] = $trip;
		}

		echo json_encode($trips);
		$suggested_trips->close();
	}


?>