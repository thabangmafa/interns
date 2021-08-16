<?php

include '../connect.php';
$conn = OpenCon();


if(isset($_POST["section"]) && $_POST["section"] == 'HostAdministrator')
{
	$query = "
	SELECT a.ID, a.DateUpdated, c.Email, b.Name,d.FirstName,d.Initials, d.LastName, d.IDNumber, e.MobileNumber, e.TelephoneNumber FROM HostAdministrator a 
	left join users c on c.UserID = a.UserID 
	left join LookupInstitutions b on b.InstitutionId = a.InstitutionID and b.IsActive = '1'
	left join RegistrationDetails d on d.UserID = a.UserID
	left join UserContactDetails e on e.UserID = a.UserID
	WHERE a.ID = '".$_POST["rowid"]."'
	";
	
	$message = 'Host Administrator application details.';
}

if(isset($_POST["section"]) && $_POST["section"] == 'ProspectiveMentors')
{
	$query = "
	
	SELECT c.Email, UpdatedDate as DateUpdated, b.Name,d.FirstName,d.Initials, d.LastName, d.IDNumber, e.MobileNumber, e.TelephoneNumber FROM ProspectiveMentors a 
	left join users c on c.UserID = a.MentorID
	left join LookupInstitutions b on b.InstitutionId = a.InstitutionID and b.IsActive = '1'
	left join RegistrationDetails d on d.UserID = c.UserID
	left join UserContactDetails e on e.UserID = c.UserID	
	WHERE a.ID = '".$_POST["rowid"]."'
	";
	
	$message = 'Prospective Mentor application details.';
}

if(isset($_POST["section"]) && $_POST["section"] == 'HostApplications')
{
	$query = "
	SELECT c.Email, ApplicationDate as DateUpdated, b.Name,d.FirstName,d.Initials, d.LastName, d.IDNumber, e.MobileNumber, e.TelephoneNumber FROM HostApplications a
		left join users c on c.UserID = a.UserID
	left join LookupInstitutions b on b.InstitutionId = a.InstitutionID and b.IsActive = '1'
	left join RegistrationDetails d on d.UserID = c.UserID
	left join UserContactDetails e on e.UserID = c.UserID	
	WHERE a.ID = '".$_POST["rowid"]."'";
	
	$message = 'Host Institution application details.';
}


$result = mysqli_query($conn,$query);
	
$data = array();



if(isset($_POST["rowid"]) && $_POST["rowid"] != '000')
{
	



	while($row = mysqli_fetch_array($result))
	{
		echo '<h5>'.$message.'</h5>';
		echo '<hr />';
		echo '<input type="hidden" id="ID" class="form-control" name="ID" value="' . @$_POST["rowid"] . '">';
		echo '<input type="hidden" id="Table" class="form-control" name="Table" value="' . @$_POST["section"] . '">';
		echo '<input type="hidden" id="institutionid" class="form-control" name="institutionid" value="' . @$_POST["institutionid"] . '">';
		echo '<input type="hidden" id="callid" class="form-control" name="callid" value="' . @$_POST["callid"] . '">';
		echo '<div class="row col px-md-3">
											<table>
											
											
											<tr>
												<td>Initials</td>
												<td>'.$row["Initials"].'</td>
											</tr>
											<tr>
												<td>First Name</td>
												<td>'.$row["FirstName"].'</td>
											</tr>
											<tr>
												<td>Surname</td>
												<td>'.$row["LastName"].'</td>
											</tr>
											<tr>
												<td>ID/Passport Number</td>
												<td>'.@$row["IDNumber"].'</td>
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
												<td>'.$row["TelephoneNumber"].'</td>
											</tr>
											<tr>
												<td>Institution</td>
												<td>'.$row["Name"].'</td>
											</tr>
											</table>
											
											
                                            </div>';
	}
	exit;
}



function get_all_data($conn)
{
 $query = "SELECT a.ID, a.DateUpdated, c.Email, b.Name,d.FirstName,d.Initials, d.LastName, d.IDNumber, e.MobileNumber, e.TelephoneNumber FROM HostAdministrator a 
left join users c on c.UserID = a.UserID 
left join LookupInstitutions b on b.InstitutionId = a.InstitutionID and b.IsActive = '1'
left join RegistrationDetails d on d.UserID = a.UserID
left join UserContactDetails e on d.UserID = a.UserID
WHERE a.ID = '".$_POST["rowid"]."'
";

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