<?php

include '../connect.php';
$conn = OpenCon();

$columns = array('InstitutionId', 'Name', 'InstitutionTypeId', 'IsActive');

$query = "SELECT * FROM `LookupInstitutions` a 
left join `LookupInstitutionTypes` b on b.`InstitutionTypeId` = a.`InstitutionTypeId`
left join `LookupStatus` c on c.`StatusId` = a.`IsActive`";

if(isset($_POST["search"]["value"]))
{
 $query .= '
 WHERE Name LIKE "%'.$_POST["search"]["value"].'%" || Status LIKE "%'.$_POST["search"]["value"].'%" || Description LIKE "%'.$_POST["search"]["value"].'%"';
}

if(isset($_POST["order"]))
{
 $query .= 'ORDER BY '.$columns[$_POST['order']['0']['column']].' '.$_POST['order']['0']['dir'].' ';
}
else
{
 $query .= 'ORDER BY Name ASC ';
}

$query1 = '';

if($_POST["length"] != -1)
{
 $query1 = 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
}


$result = mysqli_query($conn,$query . $query1);

$data = array();

while($row = mysqli_fetch_array($result))
{
 	
 $sub_array = array();
 $sub_array[] = '<div contenteditable class="update" data-id="'.$row["InstitutionId"].'" data-column="Name">' . $row["Name"] . '</div>';
 $sub_array[] = '<div contenteditable class="update" data-id="'.$row["InstitutionId"].'" data-column="InstitutionTypeId">' . $row["Description"] . '</div>';
 $sub_array[] = '<div contenteditable class="update" data-id="'.$row["InstitutionId"].'" data-column="IsActive">' . $row["Status"] . '</div>';

 $data[] = $sub_array;
}

function get_all_data($conn)
{
 $query = "SELECT * FROM `LookupInstitutions` a 
	left join `LookupInstitutionTypes` b on b.`InstitutionTypeId` = a.`InstitutionTypeId`
	left join `LookupStatus` c on c.`StatusId` = a.`IsActive`";
 $result = mysqli_query($conn,$query);
 return $result->num_rows;
}

$output = array(
 "draw"    => intval($_POST["draw"]),
 "recordsTotal"  =>  get_all_data($conn),
 "recordsFiltered" => $result->num_rows,
 "data"    => $data
);

echo json_encode($output);
CloseCon($conn);
?>