<!doctype html>
<?php

//Filename: join_event.php
//Authors: Grace Lu and Joey Woodson 
//Content: way to join the user to the trip at the moment 

	require('database.php');
	session_start();

	$trip_id = $_POST['id'];
	if($trip_id){
		$query = $mysqli->prepare('select seats_available from trips where id = ?');
		if(!$query){
			printf("Query Prep Failed: %s\n", $mysqli->error);
			exit;
		}
		$query->bind_param('i', $trip_id);
		$query->execute();
		$query->bind_result($seats_available);

		if($seats_available >= 1){
			//decrease seats available by one 
			$joined_query = $mysqli->prepare('update trips set seats_available = ? where id = ?');
			if(!$joined_query){
				printf("Query Prep Failed: %s\n", $mysqli->error);
				exit;
			}
			$joined_query->bind_param('ii', $seats_available-1, $trip_id);
			$joined_query->execute();

			//modal pops up stating success!
			echo '<a class="waves-effect waves-light btn modal-trigger" href="#full_modal">Modal</a><div id="full_modal" class="modal"><div class="modal-content"><h4>You\'ve joined!</h4><p>You are now a part of this trip!</p></div></div>';
			$joined_query->close();
		}
		else{
			//pop up a modal stating that trip is full
			echo '<a class="waves-effect waves-light btn modal-trigger" href="#full_modal">Modal</a><div id="full_modal" class="modal"><div class="modal-content"><h4>Sorry!</h4><p>This trip is full at the moment, please join another trip!</p></div></div>';
		}
		$query->close();
	}
?>
<head>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.0.0-beta1/jquery.js" type="text/javascript"></script>
</head>
<script type="text/javascript">
$(document).ready(function(){
    // the "href" attribute of .modal-trigger must specify the modal ID that wants to be triggered
    $('.modal-trigger').leanModal();
  });
</script>
</html>