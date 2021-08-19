<?php
include '../../connect.php';
$conn = OpenCon();
print_r($_POST);
if($_POST["BudgetYear"] != '' && $_POST["CallType"] != '' && $_POST["Title"] != '' && $_POST["Description"] != '' && $_POST["BudgetYear"] != '' && $_POST["OpenDate"] != '' && $_POST["ClosingDate"] != '' && $_POST["IsActive"] != ''))
{
 $BudgetYear = mysqli_real_escape_string($conn,$_POST["BudgetYear"]);
 $CallType = mysqli_real_escape_string($conn,$_POST["CallType"]);
 $Title = mysqli_real_escape_string($conn,$_POST["Title"]);
 $Description = mysqli_real_escape_string($conn,$_POST["Description"]);
 $OpenDate = mysqli_real_escape_string($conn,$_POST["OpenDate"]);
 $ClosingDate = mysqli_real_escape_string($conn,$_POST["ClosingDate"]);
 $Status = mysqli_real_escape_string($conn,$_POST["IsActive"]);
 $RegisteredBy = $_SESSION['id'];

 
 
 $InsertCall = "INSERT INTO `HostInstitutionCalls`(BudgetYear, CallType, Title, Description, OpenDate, ClosingDate, RegisteredBy,IsActive) 
 VALUES('$BudgetYear', '$CallType', '$Title', '$Description', '$OpenDate', '$ClosingDate', '$RegisteredBy',$Status)";
 
 

 if(mysqli_query($conn,$InsertCall))
 {
	echo 'Data Inserted';
 }else{
	 echo 'Data Not Inserted';
 }
}else{
	echo 'Data Not inserted due to missing information.';
}
CloseCon($conn);
?>