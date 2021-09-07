<?php

include '../connect.php';
$conn = OpenCon();

$query = 'SELECT distinct
a.HostedInternsBefore, 
NumberEmployed,
NumberHosted, 
HostedYear, 
e.Name as Province, 
SufficientResources,
TaxPin,
InstitutionRegistrationCertificate,
c.Category, 
b.Name as Institution,
h.Title,
g.Initials,
g.FirstName,
g.LastName,
d.WorkPostalAddress, 
d.WorkCityTown,
d.WorkPostalCode,
d.PrimaryEmail, 
d.TelephoneNumber,
d.MobileNumber,
d.AlternativeEmail, 
d.AlternateContactName, 
d.AlternateContactEmail, 
d.AlternateContactDesignation, 
d.AlternateContactTelephone, 
d.AlternateContactCellphone,
f.Country,
a.Resources

FROM `HostInstitutionDetails` a 
left join LookupInstitutions b on b.InstitutionId = a.InstitutionID
left join LookupCategoriseInstitution c on c.ID = a.CategoriseInstitution
left join UserContactDetails d on d.UserID = a.UpdatedBy
left join RegistrationDetails g on g.UserID = a.UpdatedBy
left join LookupUserTitle h on h.ID = g.Title
left join LookupProvince e on e.ID = d.WorkProvince
left join LookupCountry f on f.ID = d.WorkCountry
where a.InstitutionID = "'.$_POST["rowid"].'"';


$result = mysqli_query($conn,$query);

$data = array();

if(isset($_POST["rowid"]) && $_POST["rowid"] != '000')
{
	echo '<div class="row table-responsive">';
	//Registration Details
	while($row = mysqli_fetch_array($result))
	{

		echo '<table class="mb-0">';
					
			echo '<tbody>';
				
				echo '<tr>';	
					echo '<th style="width:30%">Name of Institution</th>';
					echo '<td>'.@$row['Institution'] .'</td>';
				echo '</tr>';
				
				echo '<tr>';	
					echo '<th>Categorise Institution</th>';
					echo '<td>'.@$row['Category'].'</td>';
				echo '</tr>';
				
				echo '<tr>';	
					echo '<th>Previously hosted DSI/NRF interns</th>';
					echo '<td>'.@$row['HostedInternsBefore'].'</td>';
				echo '</tr>';
				
				echo '<tr>';	
					echo '<th>Have sufficient or adequate resources</th>';
					echo '<td>'.@$row['SufficientResources'].'</td>';
				echo '</tr>';
				
				
														
				$res = explode(',',@$row['Resources']);


				$query = "SELECT * FROM LookupResources WHERE IsActive = '1' ORDER BY Resource asc";
				$result = mysqli_query($conn, $query);
				
				echo '<tr>';	
					echo '<th>Available resources</th>';
					echo '<td>';
				while($resource = mysqli_fetch_array($result)) {
						@$resou .= ucwords($resource['Resource']) . ', ';
				}
					echo rtrim(@$resou,',');
					echo '</td>';
				echo '</tr>';
													
				
				echo '<tr>';	
					echo '<th>Tax Pin</th>';
					echo '<td><a target="_blank" href="uploads/institution/'.@$row['InstitutionID'].'/'.@$row['TaxPin'].'">View Tax Pin</a></td>';
				echo '</tr>';
				
				echo '<tr>';	
					echo '<th>Registration Certificate</th>';
					echo '<td><a target="_blank" href="uploads/institution/'.@$row['InstitutionID'].'/'.@$row['InstitutionRegistrationCertificate'].'">View Registration Certificate</a></td>';
				echo '</tr>';
				
				echo '<tr>';	
					echo '<th>Physical Address</th>';
					echo '<td>'.@$row['WorkPostalAddress'].'</td>';
				echo '</tr>';
				
				echo '<tr>';	
					echo '<th>City/Town</th>';
					echo '<td>'.@$row['WorkCityTown'].'</td>';
				echo '</tr>';
				
				echo '<tr>';	
					echo '<th>Postal Code</th>';
					echo '<td>'.@$row['WorkPostalCode'] .'</td>';
				echo '</tr>';
				
				echo '<tr>';	
					echo '<th>Province/State</th>';
					echo '<td>'.@$row['Province'].'</td>';
				echo '</tr>';
				
				echo '<tr>';	
					echo '<th>Country</th>';
					echo '<td>'.@$row['Country'].'</td>';
				echo '</tr>';
				
				
				echo '<tr><td colspan="2"><div class="alert alert-info" style="margin-top: 2%; margin-bottom: 2%;">Contact Details.</div></td></tr>';
				
				echo '<tr>';	
					echo '<th>Primary Contat Person</th>';
					echo '<td>'.@$row['Title'] . ' ' . @$row['Initials'] . ' ' .@$row['FirstName'] . ' ' .@$row['LastName'] .'</td>';
				echo '</tr>';
				
				echo '<tr>';
					echo '<th>Primary Email</th>';
					echo '<td>'.@$row['PrimaryEmail'].'</td>';
				echo '</tr>';
				
				echo '<tr>';
					echo '<th>Primary Alternative Email</th>';
					echo '<td>'.@$row['AlternativeEmail'].'</td>';
				echo '</tr>';
				
				
				
				echo '<tr>';	
					echo '<th>Primary Telephone Number</th>';
					echo '<td>'.@$row['TelephoneNumber'].'</td>';
				echo '</tr>';
				
				echo '<tr>';	
					echo '<th>Primary Mobile Number</th>';
					echo '<td>'.@$row['MobileNumber'].'</td>';
				echo '</tr>';
				
				echo '<tr><td colspan="2"><hr /></td></tr>';
				
				echo '<tr>';	
					echo '<th>Alternative Contact Person</th>';
					echo '<td>'.@$row['AlternateContactName'] .'</td>';
				echo '</tr>';
				
				echo '<tr>';	
					echo '<th>Alternative Contact Email</th>';
					echo '<td>'.@$row['AlternateContactEmail'].'</td>';
				echo '</tr>';
				
				echo '<tr>';	
					echo '<th>Alternative Contact Designation</th>';
					echo '<td>'.@$row['AlternateContactDesignation'].'</td>';
				echo '</tr>';
				
				echo '<tr>';	
					echo '<th>Alternative Contact Telephone</th>';
					echo '<td>'.@$row['AlternateContactTelephone'].'</td>';
				echo '</tr>';
				
				echo '<tr>';	
					echo '<th>Alternative Contact Mobile</th>';
					echo '<td>'.@$row['AlternateContactCellphone'].'</td>';
				echo '</tr>';
				

			echo '</tbody>';
		echo '</table>';
		
	}
	
	echo '</div>';
	exit;
}






function get_all_data($conn)
{
 $query = "SELECT a.*, b.*,c.Status, e.*, d.ID FROM `LookupInstitutions` a 
left join `LookupOrganisationType` b on b.`ID` = a.`InstitutionTypeId`
left join `LookupIsActive` c on c.`StatusId` = a.`IsActive`
left join HostAdministrator d on d.InstitutionID = a.InstitutionId
left join users e on e.UserId = d.UserID";
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