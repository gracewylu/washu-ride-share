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
    </head>
    <body>
        <h1>Upcoming Trips</h1>
        <table style='width:100%'>
            <tr class='table-h1'>
                <th>Date:</th>
                <th>Time:</th>
                <th>Pick up:</th>
                <th>Drop off:</th>
                <th>Driver:</th>
            </tr>
            <?php
                //display list of elements grouped by day, with list section headings showing the days
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
                
                $section_day = date("m/d/y", strtotime("yesterday")); //set this to yesterday so the first date will be greater
                while($query->fetch()){
                    $datetime = new DateTime($date);
                    $day = $datetime->format("m/d/y");
                    $time = $datetime->format("h:i");
                    if($day != $section_day){
                        printf("<tr class='table-h2'><th colspan='5'>%s</th></tr>\n", $datetime->format('l, F d, Y'));
                        $section_day = $day;
                    }
                    printf("<tr><td>%s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td></tr>\n", $day, $time, $pick_up_location, $drop_off_location, $driver_username);
                }
            ?>
        </table>
    </body>
</html>