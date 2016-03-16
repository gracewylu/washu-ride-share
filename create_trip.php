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
    include('navbar.php');
?>

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
			  <input id="pick_up_location" name="pick_up_location" type="text" class="validate"/>
			  <label for="pick_up_location">Pick-up Spot</label>
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
				<option value="1">Car 1</option>
				<option value="2">Car 2</option>
			  </select>
			  <label for="car">Car</label>
			</div>
		  </div>
		  <div class="row">
			  <div class="input-field col s6">
			  <input id="seats_available" name="seats_available" type="text" class="validate" value="1" min="1" max="5">
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
	</div>

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
	  </script>

</html>