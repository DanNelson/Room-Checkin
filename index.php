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
<h4>Room Checkin</h4>
<form action="insert_to_db_partial.php" method="post">
Residnet Room Number <input type="text" name="room_numberi"  />  <br /> 
<input type="radio" name="id_type" id="sid" value="student_id" checked="checked" onclick="makeChoice()">Student ID<br />
<input type="radio" name="id_type" id="other" value="other" onclick="makeChoice()">Other:<br />
&nbsp;&nbsp; <input type="text" name="other_type" id="other_box" size="14" readonly="readonly" ><br />
Non-Resident ID Number <input type="text"  name="id_numberi"  /> <br />
<input value="Checkin!" type="submit" />
</form>
</body>
</html>

   