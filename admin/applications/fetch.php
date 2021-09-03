<?php

include '../connect.php';
$conn = OpenCon();

$query = 'SELECT a.ID, CONCAT("DSI/HSRC/2021/", a.CallID,"/", a.UserID) as Reference, c.Title,r.Race,p.Citizenship	,q.Gender,b.FirstName,b.DateOfBirth,m.PrimaryEmail, o.Title as CallTitle,o.OpenDate, o.ClosingDate, b.Initials,b.LastName,b.IDNumber,b.PassportNumber, CONCAT("1st: ", e.Name, " (" , j.Name, ")", "<br />2nd: ", f.Name, " (" , k.Name, ")", "<br />3rd: ", g.Name, " (" , l.Name, ")" ) as Discipline, GROUP_CONCAT(DISTINCT  h.NameOfDegree SEPARATOR "<br />") NameOfDegree, a.Status, j.Name FROM UserApplications a 
																left join RegistrationDetails b on b.UserID = a.UserID
																left join LookupUserTitle c on c.ID = b.TItle
																left join PositionAppliedFor d on d.UserID = a.UserID
																Left join LookupDisciplines e on e.ID = d.FirstDiscipline
																Left join LookupDisciplines f on f.ID = d.SecondDiscipline
																Left join LookupDisciplines g on g.ID = d.ThirdDiscipline
																left join Qualifications h on h.UserID = a.UserID
																left join RegistrationDetails i on i.UserID = a.UserID
                                                                left join LookupProvince j on j.ID = d.FirstProvince
                                                                left join LookupProvince k on k.ID = d.SecondProvince
                                                                left join LookupProvince l on l.ID = d.ThirdProvince
																left join UserContactDetails m on m.UserID = a.UserID
																left join HostInstitutionCalls o on o.ID = a.CallID
																left join LookupCitizenshipStatus p on p.ID = b.Citizenship	
																left join LookupGender q on q.ID = b.Gender
																left join LookupRace r on r.ID = b.Race																
																';



if(isset($_POST["rowid"]))
{
 $query .= '
 WHERE a.ID = "'.$_POST["rowid"].'" ';
}


$result = mysqli_query($conn,$query);


$data = array();

if(isset($_POST["rowid"]) && $_POST["rowid"] != '000')
{
	while($row = mysqli_fetch_array($result))
	{
		echo '<div class="row table-responsive">';
		
		echo '<table class="mb-0">';
					
			echo '<tbody>';
				echo '<tr>';
					echo '<th>Application</th>';
					echo '<td>'.$row['CallTitle'].'</td>';
				echo '</tr>';
				
				echo '<tr>';
					echo '<th>Call Start Date</th>';
					echo '<td>'.$row['OpenDate'].'</td>';
				echo '</tr>';
				
				echo '<tr>';	
					echo '<th>Call End Date</th>';
					echo '<td>'.$row['ClosingDate'].'</td>';
				echo '</tr>';
				
				echo '<tr>';	
					echo '<th>Application Reference</th>';
					echo '<td>'.$row['Reference'].'</td>';
				echo '</tr>';
				
				echo '<tr>';	
					echo '<th>Applicant Name</th>';
					echo '<td>'.$row['Title'] . ' ' . $row['Initials'] . ' ' .$row['FirstName'] . ' ' .$row['LastName'] .'</td>';
				echo '</tr>';
				
				echo '<tr>';	
					echo '<th>Applicant ID/Passport Number</th>';
					echo '<td>'.$row['IDNumber'].$row['PassportNumber'].'</td>';
				echo '</tr>';
				
				echo '<tr>';	
					echo '<th>Applicant Email Address</th>';
					echo '<td>'.$row['PrimaryEmail'].'</td>';
				echo '</tr>';
				
				echo '<tr>';	
					echo '<th>Applicant Race</th>';
					echo '<td>'.$row['Race'].'</td>';
				echo '</tr>';
				
				echo '<tr>';	
					echo '<th>Applicant Gender</th>';
					echo '<td>'.$row['Gender'].'</td>';
				echo '</tr>';
				
				echo '<tr>';	
					echo '<th>Applicant Date of Birth</th>';
					echo '<td>'.$row['DateOfBirth'].'</td>';
				echo '</tr>';
				
				echo '<tr>';	
					echo '<th>Applicant Citizenship</th>';
					echo '<td>'.$row['Citizenship'].'</td>';
				echo '</tr>';
				
			echo '</tbody>';
		echo '</table>';
		echo '<div class="alert alert-info" style="margin-top: 2%; margin-bottom: 2%;">Alternate Contact Person in Institution.</div>';
		echo '</div>';
		
	}
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