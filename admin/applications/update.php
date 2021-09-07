<?php
include '../connect.php';
$conn = OpenCon();


if($_POST["UpdateRecordid"] != '')
{
	$recordid = mysqli_real_escape_string($conn,$_POST["UpdateRecordid"]);
	$InterviewDate = mysqli_real_escape_string($conn,$_POST["InterviewDate"]);
	
	$query = "UPDATE `PositionAppliedFor` SET 
	InternviewDate='".$InterviewDate."'
	WHERE ID = '".$recordid."'";
 
	mysqli_query($conn,$query);
 
}


if($_POST["recordid"] != '' && $_POST['MentorInstitution'] != '')
{

 $recordid = mysqli_real_escape_string($conn,$_POST["recordid"]);
 $UserID = mysqli_real_escape_string($conn,$_POST["UserID"]);
 $Ref = mysqli_real_escape_string($conn,$_POST["Ref"]);
 $Applicant = mysqli_real_escape_string($conn,$_POST["Applicant"]);
 $applicationid = mysqli_real_escape_string($conn,$_POST["applicationid"]);
 $MentorInstitution = mysqli_real_escape_string($conn,$_POST["MentorInstitution"]);
 
 $Comments = mysqli_real_escape_string($conn,$_POST["Comments"]);
 $Status = mysqli_real_escape_string($conn,$_POST["Status"]);
 
 $options = explode('~',$_POST['Options']);
 $Province = $options[0];
 $Discipline = $options[1];
 $Option = $options[2];
 
 
 $sql = "SELECT distinct c.Email, CASE WHEN FirstName != '' THEN CONCAT(FirstName , ' ' , LastName) ELSE a.UserName END Mentor, d.Name as Institution, e.TelephoneNumber FROM users a 
	left join RegistrationDetails b on b.UserID = a.UserID
	left join ProspectiveMentors c on c.Email = a.Email
	left join LookupInstitutions d on d.InstitutionId = c.InstitutionID
	left join UserContactDetails e on e.UserID = a.UserID
 WHERE a.UserID = '".$_SESSION['id']."' and d.InstitutionId = '".$MentorInstitution."'";
		$result = mysqli_query($conn, $sql);
		$mentor = mysqli_fetch_assoc($result);
		
	$st	= $Status;
	if($Status == 'Interview unsuccessful'){
		$st	= 'Pending';
	}

$FirstQuery = "UPDATE `UserApplications` SET 
 Status='".$st."'
 WHERE UserID = '".$UserID."'";
	mysqli_query($conn, $FirstQuery); 
	

 
 $query = "UPDATE `PositionAppliedFor` SET 
 ".$Option."OptionStatus='".$Status."',
 ".$Option."OptionInstitutionResponse='".$MentorInstitution."',
 Comments='".$Comments."',
 UpdatedBy='".$_SESSION['id']."'
 WHERE ID = '".$recordid."'";
 

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
 
 
 
 
}

CloseCon($conn);
?>