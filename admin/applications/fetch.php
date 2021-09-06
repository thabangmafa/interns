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


$data = array();

if(isset($_POST["rowid"]) && $_POST["rowid"] != '000')
{
	echo '<div class="row table-responsive">';
	//Registration Details
	while($row = mysqli_fetch_array($result))
	{
		
		$userid = $row['UserID'];
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
					echo $iddoc = '<td><a target="_blank" href="uploads/applicants/'.$row['UserID'].'/'.$row['IDDocument'].'">View Document</a></td>';
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
	
	echo '</div>';
	
	
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
										<td>Qualifications Attachment</td>
										<td>';
								
								echo '<a target="_blank" href="../../uploads/qualifications/'.@$userid.'/'.$file.'"> Transcript(s)</a>';
									echo '</td>
									</tr>';
							}
							
							}

	
	echo '</tbody>';
		echo '</table>';
	
	
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