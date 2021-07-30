<?php
include '../../connect.php';
$conn = OpenCon();

if(isset($_POST["BudgetYear"], $_POST["Title"], $_POST["Description"], $_POST["BudgetYear"],$_POST["OpenDate"], $_POST["ClosingDate"],$_POST["IsActive"]))
{
 $BudgetYear = mysqli_real_escape_string($conn,$_POST["BudgetYear"]);
 $Title = mysqli_real_escape_string($conn,$_POST["Title"]);
 $Description = mysqli_real_escape_string($conn,$_POST["Description"]);
 $OpenDate = mysqli_real_escape_string($conn,$_POST["OpenDate"]);
 $ClosingDate = mysqli_real_escape_string($conn,$_POST["ClosingDate"]);
 $Status = mysqli_real_escape_string($conn,$_POST["IsActive"]);
 $RegisteredBy = $_SESSION['id'];
 $HostSubmissionDueDate = mysqli_real_escape_string($conn,$_POST["HostSubmissionDueDate"]);
$InternsApplicationDueDate = mysqli_real_escape_string($conn,$_POST["InternsApplicationDueDate"]);
$InternshipStartDate = mysqli_real_escape_string($conn,$_POST["InternshipStartDate"]);
$InternshipEndDate = mysqli_real_escape_string($conn,$_POST["InternshipEndDate"]);
 
 
 $InsertCall = "INSERT INTO `HostInstitutionCalls`(BudgetYear, Title, Description, OpenDate, ClosingDate, RegisteredBy,IsActive,HostSubmissionDueDate,InternsApplicationDueDate,InternshipStartDate,InternshipEndDate) 
 VALUES('$BudgetYear', '$Title', '$Description', '$OpenDate', '$ClosingDate', '$RegisteredBy',$Status, '$HostSubmissionDueDate', '$InternsApplicationDueDate', '$InternshipStartDate', '$InternshipEndDate')";
 
 

 if(mysqli_query($conn,$InsertCall))
 {
	echo 'Data Inserted';
 }else{
	 echo 'Data Not Inserted';
 }
}
CloseCon($conn);
?>