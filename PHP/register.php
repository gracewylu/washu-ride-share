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
        <title>Register</title>
        <link rel="stylesheet" type="text/css" href="../CSS/basic-style.css"/>
        <link rel="stylesheet" type="text/css" href="../CSS/input-form.css"/>
    </head>
    <body>
        <form action='register.php' method='post'>
            <fieldset>
                <legend>Enter your login information:</legend>
                <p><label class='field'>Username: </label><input name='username' type='text' class='text-200'/></p>
                <p><label class='field'>First name: </label><input name="first_name" type='text' class='text-200'/></p>
                <p><label class='field'>Last name: </label><input name="last_name" type='text' class='text-200'/></p>
                <p><label class='field'>Email: </label><input type='email' name='email_address' class='text-200'/></p>
                <p><label class='field'>Password: </label><input name='password' type='password' class='text-200'/></p>
                <p><label class='field'>Re-type password: </label><input name='password_retype' type='password' class='text-200'/></p>
                <p><input type='submit' class='form-submit' name='submit' value='Register'/></p>
            </fieldset>
        </form>
    </body>
</html>