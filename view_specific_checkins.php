<?php
//Turn on errors
error_reporting(E_ALL);
ini_set('display_errors','On');
//Include the database connection details and the links
include('db_connect.php');
include('links.php');

//Get the user id to be found
$id = mysqli_real_escape_string($con,$_POST['id_numberi']);

//Get checking information
$select_checkin = "SELECT * FROM checkin WHERE id_number = '$id'";
$query_checkin = mysqli_query($con,$select_checkin) or die("Could not select the proper database.");


//Get user information
$select_users = "SELECT * FROM user WHERE id_number = '$id'";
$query_users = mysqli_query($con,$select_users) or die("Could not select the proper database.");
$row_users = mysqli_fetch_array($query_users);
if (empty($row_users)){
	echo"<b> There were no entries for this ID</b>";
}
else{
echo"<table border=\"1\">";
echo "<tr><td><b>First Name</b></td><td><b>Last Name</b></td><td><b>ID Type</b></td><td><b>ID Number</b></td><td><b>Room Number</b></td><td><b>Time Stamp</b></td></tr>";

//Table prints
while($row_checkin = mysqli_fetch_array($query_checkin)){
	echo "<tr>";
	echo"<td>".$row_users['first_name']."</td>";
	echo"<td>".$row_users['last_name']."</td>";
	echo"<td>".$row_users['id_type']."</td>";
	echo"<td>".$row_checkin['id_number']."</td>";
	echo"<td>".$row_checkin['room_number']."</td>";
	echo"<td>".$row_checkin['time_stamp']."</td>";
	echo "</tr>";
}
	echo "</table>";
}
mysqli_close($con);
?>

