
<?php
//Filename: trip_calendar.php
//Author: Sam Teeter
//Content: page to display all public trips
    require("database.php");
    session_start();
    login_check();
    date_default_timezone_set("UTC");
    
    //display upcoming trip events in a sectioned list
    //TODO: create search bar where they can narrow results by date, location
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Find a trip</title>
		
		<link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
		<!--Import materialize.css-->
		<link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>

		<!--Let browser know website is optimized for mobile-->
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
		

		<!--Navbar-->
      <?php include("navbar.php");?>
    </head>
    <body>
        <h1>Upcoming Trips</h1>
		
		<!-- search bar here -->
	
        <table style='width:100%'>
			<thead>
            <tr class='table-h1'>
                <th>Date</th>
                <th>Time</th>
                <th>Pick up</th>
                <th>Drop off</th>
                <th>Driver</th>
            </tr>
			</thead>
			
			
			<!--Test table entries -->
			<tr>
			<form method="POST" action="join_event.php">
			<td>test</td><td>test</td><td>test</td><td>test</td><td>test</td>
			<input type="hidden" name="id" value="%d">
			<td><button type="submit" class="waves-effect waves-light btn">Join</button></td>
			</form>
			</tr>
			
			<tr>
			<form method="POST" action="join_event.php">
			<td>test</td><td>test</td><td>test</td><td>test</td><td>test</td>
			<input type="hidden" name="id" value="%d">
			<td><button type="submit" class="btn disabled" disabled>Going</button></td>
			</form>
			</tr>
			
            <?php
                //display list of elements grouped by day, with list section headings showing the days
                //TODO: give user option to select date range, possibly change how trips are sorted
                //TODO: link to some kind of details page for each trip where they can view more information
				
                $query = $mysqli->prepare("select date, pick_up_location, drop_off_location, driver_username, id
                                          from trips
                                          where date between now() and now()+interval 7 day
                                          order by date asc");
                if (!$query){
                    error_log("Could not prepare trips query");
                    exit;
                }
                $query->execute();
                $query->bind_result($date, $pick_up_location, $drop_off_location, $driver_username, $id);
                
                while($query->fetch()){
                    $datetime = new DateTime($date);
                    $day = $datetime->format("m/d/y");
                    $time = $datetime->format("h:i");
					
					$new_entry = "<tr><form method='POST' action='join_event.php'><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><input type='hidden' name='id' value='%d'>";
					
					//need way to check if user is already in this trip
					//if they are, display a disabled "Going" button instead
					/*
					if ($joined) {
						$new_entry += "<td><button type='submit' class='btn disabled' disabled>Going</button></td></form></tr>"
					}
					else {
						$new_entry += "<td><button type='submit' class='waves-effect waves-light btn'>Join</button></td></form></tr>"
					}
					*/
					
					//delete once "joined" is working

					$new_entry += "<td><button type='submit' class='waves-effect waves-light btn'>Join</button></td></form></tr>";
					
                    printf($new_entry, $day, $time, $pick_up_location, $drop_off_location, $driver_username, $id);
                }
            ?>
			
			
        </table>
		
		<!--Finish Materialize setup-->
        <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
        <script type="text/javascript" src="js/materialize.min.js"></script>
        <!--Set document ready function so mobile navbar button works:-->
      <script>
        $( document ).ready(function() {
            $(".button-collapse").sideNav();
        });
	  </script>
    </body>
</html>
