<?php
	require("database.php");
    session_start();
    login_check();
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
		
		$id = $_POST['id'];
		
		$query = $mysqli->prepare("select drop_off_location, driver, date, pick_up_location, depart_time, model, color, number_going from trips 
		where trip_id = id 
		join cars on (id = trip_id)");
		if (!$query){
                    error_log("Could not prepare details query");
                    exit;
                }
		$query->execute();
        $query->bind_result($drop_off_location, $driver, $date, $pick_up_location, $depart_time, $model, $color, $number_going);
		
		$car = $model + " " + $color;
		
		$details = "<table class='striped'>
		<tr>
			<td>Destination</td>
			<td>%s</td>
		</tr>
			<td>Driver</td>
			<td>%s</td>
		<tr>
			<td>Date</td>
			<td>%s</td>
		</tr>
		<tr>
			<td>Pick-up Location</td>
			<td>%s</td>
		</tr>
		<tr>
			<td>Pick-up Time</td>
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
		
		printf($details, $drop_off_location, $driver, $date, $pick_up_location, $depart_time, $car, $number_going);
		
		?>
		
		<table class='striped' style='width:40%'>
		<tr>
			<td>Destination</td>
			<td>%s</td>
		</tr>
			<td>Driver</td>
			<td>%s</td>
		<tr>
			<td>Date</td>
			<td>%s</td>
		</tr>
		<tr>
			<td>Pick-up Location</td>
			<td>%s</td>
		</tr>
		<tr>
			<td>Pick-up Time</td>
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
		</table>"
		
		<br>
		
		<a class="waves-effect waves-light btn" href="trip_calendar.php">Button</a>

		</div>

		<!--Finish Materialize setup-->
        <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
        <script type="text/javascript" src="js/materialize.min.js"></script>
        <!--Set document ready function so mobile navbar button works:-->

</body>

</html>