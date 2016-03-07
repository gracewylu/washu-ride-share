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
<<<<<<< HEAD
        <title>Get a lift</title>
        <link rel="stylesheet" type="text/css" href="/css/basic-style.css"/>
=======
        <title>Get A Ride</title>
        <!--Materialize setup-->
      <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
      
      <!--Navbar-->
      <?php include("navbar.php");?>
>>>>>>> 96c2e8d601b4a037e8fdf1f6bf52bcceee91de71
    </head>
    <body>
        <h1>Your rides:</h1><br>
            <table style='width:90%'>
                <tr>
                    <th><b>Date</b></th>
                    <th><b>Time</b></th>
                    <th><b>Pick up at:</b></th>
                    <th><b>Drop off at:</b></th>
                    <th><b>Driver</b></th>
                </tr>
        <?php
            $username = $_SESSION['username'];
            
            //fetch trips the user is part of
            $trip_request = $mysqli->prepare("select date, pick_up_location, drop_off_location, driver_username
                                             from trips join trips2users on trips.id = trips2users.trip_id
                                             where trips2users.username = ?");
            if (!$trip_request){
                error_log("Could not prepare trip request.");
                exit;
            }
            $trip_request->bind_param("s", $username);
            $trip_request->execute();
            $trip_request->bind_result($date, $pick_up_location, $drop_off_location, $driver_username);
            
            //print out trip data in table
            while($trip_request->fetch()){
                $datetime = new DateTime($date);
                $day = $datetime->format("m/d/y");
                $time = $datetime->format("h:i");
                printf("<tr><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td></tr>",
                       $day, $time, $pick_up_location, $drop_off_location, $driver_username);
            }
        ?>
            </table><br>
            <a href='http://54.213.111.166/~cse437/create_event.html'>Post a new trip</a>
        
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