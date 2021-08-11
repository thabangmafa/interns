<?php

include '../connect.php';
$conn = OpenCon();


$query = "SELECT * FROM ApplicantChecklist 	
	WHERE (UserID = '".$_SESSION['id']."' OR InstitutionID = '".$_POST["rowid"]."')";

	$result = mysqli_query($conn, $query);
	
	
	while($details = mysqli_fetch_array($result)) {
		if($details['Section'] == 'Contact Details'){
			$ContactDetails = 1;
		}
		
		if($details['Section'] == 'Employment Details'){
			$EmploymentDetails = 1;
		}
		
		if($details['Section'] == 'Language Proficiency'){
			$LanguageProficiency = 1;
		}
		
		if($details['Section'] == 'Next Of Kin'){
			$NextOfKin = 1;
		}
		
		if($details['Section'] == 'Position Applied For'){
			$PositionAppliedFor = 1;
		}
		
		if($details['Section'] == 'Personal Profile'){
			$PersonalProfile = 1;
		}
		
		if($details['Section'] == 'Qualifications'){
			$Qualifications = 1;
		}
		
		if($details['Section'] == 'Registration Details'){
			$RegistrationDetails = 1;
		}
		
		if($details['Section'] == 'References'){
			$References = 1;
		}
		
		if($details['Section'] == 'Host Institution'){
			$HostInstitution = 1;
		}
		
		if($details['Section'] == 'Prospective Mentors and Required Intern Profile'){
			$ProspectiveMentorsandRequiredInternProfile = 1;
		}
		
		if($details['Section'] == 'Profile of Requested Interns'){
			$ProfileofRequestedInterns = 1;
		}
		

		
	}
	
	$Total = @$ContactDetails + @$EmploymentDetails + @$LanguageProficiency + @$NextOfKin + @$PositionAppliedFor + @$PersonalProfile + @$Qualifications + @$RegistrationDetails + @$References + @$HostInstitution + @$ProspectiveMentorsandRequiredInternProfile + @$ProfileofRequestedInterns;



$columns = array('FirstName');

$query = "SELECT HostInstitutionCalls.*, d.* FROM HostInstitutionCalls 
										left join `CallInstitutionLink` d on d.CallID = HostInstitutionCalls.ID 
										WHERE d.ID != '' AND d.InstitutionID is not null and
										HostInstitutionCalls.IsActive = 1
										AND HostRequirementsFile != '' 
										AND HostRequirementsFile IS NOT NULL 
										AND ApplicantRequirementsFile != '' 
										AND ApplicantRequirementsFile IS NOT NULL 
										AND `ClosingDate` >= CURDATE()
										AND d.Status = 'Active'
										AND InstitutionID != '".$_POST["rowid"]."'";

$result = mysqli_query($conn,$query);
$data = array();


if(isset($_POST["rowid"]) and $_POST["rowid"] != 'N/A')
{
										echo '<table class="table table-striped" id="table1">
												<thead>
													<tr>
														<th>Title</th>
														<th>Description</th>
														<th>Open Date</th>
														<th>Closing Date</th>
														<th>Requirements Document</th>
														<th>Create</th>
													</tr>
												</thead>
												<tbody>'; 

										while($calls = mysqli_fetch_array($result)) {
											
										$appReq = 'No Document';
										 if($calls["HostRequirementsFile"]){
											 $appReq = '<a target="_blank" href="uploads/calls/'.$calls["ID"].'/'.$calls["HostRequirementsFile"].'">Open Document</a>';
										 }	
										 
										 
										 
										
										 
										echo '<tr>';
											 echo '<td>' . $calls['Title'] . '</td>';
											 echo '<td>' . $calls['Description'] . '</td>';
											 echo '<td>' . $calls['OpenDate'] . '</td>';
											 echo '<td>' . $calls['ClosingDate'] . '</td>';
											 echo '<td>' . $appReq . '</td>';
											 if($Total == '12'){
												echo '<td><div class="icon dripicons-enter" data-CallID="'.$calls["ID"].'" data-InstitutionID="'.$_POST["rowid"].'" data-bs-toggle="modal" data-bs-target="#capture-new"></div></td>';
											 }else{
												 echo '<td><div class="alert alert-light-danger color-danger"><i class="bi bi-exclamation-circle"></i> Please complete all required sections first.</div></td>';
											 }
											echo '</tr>';
										}
										
										echo '</tbody>
												</table>';
	
			
			exit;
			}else{
				//echo 'Your organisation does not qualify to apply for any open calls.';
				exit;
			}







function get_all_data($conn)
{
 $query = "SELECT HostInstitutionCalls.*, d.* FROM HostInstitutionCalls 
										left join `CallInstitutionLink` d on d.CallID = HostInstitutionCalls.ID 
										WHERE d.ID != '' AND d.InstitutionID is not null and
										HostInstitutionCalls.IsActive = 1
										AND HostRequirementsFile != '' 
										AND HostRequirementsFile IS NOT NULL 
										AND ApplicantRequirementsFile != '' 
										AND ApplicantRequirementsFile IS NOT NULL 
										AND `ClosingDate` >= CURDATE()
										AND d.Status = 'Active'
										AND InstitutionID != '".$_POST["rowid"]."'";
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