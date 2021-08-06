<?php
include '../connect.php';
$conn = OpenCon();

if(isset($_POST["ID"]))
{

 $AcademicLevel = mysqli_real_escape_string($conn,$_POST["AcademicLevel"]);
  $NameOfDegree = mysqli_real_escape_string($conn,$_POST["NameOfDegree"]);
  $TitleOfResearchProject = mysqli_real_escape_string($conn,$_POST["TitleOfResearchProject"]);
  $Institution = mysqli_real_escape_string($conn,$_POST["Institution"]);
  $Fulltime = mysqli_real_escape_string($conn,$_POST["Fulltime"]);
  $Distinction = mysqli_real_escape_string($conn,$_POST["Distinction"]);
  $DateFirstRegistration = mysqli_real_escape_string($conn,$_POST["DateFirstRegistration"]);
  $Completed = mysqli_real_escape_string($conn,$_POST["Completed"]);
  $HighestCompletedQualification = mysqli_real_escape_string($conn,$_POST["HighestCompletedQualification"]);
  $Transcript = mysqli_real_escape_string($conn,$_POST["Transcript"]);
  $Status = mysqli_real_escape_string($conn,$_POST["Status"]);
  $Reason = mysqli_real_escape_string($conn,$_POST["Reason"]);
  $AnticipatedDateCompletion = mysqli_real_escape_string($conn,$_POST["AnticipatedDateCompletion"]);
 
 $query = "UPDATE `Qualifications` SET 
  AcademicLevel='".$AcademicLevel."',
  NameOfDegree='".$NameOfDegree."',
  TitleOfResearchProject='".$TitleOfResearchProject."',
  Institution='".$Institution."',
  Fulltime='".$Fulltime."',
  Distinction='".$Distinction."',
  DateFirstRegistration='".$DateFirstRegistration."',
  Completed='".$Completed."',
  HighestCompletedQualification='".$HighestCompletedQualification."',
  Transcript='".$Transcript."',
  Status='".$Status."',
  Reason='".$Reason."',
  AnticipatedDateCompletion='".$AnticipatedDateCompletion."'
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