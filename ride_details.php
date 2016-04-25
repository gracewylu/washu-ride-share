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

<style>

table.details {
    border-collapse: collapse;
	width:15%;
	border: 1px solid black
}

th, td {
    border: 1px solid black;
}
</style>

<body>
		

		<div>
		
		<?php
		
		$trip_id = $_POST['id'];
		
		$query = $mysqli->prepare("select drop_off_location, pick_up_location, depart_time from trips 
		where id == trip_id ");
		if (!$query){
                    error_log("Could not prepare details query");
                    exit;
                }
		
		$details = "<table class='details'>
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
		
		
		
		?>
		
		
		
		<table class="details">
		<tr>
			<td>Destination</td>
			<?php
			$trip_id = $_POST['id'];
			
			$query = $mysqli->prepare("select drop_off_location from trips 
			where id == trip_id ");
			if (!$query){
						error_log("Could not prepare details query");
						exit;
					}
			$query->execute();
            $query->bind_result($drop_off_location);
			$new_entry = "<td>%s</td>";
			printf($new_entry, $drop_off_location)
			?>
		</tr>
			<td>Driver</td>
			<td></td>
		<tr>
			<td>Date</td>
			<td></td>
		</tr>
		<tr>
			<td>Pick-up Location</td>
			<td></td>
		</tr>
		<tr>
			<td>Pick-up Time</td>
			<td></td>
		</tr>
		<tr>
			<td>Car</td>
			<td></td>
		</tr>
		<tr>
			<td>Number Going</td>
			<td></td>
		</tr>	
		</table>
		
		<br>
		
		<button class="waves-effect waves-light btn" style="ali">Back</button>

		</div>

		<!--Finish Materialize setup-->
        <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
        <script type="text/javascript" src="js/materialize.min.js"></script>
        <!--Set document ready function so mobile navbar button works:-->

</body>

</html>