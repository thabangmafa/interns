<?php
include '../connect.php';
$conn = OpenCon();




if($_POST["InstitutionID"] != '' && $_POST["Comments"] != '' )
{
	$InstitutionID = mysqli_real_escape_string($conn,$_POST["InstitutionID"]);
	$Comments = mysqli_real_escape_string($conn,$_POST["Comments"]);
	
	$query = "UPDATE `HostApplications` SET 
	Comments='".$Comments."'
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


 
	
	
/*

 if(mysqli_query($conn,$query))
 {

if($Status == 'Offer to be made'){

$email = "dsi_hsrc_internship.queries@hsrc.ac.za";		 
$subject = "HSRC Interns Portal Feedback";		 
		 
$txt = 'Dear Administrator 

A host institution would like to make an offer to the following applicant:

Reference:  '.$Ref.'
Applicant:  '.$Applicant.' 
Province:  '.$Province.' 
Discipline:  '.$Discipline.' 

-----------------------------------------------------

Person processing application: 
Name:  '.$mentor['Mentor'].' 
Telephone: '.$mentor['TelephoneNumber'].' 
Email Address:  '.$mentor['Email'].'
Host Institution:  '.$mentor['Institution'].' 

Regards
DSI-HSRC Internship Programme Team

Please do not reply to this message. Replies to this message are routed to an unmonitored mailbox.
';
	$headers = "From: noreply@hsrc.ac.za" . "\r\n";

				mail($email,$subject,$txt,$headers);	 
	 
}
	 
	echo 'Data Updated';
 }else{
	 echo 'Update not done';
 }
 
 */
 
 
}

CloseCon($conn);
?>