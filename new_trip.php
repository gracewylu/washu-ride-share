<?php
    //Filename: new_trip.php
    //Author: Sam Teeter
    //Content: script to save new trip objects
    
    require('database.php');
    session_start();
    login_check();
    
    $pick_up_location = $_POST['pick_up_location'];
    $drop_off_location = $_POST['drop_off_location'];
    $driver_username = $_POST['username'];
    $car_id = $_POST['car_id'];
    $date = $_POST['date'];
    $seats_available = $POST['seats_available'];
    
    $insert_query = $mysqli->prepare("insert into trips (pick_up_location, drop_off_location, driver_username, car_id, date, seats_available) values (?, ?, ?, ?, ?, ?)");
    if (!$insert_query){
        error_log("Failed to prepare database query", 0);
    }
    $insert_query->bind_param("sssisi", $pick_up_location, $drop_off_location, $driver_username, $car_id, $date, $seats_available);
    $insert_query->execute();
    $insert_query->close();
    
    //go back to calling page
?>