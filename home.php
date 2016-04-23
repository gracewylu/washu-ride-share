<!doctype html>
<?php
//Filename: home.php
//Author: Sam Teeter
//Content: the user's homepage, presented after login
    require("database.php");
    session_start();
    login_check();
    date_default_timezone_set("UTC");
?>
<html>
    <head>
        <title>Get A Ride</title>
        <!--Materialize setup-->
      <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
      
      <!--Navbar-->
      <?php include("navbar.php");?>
    </head>
    <body>
        <div class="container">
        <h1 class="blue-grey-text">Your rides:</h1><br>
            <table style='width:90%'>
                <tr>
                    <th><b>Date</b></th>
                    <th><b>Depart:</b></th>
                    <th><b>Arrive:</b></th>
                    <th><b>Pick up at:</b></th>
                    <th><b>Drop off at:</b></th>
                    <th><b>Number going:</b></th>
                </tr>
        <?php
            $username = $_SESSION['username'];
            //fetch trips the user is part of
            $trip_request = $mysqli->prepare("select id, depart_time, arrive_time, pick_up_location, drop_off_location, number_going, is_owner
                                             from trips join trips2users on trips.id = trips2users.trip_id
                                             where trips2users.username = ? and depart_time >= now()
                                             order by depart_time asc");
            if (!$trip_request){
                error_log($mysqli->error);
                exit;
            }
            $trip_request->bind_param("s", $username);
            $trip_request->execute();
            $trip_request->bind_result($trip_id, $depart_time, $arrive_time, $pick_up_location, $drop_off_location, $number_going, $is_owner);
            
            //print out trip data in table
            while($trip_request->fetch()){
                $depart_datetime = new DateTime($depart_time);
                $arrive_datetime = new DateTime($arrive_time);
                $depart_day = $depart_datetime->format("m/d/y");
                $depart_time = $depart_datetime->format("h:i");
                $arrive_time = $arrive_datetime->format("h:i");
                $leave_button = "<td><button type='submit' class='waves-effect waves-light btn leave-button' id='".$trip_id."'>Leave</button></td>";
                $cancel_button = "<td><button type='submit' class='waves-effect waves-light btn red darken-2 cancel-button' id='".$trip_id."'>Cancel Trip</button></td>";
                $button = $leave_button;
                if ($is_owner){
                    $button = $cancel_button;
                }
                printf("<tr><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td>%s</tr>",
                       $depart_day, $depart_time, $arrive_time, $pick_up_location, $drop_off_location, $number_going, $button);
            }
        ?>
            </table><br>
            <a href='http://54.213.111.166/~cse437/create_trip.php'>Post a new ride</a>
        </div>
        
        <!--Finish Materialize setup-->
        <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
        <script type="text/javascript" src="js/materialize.min.js"></script>
        <!--Set document ready function so mobile navbar button works:-->
      <script>
        $( document ).ready(function() {
            $(".button-collapse").sideNav();
            
            //notify server if leave button clicked
            $(".leave-button").click(function(event){
                //console.log("clicked leave");
                $.ajax({
                    url:"leave_trip.php",
                    type:"POST",
                    dataType:"json",
                    data:{trip_id:event.target.id},
                    success:function(data){
                        if (data.success) {
                            console.log("success");
						    $("#"+data.left_trip_id+".leave-button")
							.closest("tr")
							.children('td')
					        .animate({ padding: 0 })
					        .wrapInner('<div />')
					        .children()
					        .slideUp(function() { $(this).closest('tr').remove()});
						}
                        else{
                            console.log(data.message);
                        }
                    },
                    error:function(jqxhr, textStatus, errorThrown){
						console.log(textStatus, errorThrown);
					}
                });
            });
			
			//notify server from cancel button
			$(".cancel-button").click(function(event){
				$.ajax({
                    url:"cancel_trip.php",
                    type:"POST",
                    dataType:"json",
                    data:{trip_id:event.target.id},
                    success:function(data){
                        if (data.success) {
                            console.log("success");
						    $("#"+data.left_trip_id+".cancel-button")
							.closest("tr")
							.children('td')
					        .animate({ padding: 0 })
					        .wrapInner('<div />')
					        .children()
					        .slideUp(function() { $(this).closest('tr').remove()});
						}
                        else{
                            console.log(data.message);
                        }
                    },
                    error:function(jqxhr, textStatus, errorThrown){
						console.log(textStatus, errorThrown);
					}
                });
			});
        });
      </script>
    </body>
</html>