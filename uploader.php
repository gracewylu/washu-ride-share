<!DOCTYPE html>
<html>
<head></head>
<body>
<?php
error_reporting(E_ALL);
ini_set("display_errors",1);

session_start();

// Get the filename and make sure it is valid
$filename = basename($_FILES['uploadedfile']['name']);
if( !preg_match('/^[\w_\.\-]+$/', $filename) ){
	echo "Invalid filename";
	exit;
}

// Get the username and make sure it is valid
$username = $_SESSION['username'];
if( !preg_match('/^[\w_\-]+$/', $username) ){
	echo "Invalid username";
	exit;
}
if(!file_exists(sprintf("/home/cse437/user_pictures/%s",$username))){
	mkdir(sprintf("/home/cse437/user_pictures/%s",$username),0777,true);
}
$full_path = sprintf("/home/cse437/user_pictures/%s/%s", $username, $filename);
 


if( move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $full_path) ){
        
header('user_profile.php');
exit;
}else{
        echo "failure";
		exit;
}
 
?>
</body>
</html>