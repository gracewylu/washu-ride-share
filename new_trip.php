<?php
    //Filename: new_trip.php
    //Author: Sam Teeter
    //Content: script to save new trip objects
    
    require('database.php');
    session_start();
    
    $pick_up_location = $_POST['pick_up_location'];
    $drop_off_location = $_POST['drop_off_location'];
    $driver_username = $_SESSION['username'];
    $date = $_POST['date'];
    $seats_available = $_POST['seats_available'];
    
    $insert_query = $mysqli->prepare("insert into trips (pick_up_location, drop_off_location, driver_username, date, seats_available)
                                     values (?, ?, ?, ?, ?);");
    $insert_trip_query = $mysqli->prepare("insert into trips2users (trip_id, username)
                                     values (LAST_INSERT_ID(),?);");
    if (!$insert_query){
        error_log("Failed to prepare new trip query");
    }
    if(!$insert_trip_query){
        error_log("Failed to prepare new trip query");
    }
    $insert_query->bind_param("ssssi", $pick_up_location, $drop_off_location, $driver_username, $date, $seats_available);
    $insert_trip_query->bind_param("s", $driver_username);
    $insert_query->execute();
    $insert_trip_query->execute();
    $insert_trip_query->close();
    $insert_query->close();
    
    
    
    //go back to calling page
    header("Location: home.php");
?>