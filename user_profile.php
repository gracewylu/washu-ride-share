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
		<?php
		if(array_key_exists('user',$_GET)){
			$username=$_GET['user'];
		} else{
			$username = $_SESSION['username'];
		}
        ?>
<!--         <div class="container">
 -->    <h1 class="blue-grey-text center">Profile for <?php $username;?></h1><br>
        
        <div class="container" id="picture">
            <div class="row">
                <div class="col s12 l2">
					<?php
					 $directory = sprintf("/home/cse437/user_pictures/%s/",$username);
					if(file_exists($directory)){
					$files = scandir($directory);
					$firstFile=$directory . $files[2];
					?>
                    <div style="height:200px;width:200px" id="picture_holder"><img style="max-height: 100%; max-width: 100%;"src="script.php?img=<?php echo $firstFile; ?>"></div>
			             <?php } else{?>
							<div style="height:200px;width:200px" id="picture_holder"></div>
						<?php
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
                        </tr>
                    <?php
                        //this will be changed to post of whatever user the profile is being requested for
                        $user_request = $mysqli->prepare("select firstname, lastname, email, address, user_desc from users where username = ?");
                        if (!$user_request){
                            error_log($mysqli->error);
                            exit;
                        }
                        $user_request->bind_param("s", $username);
                        $user_request->execute();
                        $user_request->bind_result($firstname, $lastname, $email, $address, $user_desc);
                        
                        //print out trip data in table
                        while($user_request->fetch()){
                            if($address ==null){
                                $address = 'N/A';
                            }
                            printf("<tr><td>%s %s</td><td>%s</td><td>%s</td><td>%s</td></tr>",
                                   $firstname, $lastname, $email, $address, $user_desc);
                        }
                    ?>
                    </table>
                </div>
            </div>
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