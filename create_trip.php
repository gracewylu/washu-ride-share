<!doctype html>
<head>
	 <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>

    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>

<script>
	// document.addEventListener('DOMContentLoaded', function() {
 //    	document.getElementById("date").value = new Date();
	// }, false);
</script>

<body>

<?php
    require('database.php');
    session_start();
    include('navbar.php');
	login_check();
	
	$username = trim($_SESSION['username']);
?>
  <div class='container'>
	<div class="row" style="padding-top: 30px;">
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
				<select name="start_time" id="start_time">
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
				<label for="start_time">Start time</label>
			</div>
		  </div>

			
		  <div class="row">
			<div class="input-field col s6">
				<select name="end_time" id="end_time">
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
				<label for="end_time">End time</label>
			</div>
		  </div>

		  <div class="row">
			<div class="input-field col s6">
				<select name="return_time" id="return_time">
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
				<label for="return_time">Return time (optional)</label>
			</div>
		  </div>
		<div class="row">
        <div class="col s12 m6">
          <div class="card blue-grey darken-1">
            <div class="card-content white-text">
              <span class="card-title">Car I'm driving (optional)</span>
				<div class="row">
			  		<div class="input-field col s6">
			  			<input id="seats" name="seats" type="text">
			  			<label for="seats">Seats</label>
					</div>
				</div>
				<div class="row">
					<div class="input-field col s6">
			  			<input id="model" name="model" type="text">
			  			<label for="model">Model</label>
					</div>
				</div>
				<div class="row">
					<div class="input-field col s6">
			  			<input id="color" name="color" type="text">
			  			<label for="color">Color</label>
					</div>
				</div>
		  		</div>             
            </div>
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
        	//sets current date as placeholder 
        	$('#date').attr("placeholder", Date());
            $(".button-collapse").sideNav();
            $('.modal-trigger').leanModal();
        });
		
		//Set up for datepickers
		$('.datepicker').pickadate({
			selectMonths: true, // Creates a dropdown to control month

		  });
		
		//setup for materialize select
		$('select').material_select();
		
		//query database in real time for matching trips
		var search_params = {depart_time:"", arrive_time:"", pick_up_location:"", drop_off_location:""};
		function search(params){
			$.ajax({
				method:"POST",
				url:"new_trip_search.php",
				data:{params},
				success:function(data){
					if (data.success) {
						//display search results
						console.log("success");
					}
					else{
						console.log(data.message);
					}
				},
				error: function (xhr, ajaxOptions, thrownError) {
					console.log(xhr.status);
					console.log(thrownError);
				}
			});
		}
		
		
	  </script>

</html>













