<!doctype html>
<?php
//Filename: trip_calendar.php
//Author: Sam Teeter, Joey Woodson
//Content: page to display all public trips
    require("database.php");
    session_start();
    date_default_timezone_set("UTC");
    include('navbar.php');
    //display upcoming trip events in a sectioned list
?>
<head>
<title>About</title>
	<link href="text/css" rel="stylesheet" href="css/about.css">

	<!--Import materialize.css-->
	<link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
	<link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

	<!--jQuery Link-->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.10.2/jquery.js"></script>
	<script type="text/javascript" src="js/materialize.js"></script>
	<script type="text/javascript" src="js/materialize.min.js"></script>
	<!--Let browser know website is optimized for mobile-->
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>
<main>
	<div class="section white">
		<div class="container">
                <br><br>
                <h1 class="header center teal-text text-darken-4 center">Washington University Ride Share</h1>
                <div class="row center">
                    <h5 class="header col s12 teal-text text-darken-3">Go on a journey with new friends</h5>
                </div>
        </div>
	</div>
    <div style="width: 100%;" class="parallax-container">
    	<div class="parallax"><img src="img/car_pic.jpg"></div>
    </div>
    <div class="section cyan lighten-5">
    	<div class="row">
        <div class="col s12 m8 l10 offset-m2 offset-l1 center">
          <h3 class="center teal-text text-darken-4">About Us</h3>
            <ul class="collapsible" data-collapsible="accordion">
              <li>
                <div class='collapsible-header cyan lighten-5'>
                  <h5 class="center teal-text text-darken-4">What is WURS?</h5>
                </div>
                <div class='collapsible-body'>
				<p class="center teal-text text-darken-4">WashU Ride Share is a project that originated from Washington University's CSE 437S Software Engineering class, where a team of 5 computer science students work together on a project for a semester. We decided to implement a free ride-sharing service for Washington University in St. Louis students. Our goal is to connect students with similar interests and needs who are looking to go places and attend events together. We aim to encourage a stronger community amongst all Washington University students through this project.</p>
              	</div>
              </li>
              <li>
                <div class='collapsible-header cyan lighten-5'>
                  <h5 class="center teal-text text-darken-4">Why should I use WURS?</h5>
                </div>
                <div class='collapsible-body'>
					<p class="center teal-text text-darken-4">By keeping rides between students, we believe we're creating a friendlier, safer environment versus other ride sharing services that look for drivers outside of the WashU community. We think that this is a great way for those who are willing to drive others to interact with others who are in the same clubs, have similar interests, or just want to hang out with new people.</p>
				</div>                
              </li>
              <li>
                <div class='collapsible-header cyan lighten-5'>
                  <h5 class="center teal-text text-darken-4">Is it Free?</h5>
                </div>
                <div class='collapsible-body'>
					<p class="center teal-text text-darken-4">We do not ask drivers to set prices, but we also don't require that they offer rides for free. Whether a driver decides to ask for payment is up to them and their passengers.</p>
				</div>
              </li>
            </ul>
        </div>
    </div>
    </div>
    <div class="section cyan darken-4">
    	<h3 class="center grey-text text-lighten-5">How to use WURS</h3>
    	<div class="row">
    		<div class="col l4">
    			<h5 class="grey-text text-lighten-5">Elements of WURS</h5>
    			<div class="divider"></div>
    			<p class="grey-text text-lighten-5">All Rides displays all upcoming trips that you're not a part of.</p>
    		</div>
    		<div class="col l4">
    			<h5 class="grey-text text-lighten-5">How do I offer/request a ride?</h5>
    			<div class="divider"></div>
    			<p class="grey-text text-lighten-5">Go to your My Rides page and click the "Post a new ride" button below your list of upcoming trips. While filling out your ride details, you have the option of inputting your car information if you plan on driving.</p>
    		</div>
    		<div class="col l4">
    			<h5 class="grey-text text-lighten-5">I posted a ride but I don't have a car. What now?</h5>
    			<div class="divider"></div>
    			<p class="grey-text text-lighten-5">If someone with a car sees your ride in the calendar, they can join and designate themselves as the driver. If your ride doesn't get a driver in time, you and other passengers will be notified the day before.</p>
    		</div>
    	</div>
    </div>
<script type="text/javascript">
$(document).ready(function(){
    // Following initializes parallax, an effect where the background moves slower than the foreground
    $('.parallax').parallax();

});
</script>
</main>
</html>
