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
      <?php 
        include("navbar.php");
        if(isset($_GET['user'])){
            $username=$_GET['user'];
        } else{
            $username=$_SESSION['username'];

        }

      ?>
    </head>
    <body>
<<<<<<< HEAD
       <h1 class="blue-grey-text center">Profile for <?php echo $username;?></h1><br>
        <div class="container" id="picture">
            <div class="row">
                <div class="col s12 l2">
        <?php
        $directory = sprintf("/home/cse437/user_pictures/%s/",$username);
		if(file_exists($directory)){
        $files = scandir($directory);
        $firstFile=$directory . $files[2];
        ?>
                    <div style="height:200px;width:200px"id="picture_holder"><img style="max-height: 100%; max-width: 100%;"src="script.php?img=<?php echo $firstFile; ?>"></div>
			             <?php } else{
				            echo "<div style=\"height:200px;width:200px\"id=\"picture_holder\"><img style=\"max-height: 100%; max-width: 100%;\"src=\"img/anon.jpg\"></div>";
                        }
			             ?>
                </div>
                <div class="col l9 offset-l1">
                    <table style='width:90%'>
                        <tr>
                        <th><b>Name:</b></th>
                        <th><b>Email:</b></th>
                        <th><b>Address:</b></th>
                        <th><b>Description: </b></th>
                        <th><b>Rating: </b></th>
                        </tr>
                    <?php
                        //this will be changed to post of whatever user the profile is being requested for
                        $user_request = $mysqli->prepare("select firstname, lastname, email, address, user_desc, rating, num_ratings from users where username = ?");

                        if (!$user_request){
                            error_log($mysqli->error);
                            exit;
                        }
                        $user_request->bind_param("s", $username);
                        $user_request->execute();
                        $user_request->bind_result($firstname, $lastname, $email, $address, $user_desc, $rating, $num_ratings);
                        
                        //print out trip data in table
                        while($user_request->fetch()){
                            if($address ==null){
                                $address = 'N/A';
                            }
                            if($num_ratings == 0){
                                $average_rating = 'N/A';
                                 printf("<tr><td>%s %s</td><td>%s</td><td>%s</td><td>%s</td><td>%s</td></tr>",
                                   $firstname, $lastname, $email, $address, $user_desc, $average_rating);
                            } else{
                                $average_rating = $rating/$num_ratings;
                                printf("<tr><td>%s %s</td><td>%s</td><td>%s</td><td>%s</td><td>%d</td></tr>",
                                   $firstname, $lastname, $email, $address, $user_desc, $average_rating);
                            }
                        }
                    ?>
                    </table>
                </div>
            </div>
            <?php
                if($username == $_SESSION['username']){
            ?>
            <div class="row">  
                <div class="col l6">
                <h5>Upload Profile Picture</h5>
                <div class="divider"></div>      
                </div>
            </div>
            <div class="row">
                <form action="uploader.php" enctype="multipart/form-data" method="post">
                    <div class="col s12 l4">
                        <div class="file-field input-field">
                        <div class="btn">
                        <span>File</span>
                            <input type="hidden" name="MAX_FILE_SIZE" value="20000000" />

                            <input type="file" name="uploadfile" id="file">
                        </div>
                        <div class="file-path-wrapper">
                            <input class="file-path validate" type="text">
                        </div>
                        </div>
                    </div>
                    <div class="col s12 l5" style="padding-top: 23px;">
                        <button class="btn waves-effect waves-light" type="submit">Upload Picture<i class="material-icons right">send</i></button>
                    </div>
                </form>
            </div>
            <div class="row">
                <div class="col l6">
                    <h5>Previous Rides</h5>
                    <div class="divider"></div>
                </div>

            </div>
            <div class="row">
                <div class="col s12 l2">
                    <p><b>Date</b></p>
                </div>
                <div class="col s12 l2">
                    <p><b>Depart Time</b></p>
                </div>
                <div class="col s12 l2">
                    <p><b>Arrive Time</b></p>
                </div>
                <div class="col s12 l2">
                    <p><b>Pick Up Location</b></p>
                </div>
                <div class="col s12 l2">
                    <p><b>Drop Off Location</b></p>
                </div>
            </div>
            <?php
                //fetch trips the user is part of
                $prev_trips= $mysqli->prepare("select id, depart_time, arrive_time, pick_up_location, drop_off_location, owner
                                             from trips join trips2users on trips.id = trips2users.trip_id
                                             where trips2users.username = ? and depart_time <= now()
                                             order by depart_time asc");
            if (!$prev_trips){
                error_log($mysqli->error);
                exit;
            }
            $prev_trips->bind_param("s", $username);
            $prev_trips->execute();
            $prev_trips->bind_result($trip_id, $depart_time, $arrive_time, $pick_up_location, $drop_off_location, $owner);
            

            //print out trip data in table
            while($prev_trips->fetch()){
                if($owner == $username){
                    continue; 
                } else{
                $depart_datetime = new DateTime($depart_time);
                $arrive_datetime = new DateTime($arrive_time);
                $depart_day = $depart_datetime->format("m/d/y");
                $depart_time = $depart_datetime->format("h:i");
                $arrive_time = $arrive_datetime->format("h:i");
                echo '<input type="hidden" id="driver" value='.$owner.'>
                <div class="row"><div class="col s12 l2">
                    <p>'.$depart_day.'</p>
                </div>
                <div class="col s12 l2">
                    <p>'.$depart_time.'</p>
                </div>
                <div class="col s12 l2">
                    <p>'.$arrive_time.'</p>
                </div>
                <div class="col s12 l2">
                    <p>'.$pick_up_location.'</p>
                </div>
                 <div class="col s12 l2">
                    <p>'.$drop_off_location.'</p>
                </div><div class=\"col s12 l2\"> <a class="waves-effect waves-light btn modal-trigger deep-purple darken-1" href="#rate_modal">Rate Driver</button></a></div>';
                }
            } ?>
        </div>
        <!--Rate Driver Modal-->
        <div id="rate_modal" class="modal">
            <div class="modal-content">
              <h4 class="center">Rate <?php echo $owner; ?></h4>
              <h5 class="center"> (1 being lowest and 5 being highest)</h5>
               <form action="#">
                <p class="range-field">
                  <input type="range" id="rating" min="1" max="5" />
                </p>
                <div class="col s12 l2 center"><button class="waves-effect waves-light btn" type="submit" id="rate_submit">Submit</button></div>
              </form>
            </div>
        </div>
        <?php  
            } 
        ?>
        <!--Finish Materialize setup-->
        <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
        <script type="text/javascript" src="js/materialize.min.js"></script>
        <!--Set document ready function so mobile navbar button works:-->
      <script>
        $( document ).ready(function() {
            $(".button-collapse").sideNav();
            $('.modal-trigger').leanModal();
            $('#rate_submit').click(function(){
                var rating = $('#rating').val();
                var driver = $('#driver').val();
                $.ajax({
                    type:'POST',
                    url: 'get_rating.php',
                    dataType: 'json', 
                    data: {
                        rating: rating, 
                        driver: driver  
                    },
                    success: function(data){
                    }, 
                    error: function(data){
                    }
                });
                $('#rate_modal').closeModal();
            });
        });
      </script>
    </body>
</html>