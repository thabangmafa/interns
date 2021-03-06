<?php

include '../connect.php';
$conn = OpenCon();

$query = 'SELECT distinct a.ID, CONCAT("DSI/HSRC/2021/", a.CallID,"/", a.UserID) as Reference,a.UserID, b.IDDocument, c.Title,r.Race,p.Citizenship	,q.Gender,b.FirstName,b.DateOfBirth,m.PrimaryEmail, o.Title as CallTitle,o.OpenDate, o.ClosingDate, b.Initials,b.LastName,b.IDNumber,b.PassportNumber, CONCAT("1st: ", e.Name, " (" , j.Name, ")", "<br />2nd: ", f.Name, " (" , k.Name, ")", "<br />3rd: ", g.Name, " (" , l.Name, ")" ) as Discipline, GROUP_CONCAT(DISTINCT  h.NameOfDegree SEPARATOR "<br />") NameOfDegree, a.Status, j.Name FROM UserApplications a 
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
																left join LookupRace r on r.ID = b.Race  WHERE a.ID = "'.$_POST["rowid"].'" 															
																';


$result = mysqli_query($conn,$query);


$query = 'SELECT distinct HomePhysicalAddress,HomeCityTown,HomePostalCode,b.Name as HomeProvince,c.Country,MobileNumber,PrimaryEmail,AlternativeEmail FROM `UserContactDetails` a 
LEFT JOIN LookupProvince b on b.ID = a.HomeProvince
left join LookupCountry c on c.ID = a.Country
left join UserApplications d on d.UserID = a.UserID
 WHERE d.ID = "'.$_POST["rowid"].'"';
$ContactDetails = mysqli_query($conn,$query);

$query = 'SELECT distinct  * FROM `NextOfKin` a 
left join UserApplications d on d.UserID = a.UserID
 WHERE d.ID = "'.$_POST["rowid"].'"';
$NextOfKin = mysqli_query($conn,$query);

$query = 'SELECT distinct e.Name as Language, b.Name as Speak, c.Name as `Read`, d.Name as `Write` FROM UserApplications a
left join `LanguageProficiency` f on f.UserID = a.UserID 
left join LookupProficiency b on b.ID = f.Speak
left join LookupProficiency c on c.ID = f.Read
left join LookupProficiency d on d.ID = f.Write
left join LookupLanguages e on e.ID = f.Language
 WHERE a.ID = "'.$_POST["rowid"].'"';

$LanguageProficiency = mysqli_query($conn,$query);


$query = 'SELECT distinct c.Name as AcademicLevel, b.NameOfDegree, Institution, Fulltime, Distinction,DateFirstRegistration, Completed, HighestCompletedQualification, AnticipatedDateCompletion FROM `UserApplications` a 
left join Qualifications b on b.UserID = a.UserID
left join LookupQualificationLevel c on c.ID = b.AcademicLevel
 WHERE a.ID = "'.$_POST["rowid"].'"';

$Qualifications = mysqli_query($conn,$query);

$query = 'SELECT distinct * FROM `UserApplications` a
left join `UserProfile` b on b.UserID = a.UserID
 WHERE a.ID = "'.$_POST["rowid"].'"';

$UserProfiles = mysqli_query($conn,$query);

$query = 'SELECT distinct * FROM UserApplications a
left join `References` b on b.UserID = a.UserID 
 WHERE a.ID = "'.$_POST["rowid"].'"';

$References = mysqli_query($conn,$query);

$query = 'SELECT distinct a.InstitutionID, b.Name FROM ProspectiveMentors a
left join `LookupInstitutions` b on b.InstitutionId = a.InstitutionID
left join users c on c.Email = a.Email 
 WHERE c.UserID = "'.$_SESSION["id"].'" and a.Status = "Approved"
 
 union 
 
 SELECT a.InstitutionID, b.Name FROM HostAdministrator a
left join LookupInstitutions b on b.InstitutionId = a.InstitutionID and b.IsActive = "1"
WHERE b.IsActive = "1" and a.UserID = "'.$_SESSION['id'].'" and a.Status = "Approved"
 ';

$MentorInstitutions = mysqli_query($conn,$query);
while(@$MentorInstitution = mysqli_fetch_array(@$MentorInstitutions))
					{
						
							@$instID[] .= @$MentorInstitution['InstitutionID'];
							@$Inst .= '<option value="'.@$MentorInstitution['InstitutionID'].'">'.@$MentorInstitution['Name'].'</option>';
						
					}


