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
a.Resources,
a.InstitutionID


FROM `HostInstitutionDetails` a 
left join LookupInstitutions b on b.InstitutionId = a.InstitutionID
left join LookupCategoriseInstitution c on c.ID = a.CategoriseInstitution
left join HostApplications i on i.InstitutionID = a.InstitutionID
left join UserContactDetails d on d.UserID = i.UserID
left join RegistrationDetails g on g.UserID = i.UserID
left join LookupUserTitle h on h.ID = g.Title
left join LookupProvince e on e.ID = d.WorkProvince
left join LookupCountry f on f.ID = d.WorkCountry
where a.InstitutionID = "'.$_POST["rowid"].'"';


$result = mysqli_query($conn,$query);




$query = 'SELECT distinct a.InstitutionID,a.Allocated,a.ID,b.Name as PrimaryScientificField, c.Name as SecondaryScientificField, a.NumberRequired, d.Name as QualificationLevel, e.Name as Location FROM `ProfileOfRequestedInterns` a 
left join LookupStudyField b on b.ID = a.PrimaryScientificField
left join LookupStudyField c on c.ID = a.SecondaryScientificField
left join LookupQualificationLevel d on d.ID = a.QualificationLevel
left join LookupProvince e on e.ID = a.Location
 WHERE a.InstitutionID = "'.$_POST["rowid"].'" order by QualificationLevel, Location';

$RequestedInterns = mysqli_query($conn,$query);

$query = 'SELECT distinct Comments FROM `HostApplications`
 WHERE InstitutionID = "'.$_POST["rowid"].'"';

$Comments = mysqli_query($conn,$query);

$query = 'SELECT count(Email) Mentors FROM `ProspectiveMentors`
 WHERE InstitutionID = "'.$_POST["rowid"].'" AND Status = "Approved"';

$Mentors = mysqli_query($conn,$query);
$Mentor = mysqli_fetch_assoc($Mentors);
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


				$query = "SELECT distinct * FROM LookupResources WHERE IsActive = '1' ORDER BY Resource asc";
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
	
	echo '<div class="alert alert-info" style="margin-top: 2%; margin-bottom: 2%;">Profile of Requested Interns.
	<a href="mentors-review.php?id='.@$_POST["rowid"].'" style="float:right" class="btn btn-danger">
                                            Approved Mentors <span class="badge bg-transparent">'.$Mentor['Mentors'].'</span>
                                        </a></div>';
	echo '<table class="mb-0" style="width:100%">';
	echo '<tbody>';
										
		echo '<tr>';
					echo '<th>Primary Scientific Field</th>';
					echo '<th>Secondary Scientific Field</th>';
					echo '<th>Number Required</th>';
					echo '<th>Qualification Level</th>';
					echo '<th>Location</th>';
					echo '<th>Allocation</th>';
				echo '</tr>';
echo '<tr><td colspan="6"><hr /></td></tr>';
echo '<input type="hidden" name="InstitutionID" id="InstitutionID" value="'.@$_POST["rowid"].'" />';
$total = 0;
$totalAllocated = 0;
	while(@$Requested = mysqli_fetch_array(@$RequestedInterns))
	{
			$total = $total + @$Requested['NumberRequired'];
			$totalAllocated = $totalAllocated + @$Requested['Allocated'];
				echo '<tr>';
					echo '<td>'.@$Requested['PrimaryScientificField'].'</td>';
					echo '<td>'.@$Requested['SecondaryScientificField'].'</td>';
					echo '<td>'.@$Requested['NumberRequired'].'</td>';
					echo '<td>'.@$Requested['QualificationLevel'].'</td>';
					echo '<td>'.@$Requested['Location'].'</td>';
					echo '<td><select class="choices form-select" name="allocation[]" id="allocation">';
					for($i=0;$i<=@$Requested['NumberRequired'];$i++){
						@$selected = '';
						if(@$Requested['Allocated'] == @$i){ @$selected = 'selected="selected"';}
							echo '<option value="'.@$Requested['ID'].'~'.@$i.'" '.@$selected.'>'.@$i.'</option>';
					}
						echo '</select></td>';
				echo '</tr>';
				
				
				
			
	}
	echo '<tr>';
					echo '<td></td>';
					echo '<td></td>';
					echo '<td class="btn btn-success">Total Requested <span class="badge bg-transparent">'.@$total.'</span></td>';
					echo '<td></td>';
					echo '<td></td>';
					echo '<td class="btn btn-success">Total Allocated <span class="badge bg-transparent">'.@$totalAllocated.'</span>></td>';
				echo '</tr>';
	echo '<tr><td colspan="6"><hr /></td></tr>';
	
	
	while(@$Comment = mysqli_fetch_array(@$Comments))
	{
		echo '<tr><td colspan="6">Comments<textarea class="form-control" id="Comments" name="Comments" rows="3" style="width:100%" placeholder="Type any comments here...">'.@$Comment['Comments'].'</textarea></td></tr>'; 
	}		
	echo '</tbody>';
		echo '</table>';
	
	echo '</div>';
	exit;
}






function get_all_data($conn)
{
 $query = "SELECT distinct a.*, b.*,c.Status, e.*, d.ID FROM `LookupInstitutions` a 
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