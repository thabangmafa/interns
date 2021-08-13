<?php
include '../connect.php';
$conn = OpenCon();

if($_POST["AcademicLevel"] != '' && $_POST["NameOfDegree"] != '')
{
	

  $AcademicLevel = mysqli_real_escape_string($conn,$_POST["AcademicLevel"]);
  $NameOfDegree = mysqli_real_escape_string($conn,$_POST["NameOfDegree"]);
  $TitleOfResearchProject = mysqli_real_escape_string($conn,$_POST["TitleOfResearchProject"]);
  $Institution = mysqli_real_escape_string($conn,$_POST["Institution"]);
  $Fulltime = mysqli_real_escape_string($conn,$_POST["Fulltime"]);
  $Distinction = mysqli_real_escape_string($conn,$_POST["Distinction"]);
  $DateFirstRegistration = mysqli_real_escape_string($conn,$_POST["DateFirstRegistration"]);
  $Completed = mysqli_real_escape_string($conn,$_POST["Completed"]);
  $HighestCompletedQualification = mysqli_real_escape_string($conn,$_POST["HighestCompletedQualification"]);
  //$Transcript = mysqli_real_escape_string($conn,$_POST["Transcript"]);
  $Status = mysqli_real_escape_string($conn,$_POST["Status"]);
  $Reason = mysqli_real_escape_string($conn,$_POST["Reason"]);
  $AnticipatedDateCompletion = mysqli_real_escape_string($conn,$_POST["AnticipatedDateCompletion"]);
 $ID = $_SESSION['id'];
 $TranscriptFile = '';
 
 
 
  // Count total files
 $Transcripts = count($_FILES['TranscriptFile']['name']);

 // Looping all files
 for($i=0;$i<$Transcripts;$i++){
	 
 
  $TranscriptFile = $_FILES['TranscriptFile']['name'][$i];
 
  	if (!file_exists('../../uploads/qualifications/'.$_SESSION["id"])) {
		mkdir('../../uploads/qualifications/'.$_SESSION["id"], 0777, true);
	}
	
   /* Location */
   $location = "../../uploads/qualifications/".$_SESSION["id"].'/'.$TranscriptFile;
   $imageFileType = pathinfo($location,PATHINFO_EXTENSION);
   $imageFileType = strtolower($imageFileType);

   /* Valid extensions */
   $valid_extensions = array("pdf","doc","docx");

   $response = 0;
   /* Check file extension */
   if(in_array(strtolower($imageFileType), $valid_extensions)) {
      /* Upload file */
	  move_uploaded_file($_FILES['TranscriptFile']['tmp_name'][$i],$location);

   }
 
 }
 
 $query = "INSERT INTO `Qualifications`(
 
  UserID,
  AcademicLevel,
  NameOfDegree,
  TitleOfResearchProject,
  Institution,
  Fulltime,
  Distinction,
  DateFirstRegistration,
  Completed,
  HighestCompletedQualification,
  Transcript,
  Status,
  Reason,
  AnticipatedDateCompletion) 
  VALUES('$ID',
  '$AcademicLevel',
  '$NameOfDegree',
  '$TitleOfResearchProject',
  '$Institution',
  '$Fulltime',
  '$Distinction',
  '$DateFirstRegistration',
  '$Completed',
  '$HighestCompletedQualification',
  '$TranscriptFile',
  '$Status',
  '$Reason',
  '$AnticipatedDateCompletion')";

 if(mysqli_query($conn,$query))
 {
  echo 'Data Inserted';
  $checklist = "INSERT INTO ApplicantChecklist(UserID, Section)VALUES('$ID','Qualifications')";
  mysqli_query($conn, $checklist);
 }else{
	 echo 'Data Not Inserted';
 }
}else{
	echo 'Data Not Inserted due to missing information';
}
CloseCon($conn);
?>