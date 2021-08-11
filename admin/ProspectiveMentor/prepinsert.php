<?php
include '../connect.php';
$conn = OpenCon();

if(isset($_POST["Email"]) && $_POST["Email"] != '')
{
	
  //$MentorID = mysqli_real_escape_string($conn,$_POST["MentorID"]);
  $Name = mysqli_real_escape_string($conn,$_POST["Name"]);
  $Surname = mysqli_real_escape_string($conn,$_POST["Surname"]);
  $Email = mysqli_real_escape_string($conn,$_POST["Email"]);
  $InstitutionID = mysqli_real_escape_string($conn,$_POST["InstitutionID"]);
  
 $ID = $_SESSION['id'];

 
 $query = "SELECT A.UserID, A.Email, B.Initials, F.Title, B.FirstName, B.LastName, C.Organization, C.Position, D.MobileNumber, D.TelephoneNumber, E.Name as Institution FROM users A 
 LEFT JOIN RegistrationDetails B ON B.UserID = A.UserID
 LEFT JOIN EmploymentDetails C ON C.UserID = A.UserID
 LEFT JOIN UserContactDetails D ON D.UserID = A.UserID
 LEFT JOIN LookupInstitutions E ON E.InstitutionId = D.CurrentOrganisation
 LEFT JOIN LookupUserTitle F ON F.ID = B.TITLE
 WHERE lower(A.Email) = lower('".$Email."')";

$result = mysqli_query($conn,$query);
$row = mysqli_fetch_array($result);	


$query = "SELECT Name FROM LookupInstitutions WHERE InstitutionId = '".$InstitutionID."'";
$result = mysqli_query($conn,$query);
$Inst = mysqli_fetch_array($result);	

$data = array();

if(isset($Email))
{
	if(@$row["Email"])
	{
				echo '<div class="alert alert-light-warning color-warning"><i class="bi-exclamation-triangle"></i> Please confirm if the details below are correct. On confirmation, an email will be sent to the prospective mentor.
                                    </div>';
									echo '<input type="hidden" id="MentorID" class="form-control" name="MentorID" value="' . $row["UserID"] . '">';
									echo '<input type="hidden" id="Name" class="form-control" name="Name" value="' . $row["FirstName"] . '">';
									echo '<input type="hidden" id="Surname" class="form-control" name="Surname" value="' . $row["LastName"] . '">';
									echo '<input type="hidden" id="Email" class="form-control" name="Email" value="' . $row["Email"] . '">';
									echo '<input type="hidden" id="InstitutionID" class="form-control" name="InstitutionID" value="' . $InstitutionID . '">';
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
												<td>Current Organisation</td>
												<td>'.$row["Institution"].'</td>
											</tr>
											</table>
											
											
                                            </div>';
				
				
			exit;
	}else{
		
		echo '<div class="alert alert-light-danger color-danger"><i class="bi-exclamation-triangle"></i> Prospective mentor not registered on the system. On confirmation, an invite will be sent to the prospective mentor to register.
                                    </div>';
									echo '<input type="hidden" id="MentorID" class="form-control" name="MentorID" value="">';
									echo '<input type="hidden" id="Name" class="form-control" name="Name" value="' . $Name . '">';
									echo '<input type="hidden" id="Surname" class="form-control" name="Surname" value="' . $Surname . '">';
									echo '<input type="hidden" id="Email" class="form-control" name="Email" value="' . $Email . '">';
									echo '<input type="hidden" id="InstitutionID" class="form-control" name="InstitutionID" value="' . $InstitutionID . '">';
									echo '<div class="row">
											<table>
											<tr>
												<td>Title</td>
												<td>'.$_POST["Name"].'</td>
											</tr>
											<tr>
												<td>Surname</td>
												<td>'.$_POST["Surname"].'</td>
											</tr>
											<tr>
												<td>Initials</td>
												<td>'.$_POST["Email"].'</td>
											</tr>
											
											</table>
											
											
                                            </div>';
		exit;
	}
}



function get_all_data($conn)
{
 $query = "SELECT  A.UserID, A.Email, B.Initials, F.Title, B.FirstName, B.LastName, C.Organization, C.Position, D.MobileNumber, D.TelephoneNumber, E.Name as Institution FROM users A 
 LEFT JOIN RegistrationDetails B ON B.UserID = A.UserID
 LEFT JOIN EmploymentDetails C ON C.UserID = A.UserID
 LEFT JOIN UserContactDetails D ON D.UserID = A.UserID
 LEFT JOIN LookupInstitutions E ON E.InstitutionId = D.CurrentOrganisation
  LEFT JOIN LookupUserTitle F ON F.ID = B.TITLE
 WHERE lower(Email) = lower('".$Email."')
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
}else{
	echo 'Alert';
	
}
CloseCon($conn);
?>