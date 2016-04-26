<?php
error_reporting(E_ALL);
ini_set("display_errors",1);

session_start();

// Get the filename and make sure it is valid
$filename = basename($_FILES['uploadfile']['name']);
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
$path = sprintf("/home/cse437/user_pictures/%s",$username);
$files = scandir($path);
$firstFile = $files[2];
if($firstFile){
	unlink($path . $firstFile);
}
$full_path = sprintf("/home/cse437/user_pictures/%s/%s", $username, $filename);

if($_FILES['uploadfile']['error']==0){ 
	if(move_uploaded_file($_FILES['uploadfile']['tmp_name'], $full_path)){
		header('Location:user_profile.php');
		exit;
	}  
	else{
		echo "error moving uploaded file";
		exit;
	}
}else{
        echo $_FILES['uploadfile']['error'];
}
 
?>