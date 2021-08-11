<?php
include '../connect.php';
$conn = OpenCon();

if(isset($_POST["ID"]))
{

$InstitutionID = mysqli_real_escape_string($conn,$_POST["InstitutionID"]);
 $PrimaryScientificField = mysqli_real_escape_string($conn,$_POST["PrimaryScientificField"]);
  $SecondaryScientificField = mysqli_real_escape_string($conn,$_POST["SecondaryScientificField"]);
  $NumberRequired = mysqli_real_escape_string($conn,$_POST["NumberRequired"]);
  $QualificationLevel = mysqli_real_escape_string($conn,$_POST["QualificationLevel"]);
 
 $query = "UPDATE `ProfileOfRequestedInterns` SET 
 InstitutionID='".$InstitutionID."',
  PrimaryScientificField='".$PrimaryScientificField."',
  SecondaryScientificField='".$SecondaryScientificField."',
  NumberRequired='".$NumberRequired."',
  QualificationLevel='".$QualificationLevel."'
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