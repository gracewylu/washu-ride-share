<!doctype html>
<?php

//Filename: search.php
//Authors: Joey Woodson
//Content: Search bar

	require('database.php');
	session_start();
	include('navbar.php');

	$search = $_GET['q'];
	//this isn't correct need to fix this so that it can search through the entire database not just for similar pick_up_location 
	$query = $mysqli->prepare("SELECT pick_up_location, drop_off_location, number_going, depart_time, arrive_time, return_time FROM trips WHERE pick_up_location LIKE ?");
	
	if(!$query) {
	    echo $mysqli->error;
	    exit;
	}
	
	$search = "%".$search."%";
	$query->bind_param("s", $search);
	$query->execute();
	// if($query->num_rows==0){
	// 	echo "<h3 class=\"center\">Sorry there aren't any matching results</h3>";
	// }
		$query->bind_result($pul,$dol,$ng,$dt,$at,$rt);
		while($query->fetch()) {
	    	echo $pul."\t".$dol."\t".$ng."\t".$dt."\t".$at."\t".$rt."\n";
		}
		$query->close();
?>
<head>
		<link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
		<!--Import materialize.css-->
		<link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
		<!--jQuery Link-->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.10.2/jquery.js"></script>


		<!--Let browser know website is optimized for mobile-->
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>
<body>
<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
<script type="text/javascript" src="js/materialize.min.js"></script>
</body>
</html>