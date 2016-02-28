<!doctype html>
<?php
//Filename: home.php
//Author: Sam Teeter
//Content: the user's homepage, presented after login
    require("database.php");
    session_start();
        
    //login check
    if(!isset($_SESSION['username'])){
        //echo $_SERVER['SERVER_NAME']; 
        header("Location:http://".$_SERVER['SERVER_NAME']."/~cse437/HTML/login.html");
    }
?>
<html>
    <head>
        <title>Get a lift</title>
    </head>
    <body>
        <h1>Your trips:</h1><br>;
            <table style='width:90%'>
                <tr>
                    <td><b>Date</b></td>
                    <td><b>Time</b></td>
                    <td><b>Pick up at:</b></td>
                    <td><b>Drop off at:</b></td>
                    <td><b>Driver</b></td>
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
            </table>
    </body>
</html>