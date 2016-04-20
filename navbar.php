<?php
//Filename: navbar.php
//Author: Sam Teeter
//Content: navigation bar for all pages

//Pages that use this will need to have the materialize environment set up

echo<<<HTML
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
            <li><a href='trip_calendar.php'>Find a Ride</a></li>
			<li><a href='logout.php'>Logout</a></li>
        </ul>
        <ul class='side-nav' id='sidebar'>
            <li><a href='home.php'>My Rides</a></li>
            <li><a href='trip_calendar.php'>Ride Calendar</a></li>
			<li><a href='logout.php'>Logout</a></li>
        </ul>
    </div>
</nav>
HTML;

//NOTE: pages that include the navbar will also need to add the following line to the document ready function in jQuery:
// $(".button-collapse").sideNav();
?>