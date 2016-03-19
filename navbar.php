<?php
//Filename: navbar.php
//Author: Sam Teeter
//Content: navigation bar for all pages

//Pages that use this will need to have the materialize environment set up

echo<<<HTML
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

<!--Import materialize.css-->
<link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>

<!--Let browser know website is optimized for mobile-->
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>

<!--Setup jquery ui-->
<script src="//code.jquery.com/jquery-1.10.2.js"></script>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>

<style>
nav ul li a{
    color:#424242
}
</style>
<nav>
    <div class='nav-wrapper teal lighten-4 black-text'>
        <a href='trip_calendar.php' class='brand-logo grey-text text-darken-3'>&nbsp;Get a Ride</a>
        <a href='#' data-activates='sidebar' class='button-collapse'><i class='material-icons'>menu</i></a>
        <ul id='nav-mobile' class='right hide-on-med-and-down'>
            <li><a href='home.php'>My Rides</a></li>
            <li><a href='trip_calendar.php'>Ride Calendar</a></li>
			<li><a href='logout.php'>Logout</a></li>
            <li><a href="#" id="chat-button" class="white-text"><i class='material-icons'>chat_bubble_outline</i></a></li>
        </ul>
        <ul class='side-nav' id='sidebar'>
            <li><a href='home.php'>My Rides</a></li>
            <li><a href='trip_calendar.php'>Ride Calendar</a></li>
			<li><a href='logout.php'>Logout</a></li>
        </ul>
    </div>
</nav>

<!--Finish Materialize setup-->
        <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
        <script type="text/javascript" src="js/materialize.min.js"></script>

<script>
    $( document ).ready(function() {
        $(".button-collapse").sideNav();
    });
</script>

HTML;
?>