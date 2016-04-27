<?php
	require('database.php');

	$rating = $_POST['rating'];
	$driver = $_POST['driver'];

	$get_rating = $mysqli->prepare('Select rating, num_ratings from users where username=?');
	if(!$get_rating){
		echo "Couldn't prepare update rating query";
		exit;
	}
	$get_rating->bind_param("s", $driver);
	$get_rating->execute();
	$get_rating->bind_result($current_rating, $num_ratings);

	$num_ratings += 1;
	if($current_rating == null){
		$current_rating = 0; 

	} 
	$current_rating += $rating; 
	$average_rating = $current_rating/$num_ratings;
	$get_rating->close();
	$update_rating = $mysqli->prepare('Update users set rating=?,num_ratings=? where username=?');
	$update_rating->bind_param('iis', $current_rating, $num_ratings, $driver);
	$update_rating->execute();
	$update_rating->close();
	echo json_encode($average_rating);
?>