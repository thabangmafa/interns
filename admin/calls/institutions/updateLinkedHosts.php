<?php
include '../../connect.php';
$conn = OpenCon();

if(isset($_POST["ID"]))
{


  mysqli_query($conn,"DELETE FROM `CallInstitutionLink` WHERE CALLID = '".$_POST["ID"]."'");
  foreach($_POST["Institution"] as $institution){

		$InsertInstitution = "INSERT INTO `CallInstitutionLink`(CallID, InstitutionID) VALUES('".$_POST["ID"]."', '$institution')";
		if(mysqli_query($conn,$InsertInstitution)){
			
			echo 'Data Updated';
			
		}
		else{
			 echo 'Update not done';
		 }
	 }
	 
  
 
}
CloseCon($conn);
?>