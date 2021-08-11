<?php
include '../connect.php';
$conn = OpenCon();

if(isset($_POST["Name"]) && isset($_POST["Surname"]) && isset($_POST["Email"]))
{
	
  $MentorID = mysqli_real_escape_string($conn,$_POST["MentorID"]);
  $Name = mysqli_real_escape_string($conn,$_POST["Name"]);
  $Surname = mysqli_real_escape_string($conn,$_POST["Surname"]);
  $Email = mysqli_real_escape_string($conn,$_POST["Email"]);
  $InstitutionID = mysqli_real_escape_string($conn,$_POST["InstitutionID"]);
  
 $ID = $_SESSION['id'];
 
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
  'Pending Approval')";


echo $query;

 if(mysqli_query($conn,$query))
 {
  echo 'Data Inserted';
  
  
   $subject = "HSRC Interns - Mentor Invitation by " . $Person['Initials'] . ' ' . $Person['FirstName'] . ' ' . $Person['FirstName'];
  if($MentorID = ''){
	$txt = "Dear " . $Name . ' ' . $Surname . '\r\n'. $Person['Initials'] . ' ' . $Person['FirstName'] . ' ' . $Person['FirstName'] . ' has invited you to become a mentor on the HSRC Interns Programme.
	\n\n Please click on this link in order to register on the portal: http://interns.hsrc.ac.za \n\nRegards, \nHSRC Internship Programme';
	
  }else{
	$txt = "Dear " . $Name . ' ' . $Surname . '\r\n'. $Person['Initials'] . ' ' . $Person['FirstName'] . ' ' . $Person['FirstName'] . ' has invited you to become a mentor on the HSRC Interns Programme.
	\n\n Please login to the platform in order to respond to this invitation. http://interns.hsrc.ac.za \n\nRegards, \nHSRC Internship Programme';

  }
  $headers = "From: noreply@hsrc.ac.za" . "\r\n";
  mail($Email,$subject,$txt,$headers);  
  
  
  
 }else{
	 echo 'Data Not Inserted';
 }
}else{
	echo 'Data Not Inserted due to missing information';
}
CloseCon($conn);
?>