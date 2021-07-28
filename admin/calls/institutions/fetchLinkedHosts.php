<?php

include '../../connect.php';
$conn = OpenCon();

$columns = array('BudgetYear', 'Title', 'IsActive');

$query = "SELECT * FROM `CallInstitutionLink` a
left join LookupInstitutions b on b.InstitutionId = a.InstitutionID

WHERE CALLID = '".$_POST["rowid"]."' ";

$result = mysqli_query($conn,$query);

$Institution = mysqli_query($conn,"SELECT distinct * FROM LookupInstitutions WHERE IsActive = '1' AND InstitutionId not in (SELECT InstitutionID from CallInstitutionLink WHERE CALLID = '".$_POST["rowid"]."')");

while($types = mysqli_fetch_array($Institution))
	{
		$type[] = $types;
	}
	


$data = array();

if(isset($_POST["rowid"]) && $_POST["rowid"] != '000')
{

		echo '<input type="hidden" id="ID" class="form-control" name="ID" value="' . $_POST["rowid"] . '">';
		
		echo '<div class="col-md-12 col-12">
				<div class="form-check">' ?>
				<?php
				
					while($row = mysqli_fetch_array($result))
					{	
						echo '<input type="checkbox" class="form-check-input" name="Institution[]" id="Institution" checked="checked" value="'.$row["InstitutionID"].'" >' . $row['Name'] . '<br />';
					}	

					foreach ($type as $t){ 	 
						echo '<input type="checkbox" class="form-check-input" name="Institution[]" id="Institution" value="'.$t["InstitutionId"].'" >' . $t['Name'] . '<br />';	
					}	
				echo '
				</fieldset>
				</div>
			</div>';
		
			
			
	
	exit;
}


while($row = mysqli_fetch_array($result))
{
 	
 $sub_array = array();
 //$sub_array[] = '<div data-id="'.$row["CID"].'" data-column="BudgetYear">' . $row["Budgy"] . '</div>';
 //$sub_array[] = '<div data-id="'.$row["CID"].'" data-column="Title">' . $row["Title"] . '</div>';
 //$sub_array[] = '<div data-id="'.$row["CID"].'" data-column="Description">' . $row["Description"] . '</div>';
 //$sub_array[] = '<div data-id="'.$row["CID"].'" data-column="OpenDate">' . $row["OpenDate"] . '</div>';
 //$sub_array[] = '<div data-id="'.$row["CID"].'" data-column="ClosingDate">' . $row["ClosingDate"] . '</div>';
 //$sub_array[] = '<div data-id="'.$row["CID"].'" data-column="Status">' . $row["Status"] . '</div>';
 //$sub_array[] = '<div class="icon dripicons-enter" data-id="'.$row["CID"].'" data-bs-toggle="modal" data-bs-target="#link_institution"></div>';
 
	$sub_array[] = '<div class="icon dripicons-document-edit" data-id="'.$row["CALLID"].'" data-bs-toggle="modal" data-bs-target="#manage_institution"></div>';
 $data[] = $sub_array;
}



function get_all_data($conn)
{
 $query = "SELECT * FROM `LookupInstitutions` WHERE IsActive = '1'";

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