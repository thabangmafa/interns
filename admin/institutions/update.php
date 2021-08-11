<?php
include '../connect.php';
$conn = OpenCon();

if(isset($_POST["id"]))
{

 $name = mysqli_real_escape_string($conn,$_POST["name"]);
 $type = mysqli_real_escape_string($conn,$_POST["type"]);
 $status = mysqli_real_escape_string($conn,$_POST["status"]);
 $Administrator = mysqli_real_escape_string($conn,$_POST["Administrator"]);
 
 $query = "UPDATE `LookupInstitutions` SET 
 Name='".$name."',
 InstitutionTypeId='".$type."',
 IsActive='".$status."'
 WHERE InstitutionId = '".$_POST["id"]."'";
 

 if(mysqli_query($conn,$query))
 {
	 
	 $query = "INSERT INTO `HostAdministrator`(UserID, InstitutionID, Status) VALUES('$Administrator', '".$_POST["id"]."', 'Approved')";
	 mysqli_query($conn,$query);
  echo 'Data Updated';
 }else{
	 echo 'Update not done';
 }
}
CloseCon($conn);
?>