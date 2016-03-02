<?php
//Filename: navbar.php
//Author: Sam Teeter
//Content: navigation bar for all pages

//Note to self: more elegant way to do this?
//Pages that use this will need to have the materialize environment set up

echo<<<HTML
<nav>
    <div class='nav-wrapper'>
        <a href='trip_calendar.php' class='brand-logo'>Get a Ride</a>
        <a href='#' data-activates='sidebar' class='button-collapse'><i class='material-icons'>menu</i></a>
        <ul id='nav-mobile' class='right hide-on-med-and-down'>
            <li><a href='home.php'>My Rides</a></li>
            <li><a href='trip_calendar.php'>Ride Calendar</a></li>
        </ul>
        <ul class='side-nav' id='sidebar'>
            <li><a href='home.php'>My Rides</a></li>
            <li><a href='trip_calendar.php'>Ride Calendar</a></li>
        </ul>
    </div>
</nav>
HTML;

//NOTE: pages that include the navbar will also need to add the following line to the document ready function in jQuery:
// $(".button-collapse").sideNav();
?>