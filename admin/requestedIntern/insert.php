<?php
include '../connect.php';
$conn = OpenCon();

if(isset($_POST["InstitutionID"]) && isset($_POST["PrimaryScientificField"]) && isset($_POST["SecondaryScientificField"]) && isset($_POST["NumberRequired"]) && isset($_POST["QualificationLevel"]))
{
	
  $InstitutionID = mysqli_real_escape_string($conn,$_POST["InstitutionID"]);
  $PrimaryScientificField = mysqli_real_escape_string($conn,$_POST["PrimaryScientificField"]);
  $SecondaryScientificField = mysqli_real_escape_string($conn,$_POST["SecondaryScientificField"]);
  $NumberRequired = mysqli_real_escape_string($conn,$_POST["NumberRequired"]);
  $QualificationLevel = mysqli_real_escape_string($conn,$_POST["QualificationLevel"]);
  
 $ID = $_SESSION['id'];

 
 $query = "INSERT INTO `ProfileOfRequestedInterns`(
 
  UserID,
  InstitutionID,
  PrimaryScientificField,
  SecondaryScientificField,
  NumberRequired,
  QualificationLevel) 
  VALUES('$ID',
  '$InstitutionID',
  '$PrimaryScientificField',
  '$SecondaryScientificField',
  '$NumberRequired',
  '$QualificationLevel')";

 if(mysqli_query($conn,$query))
 {
	 $checklist = "INSERT INTO ApplicantChecklist(UserID, InstitutionID, Section)VALUES('$ID','$InstitutionID','Profile of Requested Interns')";
	mysqli_query($conn, $checklist);
	echo $checklist;
  echo 'Data Inserted';
 }else{
	 echo 'Data Not Inserted';
 }
}else{
	echo 'Data Not Inserted due to missing information';
}
CloseCon($conn);
?>