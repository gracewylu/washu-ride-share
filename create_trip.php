<!doctype html>
<head>
	
</head>

<script>
document.addEventListener('DOMContentLoaded', function() {
    document.getElementById("date").valueAsDate = new Date();
}, false);
</script>

<body>

<?php
    require('database.php');
    session_start();
?>

<form action="new_trip.php" method="POST">
  Event: 
  <input type="text" name="drop_off_location">
  <br>
  
  Date: 
  <input type="date" id="date" name="date">
  <br>
  
  Pick-up Spot:
  <input type="text" name="pick_up_location">
  <br>
  
  <!--get car id from car-->
  Car:
  <select name="car">
  <option value="Car1">Car1</option>
  <option value="Car2">Car2</option>
  </select>
  <br>
  
  Available Seats:
  <!--change 'max' to max number of seats in car-->
  <!-- should be updated when user changes car-->
  <input type="number" name="seats_available" value="1" min="1" max="5">
  
  <input type="hidden" name="username" value="%d">
  
  <br>
  
  <input type="submit" value="Submit">
  </select>
</form>

</body>

</html>