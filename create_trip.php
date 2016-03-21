<!doctype html>
<head>
	 <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>

    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>

<script>
document.addEventListener('DOMContentLoaded', function() {
    document.getElementById("date").valueAsDate = new Date();
}, false);
</script>

<body>

<?php
    require('database.php');
    session_start();
    login_check();
    include('navbar.php');
	
	$username = trim($_SESSION['username']);
	
	//check if user has car
	$cars;
	$query = $mysqli->prepare("select car_id, make, year from cars where owner='".$username."';");
	if(!$query){
		exit;
	}
	$query->execute();
	
	$result = $query->get_result();
	$i=0;
	while($row=$result->fetch_assoc()){
		$cars[$i]["name"] = $row["year"]." ".$row["make"];
		$cars[$i]["id"] = $row["car_id"];
	}
?>
  <div class='container'>
	<div class="row">
		<form class="col s12" action="new_trip.php" method="POST">
		  <div class="row">
			  <div class="input-field col s6">
			  <input type="date" class="datepicker" id="date" name="date">
			  <label for="date">Date</label>
			</div>
		  </div>
		  
		  <div class="row">
			<div class="input-field col s6">
				<select name="time" id="time">
					<option value="0">12:00 AM</option>
					<?php for($h=1; $h<12; $h++){
						for ($m=0.0; $m<60; $m+=15){
							printf("<option value=%d>%d:%02d AM </option>/n", $h+$m/60.0, $h, $m);
						}
					}?>
					<option value="12" selected>12:00 PM</option>
					<?php for($h=13; $h<24; $h++){
						for ($m=0.0; $m<60; $m+=15){
							printf("<option value=%d>%d:%02d PM </option>/n", $h+$m/60.0, $h-12, $m);
						}
					}?>
				</select>
				<label>Time</label>
			</div>
		</div>
		  
		  <div class="row">
			  <div class="input-field col s6">
			  <input id="pick_up_location" name="pick_up_location" type="text" class="validate"/>
			  <label for="pick_up_location">Pick-up Location</label>
			</div>
		  </div>
		  <div class="row">
			  <div class="input-field col s6">
			  <input id="drop_off_location" name="drop_off_location" type="text" class="validate">
			  <label for="drop_off_location">Drop-off Location</label>
			</div>
		  </div>
		 
		  <div class="row">
			<div class="input-field col s6">
				<select>
					<option value="">Select a car</option>
					<?php foreach ($cars as $car){
						echo "<option value='".htmlentities($car["id"])."'>".htmlentities($car["name"])."</option>";
					}?>	
				</select>
				<label>Car</label>
			</div>
		  </div>
		  
		  <div class="row">
			  <div class="input-field col s6">
			  <input id="seats_available" name="seats_available" type="number" class="validate" value="1" min="1" max="5">
			  <label for="seats_available">Available Seats</label>
			</div>
		  </div>
	   
		<input type="hidden" name="username" value="%d">
	   
		  <div class="row"> 
			  <div class="col l4">
				<input type="submit" value="Submit" class="btn waves-effect waves-light custom-button blue-background">
			  </div>
		  </div>
	  </form>
	</div><!--End row-->
	
  </div><!--End container-->
</body>

<!--Finish Materialize setup-->
        <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
        <script type="text/javascript" src="js/materialize.min.js"></script>
        
      <script>
		//Set document ready function so mobile navbar button works
        $( document ).ready(function() {
            $(".button-collapse").sideNav();
            $('.modal-trigger').leanModal();
        });
		
		//Set up for datepickers
		$('.datepicker').pickadate({
			selectMonths: true, // Creates a dropdown to control month
		  });
		
		//setup for materialize select
		$('select').material_select();
	  </script>

</html>