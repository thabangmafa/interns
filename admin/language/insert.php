<?php
include '../connect.php';
$conn = OpenCon();

if(isset($_POST["Language"], $_POST["Speak"], $_POST["Read"], $_POST["Write"]))
{
	
 $Language = mysqli_real_escape_string($conn,$_POST["Language"]);
 $Speak = mysqli_real_escape_string($conn,$_POST["Speak"]);
 $Read = mysqli_real_escape_string($conn,$_POST["Read"]);
 $Write = mysqli_real_escape_string($conn,$_POST["Write"]);
 $ID = $_SESSION['id'];
 
 $query = "INSERT INTO `LanguageProficiency`(UserID, `Language`, `Speak`, `Read`, `Write`) VALUES('$ID','$Language', '$Speak', '$Read', '$Write')";

 if(mysqli_query($conn,$query))
 {
  echo 'Data Inserted';
 }else{
	 echo 'Data Not Inserted';
 }
}else{
	echo 'Data Not Inserted due to missing information';
}
CloseCon($conn);
?>