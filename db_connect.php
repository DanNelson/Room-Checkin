<?
//Information for connecting to the database
$username = "root";
$password = "root";
$hostname = "localhost";
$con = mysqli_connect($hostname, $username, $password)
	or die ("There has been a error connecting to the databse.");
mysqli_select_db($con,'database_test')
	or die ("There has been an error selecting the database.");

?>