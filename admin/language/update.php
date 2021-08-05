<?php
include '../connect.php';
$conn = OpenCon();

if(isset($_POST["ID"]))
{

 $Language = mysqli_real_escape_string($conn,$_POST["Language"]);
 $Speak = mysqli_real_escape_string($conn,$_POST["Speak"]);
 $Read = mysqli_real_escape_string($conn,$_POST["Read"]);
 $Write = mysqli_real_escape_string($conn,$_POST["Write"]);
 
 $query = "UPDATE `LanguageProficiency` SET 
 Language='".$Language."',
 `Speak`='".$Speak."',
 `Read`='".$Read."',
 `Write`='".$Write."'
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