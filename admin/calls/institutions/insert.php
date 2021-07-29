<?php
include '../../connect.php';
$conn = OpenCon();

if(isset($_POST["BudgetYear"], $_POST["Title"], $_POST["Description"], $_POST["BudgetYear"],$_POST["OpenDate"], $_POST["ClosingDate"],$_POST["Status"]))
{
 $BudgetYear = mysqli_real_escape_string($conn,$_POST["BudgetYear"]);
 $Title = mysqli_real_escape_string($conn,$_POST["Title"]);
 $Description = mysqli_real_escape_string($conn,$_POST["Description"]);
 $OpenDate = mysqli_real_escape_string($conn,$_POST["OpenDate"]);
 $ClosingDate = mysqli_real_escape_string($conn,$_POST["ClosingDate"]);
 $Status = mysqli_real_escape_string($conn,$_POST["Status"]);
 $RegisteredBy = $_SESSION['id'];
 
 
 $InsertCall = "INSERT INTO `HostInstitutionCalls`(BudgetYear, Title, Description, OpenDate, ClosingDate, RegisteredBy,IsActive) VALUES('$BudgetYear', '$Title', '$Description', '$OpenDate', '$ClosingDate', '$RegisteredBy',$Status)";
 
 

 if(mysqli_query($conn,$InsertCall))
 {
	echo 'Data Inserted';
 }else{
	 echo 'Data Not Inserted';
 }
}
CloseCon($conn);
?>