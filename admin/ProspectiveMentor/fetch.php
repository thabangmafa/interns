<?php

include '../connect.php';
$conn = OpenCon();

$columns = array('Name', 'Surname', 'Email');

$query = "SELECT a.ID,a.Status,C.FirstName as Name,a.Email, C.LastName as Surname, B.Name as Institution FROM ProspectiveMentors a 
LEFT JOIN LookupInstitutions B on B.InstitutionId = a.InstitutionID
LEFT JOIN RegistrationDetails C on C.UserID = a.MentorID
WHERE a.InstitutionID = '".@$_SESSION['InstitutionID']."'
";

if(isset($_POST["search"]["value"]))
{
 $query .= '
 AND (C.FirstName LIKE "%'.$_POST["search"]["value"].'%" || C.LastName LIKE "%'.$_POST["search"]["value"].'%" || Email LIKE "%'.$_POST["search"]["value"].'%")';
}

if(isset($_POST["rowid"]))
{
 $query .= '
 AND ID = "'.$_POST["rowid"].'" ';
}

if(isset($_POST["order"]))
{
 $query .= 'ORDER BY '.$columns[$_POST['order']['0']['column']].' '.$_POST['order']['0']['dir'].' ';
}
else
{
 $query .= 'ORDER BY C.LastName ASC ';
}

$query1 = '';

if(@$_POST["length"] != -1 && !isset($_POST["rowid"]))
{
 $query1 = 'LIMIT ' . @$_POST['start'] . ', ' . @$_POST['length'];
}


$result = mysqli_query($conn,$query. $query1);
	
$data = array();

$LookupQualificationLevels = mysqli_query($conn,"SELECT distinct * FROM LookupQualificationLevel WHERE IsActive = '1' AND UserType IN (2,3)");

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
				
				echo '<input type="hidden" id="InstitutionID" class="form-control" name="InstitutionID" value="' . @$_SESSION['InstitutionID'] . '">';
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
												
                                            </div>';
				
				
			exit;
}



if(isset($_POST["rowid"]) && $_POST["rowid"] != '000')
{
	



	while($row = mysqli_fetch_array($result))
	{
		echo '<div class="row">';

		echo '<input type="hidden" id="ID" class="form-control" name="ID" value="' . $row["ID"] . '">';
	
		echo '<input type="hidden" id="InstitutionID" class="form-control" name="InstitutionID" value="' . @$_SESSION['InstitutionID'] . '">';
									echo '<div class="row">
												<div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="Name">Name</label>
                                                        <input type="text" id="Name" class="form-control"
                                                             name="Name" value="' . $row["Name"] . '">
                                                    </div>
                                                </div>
												
												<div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="Surname">Surname</label>
                                                        <input type="text" id="Surname" class="form-control"
                                                             name="Surname" value="' . $row["Surname"] . '">
                                                    </div>
                                                </div>
												
												<div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="Email">Email Address</label>
                                                        <input type="email" id="Email" class="form-control"
                                                             name="Email" value="' . $row["Email"] . '">
                                                    </div>
                                                </div>
												
												<div class="col-md-6 col-12" >
                                                    <div class="form-group">
                                                        <label for="Status">Status</label>
                                                        <fieldset class="form-group">
                                                    <select class="choices form-select" id="Status" name="Status">
													<option>' . $row["Status"] . '</option>
                                                        <option>Withdraw</option>
														<option>Delete</option>
                                                    </select>
                                                </fieldset>
                                                    </div>
                                                </div>
												
                                            </div>';
		
		

					
					
		echo '</div>';
	}
	exit;
}


while($row = mysqli_fetch_array($result))
{
 	
 $sub_array = array();
 $sub_array[] = '<div data-id="'.$row["ID"].'" data-column="Name">' . $row["Name"] . '</div>';
 $sub_array[] = '<div data-id="'.$row["ID"].'" data-column="Surname">' . $row["Surname"] . '</div>';
 $sub_array[] = '<div data-id="'.$row["ID"].'" data-column="Email">' . $row["Email"] . '</div>';
 $sub_array[] = '<div data-id="'.$row["ID"].'" data-column="InstitutionID">' . $row["Institution"] . '</div>';
  $sub_array[] = '<div data-id="'.$row["ID"].'" data-column="Status">' . $row["Status"] . '</div>';
  if($row["Status"] == 'Approved'){
	  //$sub_array[] = '<div class="fa-fw select-all fas" data-id="'.$row["ID"].'" data-bs-toggle="modal" data-bs-target="#capture-new"></div>';
  }else{
	  //$sub_array[] = '<span class="fa-fw select-all fas"></span>';
  }
  $sub_array[] = '<div class="icon dripicons-document-edit" data-id="'.$row["ID"].'" data-bs-toggle="modal" data-bs-target="#capture-new"></div>';
 

 $data[] = $sub_array;
}



function get_all_data($conn)
{
 $query = "SELECT a.ID,a.Status,C.FirstName as Name,a.Email, C.LastName as Surname, B.Name as Institution FROM ProspectiveMentors a 
LEFT JOIN LookupInstitutions B on B.InstitutionId = a.InstitutionID
LEFT JOIN RegistrationDetails C on C.UserID = a.MentorID
WHERE a.InstitutionID = '".@$_SESSION['InstitutionID']."'
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