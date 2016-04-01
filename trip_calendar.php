
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
		
		<!--Navbar-->
     <?php include("navbar.php");?>
	 <?php include("chat_box.php");?>
    </head>
    <body>
		<div class='container'>
        <h1 class="blue-grey-text">Upcoming Rides</h1>
		
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
			<td><button type="submit" class="join-button waves-effect waves-light btn">Join</button></td>
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
                                          where date between date_sub(now(), INTERVAL 1 week) and now()
                                          order by date asc");
                if (!$query){
                    error_log("Could not prepare trips query");
                    exit;
                }
                $query->execute();
                $query->bind_result($date, $pick_up_location, $drop_off_location, $driver_username, $id);
                
                //grabs the info of trip from query 
                while($query->fetch()){
                    $datetime = new DateTime($date);
                    $day = $datetime->format("m/d/y");
                    $time = $datetime->format("h:i");
					
					$new_entry = "<tr>
									<td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td>
									<input type='hidden' class='trip-id' value='%d'>
									<td><button type='submit' class='join-button waves-effect waves-light btn'>Join</button></td>
								</tr>";
					
                    printf($new_entry, $day, $time, $pick_up_location, $drop_off_location, $driver_username, $id);
                }
            ?>
			
			
        </table>
		</div>
		
        <!--Set document ready function so mobile navbar button works:-->
      <script>
        $( document ).ready(function() {
            $('.modal-trigger').leanModal();
			$('.join-button').click(function(){
				//notify the database of the change and remove the row from the table
				var tripId = $( this ).closest(".trip-id").value;
				$.post("join_trip.php", { id: tripId }, function(data){
					if (data.success) {
                        $( this ).closest("tr").remove();
                    }
					else{
						console.log(data.message);
					}
				}, "json");
			});
        });
	  </script>
    </body>
</html>
