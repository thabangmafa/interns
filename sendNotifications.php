<?php
include 'admin/connect.php';
$conn = OpenCon();




$query = "select * from (SELECT distinct
CONCAT(e.FirstName, ' ', e.LastName) as Applicant,
a.UserID,
a.UpdatedBy as MentorID,
a.InternviewDate,
a.Comments,
h.Email as ApplicantEmail,
CASE 
WHEN FirstOptionStatus != 'NULL' THEN FirstOptionStatus
WHEN SecondOptionStatus != 'NULL' THEN SecondOptionStatus
WHEN ThirdOptionStatus != 'NULL' THEN ThirdOptionStatus ELSE ''
END Options,

f.Email as MentorEmail, CONCAT(bb.FirstName,' ', bb.LastName) as Mentor, CASE WHEN dd.Name != '' THEN dd.Name ELSE gg.Name END as Institution, ee.TelephoneNumber

FROM `PositionAppliedFor` a 
left join RegistrationDetails e on e.UserID = a.UserID
left join users f on f.UserID = a.UpdatedBy
left join ProspectiveMentors g on lower(g.Email) = lower(f.Email)
left join users h on h.UserID = a.UserID

left join RegistrationDetails bb on bb.UserID = a.UpdatedBy

	left join HostAdministrator ff on ff.UserID = h.UserID
	left join LookupInstitutions dd on dd.InstitutionId = g.InstitutionID
	left join LookupInstitutions gg on gg.InstitutionId = ff.InstitutionID
	left join UserContactDetails ee on ee.UserID = h.UserID
where a.ID in ('724',
'785',
'920',
'1354',
'1674',
'1785',
'1938',
'1951',
'2144',
'2473',
'2944',
'3015',
'3148',
'3189',
'3616',
'3623',
'3735',
'4194',
'4762',
'5043',
'5309',
'5608',
'5769',
'5866',
'5956',
'6054',
'6881',
'7079',
'7277',
'7793',
'7874',
'8373',
'8479',
'8543',
'8819',
'8909',
'9315',
'9486',
'9590',
'9982',
'10113',
'10215',
'10333',
'10825',
'11116',
'11233',
'11555'
) ) a 
left join EmailTemplates b on b.Title = a.Options";
$result = mysqli_query($conn, $query);

while($applications = mysqli_fetch_array($result)) {
	


@$interview_date = mysqli_real_escape_string($conn,@$applications["InternviewDate"]);
@$interview_date = str_replace('T',' at ',@$interview_date);
$UserID = mysqli_real_escape_string($conn,$applications["UserID"]);
$Applicant = mysqli_real_escape_string($conn,$applications["Applicant"]);
$MentorInstitution = mysqli_real_escape_string($conn,$applications["Institution"]);
$Comments = mysqli_real_escape_string($conn,$applications["Comments"]);
$Status = mysqli_real_escape_string($conn,$applications["Options"]);
$MentorID = mysqli_real_escape_string($conn,$applications["MentorID"]);
$applicant_email = mysqli_real_escape_string($conn,$applications["ApplicantEmail"]);
$email_address_of_mentor = mysqli_real_escape_string($conn,$applications["MentorEmail"]);
$name_of_institution = mysqli_real_escape_string($conn,$applications["Institution"]);
$name_of_mentor = mysqli_real_escape_string($conn,$applications["Mentor"]);
$telephone_number_of_mentor = mysqli_real_escape_string($conn,$applications["TelephoneNumber"]);
$candidates_name = mysqli_real_escape_string($conn,$applications["Applicant"]);



		 
$subject = "DSI-HSRC Internship Programme";	
$headers = "From: noreply@hsrc.ac.za" . "\r\n";
$headers .= "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
$headers .= 'Cc: dsi_hsrc_internship.queries@hsrc.ac.za,tmafa@hsrc.ac.za,' . @$email_address_of_mentor;


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

$emailContent = strtr($applications['Details'],$varMap);
$EmailTo = strtr($applications['EmailTo'],$varMap);

//mail($EmailTo,$subject,$emailContent,$headers);

}



CloseCon($conn);
?>