<?php
//Filename: trip_calendar.php
//Author: Sam Teeter, Joey Woodson
//Content: page to display all public trips
    require("database.php");
    session_start();
    login_check();
    date_default_timezone_set("UTC");
    
    //display upcoming trip events in a sectioned list
    //TODO: create search bar where they can narrow results by date, location
?>

<!DOCTYPE html>
<html>
    <head>
		
        <title>About</title>
		
		<link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
		<!--Import materialize.css-->
		<link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
		<!--jQuery Link-->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.10.2/jquery.js"></script>


		<!--Let browser know website is optimized for mobile-->
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
		

		
    </head>
    <body>
	
		<header>
			<!--Navbar-->
			<?php include("navbar.php");?>
			  <ul class="side-nav fixed" style='transform: translateX(0%);'>
				<li><a style="display:block" onclick="changePage('about')">About</a></li>
				<li><a style="display:block" onclick="changePage('howto')">How to Use</a></li>
			  </ul>
			  <a href="#" data-activates="slide-out" class="button-collapse"><i class="mdi-navigation-menu"></i></a>
		</header>
        
		<div style="padding-left: 240px">
			<div>
			<ul class="collapsible" data-collapsible="expandable" id="questions">
				
			</ul>
			</div>
        </div>

		<div id="replacements" style="display:none">
			<ul id="about">
				<li>
				  <div class="collapsible-header">What is WashU Ride Share?</div>
				  <div class="collapsible-body"><p>WashU Ride Share is a free ride-sharing service for Washington University in St. Louis students. Our goal is to connect students with each other through their common need to get somewhere.</p></div>
				</li>
				<li>
				  <div class="collapsible-header">Why should I use WashU Ride Share?</div>
				  <div class="collapsible-body"><p>By keeping rides between students, we believe we're creating a friendlier, safer environemnt versus other ride sharing services that look for drivers outside of the WashU community.</p></div>
				</li>
				<li>
				  <div class="collapsible-header">Is it free?</div>
				  <div class="collapsible-body"><p>We do not ask drivers to set prices, but we also don't require that they offer rides for free. Whether a driver decides to ask for payment is up to them and their passengers.</p></div>
				</li>
			</ul>
			
			<ul id="howto">
				<li>
				  <div class="collapsible-header">What does Ride Calendar do?</div>
				  <div class="collapsible-body"><p>Ride Calendar displays all upcoming trips.</p></div>
				</li>
				<li>
				  <div class="collapsible-header">How do I offer/request a ride?</div>
				  <div class="collapsible-body"><p>Go to your My Rides page and click the "Post a new ride" button below your list of upcoming trips. While filling out your ride details, you have the option of inputting your car information if you plan on driving.</p></div>
				</li>
				<li>
				  <div class="collapsible-header">I posted a ride but I don't have a car. What now?</div>
				  <div class="collapsible-body"><p>If someone with a car sees your ride in the calendar, they can join and designate themselves as the driver. If your ride doesn't get a driver in time, you and other passengers will be notified the day before.</p></div>
				</li>
			</ul>
		</div>

		<!--Finish Materialize setup-->
        <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
        <script type="text/javascript" src="js/materialize.min.js"></script>
        <!--Set document ready function so mobile navbar button works:-->

		<script>		
        $( document ).ready(function() {
            $(".button-collapse").sideNav();
            $('.modal-trigger').leanModal();
			changePage('about');
        });


		function changePage(str) {
			document.getElementById('questions').innerHTML = document.getElementById(str).innerHTML ;
		}
	  </script>
    </body>
</html>
