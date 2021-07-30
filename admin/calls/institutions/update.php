<?php
include '../../connect.php';
$conn = OpenCon();

if(isset($_POST["ID"]))
{
$update = '';
 $BudgetYear = mysqli_real_escape_string($conn,$_POST["BudgetYear"]);
 $Title = mysqli_real_escape_string($conn,$_POST["Title"]);
 $Description = mysqli_real_escape_string($conn,$_POST["Description"]);
 $OpenDate = mysqli_real_escape_string($conn,$_POST["OpenDate"]);
 $ClosingDate = mysqli_real_escape_string($conn,$_POST["ClosingDate"]);
 $UpdatedBy = $_SESSION['id'];
 $status = mysqli_real_escape_string($conn,$_POST["IsActive"]);
 $HostSubmissionDueDate = mysqli_real_escape_string($conn,$_POST["HostSubmissionDueDate"]);
$InternsApplicationDueDate = mysqli_real_escape_string($conn,$_POST["InternsApplicationDueDate"]);
$InternshipStartDate = mysqli_real_escape_string($conn,$_POST["InternshipStartDate"]);
$InternshipEndDate = mysqli_real_escape_string($conn,$_POST["InternshipEndDate"]);

 
 if(isset($_FILES['HostRequirementsFile']['name'])){

   /* Getting file name */
   $HostRequirementsFile = $_FILES['HostRequirementsFile']['name'];
	
	
	if (!file_exists('../../../uploads/calls/'.$_POST["ID"])) {
		mkdir('../../../uploads/calls/'.$_POST["ID"], 0777, true);
	}
	
   /* Location */
   $location = "../../../uploads/calls/".$_POST["ID"].'/'.$HostRequirementsFile;
   $imageFileType = pathinfo($location,PATHINFO_EXTENSION);
   $imageFileType = strtolower($imageFileType);

   /* Valid extensions */
   $valid_extensions = array("pdf","doc","docx");

   $response = 0;
   /* Check file extension */
   if(in_array(strtolower($imageFileType), $valid_extensions)) {
      /* Upload file */
      if(move_uploaded_file($_FILES['HostRequirementsFile']['tmp_name'],$location)){
         $response = $location;
		 $update .= "HostRequirementsFile='".$HostRequirementsFile."',";
      }
   }

}
 

 if(isset($_FILES['ApplicantRequirementsFile']['name'])){
	
   /* Getting file name */
   $ApplicantRequirementsFile = $_FILES['ApplicantRequirementsFile']['name'];
	
	if (!file_exists('../../../uploads/calls/'.$_POST["ID"])) {
		mkdir('../../../uploads/calls/'.$_POST["ID"], 0777, true);
	}
   /* Location */
   $location = "../../../uploads/calls/".$_POST["ID"].'/'.$ApplicantRequirementsFile;
   $imageFileType = pathinfo($location,PATHINFO_EXTENSION);
   $imageFileType = strtolower($imageFileType);

   /* Valid extensions */
   $valid_extensions = array("pdf","doc","docx");

   $response = 0;
   /* Check file extension */
   if(in_array(strtolower($imageFileType), $valid_extensions)) {
      /* Upload file */
      if(move_uploaded_file($_FILES['ApplicantRequirementsFile']['tmp_name'],$location)){
         $response = $location;
		 $update .= "ApplicantRequirementsFile='".$ApplicantRequirementsFile."',";
      }
   }

}

$query = "UPDATE `HostInstitutionCalls` SET 
 BudgetYear='".$BudgetYear."',
 Title='".$Title."',
 Description='".$Description."',
 OpenDate='".$OpenDate."',
 ClosingDate='".$ClosingDate."',
 ".$update."
 UpdatedBy='".$UpdatedBy."',
 IsActive='".$status."',
 HostSubmissionDueDate='".$HostSubmissionDueDate."',
	InternsApplicationDueDate='".$InternsApplicationDueDate."',
	InternshipStartDate='".$InternshipStartDate."',
	InternshipEndDate='".$InternshipEndDate."'
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