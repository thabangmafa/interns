<?php
include '../connect.php';
$conn = OpenCon();

if(isset($_POST["ID"]))
{

 $AcademicLevel = mysqli_real_escape_string($conn,$_POST["AcademicLevel"]);
  $NameOfDegree = mysqli_real_escape_string($conn,$_POST["NameOfDegree"]);
  $TitleOfResearchProject = mysqli_real_escape_string($conn,$_POST["TitleOfResearchProject"]);
  $Institution = mysqli_real_escape_string($conn,$_POST["Institution"]);
  $Fulltime = mysqli_real_escape_string($conn,$_POST["Fulltime"]);
  $Distinction = mysqli_real_escape_string($conn,$_POST["Distinction"]);
  $Sector = mysqli_real_escape_string($conn,$_POST["Sector"]);
  $DateFirstRegistration = mysqli_real_escape_string($conn,$_POST["DateFirstRegistration"]);
  $Completed = mysqli_real_escape_string($conn,$_POST["Completed"]);
  $HighestCompletedQualification = mysqli_real_escape_string($conn,$_POST["HighestCompletedQualification"]);
  $Transcript = mysqli_real_escape_string($conn,$_POST["Transcript"]);
  $Status = mysqli_real_escape_string($conn,$_POST["Status"]);
  $Reason = mysqli_real_escape_string($conn,$_POST["Reason"]);
  $AnticipatedDateCompletion = mysqli_real_escape_string($conn,$_POST["AnticipatedDateCompletion"]);
  
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
 
 $query = "UPDATE `Qualifications` SET 
  AcademicLevel='".$AcademicLevel."',
  NameOfDegree='".$NameOfDegree."',
  TitleOfResearchProject='".$TitleOfResearchProject."',
  Institution='".$Institution."',
  Fulltime='".$Fulltime."',
  Distinction='".$Distinction."',
  Sector='".$Sector."',
  DateFirstRegistration='".$DateFirstRegistration."',
  Completed='".$Completed."',
  HighestCompletedQualification='".$HighestCompletedQualification."',
  Transcript='".$Transcript."',
  Status='".$Status."',
  Reason='".$Reason."',
  AnticipatedDateCompletion='".$AnticipatedDateCompletion."'
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