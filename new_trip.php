<?php
    //Filename: new_trip.php
    //Author: Sam Teeter
    //Content: script to save new trip objects
    
    require('database.php');
    session_start();
    
    date_default_timezone_set('America/Chicago');


    $date = $_POST['date'];    
    $pick_up_location = $_POST['pick_up_location'];
    $start_time = $_POST['start_time'];
    $drop_off_location = $_POST['drop_off_location'];
    $end_time = $_POST['end_time'];
    $return_time = $_POST['return_time'];
    $driver = $_SESSION['username'];

    $seats = $_POST['seats'];
    $model=$_POST['model'];
    $color=$_POST['color'];
    
    $month = substr($date, 0,2);
    $day = substr($date, 3,2);
    $year = substr($date, 6, 4);
    
    $date = $year."-".$month."-".$day;

    $depart_time = $date." ".$start_time.":00"; 
    $arrive_time = $date." ".$end_time.":00";

    $number_going = 1; //when you create a trip naturally you will be going and those who join will be appended to this value later 

    $trip_query = $mysqli->prepare("insert into trips (pick_up_location, drop_off_location, number_going, depart_time, arrive_time, return_time) values (?, ?, ?, ?, ?,?);");
    if (!$trip_query){
        error_log("Failed to prepare new trip query");
        echo "Failed to prepare new trip query";
    }
    
    $trip_query->bind_param("ssisss", $pick_up_location, $drop_off_location, $number_going, $depart_time, $arrive_time, $return_time);
    $trip_query->execute();
    $last_id = $trip_query->insert_id; 

    $trip_query->close();

    if($model != null && $seats != null && $color != null){
        $car_query = $mysqli->prepare("insert into cars(model, total_seats, trip_id, color, driver) values (?, ?, ?, ?, ?);");
        if(!$car_query){
            echo "Failed to prepare a car query";
        }
        $car_query->bind_param("siiss", $model, $seats, $last_id, $color, $driver);
        $car_query->execute(); 
    }
    $last_car_id=$car_query->insert_id; 
    $car_query->close();

    $trip_to_user = $mysqli->prepare("insert into trips2users(trip_id, username, driving, car_id, is_owner) values (?, ?, ?, ?, ?);");
    if(!$trip_to_user){
        echo "Failed to prepare trip to user query";
    }    
    //$booleanvar?1:0; 
    $true = 1; 
    $false = 0; 
    
    //echo "<br>".$last_id."<br>".$driver."<br>".$last_car_id;
    $trip_to_user->bind_param("isiii", $last_id, $driver, $true, $last_car_id, $true);
    $trip_to_user->execute();
    $trip_to_user->close();

    //go back to calling page
    //header("Location: home.php");
?>