<?php
include '../connect.php';
$conn = OpenCon();

if($_POST["InstitutionID"] != '' && $_POST["Comments"] != '' )
{
	$InstitutionID = mysqli_real_escape_string($conn,$_POST["InstitutionID"]);
	$Comments = mysqli_real_escape_string($conn,$_POST["Comments"]);
	
	$query = "UPDATE `HostApplications` SET 
	Comments='".$Comments."',
	Status='Approved'
	WHERE InstitutionID = '".$InstitutionID."'";
 
	mysqli_query($conn,$query);
 
}


if($_POST["InstitutionID"] != '' && $_POST['allocation'] != '')
{

 $InstitutionID = mysqli_real_escape_string($conn,$_POST["InstitutionID"]);

	 
 foreach(@$_POST['allocation'] as $allocations){

		$options = explode('~',$allocations);
		$setAllocations =  'Allocated = ' . $options[1].' WHERE ID = ' . $options[0];
		@$Query = "UPDATE `ProfileOfRequestedInterns` SET ".$setAllocations."";
		mysqli_query($conn, $Query); 
	}

 
}

CloseCon($conn);
?>