<?php
	require("database.php");
    session_start();
    login_check();
    include('navbar.php');
?>

<!doctype html>
<head>
	<link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
	
    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>

<body>
		

		<div>
		
		<?php
		
		$id = $_GET['details'];
		
		$query = $mysqli->prepare("select trips.drop_off_location, trips.owner, trips.depart_time, trips.pick_up_location, trips.return_time, cars.model, cars.color, trips.number_going from trips inner join cars on cars.trip_id = trips.id where trips.id = ".$id);
		if (!$query){
					echo "query didn't work";
                    error_log("Could not prepare details query");
                    exit;
        }
		$query->execute();
		//means that there is most likely no car associated with the trip
		if($query->num_rows == 0) {
			$query->close();

			if($trip_info = $mysqli->prepare("select drop_off_location, owner, depart_time, pick_up_location from trips where id = ".$id)){
				if($trip_info->execute()){
					$trip_info->store_result();
					$trip_info->bind_result($d_location, $owner, $d_time, $p_location) or die("Error binding result - ".$trip_info->error);
					// if($trip_info->bind_result($d_location, $owner, $d_time, $p_location)){
					// 	echo "drop off location: ".$d_location;
						$details = "<table class='striped'>
						<tr>
						<td>Destination</td>
						<td>%s</td>
						</tr>
						<td>Driver</td>
						<td>%s</td>
						<tr>
						<td>Depart Time</td>
						<td>%s</td>
						</tr>
						<tr>
						<td>Pick-up Location</td>
						<td>%s</td>
						</tr>
		
						</table>";
        				printf($details, $d_location, $owner, $d_time, $p_location);


					// }
				}

			}
			// if (!$trip_info){
			// 		echo "Couldn't acquire trip info";
   //                  error_log("Could not prepare details query");
   //                  exit;
   //      	}
		}
		else{
        $query->bind_result($drop_off_location, $driver, $depart_time, $pick_up_location, $return_time, $model, $color, $number_going);
		
		$car = $model + " " + $color;
		
		$details = "<table class='striped'>
		<tr>
			<td>Destination</td>
			<td>%s</td>
		</tr>
			<td>Driver</td>
			<td>%s</td>
		<tr>
			<td>Depart Time</td>
			<td>%s</td>
		</tr>
		<tr>
			<td>Pick-up Location</td>
			<td>%s</td>
		</tr>
		<tr>
			<td>Return Time</td>
			<td>%s</td>
		</tr>
		<tr>
			<td>Car</td>
			<td>%s</td>
		</tr>
		<tr>
			<td>Number Going</td>
			<td>%d</td>
		</tr>	
		</table>";
		
		printf($details, $drop_off_location, $driver, $depart_time, $pick_up_location, $return_time, $car, $number_going);
		$query->close();
		}
		?>
		
		<br>
		
		<div class="row"><div class="col s12 l5 offset-l11"><a class="waves-effect waves-light btn" href="trip_calendar.php">Back</a></div></div>

		</div>

		<!--Finish Materialize setup-->
        <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
        <script type="text/javascript" src="js/materialize.min.js"></script>
        <!--Set document ready function so mobile navbar button works:-->

</body>

</html>