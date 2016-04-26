<?php
    //Filename: register.php
    //Author: Sam Teeter
    //Contents: page for registering new users
    
    require("database.php");
    session_start();
    
    //if the form has already been submitted, attempt to add the user to the database
    //TODO: add code to check if the user already exists, passwords are correct, etc.
    //and display appropriate error messages
    
    if(isset($_POST['submit'])){
        $new_username = $_POST['username'];
        $new_password = $_POST['password'];
        $new_email = $_POST['email_address'];
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        
        $query = $mysqli->prepare("insert into users(username, firstname, lastname, joined, salted_password, email)
                                  values (?, ?, ?, now(), ?, ?)");
        if (!$query){
            error_log("Could not prepare insert query");
            exit;
        }
        $query->bind_param("sssss", $new_username, $first_name, $last_name, crypt($new_password), $new_email);
        $query->execute();
        $query->close();
        
        //assuming registration successful, log the user in and continue to the home page.
        $_SESSION['username'] = $new_username;
        header('Location:home.php');
    }
?>

<!doctype html>
<html>
    <head>
        <style>
            nav ul li a{
                color:#424242
        }
        </style>
        <title>Register</title>
        <link rel="stylesheet" type="text/css" href="css/materialize.min.css"/>
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <script src="js/materialize.min.js"></script>
    </head>
    <body>
        <nav class="top-nav">
            <div class='nav-wrapper teal lighten-4 black-text'>
                <a href="trip_calendar.php" style="padding-left: 20px;"><img src="img/wurs_logo.png"></a>
                <a href='#' data-activates='sidebar' class='button-collapse'><i class='material-icons'>menu</i></a>
                <ul id='nav-mobile' class='right hide-on-med-and-down'>
                    <li><a href='about.php'>About</a></li>
                </ul>
                <ul class='side-nav' id='sidebar'>
                    <li><a href='about.php'>About</a></li>
                </ul>
            </div>
        </nav>
        <div class="section teal lighten-1">
             <div class="container">
                 <h2 class="header center grey-text text-lighten-4">
                     Register
                 </h2>
             </div>
         </div>
         <div class="container">
        <form action='register.php' method='post'>
            <h5 class="header center blue-text darken-4">
                 Enter your login information:
             </h5>
                <h6 class="blue-grey-text">Registered? <a href='http://54.213.111.166/~cse437/login.html'>Login!</a></h6><br>
                <p><label class='field'>Username: </label><input name='username' type='text' class='text-200'/></p>
                <p><label class='field'>First name: </label><input name="first_name" type='text' class='text-200'/></p>
                <p><label class='field'>Last name: </label><input name="last_name" type='text' class='text-200'/></p>
                <p><label class='field'>Email: </label><input type='email' name='email_address' class='text-200'/></p>
                <p><label class='field'>Password: </label><input name='password' type='password' class='text-200'/></p>
                <p><label class='field'>Re-type password: </label><input name='password_retype' type='password' class='text-200'/></p>
                <p><button class="btn waves-effect waves-light" type='submit' name='submit'>Register<i class="material-icons right">send</i></button></p>
        </form>
    </div>
    </body>
</html>