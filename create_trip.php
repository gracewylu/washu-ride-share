<!doctype html>
<head>
	 <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>

    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>

<body>

<?php
    require('database.php');
    session_start();
    include('navbar.php');
	login_check();
	
	$username = trim($_SESSION['username']);
?>
<script type="text/javascript">

</script>
  <!--<div class='container'>-->
	<div class="row" style="padding-top: 30px;">
		<form class="col s12 l6 offset-l1" action="new_trip.php" method="POST">
			<div class="row">
				<div class="input-field col s6 l9">
			  		<input type="date" class="datepicker" id="date" name="date" required>
			  		<label for="date">Date</label>
				</div>
		  	</div>	
		  	<div class="row">
			  	<div class="input-field col s6 l9">
			  		<input id="pick_up_location" name="pick_up_location" type="text" class="validate required" required/>
			  		<label for="pick_up_location">Pick-up Location</label>
				</div>
		  	</div>
		  <div class="row">
			<div class="input-field col s6 l9">
				<select class="validate required" name="start_time" id="start_time" required>
					<option value="" selected></option>
					<option value="00:00">12:00 AM</option>
					<?php 
					for($h=1; $h<12; $h++){
						for ($m=0.0; $m<60; $m+=15){
							printf("<option value=%02d:%02d>%d:%02d AM </option>/n", $h, $m, $h, $m);
						}
					}
					?>
					<option value="12" name="12:00">12:00 PM</option>
					<?php 
					for($h=13; $h<24; $h++){
						for ($m=0.0; $m<60; $m+=15){
							printf("<option value=%02d:%02d>%d:%02d PM </option>/n", $h, $m, $h-12, $m);
						}
					}
					?>
				</select>
				<label for="start_time">Start time</label>
			</div>
		  </div>
			
		<div class="row">
			<div class="input-field col s6 l9">
			  <input id="drop_off_location" name="drop_off_location" type="text" class="validate required" required>
			  <label for="drop_off_location">Drop-off Location</label>
			</div>
		</div>
		 <div class="row">
			<div class="input-field col s6 l9">
				<select class=" validate required" name="end_time" id="end_time" required>
					<option value="" selected></option>
					<option value="00:00">12:00 AM</option>
					<?php 
					for($h=1; $h<12; $h++){
						for ($m=0.0; $m<60; $m+=15){
							printf("<option value=%02d:%02d>%d:%02d AM </option>/n", $h, $m, $h, $m);
						}
					}
					?>
					<option value="12:00">12:00 PM</option>
					<?php 
					for($h=13; $h<24; $h++){
						for ($m=0.0; $m<60; $m+=15){
							printf("<option value=%02d:%02d>%d:%02d PM </option>/n", $h, $m, $h-12, $m);
						}
					}
					?>
				</select>
				<label for="end_time">Arrival time</label>
			</div>
		  </div>
		<div class="row">
			<div class="input-field col s6 l9">
				<select name="return_time" id="return_time">
					<option value="" selected></option>
					<option value="00:00">12:00 AM</option>
					<?php 
					for($h=1; $h<12; $h++){
						for ($m=0.0; $m<60; $m+=15){
							printf("<option value=%02d:%02d>%d:%02d AM </option>/n", $h, $m, $h, $m);
						}
					}
					?>
					<option value="12" name="12:00">12:00 PM</option>
					<?php 
					for($h=13; $h<24; $h++){
						for ($m=0.0; $m<60; $m+=15){
							printf("<option value=%02d:%02d>%d:%02d PM </option>/n", $h, $m, $h-12, $m);
						}
					}
					?>
				</select>
				<label for="return_time">Return time</label>
			</div>
		  </div>
	
		 <div class="row">
        	<div class="col s12 m6 l9">
          		<div class="card blue-grey darken-1">
            		<div class="card-content white-text">
              			<span class="card-title">Car I'm driving (Required for drivers)</span>
						<div class="row">
			  				<div class="input-field col s6 l9">
			  					<input id="seats" name="seats" type="text">
			  					<label for="seats">Seats</label>
							</div>
						</div>
						<div class="row">
							<div class="input-field col s6 l9">
			  					<input id="model" name="model" type="text">
			  					<label for="model">Model</label>
							</div>
						</div>
						<div class="row">
							<div class="input-field col s6 l9">
			  					<input id="color" name="color" type="text">
			  					<label for="color">Color</label>
							</div>
						</div>
		  			</div>             
            	</div>
          	</div>
        </div> 
      <!-- </div> -->   
		<input type="hidden" name="username" value="%d">
		<input type="submit" value="Submit" class="btn waves-effect waves-light custom-button blue-background">
			 
	  </form>
	  <div class="col l5">
	  	<p><b>Suggested Events</b></p>
	  	<table id="suggested_trips" style='width:90%'>
                <tr>
                    <th><b>Date</b></th>
                    <th><b>Time</b></th>
                    <th><b>Pick up Location</b></th>
                    <th><b>Drop off Location</b></th>
                    <th></th>
                </tr>
        </table>
	  </div>
	</div><!--End row-->
	
  <!--</div>-->
