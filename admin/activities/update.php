<?php
include '../connect.php';
$conn = OpenCon();

if(isset($_POST["ID"]) && isset($_POST["Table"]))
{

 $Table = mysqli_real_escape_string($conn,$_POST["Table"]);
 
 $query = "UPDATE ".$Table." SET 
 Status='".$_GET['action']."'
 WHERE ID = '".$_POST["ID"]."'";

 mysqli_query($conn,$query);
 
 if($Table == 'HostApplications')
{


 $query = "INSERT INTO CallInstitutionLink (CallID, InstitutionID, Status)VALUES('".$_POST["callid"]."','".$_POST["institutionid"]."', 'Actve')";
 mysqli_query($conn,$query);
 
}
 
 
}


CloseCon($conn);
?>