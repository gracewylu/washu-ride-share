<?php
//Filename: navbar.php
//Author: Sam Teeter
//Content: navigation bar for all pages

//Pages that use this will need to have the materialize environment set up
if(!isset($_SESSION['username'])){
echo<<<HTML
<style>
nav ul li a{
    color:#424242
}

</style>
<nav class="top-nav">
    <div class='nav-wrapper teal lighten-4 black-text'>
        <!--<a href='trip_calendar.php' class='page-title grey-text text-darken-3'>&nbsp;Get a Ride</a>-->
        <a href="trip_calendar.php" style="padding-left: 20px; padding-top: 10px;"><img src="img/wurs_logo.png"></a>
        <a href='#' data-activates='sidebar' class='button-collapse'><i class='material-icons'>menu</i></a>
        <ul id='nav-mobile' class='right hide-on-med-and-down'>
            <li><a href='login.html'>Login</a></li>
            <li><a href="register.php">Register</a></li>
        </ul>
        <ul class='side-nav' id='sidebar'>
            <li><a href='login.html'>Login</a></li>
            <li><a href="register.php">Register</a></li>
        </ul>
    </div>
</nav>
HTML;
}
else{
echo<<<HTML
<style>
nav ul li a{
    color:#424242
}

</style>
<nav class="top-nav">
    <div class='nav-wrapper teal lighten-4 black-text'>
        <!--<a href='trip_calendar.php' class='page-title grey-text text-darken-3'>&nbsp;Get a Ride</a>-->
        <a href="trip_calendar.php" style="padding-left: 20px; padding-top: 10px;"><img src="img/wurs_logo.png"></a>
        <a href='#' data-activates='sidebar' class='button-collapse'><i class='material-icons'>menu</i></a>
        <ul id='nav-mobile' class='right hide-on-med-and-down'>
            <li><a href='home.php'>My Rides</a></li>
            <li><a href='trip_calendar.php'>All Rides</a></li>
            <li><a href='about.php'>About</a></li>
            <li><a href='user_profile.php'>My Profile</a></li>
            <li><a href='logout.php'>Logout</a></li>
             <li>
                <form class="teal lighten-3" method="GET" action="search.php">
                    <div class="input-field">
                        <input id="search" name="q" type="search">
                            <label for="search"><i class="material-icons">search</i></label>
                        </input>
                    </div>
                </form>
            </li>
        </ul>
        <ul class='side-nav' id='sidebar'>
            <li><a href='home.php'>My Rides</a></li>
            <li><a href='trip_calendar.php'>All Rides</a></li>
            <li><a href='about.php'>About</a></li>
            <li><a href='user_profile.php'>My Profile</a></li>
            <li><a href='logout.php'>Logout</a></li>
        </ul>
    </div>
</nav>
HTML;
}

//NOTE: pages that include the navbar will also need to add the following line to the document ready function in jQuery:
// $(".button-collapse").sideNav();
?>