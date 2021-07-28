<?php
include '../../connect.php';
$conn = OpenCon();

if(isset($_POST["ID"]))
{

 $BudgetYear = mysqli_real_escape_string($conn,$_POST["BudgetYear"]);
 $Title = mysqli_real_escape_string($conn,$_POST["Title"]);
 $Description = mysqli_real_escape_string($conn,$_POST["Description"]);
 $OpenDate = mysqli_real_escape_string($conn,$_POST["OpenDate"]);
 $ClosingDate = mysqli_real_escape_string($conn,$_POST["ClosingDate"]);
 $UpdatedBy = $_SESSION['id'];
 $status = mysqli_real_escape_string($conn,$_POST["Status"]);

 
 $query = "UPDATE `HostInstitutionCalls` SET 
 BudgetYear='".$BudgetYear."',
 Title='".$Title."',
 Description='".$Description."',
 OpenDate='".$OpenDate."',
 ClosingDate='".$ClosingDate."',
 UpdatedBy='".$UpdatedBy."',
 IsActive='".$status."'
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