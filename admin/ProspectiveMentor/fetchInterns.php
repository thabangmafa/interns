<?php

include '../connect.php';
$conn = OpenCon();

$columns = array('Name', 'Surname', 'Email');

$query = "SELECT distinct * FROM UserApplications a
LEFT JOIN UserProfile b ON b.UserID = a.UserID
LEFT JOIN RegistrationDetails c ON c.UserID = a.UserID
LEFT JOIN Qualifications e ON e.UserID = a.UserID
LEFT JOIN PositionAppliedFor f ON f.UserID = a.UserID

 WHERE a.Status = 'Pending' ";

if(isset($_POST["search"]["value"]))
{
 $query .= '
 AND (a.Name LIKE "%'.$_POST["search"]["value"].'%" || Surname LIKE "%'.$_POST["search"]["value"].'%" || Email LIKE "%'.$_POST["search"]["value"].'%")';
}



if(isset($_POST["order"]))
{
 $query .= 'ORDER BY '.$columns[$_POST['order']['0']['column']].' '.$_POST['order']['0']['dir'].' ';
}
else
{
 $query .= 'ORDER BY LastName ASC ';
}

$query1 = '';

if(@$_POST["length"] != -1 && !isset($_POST["rowid"]))
{
 $query1 = 'LIMIT ' . @$_POST['start'] . ', ' . @$_POST['length'];
}

echo $query. $query1;
$result = mysqli_query($conn,$query. $query1);
	
$data = array();

$LookupQualificationLevels = mysqli_query($conn,"SELECT distinct * FROM LookupQualificationLevel WHERE IsActive = '1'");

while($LookupQualificationLevel = mysqli_fetch_array($LookupQualificationLevels))
	{
		$Levels[] = $LookupQualificationLevel;
	}
	
$LookupStudyFields = mysqli_query($conn,"SELECT distinct * FROM LookupStudyField WHERE IsActive = '1'");

while($LookupStudyField = mysqli_fetch_array($LookupStudyFields))
	{
		$Fields[] = $LookupStudyField;
	}


if(isset($_POST["rowid"]) && $_POST["rowid"] == '000')
{
				
				
									echo '<div class="row">
												<div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="Name">Name</label>
                                                        <input type="text" id="Name" class="form-control"
                                                             name="Name">
                                                    </div>
                                                </div>
												
												<div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="Surname">Surname</label>
                                                        <input type="text" id="Surname" class="form-control"
                                                             name="Surname">
                                                    </div>
                                                </div>
												
												<div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="Email">Email Address</label>
                                                        <input type="email" id="Email" class="form-control"
                                                             name="Email">
                                                    </div>
                                                </div>
												
												<div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="Institution">Institution</label>
                                                        <select class="choices form-select" id="Institution" name="Institution" >';
														
				
															$query = "SELECT b.* FROM HostAdministrator a
																		left join LookupInstitutions b on b.InstitutionId = a.InstitutionID and b.IsActive = '1'
																		WHERE a.IsActive = '1' and a.UserID = '".$_SESSION['id']."' ORDER BY Name asc";
															$result = mysqli_query($conn, $query);

															while($institution = mysqli_fetch_array($result)) {
																
															 echo '<option value="'.$institution['InstitutionId'].'">'.ucwords($institution['Name']).'</option>';
															}

													echo'
                                                    </select>
                                                    </div>
                                                </div>
												
                                            </div>';
				
				
			exit;
}



if(isset($_POST["rowid"]) && $_POST["rowid"] != '000')
{
	



	while($row = mysqli_fetch_array($result))
	{


		
		
		
		echo '<div class="row">
				<input type="hidden" id="ID" class="form-control" name="ID" value="' . $row["ID"] . '">
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
	}
	exit;
}


while($row = mysqli_fetch_array($result))
{
 	
 $sub_array = array();
 $sub_array[] = '<div data-id="'.$row["ID"].'" data-column="Name">' . $row["Name"] . '</div>';
 $sub_array[] = '<div data-id="'.$row["ID"].'" data-column="Surname">' . $row["Surname"] . '</div>';
 // $sub_array[] = '<div data-id="'.$row["ID"].'" data-column="Department">' . $row["Department"] . '</div>';
 $sub_array[] = '<div data-id="'.$row["ID"].'" data-column="Email">' . $row["Email"] . '</div>';
 $sub_array[] = '<div data-id="'.$row["ID"].'" data-column="InstitutionID">' . $row["Institution"] . '</div>';
  $sub_array[] = '<div data-id="'.$row["ID"].'" data-column="Status">' . $row["Status"] . '</div>';
 $sub_array[] = '<div class="icon dripicons-document-edit" data-id="'.$row["ID"].'" data-bs-toggle="modal" data-bs-target="#capture-new"></div>';
 $sub_array[] = '<div class="icon dripicons-document-edit" data-id="'.$row["ID"].'" data-bs-toggle="modal" data-bs-target="#capture-new"></div>';
 $sub_array[] = '<div class="icon dripicons-document-edit" data-id="'.$row["ID"].'" data-bs-toggle="modal" data-bs-target="#capture-new"></div>';
 
 $data[] = $sub_array;
}



function get_all_data($conn)
{
 $query = "SELECT a.ID,a.Status,a.Name,a.Email, a.Surname, B.Name as Institution FROM ProspectiveMentors a 
LEFT JOIN LookupInstitutions B on B.InstitutionId = a.InstitutionID
WHERE AddedBy = '".$_SESSION['id']."'
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