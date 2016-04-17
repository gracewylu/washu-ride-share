<!doctype html>
<?php
//Filename: home.php
//Author: Sam Teeter
//Content: the user's homepage, presented after login
    require("database.php");
    session_start();
    login_check();
    date_default_timezone_set("UTC");
?>
<html>
    <head>
        <title>User Profile</title>
        <!--Materialize setup-->
      <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
      
      <!--Navbar-->
      <?php include("navbar.php");?>
    </head>
    <body>
        
        <div class="container">
        <h1 class="blue-grey-text">Profile for <?php echo $_SESSION['username'];?></h1><br>
        <table style='width:90%'>
                <tr>
                    <th><b>Name:</b></th>
                    <th><b>Email:</b></th>
                </tr>
        <?php
        //this will be changed to post of whatever user the profile is being requested for
        $username = $_SESSION['username'];      
            $user_request = $mysqli->prepare("select firstname, lastname, email from users where username = ?");
            if (!$user_request){
                error_log($mysqli->error);
                exit;
            }
            $user_request->bind_param("s", $username);
            $user_request->execute();
            $user_request->bind_result($firstname, $lastname, $email);
            
            //print out trip data in table
            while($user_request->fetch()){
                printf("<tr><td>%s %s</td><td>%s</td></tr>",
                       $firstname, $lastname, $email);
            }
        ?>
        </div>
        
        <!--Finish Materialize setup-->
        <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
        <script type="text/javascript" src="js/materialize.min.js"></script>
        <!--Set document ready function so mobile navbar button works:-->
      <script>
        $( document ).ready(function() {
            $(".button-collapse").sideNav();
        });
      </script>
    </body>
</html>