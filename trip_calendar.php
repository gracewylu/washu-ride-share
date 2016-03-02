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
        <title>Ride Calendar</title>
        <!--Materialize setup-->
      <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
      
      <!--Navbar-->
      <?php include("navbar.php");?>
      
      <script>
        $( document ).ready(function() {
            $(".button-collapse").sideNav();
        });
      </script>
    </head>
    <body>
        <div class='container'>
        <h1>Upcoming Rides</h1>
        <table style='width:100%'>
            <thead>
                <tr class='table-h1'>
                    <th>Date:</th>
                    <th>Time:</th>
                    <th>Pick up:</th>
                    <th>Drop off:</th>
                    <th>Driver:</th>
                </tr>
            </thead>
            <?php
                //display upcoming trips
                //TODO: consider switching table to materialize collapsible
                //TODO: give user option to select date range, possibly change how trips are sorted
                //TODO: link to some kind of details page for each trip where they can view more information
                //TODO: button to let them join the trip
                $query = $mysqli->prepare("select date, pick_up_location, drop_off_location, driver_username
                                          from trips
                                          where date between now() and now()+interval 7 day
                                          order by date asc");
                if (!$query){
                    error_log("Could not prepare trips query");
                    exit;
                }
                $query->execute();
                $query->bind_result($date, $pick_up_location, $drop_off_location, $driver_username);
                
                while($query->fetch()){
                    $datetime = new DateTime($date);
                    $day = $datetime->format("m/d/y");
                    $time = $datetime->format("h:i");
                    printf("<tr><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td></tr>\n", $day, $time, $pick_up_location, $drop_off_location, $driver_username);
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
        });
      </script>
    </body>
</html>