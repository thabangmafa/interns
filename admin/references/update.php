<?php
include '../connect.php';
$conn = OpenCon();

if(isset($_POST["ID"]))
{

 $Name = mysqli_real_escape_string($conn,$_POST["Name"]);
 $Relationship = mysqli_real_escape_string($conn,$_POST["Relationship"]);
 $Telephone = mysqli_real_escape_string($conn,$_POST["Telephone"]);
 $Email = mysqli_real_escape_string($conn,$_POST["Email"]);
 $Organisation = mysqli_real_escape_string($conn,$_POST["Organisation"]);
 
 $query = "UPDATE `References` SET 
 Name='".$Name."',
 Relationship='".$Relationship."',
 Telephone='".$Telephone."',
 Email='".$Email."',
 Organisation='".$Organisation."'
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