<?php 
//Inserts student and checkin into database if they have not checked in before
//Turn on errors
error_reporting(E_ALL);
ini_set('display_errors','On');
//Include the database connection details and links
include('db_connect.php');
include('links.php');

//Get all fields from page avoiding injections
$first_name =  mysqli_real_escape_string($con,$_POST['first_namei']);
$last_name = mysqli_real_escape_string($con,$_POST['last_namei']);
$id_type = mysqli_real_escape_string($con,$_POST['id_type']);
if ($id_type =='other'){
	$id_type = mysqli_real_escape_string($con,$_POST['other_type']);
}
$id_number = mysqli_real_escape_string($con,$_POST['id_numberi']);
$room_number = mysqli_real_escape_string($con,$_POST['room_numberi']);


//Insert user information
mysqli_query($con,"INSERT INTO user(first_name,last_name,id_type,id_number)
VALUES('$first_name','$last_name','$id_type','$id_number')")
or die(mysqli_error($con));

//Insert checkin information
mysqli_query($con,"INSERT INTO checkin(id_number,room_number,time_stamp)
VALUES('$id_number','$room_number',NOW())")
or die("There has been an error checking the user in. 102");

//Get checking information
$id = mysqli_insert_id($con);
$select_checkin = "SELECT * FROM checkin WHERE id='$id'";
$query_checkin = mysqli_query($con,$select_checkin) or die("Could not select the proper database.");
$row_checkin = mysqli_fetch_array($query_checkin);

//Get user information
$select_users = "SELECT * FROM user WHERE id_number='$id_number'";
$query_users = mysqli_query($con,$select_users) or die("Could not select the proper database.");
$row_users = mysqli_fetch_array($query_users);

//Table prints
echo"<table border=\"1\">";
echo "<tr><td><b>First Name</b></td><td><b>Last Name</b></td><td><b>ID Type</b></td><td><b>ID Number</b></td><td><b>Room Number</b></td><td><b>Time Stamp</b></td></tr>";
echo "<tr>";
echo"<td>".$row_users['first_name']."</td>";
echo"<td>".$row_users['last_name']."</td>";
echo"<td>".$row_users['id_type']."</td>";
echo"<td>".$row_checkin['id_number']."</td>";
echo"<td>".$row_checkin['room_number']."</td>";
echo"<td>".$row_checkin['time_stamp']."</td>";
echo "</tr>";
echo "</table>";
mysqli_close($con);
?>


