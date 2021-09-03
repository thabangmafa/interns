<?php
include '../connect.php';
$conn = OpenCon();

if($_POST["Email"] != '')
{
	
  $MentorID = mysqli_real_escape_string($conn,@$_POST["MentorID"]);
  $Name = mysqli_real_escape_string($conn,@$_POST["Name"]);
  $Surname = mysqli_real_escape_string($conn,@$_POST["Surname"]);
  $Email = mysqli_real_escape_string($conn,@$_POST["Email"]);
  $InstitutionID = mysqli_real_escape_string($conn,@$_POST["InstitutionID"]);
  
  if(@$_POST["Status"] != ''){
  $Status = mysqli_real_escape_string($conn,@$_POST["Status"]);
  }else{
	  $Status = 'Pending Mentor Approval';
  }
 
  
 $ID = $_SESSION['id'];
 
 if(@$_POST["ID"] != ''){
	 
	 $query = "UPDATE ProspectiveMentors SET Status = '".$Status."' WHERE ID = '".@$_POST["ID"]."'";
	 
	 mysqli_query($conn,$query);
	 echo 'Data Inserted';
	 
	 }else{
 
 $query = "SELECT * FROM RegistrationDetails WHERE UserID = '".$_SESSION['id']."'";
$result = mysqli_query($conn,$query);
$Person = mysqli_fetch_array($result);

 
 $query = "INSERT INTO `ProspectiveMentors`(
 
  MentorID,
  Name,
  Surname,
  Email,
  InstitutionID,
  AddedBy,
  Status) 
  VALUES('$MentorID',
  '$Name',
  '$Surname',
  '$Email',
  '$InstitutionID',
  '$ID',
  '$Status')";


 if(mysqli_query($conn,$query))
 {
  echo 'Data Inserted';
  
  $checklist = "INSERT INTO ApplicantChecklist(UserID, InstitutionID, Section)VALUES('$ID','$InstitutionID','Prospective Mentors and Required Intern Profile')";
	mysqli_query($conn, $checklist);
	
   $subject = "HSRC Interns - Mentor Invitation by " . @$Person['Initials'] . ' ' . @$Person['FirstName'] . ' ' . @$Person['LastName'];
  if($MentorID == ''){
	$txt = "Dear " . @$Name . ' ' . @$Surname . '
	
	'. @$Person['Initials'] . ' ' . @$Person['FirstName'] . ' ' . @$Person['LastName'] . ' has invited you to become a mentor on the HSRC Interns Programme.
	
	Please click on this link in order to register on the portal: http://interns.hsrc.ac.za
	Regards,
	HSRC Internship Programme';
	
  }else{
	$txt = "Dear " . @$Name . ' ' . @$Surname . '
	
	'. @$Person['Initials'] . ' ' . @$Person['FirstName'] . ' ' . @$Person['LastName'] . ' has invited you to become a mentor on the HSRC Interns Programme.
	
	Please login to the platform in order to respond to this invitation. http://interns.hsrc.ac.za
	
	Regards,
	HSRC Internship Programme';

  }
  $headers = "From: noreply@hsrc.ac.za" . "\r\n";
  mail($Email,$subject,$txt,$headers);  
  
  
  
 }else{
	 echo 'Data Not Inserted';
 }
 

 }
 
 
}else{
	echo 'Data Not Inserted due to missing information';
}
CloseCon($conn);
?>