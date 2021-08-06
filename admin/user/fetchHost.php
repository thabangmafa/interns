<?php

include '../connect.php';
$conn = OpenCon();

$query = "SELECT b.Name FROM HostInstitutionDetails a
left join LookupInstitutions b on b.InstitutionId = a.InstitutionID
WHERE a.InstitutionID = '".$_POST['InstitutionID']."'";

$result = mysqli_query($conn,$query);
$row = mysqli_fetch_array($result);
$data = array();


if(isset($_POST["rowid"]))
{

	echo '<input type="hidden" id="CALLID" class="form-control" name="CALLID" value="' . $_POST["rowid"] . '">';
	echo '<div class="row">
											<table>
											<tr>
												<td>Institution</td>
												<td>'.$row["Name"].'</td>
											</tr>
											
											</table>
											
											
                                            </div>';
	
			
			exit;
}







function get_all_data($conn)
{
 $query = "SELECT b.Name FROM HostInstitutionDetails a
left join LookupInstitutions b on b.InstitutionId = a.InstitutionID
WHERE a.InstitutionID = '".$_POST['InstitutionID']."'";

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