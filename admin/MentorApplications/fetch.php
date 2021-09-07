<?php

include '../connect.php';
$conn = OpenCon();

$query = 'SELECT distinct l.EmploymentStatus,l.Position, l.EmployedFromDate,l.EmployedToDate, m.Name as InstitutionType, n.Name as Institution,
i.DepartmentSchoolInstitution,Faculty,WorkPostalAddress, WorkCityTown, WorkPostalCode,j.Name as Province,TelephoneNumber,MobileNumber, k.Country,
b.UserID,c.IDDocument,a.Email,d.Title, c.Initials,g.Gender,c.DateOfBirth, c.FirstName, c.LastName, c.IDNumber, c.PassportNumber, c.HostedInternsBefore, e.Race, h.Citizenship FROM ProspectiveMentors a 
left join users b on lower(b.Email) = lower(a.Email)
left join RegistrationDetails c on c.UserID = b.UserID
left join LookupUserTitle d on d.ID = c.Title
left join LookupRace e on e.ID = c.Race
left join LookupGender g on g.ID = c.Gender
left join LookupCitizenshipStatus h on h.ID = c.Citizenship
left join UserContactDetails i on i.UserID = b.UserID
left join LookupProvince j on j.ID = i.WorkProvince	
left join LookupCountry k on k.ID = i.WorkCountry
left join EmploymentDetails l on l.UserID = b.UserID
left join LookupOrganisationType m on m.ID = l.Type
left join LookupInstitutions n on n.InstitutionId = l.Organization
 WHERE a.ID = "'.$_POST["rowid"].'"';


$result = mysqli_query($conn,$query);


$query = 'SELECT distinct c.Name as AcademicLevel, b.NameOfDegree 
FROM `ProspectiveMentors` a 
left join users d on lower(d.Email) = lower(a.Email)
left join Qualifications b on b.UserID = d.UserID
left join LookupQualificationLevel c on c.ID = b.AcademicLevel
 WHERE a.ID = "'.$_POST["rowid"].'"';

$Qualifications = mysqli_query($conn,$query);

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
					echo '<th>Mentor Name</th>';
					echo '<td>'.@$row['Title'] . ' ' . @$row['Initials'] . ' ' .@$row['FirstName'] . ' ' .@$row['LastName'] .'</td>';
				echo '</tr>';
				
				echo '<tr>';	
					echo '<th>ID/Passport Number</th>';
					echo '<td>'.@$row['IDNumber'].$row['PassportNumber'].'</td>';
				echo '</tr>';
				
				echo '<tr>';	
					echo '<th>ID/Passport Document</th>';
					echo '<td><a target="_blank" href="uploads/applicants/'.@$row['UserID'].'/'.@$row['IDDocument'].'">View ID/Passport Document</a></td>';
				echo '</tr>';
				
				echo '<tr>';	
					echo '<th>Race</th>';
					echo '<td>'.@$row['Race'].'</td>';
				echo '</tr>';
				
				echo '<tr>';	
					echo '<th>Gender</th>';
					echo '<td>'.@$row['Gender'].'</td>';
				echo '</tr>';
				
				echo '<tr>';	
					echo '<th>Date of Birth</th>';
					echo '<td>'.@$row['DateOfBirth'].'</td>';
				echo '</tr>';
				
				echo '<tr>';	
					echo '<th>Citizenship</th>';
					echo '<td>'.@$row['Citizenship'].'</td>';
				echo '</tr>';
				
				echo '<tr><td colspan="2"><div class="alert alert-info" style="margin-top: 2%; margin-bottom: 2%;">Contact Details.</div></td></tr>';
				
				echo '<tr>';
					echo '<th width="50%">Department/School/Institution</th>';
					echo '<td>'.@$row['DepartmentSchoolInstitution'].'</td>';
				echo '</tr>';
				
				echo '<tr>';
					echo '<th>Faculty</th>';
					echo '<td>'.@$row['Faculty'].'</td>';
				echo '</tr>';
				
				echo '<tr>';	
					echo '<th>Work Physical Address</th>';
					echo '<td>'.@$row['WorkPostalAddress'].'</td>';
				echo '</tr>';
				
				echo '<tr>';	
					echo '<th>Work City/Town</th>';
					echo '<td>'.@$row['WorkCityTown'].'</td>';
				echo '</tr>';
				
				echo '<tr>';	
					echo '<th>Work Postal Code</th>';
					echo '<td>'.@$row['WorkPostalCode'] .'</td>';
				echo '</tr>';
				
				echo '<tr>';	
					echo '<th>Work Province/State</th>';
					echo '<td>'.@$row['Province'].'</td>';
				echo '</tr>';
				
				echo '<tr>';	
					echo '<th>Work Country</th>';
					echo '<td>'.@$row['Country'].'</td>';
				echo '</tr>';
				
				echo '<tr>';	
					echo '<th>Telephone Number</th>';
					echo '<td>'.@$row['TelephoneNumber'].'</td>';
				echo '</tr>';
				
				echo '<tr>';	
					echo '<th>Mobile Number</th>';
					echo '<td>'.@$row['MobileNumber'].'</td>';
				echo '</tr>';
				
				echo '<tr>';	
					echo '<th>Email Address</th>';
					echo '<td>'.@$row['Email'].'</td>';
				echo '</tr>';
				
				
				echo '<tr><td colspan="2"><div class="alert alert-info" style="margin-top: 2%; margin-bottom: 2%;">Employment Details.</div></td></tr>';
				
				echo '<tr>';
					echo '<th width="50%">Employment Status</th>';
					echo '<td>'.@$row['EmploymentStatus'].'</td>';
				echo '</tr>';
				
				echo '<tr>';
					echo '<th>Position</th>';
					echo '<td>'.@$row['Position'].'</td>';
				echo '</tr>';
				if(@$row['EmploymentStatus'] != 'Permanent'){
				echo '<tr>';	
					echo '<th>Employed From Date</th>';
					echo '<td>'.@$row['EmployedFromDate'].'</td>';
				echo '</tr>';
				
				echo '<tr>';	
					echo '<th>Employed To Date</th>';
					echo '<td>'.@$row['EmployedToDate'].'</td>';
				echo '</tr>';
				}
				echo '<tr>';	
					echo '<th>Organization</th>';
					echo '<td>'.@$row['Institution'].'</td>';
				echo '</tr>';
				
				echo '<tr>';	
					echo '<th>Type of Institution</th>';
					echo '<td>'.@$row['InstitutionType'] .'</td>';
				echo '</tr>';
				
				
				
				
				
				
			echo '</tbody>';
		echo '</table>';
		
	}
	
		
		echo '<div class="alert alert-info" style="margin-top: 2%; margin-bottom: 2%;">Qualifications.</div>';
	echo '<table class="mb-0">';
	echo '<tbody>';
	//Qualifications
	
	
	while(@$Qual = mysqli_fetch_array(@$Qualifications))
	{
		
				echo '<tr>';
					echo '<th width="50%">Name Of Degree</th>';
					echo '<td>'.@$Qual['NameOfDegree'].'</td>';
				echo '</tr>';
				
				echo '<tr>';
					echo '<th>AcademicLevel</th>';
					echo '<td>'.@$Qual['AcademicLevel'].'</td>';
				echo '</tr>';
				
				echo '<tr>';
					echo '<td colspan="2"><hr /></td>';
					echo '</tr>';
				
			
	}
	echo '</tbody>';
		echo '</table>';
		
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