<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<script type="text/javascript">
function makeChoice() {
    if (document.getElementById('sid').checked == true) {
   	 document.getElementById('other_box').setAttribute('readonly','readonly');
   	 document.getElementById('other_box').value="";
   }
   else if (document.getElementById('other').checked == true) {
   	  document.getElementById('other_box').removeAttribute('readonly','');
  
   }

}
</script>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Room Checkin</title>
</head>
<body>
<?php include('links.php');?>
<?php $id_number_g = $_GET['id_number'];
   	  $room_number_g = $_GET['room_number'];
	  $id_type_g = $_GET['id_type'];
?>
<h4>Room Checkin</h4>
<form action="insert_to_db_full.php" method="post"> 
Non-Resident First Name <input type="text" name="first_namei"  /> <br />
Non-Resident Last Name <input type="text" name="last_namei"  /> <br />
Resident Room Number <input type="text"  name="room_numberi" value="<?php echo $room_number_g?>"  />  <br />
<input type="radio" name="id_type" id="sid" value="student_id" <?php if($id_type_g=="student_id"){ echo "checked=\"checked\"";}?>onclick="makeChoice()">Student ID<br />
<input type="radio" name="id_type" id="other" value="other" <?php if(!($id_type_g=="student_id")){ echo "checked=\"checked\"";}?>onclick="makeChoice()">Other:<br />
&nbsp;&nbsp; <input type="text" name="other_type" size="14" id="other_box" value="<?php if(!(id_type_g=="student_id")){ echo $id_type_g;}?>" readonly="readonly" ><br />
Non-Resident ID Number <input type="text" name="id_numberi" value="<?php echo $id_number_g?>" /> <br />
<input value="Checkin!" type="submit" />
</form>
</body>
</html>

