
<?php
//Filename: trip_calendar.php
//Author: Sam Teeter, Joey Woodson
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
		<!--jQuery Link-->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.10.2/jquery.js"></script>


		<!--Let browser know website is optimized for mobile-->
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
		

		<!--Navbar-->
     <?php include("navbar.php");?>
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
                    <th>Pick-up Location</th>
                    <th>Drop-off Location</th>
                    <th>Number Going</th>
                </tr>
            </thead>
			
<?php
                //display list of elements grouped by day, with list section headings showing the days
                //TODO: give user option to select date range, possibly change how trips are sorted
                //TODO: link to some kind of details page for each trip where they can view more information
				
                $query = $mysqli->prepare("select depart_time, arrive_time, return_time, pick_up_location, drop_off_location, number_going, id
                                          from trips
                                          where depart_time >= now()
                                          order by depart_time asc");
                if (!$query){
                    error_log("Could not prepare trips query");
                    exit;
                }
                $query->execute();
                $query->bind_result($depart_date, $arrive_date, $return_date, $pick_up_location, $drop_off_location, $number_going, $id);
                
                //grabs the info of trip from query 
                while($query->fetch()){
                    $datetime = new DateTime($depart_date);
                    $day = $datetime->format("m/d/y");
                    $time = $datetime->format("h:i");
					
					$new_entry = "            <tr><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><input type='hidden' name='id' value='%d'>";
					$new_entry .= '<td><button type="submit" class="waves-effect waves-light btn join-button" id="'.$id.'">Join</button></td></tr>';
					$new_entry .= "\n";

					
					//need way to check if user is already in this trip
					//if they are, display a disabled "Going" button instead
					if(isset($_SESSION['trip_joined'])){ 
					    unset($_SESSION['trip_joined']);
					} else {
					    printf($new_entry, $day, $time, $pick_up_location, $drop_off_location, $number_going, $id);
					}
                }
            ?>
			
			
        </table>
		</div>
		
		<!--Finish Materialize setup-->
        <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
        <script type="text/javascript" src="js/materialize.min.js"></script>
        <!--Set document ready function so mobile navbar button works:-->
      <script>
        $( document ).ready(function() {
            $(".button-collapse").sideNav();
            $('.modal-trigger').leanModal();
			$('.join-button').click(function(){
				//notify the database of the change and remove the row from the table
				var tripId = $(this).closest("tr").children("input[name=id]")[0].value;
				var ajaxData = {
					url: "join_trip.php",
					type: "POST",
					dataType:"json",
					data:{id:tripId},
					success: function(data){
						if (data.success) {
							console.log("success");
						    $( this ).closest("tr").remove();
						}
						else{
							console.log(data.message);
						}
					},
					error:function(jqxhr, textStatus, errorThrown){
						console.log(textStatus, errorThrown);
					}
				}
				$.ajax(ajaxData);
			});
        });
	  </script>
    </body>
</html>
