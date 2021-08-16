<?php
include '../connect.php';
$conn = OpenCon();

if($_POST["PrimaryScientificField"] != '' && $_POST["SecondaryScientificField"] != '' && $_POST["Location"] && $_POST["NumberRequired"] != '' && $_POST["QualificationLevel"] != '')
{
	
  $InstitutionID = $_SESSION['InstitutionID'];
  $PrimaryScientificField = mysqli_real_escape_string($conn,$_POST["PrimaryScientificField"]);
  $SecondaryScientificField = mysqli_real_escape_string($conn,$_POST["SecondaryScientificField"]);
  $NumberRequired = mysqli_real_escape_string($conn,$_POST["NumberRequired"]);
  $Location = mysqli_real_escape_string($conn,$_POST["Location"]);
  $QualificationLevel = mysqli_real_escape_string($conn,$_POST["QualificationLevel"]);
  
 $ID = $_SESSION['id'];

 
 $query = "INSERT INTO `ProfileOfRequestedInterns`(
 
  UserID,
  InstitutionID,
  PrimaryScientificField,
  SecondaryScientificField,
  NumberRequired,
  Location,
  QualificationLevel) 
  VALUES('$ID',
  '$InstitutionID',
  '$PrimaryScientificField',
  '$SecondaryScientificField',
  '$NumberRequired',
  '$Location',
  '$QualificationLevel')";

 if(mysqli_query($conn,$query))
 {
	 $checklist = "INSERT INTO ApplicantChecklist(UserID, InstitutionID, Section)VALUES('$ID','$InstitutionID','Profile of Requested Interns')";
	mysqli_query($conn, $checklist);

  echo 'Data Inserted';
 }else{
	 echo 'Data Not Inserted';
 }
}else{
	echo 'Data Not Inserted due to missing information';
}
CloseCon($conn);
?>