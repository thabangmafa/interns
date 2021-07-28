<?php
include '../connect.php';
$conn = OpenCon();

if(isset($_POST["id"]))
{

 $name = mysqli_real_escape_string($conn,$_POST["name"]);
 $type = mysqli_real_escape_string($conn,$_POST["type"]);
 $status = mysqli_real_escape_string($conn,$_POST["status"]);
 
 $query = "UPDATE `LookupInstitutions` SET 
 Name='".$name."',
 ID='".$type."',
 IsActive='".$status."'
 WHERE ID = '".$_POST["id"]."'";
 

 if(mysqli_query($conn,$query))
 {
  echo 'Data Updated';
 }else{
	 echo 'Update not done';
 }
}
CloseCon($conn);
?>