$query = 'SELECT d.ID, a.ID as applicationid,FirstOptionStatus,SecondOptionStatus,ThirdOptionStatus,FirstOptionInstitutionResponse,SecondOptionInstitutionResponse,ThirdOptionInstitutionResponse,a.Comments, a.Status, j.Name as FirstProvince, k.Name as SecondProvince, l.Name as ThirdProvince, e.Name as FirstDiscipline, f.Name as SecondDiscipline, g.Name as ThirdDiscipline FROM UserApplications a 
left join `PositionAppliedFor` d on d.UserID = a.UserID

left join LookupProvince j on j.ID = d.FirstProvince
left join LookupProvince k on k.ID = d.SecondProvince
left join LookupProvince l on l.ID = d.ThirdProvince

Left join LookupDisciplines e on e.ID = d.FirstDiscipline
Left join LookupDisciplines f on f.ID = d.SecondDiscipline
Left join LookupDisciplines g on g.ID = d.ThirdDiscipline
 WHERE a.ID = "'.$_POST["rowid"].'"';

$PositionAppliedFor = mysqli_query($conn,$query);


$data = array();

if(isset($_POST["rowid"]) && $_POST["rowid"] != '000')
{
	echo '<div class="row table-responsive" style="margin-left:25px;">';
	//Registration Details
	while($row = mysqli_fetch_array($result))
	{
		
		$userid = $row['UserID'];
		$ref = $row['Reference'];
		$applicant = $row['Title'] . ' ' . $row['Initials'] . ' ' .$row['FirstName'] . ' ' .$row['LastName'];
		echo '<table class="mb-0">';
					
			echo '<tbody>';
				echo '<tr>';
					echo '<th width="50%">Application</th>';
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
					echo '<th>Applicant ID/Passport Document</th>';
					echo $iddoc = '<td><a target="_blank" href="uploads/applicants/'.$row['UserID'].'/'.$row['IDDocument'].'">View ID/Passport Document</a></td>';
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
		
	}
	
	
	//Contact Details
	while(@$Contacts = mysqli_fetch_array($ContactDetails))
	{
		
		echo '<div class="alert alert-info" style="margin-top: 2%; margin-bottom: 2%;">Contact Details.</div>';
		
		echo '<table class="mb-0">';
					
			echo '<tbody>';
				echo '<tr>';
					echo '<th width="50%">Home Physical Address</th>';
					echo '<td>'.$Contacts['HomePhysicalAddress'].'</td>';
				echo '</tr>';
				
				echo '<tr>';
					echo '<th>Home City/Town</th>';
					echo '<td>'.$Contacts['HomeCityTown'].'</td>';
				echo '</tr>';
				
				echo '<tr>';	
					echo '<th>Home Postal Code</th>';
					echo '<td>'.$Contacts['HomePostalCode'].'</td>';
				echo '</tr>';
				
				echo '<tr>';	
					echo '<th>Home Province</th>';
					echo '<td>'.$Contacts['HomeProvince'].'</td>';
				echo '</tr>';
				
				echo '<tr>';	
					echo '<th>Home Country</th>';
					echo '<td>'.$Contacts['Country'] .'</td>';
				echo '</tr>';
				
				echo '<tr>';	
					echo '<th>Mobile Number</th>';
					echo '<td>'.$Contacts['MobileNumber'].'</td>';
				echo '</tr>';
				
				echo '<tr>';	
					echo '<th>Primary Email Address</th>';
					echo '<td>'.$Contacts['PrimaryEmail'].'</td>';
				echo '</tr>';
				
				echo '<tr>';	
					echo '<th>Alternate Email Address</th>';
					echo '<td>'.$Contacts['AlternativeEmail'].'</td>';
				echo '</tr>';
				
			echo '</tbody>';
		echo '</table>';
		
	}
	
	//Next of Kin
	while(@$NOK = mysqli_fetch_array(@$NextOfKin))
	{
		
		
		echo '<div class="alert alert-info" style="margin-top: 2%; margin-bottom: 2%;">Next of Kin.</div>';
		
		echo '<table class="mb-0">';
					
			echo '<tbody>';
				echo '<tr>';
					echo '<th width="50%">Name</th>';
					echo '<td>'.$NOK['Name'].'</td>';
				echo '</tr>';
				
				echo '<tr>';
					echo '<th>Cellphone Number</th>';
					echo '<td>'.$NOK['Cellnumber'].'</td>';
				echo '</tr>';
				
				echo '<tr>';	
					echo '<th>Relationship</th>';
					echo '<td>'.$NOK['Relationship'].'</td>';
				echo '</tr>';
				
				echo '<tr>';	
					echo '<th>Physical Address</th>';
					echo '<td>'.$NOK['Address'].'</td>';
				echo '</tr>';
				
			echo '</tbody>';
		echo '</table>';
	}
	
	echo '<div class="alert alert-info" style="margin-top: 2%; margin-bottom: 2%;">Language Proficiency.</div>';
	echo '<table class="mb-0">';
	echo '<tbody>';
	//Language Proficiency
	while(@$LanguageP = mysqli_fetch_array(@$LanguageProficiency))
	{
		
				echo '<tr>';
					echo '<th width="50%">Language</th>';
					echo '<td>'.$LanguageP['Language'].'</td>';
				echo '</tr>';
				
				echo '<tr>';
					echo '<th>Speak</th>';
					echo '<td>'.$LanguageP['Speak'].'</td>';
				echo '</tr>';
				
				echo '<tr>';	
					echo '<th>Read</th>';
					echo '<td>'.$LanguageP['Read'].'</td>';
				echo '</tr>';
				
				echo '<tr>';	
					echo '<th>Write</th>';
					echo '<td>'.$LanguageP['Write'].'</td>';
				echo '</tr>';
				
				echo '<tr>';
					echo '<td colspan="2"><hr /></td>';
					echo '</tr>';
				
			
	}
	echo '</tbody>';
		echo '</table>';
		
		
		echo '<div class="alert alert-info" style="margin-top: 2%; margin-bottom: 2%;">Qualifications.</div>';
	echo '<table class="mb-0">';
	echo '<tbody>';
	//Qualifications
	
	
	while(@$Qual = mysqli_fetch_array(@$Qualifications))
	{
		
				echo '<tr>';
					echo '<th width="50%">Name Of Degree</th>';
					echo '<td>'.$Qual['NameOfDegree'].'</td>';
				echo '</tr>';
				
				echo '<tr>';
					echo '<th>AcademicLevel</th>';
					echo '<td>'.$Qual['AcademicLevel'].'</td>';
				echo '</tr>';
				
				echo '<tr>';	
					echo '<th>Institution</th>';
					echo '<td>'.$Qual['Institution'].'</td>';
				echo '</tr>';
				
				echo '<tr>';	
					echo '<th>Fulltime</th>';
					echo '<td>'.$Qual['Fulltime'].'</td>';
				echo '</tr>';
				
				echo '<tr>';	
					echo '<th>Degree Classification</th>';
					echo '<td>'.$Qual['Distinction'].'</td>';
				echo '</tr>';
				
				echo '<tr>';	
					echo '<th>Date First Registration</th>';
					echo '<td>'.$Qual['DateFirstRegistration'].'</td>';
				echo '</tr>';
				
				echo '<tr>';	
					echo '<th>Completed</th>';
					echo '<td>'.$Qual['Completed'].'</td>';
				echo '</tr>';
				
				echo '<tr>';	
					echo '<th>Highest Completed Qualification</th>';
					echo '<td>'.$Qual['HighestCompletedQualification'].'</td>';
				echo '</tr>';
				
				echo '<tr>';	
					echo '<th>Date of Completion</th>';
					echo '<td>'.$Qual['AnticipatedDateCompletion'].'</td>';
				echo '</tr>';
				
			
				echo '<tr>';
					echo '<td colspan="2"><hr /></td>';
					echo '</tr>';
				
			
	}
	echo '</tbody>';
		echo '</table>';
	
	
	
	
	//User Profile
	while(@$Profiles = mysqli_fetch_array($UserProfiles))
	{
		
		echo '<div class="alert alert-info" style="margin-top: 2%; margin-bottom: 2%;">Personal Profile.</div>';
		
		echo '<table class="mb-0">';
					
			echo '<tbody>';
				echo '<tr>';
					echo '<th width="50%">Educational and Professional Summary</th>';
					echo '<td>'.$Profiles['EducationalandProfessional'].'</td>';
				echo '</tr>';
				echo '<tr><td colspan="2"><hr /></td></tr>';
				echo '<tr>';
					echo '<th>Educational and Career, Goals and Aspirations</th>';
					echo '<td>'.$Profiles['GoalsandAspirations'].'</td>';
				echo '</tr>';
				echo '<tr><td colspan="2"><hr /></td></tr>';
				echo '<tr>';	
					echo '<th>Awards and Special Achievements</th>';
					echo '<td>'.$Profiles['Awards'].'</td>';
				echo '</tr>';
				echo '<tr><td colspan="2"><hr /></td></tr>';
				echo '<tr>';	
					echo '<th>Civic, community engagement and other interests</th>';
					echo '<td>'.$Profiles['CommunityEngagement'].'</td>';
				echo '</tr>';
				echo '<tr><td colspan="2"><hr /></td></tr>';
				echo '<tr>';	
					echo '<th>Where found out about this internship opportunity</th>';
					echo '<td>'.$Profiles['Platform'] .'</td>';
				echo '</tr>';
				
			echo '</tbody>';
		echo '</table>';
		
	}
	
	
	
	echo '<div class="alert alert-info" style="margin-top: 2%; margin-bottom: 2%;">References.</div>';
	echo '<table class="mb-0" style="width:100%">';
	echo '<tbody>';
	//References
	while(@$Reference = mysqli_fetch_array(@$References))
	{
		
				echo '<tr>';
					echo '<th width="50%">Name</th>';
					echo '<td>'.$Reference['Name'].'</td>';
				echo '</tr>';
				
				echo '<tr>';
					echo '<th>Relationship</th>';
					echo '<td>'.$Reference['Relationship'].'</td>';
				echo '</tr>';
				
				echo '<tr>';	
					echo '<th>Telephone</th>';
					echo '<td>'.$Reference['Telephone'].'</td>';
				echo '</tr>';
				
				echo '<tr>';	
					echo '<th>Email</th>';
					echo '<td>'.$Reference['Email'].'</td>';
				echo '</tr>';
				
				echo '<tr>';	
					echo '<th>Organisation</th>';
					echo '<td>'.$Reference['Organisation'].'</td>';
				echo '</tr>';
				
				echo '<tr>';
					echo '<td colspan="2"><hr /></td>';
					echo '</tr>';
				
			
	}
	echo '</tbody>';
		echo '</table>';
		
		echo '<div class="alert alert-info" style="margin-top: 2%; margin-bottom: 2%;">User Attachments.</div>';
	echo '<table class="mb-0" style="width:100%">';
	echo '<tbody>';
	//User Atachments

		
				echo '<tr>';
					echo '<th width="50%">ID/Passport Document</th>';
					echo $iddoc;
				echo '</tr>';
				
				@$directory = '../../uploads/qualifications/'.@$userid;
				@$scanned_directory = array_diff(scandir(@$directory), array('..', '.'));
				$files = '';
				$req = '';
				$i = 0;
				
							if(@$scanned_directory){
							foreach($scanned_directory as $file){
								$i++;
								echo '<tr>
										<th>Qualifications Attachment</th>
										<td>';
								
								echo '<a target="_blank" href="../../uploads/qualifications/'.@$userid.'/'.$file.'">View Transcript(s)</a>';
									echo '</td>
									</tr>';
							}
							
							}

	
	echo '</tbody>';
		echo '</table>';
		
		
		
	echo '<div class="alert alert-info" style="margin-top: 2%; margin-bottom: 2%;">Position Applied For.</div>';
	echo '<table class="mb-0" style="width:100%">';
	echo '<tbody>';
	//Language Proficiency
	while(@$PositionApplied = mysqli_fetch_array(@$PositionAppliedFor))
	{
				echo '<input type="hidden" name="recordid" id="recordid" value="'.$PositionApplied['ID'].'" />';
				echo '<input type="hidden" name="applicationid" id="applicationid" value="'.$PositionApplied['applicationid'].'" />';
				echo '<input type="hidden" name="UserID" id="UserID" value="'.$userid.'" />';
				echo '<input type="hidden" name="Ref" id="Ref" value="'.$ref.'" />';
				echo '<input type="hidden" name="Applicant" id="Applicant" value="'.$applicant.'" />';
				
				echo '<tr>';
					echo '<th>Preferences</th>';
					echo '<th>Province</th>';
					echo '<th>Discipline</th>';
					echo '<th>Status</th>';
				echo '</tr>';
				
				echo '<tr><td colspan="4"><hr /></td></tr>';
				
				echo '<tr>';
					echo '<td>Option 1</td>';
					echo '<td>'.$PositionApplied['FirstProvince'].'</td>';
					echo '<td>'.$PositionApplied['FirstDiscipline'].'</td>';
					echo '<td>';
					if($PositionApplied['FirstOptionStatus'] == ''){ echo 'Submitted to HSRC'; }else{ echo $PositionApplied['FirstOptionStatus']; }
					echo '</td>';
				echo '</tr>';
				
				echo '<tr><td colspan="4"><hr /></td></tr>';
				
				echo '<tr>';
					echo '<td>Option 2</td>';
					echo '<td>'.$PositionApplied['SecondProvince'].'</td>';
					echo '<td>'.$PositionApplied['SecondDiscipline'].'</td>';
					echo '<td>';
					if($PositionApplied['SecondOptionStatus'] == ''){ echo 'Submitted to HSRC'; }else{ echo $PositionApplied['SecondOptionStatus']; }
					echo '</td>';
				echo '</tr>';
				
				echo '<tr><td colspan="4"><hr /></td></tr>';
				
				echo '<tr>';	
					echo '<td>Option 3</td>';
					echo '<td>'.$PositionApplied['ThirdProvince'].'</td>';
					echo '<td>'.$PositionApplied['ThirdDiscipline'].'</td>';
					echo '<td>';
					if($PositionApplied['ThirdOptionStatus'] == ''){ echo 'Submitted to HSRC'; }else{ echo $PositionApplied['ThirdOptionStatus']; }
					echo '</td>';
				echo '</tr>';
				
				echo '<tr><td colspan="4"><div class="alert alert-success" style="margin-top: 2%; margin-bottom: 2%;">Respond to application by select the option and feedback.</div></td></tr>';
				

				if(	@$_SESSION['user_type'] != '1' && 
					$PositionApplied['Status'] == 'Offer to be made' && 
					!@in_array(@$PositionApplied['FirstOptionInstitutionResponse'], $instID) && 
					!@in_array(@$PositionApplied['SecondOptionInstitutionResponse'], $instID) &&
					!@in_array(@$PositionApplied['ThirdOptionInstitutionResponse'], $instID)
				){
					
					
				echo '<tr><td colspan="4">You will not be able to respond to this application as there is a pending offer to be made.</td></tr>';
				}else{
				
				echo '<tr><td colspan="4">Your Institution';
						echo '<select class="choices form-select" id="MentorInstitution" name="MentorInstitution">';
				//while(@$MentorInstitution = mysqli_fetch_array(@$MentorInstitutions))
				//	{
						
							echo @$Inst;
							//echo '<option value="'.@$MentorInstitution['InstitutionID'].'">'.@$MentorInstitution['Name'].'</option>';
						
				//	}
			
			echo '</select></td></tr>';
			echo '<tr><td colspan="4"><hr /></td></tr>';
				echo '<tr><td><div class="col-md-12 col-12">
				<div class="form-group">
						<label for="InterviewDate">Select Option</label>';
				echo '<select class="choices form-select" id="Options" name="Options">';
					echo '<option value="'.$PositionApplied['FirstProvince'].'~'.$PositionApplied['FirstDiscipline'].'~First">Option 1</option>';
					echo '<option value="'.$PositionApplied['SecondProvince'].'~'.$PositionApplied['SecondDiscipline'].'~Second">Option 2</option>';
					echo '<option value="'.$PositionApplied['ThirdProvince'].'~'.$PositionApplied['ThirdDiscipline'].'~Third">Option 3</option>';
				echo '</select>';
				
				echo '</div></div></td><td colspan="2">
				<div class="col-md-12 col-12"><div class="form-group">
						<label for="InterviewDate">Select Response</label>';
				echo '<select class="choices form-select" id="Status" name="Status">';
				echo '<option></option>';
					echo '<option>To be interviewed</option>';
					echo '<option>Interview date set</option>';
					echo '<option>Interview unsuccessful</option>';
					echo '<option>Offer to be made</option>';
					echo '<option>Application withdrawn</option>';
					echo '<option>No longer available</option>';
				echo '</select></div></div></td>
				<td>
				<div class="col-md-12 col-12 internview-data">
					
				</div>
				</td>
				</tr>';

				

				echo '<tr><td colspan="4"><hr /></td></tr>';
				echo '<tr><td colspan="4">Comments<textarea class="form-control" id="Comments" name="Comments" rows="3" style="width:100%" placeholder="Type any comments here...">'.$PositionApplied['Comments'].'</textarea></td></tr>'; 
				}
			
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