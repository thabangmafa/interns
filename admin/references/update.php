<?php
include '../connect.php';
$conn = OpenCon();

if(isset($_POST["ID"]))
{

 $Name = mysqli_real_escape_string($conn,$_POST["Name"]);
 $Relationship = mysqli_real_escape_string($conn,$_POST["Relationship"]);
 $Telephone = mysqli_real_escape_string($conn,$_POST["Telephone"]);
 
 $query = "UPDATE `References` SET 
 Name='".$Name."',
 Relationship='".$Relationship."',
 Telephone='".$Telephone."'
 WHERE ID = '".$_POST["ID"]."'";
 

 if(mysqli_query($conn,$query))
 {
  echo 'Data Updated';
 }else{
	 echo 'Update not done';
 }
}
CloseCon($conn);
?>