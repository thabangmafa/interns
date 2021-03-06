<?php

include '../connect.php';
$conn = OpenCon();

$query = "SELECT a.InstitutionID, WorkPostalAddress, WorkCityTown, WorkPostalCode, TelephoneNumber, PrimaryEmail, b.Name FROM HostInstitutionDetails a 
left join LookupInstitutions b on b.InstitutionId = a.InstitutionID 
left join UserContactDetails C on C.CurrentOrganisation = a.InstitutionID 
WHERE a.InstitutionID = '".$_POST['InstitutionID']."' and C.UserID = '".$_SESSION['id']."'";


$result = mysqli_query($conn,$query);
$row = mysqli_fetch_array($result);
$data = array();


if(isset($_POST["CallID"]))
{

	echo '<input type="hidden" id="CALLID" class="form-control" name="CALLID" value="' . $_POST["CallID"] . '">';
	echo '<input type="hidden" id="InstitutionID" class="form-control" name="InstitutionID" value="' . $_POST["InstitutionID"] . '">';
	echo '<div class="row">
				<table>
				<tr>
					<td>Institution</td>
					<td>'.$row["Name"].'</td>
				</tr>
				<tr>
					<td>Address</td>
					<td>'.$row["WorkPostalAddress"].'</td>
				</tr>
				<tr>
					<td>City/Town</td>
					<td>'.$row["WorkCityTown"].'</td>
				</tr>
				<tr>
					<td>Postal Code</td>
					<td>'.$row["WorkPostalCode"].'</td>
				</tr>
				<tr>
					<td>Telephone Number</td>
					<td>'.$row["TelephoneNumber"].'</td>
				</tr>
				<tr>
					<td>Primary Email</td>
					<td>'.$row["PrimaryEmail"].'</td>
				</tr>
				
				</table>
				
				
				</div>';
	
			
			exit;
}







function get_all_data($conn)
{
 $query = "SELECT b.Name FROM HostInstitutionDetails a
left join LookupInstitutions b on b.InstitutionId = a.InstitutionID
WHERE a.InstitutionID = '".$_POST['InstitutionID']."'";

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