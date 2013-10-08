<?php 
//Inserts checkin into database if the student has checked in before
//Turn on error reporting
error_reporting(E_ALL);
ini_set('display_errors','On');

//Include the DB connect and links
include('db_connect.php');
include('links.php');

//Get the room number avoiding injections
$room_number = mysqli_real_escape_string($con,$_POST['room_numberi']);
//Get the ID type
$id_type = mysqli_real_escape_string($con,$_POST['id_type']);
//If the id type is other, then get the id type
if ($id_type =='other'){
	$id_type = mysqli_real_escape_string($con,$_POST['other_type']);
}

//Get the ID number
$id_number = mysqli_real_escape_string($con,$_POST['id_numberi']);

//Create mysql query 
$query = "SELECT * FROM user WHERE id_number='$id_number' AND id_type='$id_type'";
//Execute mysql query
$query = mysqli_query($con,$query) or die("Could not select the proper database.");
$row = mysqli_fetch_array($query);

//If there is not a previous entry from a previous checkin, propmpt for more information
if (empty($row)){
	mysqli_close($con);
	echo "<script type=\"text/javascript\">";
	echo "window.location = \"http://localhost/PHPeclipse/Database/index_full.php?id_number=".$id_number."&room_number=".$room_number."&id_type=".$id_type."\"";
	echo "</script>";
	die;
}

//If the student has checked into this dorm before, do not prompt them for there name
else{
	//Get the id number for matching user
	$id_number_db = $row['id_number'];

	//Check user in
	mysqli_query($con,"INSERT INTO checkin(id_number,room_number,time_stamp)
	VALUES('$id_number_db','$room_number',NOW())")
	or die("There has been an error checking the user in. 102");

	//Get checkin information
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
}
mysqli_close($con);
?>