</body>

        <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
        <script type="text/javascript" src="js/materialize.min.js"></script>
        
      <script> 
      	var loaded_pickup = false; 

      	var loaded_dropoff = false;

      	//continuous ajax request to run to show suggested events 
		function find_suggested_events(){
			var $pick_up_location = document.getElementById('pick_up_location').value;
			var $drop_off_location = document.getElementById('drop_off_location').value;
 			
 			 $.ajax({
				type:'POST',
				url: 'get_info.php',
				dataType: 'json', 
				data: {
					pick_up_location: $pick_up_location,
					drop_off_location: $drop_off_location 
				},
				success: function(trips){
					//list the similar event in the suggested events column
					$.each(trips, function(index, trip){
						var depart_day=trip.depart_time.substr(5,2) + "/" + trip.depart_time.substr(8,2) + "/" + trip.depart_time.substr(0,4);
						var hour=parseInt(trip.depart_time.substr(11,2));
						if(hour > 12) hour=hour-12; 
						var depart_time = hour + ":" + trip.depart_time.substr(14,2);
						$('#suggested_trips').append('<tr><td>'+depart_day+'</td><td>'+depart_time+'</td><td>'+trip.pick_up_location+'</td><td>'+trip.drop_off_location+'</td><td><button type="submit" class="waves-effect waves-light btn join-button" id="'+trip.id+'">Join</button></td></tr>');
					})
				}, 
				error:function(){
					alert("Issue with getting results from database");
				}
			});

		}

		//Set document ready function so mobile navbar button works
        $( document ).ready(function() {
        	//sets current date as placeholder 
        	$('#date').attr("placeholder", Date());
            $(".button-collapse").sideNav();
            $('.modal-trigger').leanModal();


            $('#start_time').change(function(){
            	//do ajax request 
            	if(loaded_pickup) return; 

            	find_suggested_events();

            	loaded_pickup = true; 
            });
            $('#end_time').change(function(){
            	if(loaded_dropoff) return;

            	find_suggested_events(); 

            	loaded_dropoff = true; 
            });
        });
		
		//Set up for datepickers
		$('.datepicker').pickadate({
			selectMonths: true, // Creates a dropdown to control month
			format: 'mm/dd/yyyy', 
			min: new Date()
		});
		
		//setup for materialize select
		$('select').material_select();

		$(document).on('click', '.join-button', function(event){
			var tripId = event.target.id;
			var ajaxData = {
				url: "join_trip.php",
				type: "POST",
				dataType:"json",
				data:{id:tripId},
				success: function(data){
					if (data.success) {
						$("#"+data.joined_trip_id+".join-button")
							.closest("tr")
							.children('td')
					        .animate({ padding: 0 })
					        .wrapInner('<div />')
					        .children()
					        .slideUp(function() { $(this).closest('tr').remove()});
					        setTimeout(function(){
					        	window.location.replace("home.php");
					        }, 1500);
						}
						else{
							console.log(data.message);
						}
					},
					error:function(jqxhr, textStatus, errorThrown){
						console.log(textStatus, errorThrown);
					}
				}
				$.ajax(ajaxData);
		});


		// var required = 0; 
		// $('.required').keypress(function(event){
		// 	required += 1; 
		// 	alert(required);
		// });

		// picker.on('open', function(){
		// 	required += 1; 
		// });
		// picker.trigger('open');

	  </script>

</html>