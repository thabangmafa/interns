<?php
include '../connect.php';
$conn = OpenCon();


if(@$_POST["InterviewDate"] != '')
{
	$recordid = mysqli_real_escape_string($conn,$_POST["recordid"]);
	@$interview_date = mysqli_real_escape_string($conn,@$_POST["InterviewDate"]);
	
	$query = "UPDATE `PositionAppliedFor` SET 
	InternviewDate='".$interview_date."'
	WHERE ID = '".$recordid."'";
 
	mysqli_query($conn,$query);
	@$interview_date = str_replace('T',' at ',@$interview_date);
 
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
 
 $sql = "SELECT distinct Email FROM users WHERE UserID='".$UserID."' ";
		$result = mysqli_query($conn, $sql);
		$getemail = mysqli_fetch_assoc($result);
		$applicant_email = $getemail['Email'];
 
 
 $sql = "SELECT distinct a.Email, CONCAT(b.FirstName,' ', b.LastName) as Mentor, CASE WHEN d.Name != '' THEN d.Name ELSE g.Name END as Institution, e.TelephoneNumber FROM users a 
	left join RegistrationDetails b on b.UserID = a.UserID
	left join ProspectiveMentors c on lower(c.Email) = lower(a.Email)
	left join HostAdministrator f on f.UserID = a.UserID
	left join LookupInstitutions d on d.InstitutionId = c.InstitutionID
	left join LookupInstitutions g on g.InstitutionId = f.InstitutionID
	left join UserContactDetails e on e.UserID = a.UserID
	
 WHERE a.UserID = '".$_SESSION['id']."' and (d.InstitutionId = '".$MentorInstitution."' || f.InstitutionID = '".$MentorInstitution."')";
		$result = mysqli_query($conn, $sql);
		$mentor = mysqli_fetch_assoc($result);

$name_of_institution = $mentor['Institution'];
$name_of_mentor = $mentor['Mentor'];
$telephone_number_of_mentor = $mentor['TelephoneNumber'];
$email_address_of_mentor = $mentor['Email'];
$candidates_name = $Applicant;
		
	$st	= $Status;
	if($Status == 'Interview unsuccessful' || $Status == 'Application withdrawn'){
		$st	= 'Pending';
	}
	
	if($Status == 'No longer available'){
		$st	= 'Withdrawn';
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
	 if($Status != 'No longer available'){
$email = "tmafa@hsrc.ac.za";		 
$subject = "DSI-HSRC Internship Programme";	
$headers = "From: noreply@hsrc.ac.za" . "\r\n";
$headers .= "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
$headers .= 'Cc: dsi_hsrc_internship.queries@hsrc.ac.za,' . @$email_address_of_mentor;

$sql = "SELECT distinct * FROM EmailTemplates WHERE Title='".$Status."' ";

		$result = mysqli_query($conn, $sql);
		$emailDetails = mysqli_fetch_assoc($result);

//replace template var with value
$token = array(
    'name_of_institution'  => @$name_of_institution,
    'name_of_mentor' => @$name_of_mentor,
    'telephone_number_of_mentor' => @$telephone_number_of_mentor,
    'email_address_of_mentor'=> @$email_address_of_mentor,
	'candidates_name'=> @$candidates_name,
	'interview_date'=> @$interview_date,
	'applicant_email'=> @$applicant_email,
	'response_comments'=> @$Comments
	
);

foreach($token as $key=>$val){
    $varMap[sprintf($key)] = $val;
}

$emailContent = strtr($emailDetails['Details'],$varMap);
$EmailTo = strtr($emailDetails['EmailTo'],$varMap);

mail($EmailTo,$subject,$emailContent,$headers);
	 }
	echo 'Data Updated';
 }else{
	 echo 'Update not done';
 }
 
 
 
 
}

CloseCon($conn);
?>