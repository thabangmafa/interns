<?php

include '../connect.php';
$conn = OpenCon();

$columns = array('FirstName');

$query = "SELECT HostInstitutionCalls.*, d.* FROM HostInstitutionCalls 
										left join `CallInstitutionLink` d on d.CallID = HostInstitutionCalls.ID 
										WHERE d.ID != '' AND d.InstitutionID is not null and
										HostInstitutionCalls.IsActive = 1
										AND HostRequirementsFile != '' 
										AND HostRequirementsFile IS NOT NULL 
										AND ApplicantRequirementsFile != '' 
										AND ApplicantRequirementsFile IS NOT NULL 
										AND `HostSubmissionDueDate` >= CURDATE()
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
											 echo '<td>' . $calls['HostSubmissionDueDate'] . '</td>';
											 echo '<td>' . $appReq . '</td>';
											 echo '<td><div class="icon dripicons-enter" data-CallID="'.$calls["ID"].'" data-InstitutionID="'.$_POST["rowid"].'" data-bs-toggle="modal" data-bs-target="#capture-new"></div></td>';
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
										AND `HostSubmissionDueDate` >= CURDATE()
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