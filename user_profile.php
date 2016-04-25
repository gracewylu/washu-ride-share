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
        <?php
        $directory = sprintf("/home/cse437/user_pictures/%s/",$_SESSION['username']);
		if(file_exists($directory)){
        $files = scandir($directory);
        $firstFile=$directory . $files[2];
        ?>
        <div class="container" id="picture">
            <div style="height:200px;width:200px"id="picture_holder"><img style="max-height: 100%; max-width: 100%;"src="script.php?img=<?php echo $firstFile; ?>"></div>
			<?php } else{
				echo "No picture";
			}
			?>
            <form enctype="multipart/form-data" action="uploader.php" id="pic_upload" method="POST">
	<p>
		<input type="hidden" name="MAX_FILE_SIZE" value="20000000" />
		<label for="uploadfile_input">Choose a file to upload:</label> <input name="uploadedfile" type="file" id="uploadfile_input" />
	</p>
	<p>
		<button class="btn waves-effect waves-light" type="submit" form = "pic_upload">Upload Picture<i class="material-icons right">send</i></button>
	</p>
</form>
        </div>
        <table style='width:90%'>
                <tr>
                    <th><b>Name:</b></th>
                    <th><b>Email:</b></th>
                    <th><b>Address:</b></th>
                </tr>
        <?php
        //this will be changed to post of whatever user the profile is being requested for
        $username = $_SESSION['username'];      
            $user_request = $mysqli->prepare("select firstname, lastname, email, address from users where username = ?");
            if (!$user_request){
                error_log($mysqli->error);
                exit;
            }
            $user_request->bind_param("s", $username);
            $user_request->execute();
            $user_request->bind_result($firstname, $lastname, $email, $address);
            
            //print out trip data in table
            while($user_request->fetch()){
                printf("<tr><td>%s %s</td><td>%s</td><td>%s</td></tr>",
                       $firstname, $lastname, $email, $address);
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