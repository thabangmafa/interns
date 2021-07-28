<?php

include '../connect.php';
$conn = OpenCon();

$columns = array('FirstName');

$query = "SELECT b.Title, a.Initials, a.FirstName, a.LastName, a.IDNumber, a.MobileNumber, a.Telephone, c.Name as Institution, d.Email FROM `RegistrationDetails` a
left join LookupUserTitle b on b.ID = a.Title
left join LookupInstitutions c on c.InstitutionId = a.CurrentOrganisation 
left join users d on d.UserID = a.UserID
WHERE a.UserID = '".$_SESSION["id"]."'";

$result = mysqli_query($conn,$query);
$row = mysqli_fetch_array($result);
$data = array();


if(isset($_POST["rowid"]))
{

	echo '<input type="hidden" id="CALLID" class="form-control" name="CALLID" value="' . $_POST["rowid"] . '">';
	echo '<div class="row">
											<table>
											<tr>
												<td>Title</td>
												<td>'.$row["Title"].'</td>
											</tr>
											<tr>
												<td>Surname</td>
												<td>'.$row["LastName"].'</td>
											</tr>
											<tr>
												<td>Initials</td>
												<td>'.$row["Initials"].'</td>
											</tr>
											<tr>
												<td>First Name</td>
												<td>'.$row["FirstName"].'</td>
											</tr>
											<tr>
												<td>ID/Passport Number</td>
												<td>'.$row["IDNumber"].'</td>
											</tr>
											<tr>
												<td>Primary Email Address</td>
												<td>'.$row["Email"].'</td>
											</tr>
											<tr>
												<td>Mobile Number</td>
												<td>'.$row["MobileNumber"].'</td>
											</tr>
											<tr>
												<td>Primary Telephone Number</td>
												<td>'.$row["Telephone"].'</td>
											</tr>
											<tr>
												<td>Current Organisation</td>
												<td>'.$row["Institution"].'</td>
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