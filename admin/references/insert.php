<?php
include '../connect.php';
$conn = OpenCon();

if(isset($_POST["Name"], $_POST["Relationship"], $_POST["Telephone"]))
{
	
 $Name = mysqli_real_escape_string($conn,$_POST["Name"]);
 $Relationship = mysqli_real_escape_string($conn,$_POST["Relationship"]);
 $Telephone = mysqli_real_escape_string($conn,$_POST["Telephone"]);
 $ID = $_SESSION['id'];
 
 $query = "INSERT INTO `References`(UserID, Name, Relationship, Telephone) VALUES('$ID','$Name', '$Relationship', '$Telephone')";

 if(mysqli_query($conn,$query))
 {
  echo 'Data Inserted';
  
  $counter = "SELECT count(*) Refs FROM `References` WHERE UserID = '$ID'";
  $res = mysqli_query($conn, $counter);
  $userdetails = mysqli_fetch_array($res);
  
	  if ($userdetails['Refs'] > 2) {
		  $checklist = "INSERT INTO ApplicantChecklist(UserID, Section)VALUES('$ID','References')";
		  mysqli_query($conn, $checklist);
	  }
 }else{
	 echo 'Data Not Inserted';
 }
}else{
	echo 'Data Not Inserted due to missing information';
}
CloseCon($conn);
?>