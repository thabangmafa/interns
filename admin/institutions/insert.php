<?php
include '../connect.php';
$conn = OpenCon();

if(isset($_POST["Name"], $_POST["Type"], $_POST["Status"]))
{
 $name = mysqli_real_escape_string($conn,$_POST["Name"]);
 $type = mysqli_real_escape_string($conn,$_POST["Type"]);
 $status = mysqli_real_escape_string($conn,$_POST["Status"]);
 
 $query = "INSERT INTO `LookupInstitutions`(InstitutionTypeId, Name, IsActive, ModifiedUserId) VALUES('$type', '$name', '$status', '1')";
 if(mysqli_query($conn,$query))
 {
  echo 'Data Inserted';
 }else{
	 echo 'Data Not Inserted' . $query;
 }
}
CloseCon($conn);
?>