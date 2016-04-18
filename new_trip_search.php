<?php

//configure page to send json data
	header("Content-Type: application/json");

	require('database.php');
	session_start();
			
	//customize database query based on which params are set
    $param_names = array("depart_time", "arrive_time", "pick_up_location", "drop_off_location");
    //prioritize results with greatest similarity in pick up, drop off location
    $sql = "select * from trips where depart_time >= now";
    if (!empty($_POST['pick_up_location']) || !empty($_POST['drop_off_location'])){
        $sql = "select *, count(if(match(pick_up_location, drop_off_location) against ('%s %s'))), from trips where depart_time >= now";
    }
    foreach ($param in $param_names){
        if(!empty($_POST[$param]){
            switch($param){
                case "depart_time":
                case "arrive_time":
                    $upper_date = new DateTime($_POST[$param]);
                    $lower_date = clone $upper_date;
                    $upper_date->add(new DateInterval("PT1H"));
                    $lower_date->sub(new DateInterval("PT1H"));
                    $upper_date_str = date("Y-m-d H:i:s", $upper_date);
                    $lower_date_str = date("Y-m-d H:i:s", $lower_date);
                    $sql .= sprintf(" and %s between '%s' and '%s'", $param, $lower_date_str, $upper_date_str);
                    break;
            }
        }
    }
    
?>