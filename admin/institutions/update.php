<?php
include '../connect.php';
$conn = OpenCon();

if(isset($_POST["id"]))
{
 $value = mysqli_real_escape_string($conn,$_POST["value"]);
 $query = "UPDATE `LookupInstitutions` SET ".strtoupper($_POST["column_name"])."='".$value."' WHERE InstitutionId = '".$_POST["id"]."'";
 

 if(mysqli_query($conn,$query))
 {
  echo 'Data Updated';
 }else{
	 echo 'Update not done';
 }
}
CloseCon($conn);
?>