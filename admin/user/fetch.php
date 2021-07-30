<?php

include '../connect.php';
$conn = OpenCon();

$columns = array('FirstName');

$query = "SELECT b.Title, a.Initials, a.FirstName, a.LastName, a.IDNumber, e.MobileNumber, e.TelephoneNumber, c.Name as Institution, d.Email FROM `RegistrationDetails` a
left join UserContactDetails e on e.UserID = a.UserID
left join LookupUserTitle b on b.ID = a.Title
left join LookupInstitutions c on c.InstitutionId = e.CurrentOrganisation 
left join users d on d.UserID = a.UserID
WHERE a.UserID = '".$_SESSION["id"]."'";


$query = "SELECT * FROM LookupInstitutions

WHERE InstitutionId = '".$_POST["InstitutionID"]."'";

$result = mysqli_query($conn,$query);
$row = mysqli_fetch_array($result);
$data = array();


if(isset($_POST["CallID"]) && isset($_POST["InstitutionID"]))
{

	echo '<input type="hidden" id="CALLID" class="form-control" name="CALLID" value="' . $_POST["CallID"] . '">';
	echo '<input type="hidden" id="InstitutionID" class="form-control" name="InstitutionID" value="' . $_POST["InstitutionID"] . '">';
	echo '<div class="row">
											<table>
											<tr>
												<td>Institution</td>
												<td>'.$row["Name"].'</td>
											</tr>
											
											</table>

                                            </div>';
	
			
			exit;
}







function get_all_data($conn)
{
 $query = "SELECT b.Title, a.Initials, a.FirstName, a.LastName, a.IDNumber, a.MobileNumber, a.Telephone, c.Name as Institution, d.Email FROM `RegistrationDetails` a
left join LookupUserTitle b on b.ID = a.Title
left join LookupInstitutions c on c.InstitutionId = a.CurrentOrganisation 
left join user d on d.UserID = a.UserID
WHERE a.UserID = '".$_SESSION["id"]."'";
 $result = mysqli_query($conn,$query);
 return $result->num_rows;
}

$output = array(
 "draw"    => intval(@$_POST["draw"]),
 "recordsTotal"  =>  get_all_data($conn),
 "recordsFiltered" => $result->num_rows,
 "data"    => $data
);

echo json_encode($output);
CloseCon($conn);
?>