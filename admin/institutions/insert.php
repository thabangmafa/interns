<?php
include '../connect.php';
$conn = OpenCon();

if(isset($_POST["name"], $_POST["type"], $_POST["status"]))
{
 $name = mysqli_real_escape_string($conn,$_POST["name"]);
 $type = mysqli_real_escape_string($conn,$_POST["type"]);
 $status = mysqli_real_escape_string($conn,$_POST["status"]);
 
 $query = "INSERT INTO `LookupInstitutions`(InstitutionTypeId, Name, IsActive) VALUES('$type', '$name', '$status')";
 if(mysqli_query($conn,$query))
 {
  echo 'Data Inserted';
 }else{
	 echo 'Data Not Inserted';
 }
}
CloseCon($conn);
?>