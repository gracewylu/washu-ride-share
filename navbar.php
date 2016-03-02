<?php
//Filename: navbar.php
//Author: Sam Teeter
//Content: navigation bar for all pages

//Note to self: more elegant way to do this?
//Pages that use this will need to have the materialize environment set up

echo
"<nav>
    <div class='nav-wrapper'>
        <a href='trip_calendar.php' class='brand-logo'>Get a Ride</a>
        <ul id='nav-mobile' class='right hide-on-med-and-down'>
        <li><a href='home.php'>My Rides</a></li>
        <li><a href='trip_calendar.php'>Ride Calendar</a></li>
        </ul>
    </div>
</nav";
?>