<?php

include '../connect.php';
$conn = OpenCon();

$columns = array('a.InstitutionId', 'a.Name', 'd.UserID','a.IsActive');

$query = "SELECT a.*, b.*,c.Status, e.* FROM `LookupInstitutions` a 
left join `LookupInstitutionTypes` b on b.`InstitutionTypeId` = a.`InstitutionTypeId`
left join `LookupIsActive` c on c.`StatusId` = a.`IsActive`
left join HostAdministrator d on d.InstitutionID = a.InstitutionId
left join users e on e.UserId = d.UserID
";

if(isset($_POST["search"]["value"]))
{
 $query .= '
 WHERE Name LIKE "%'.$_POST["search"]["value"].'%" || c.Status LIKE "%'.$_POST["search"]["value"].'%" || Description LIKE "%'.$_POST["search"]["value"].'%"';
}

if(isset($_POST["rowid"]))
{
 $query .= '
 WHERE a.InstitutionId = "'.$_POST["rowid"].'" ';
}

if(isset($_POST["order"]))
{
 $query .= 'ORDER BY '.$columns[$_POST['order']['0']['column']].' '.$_POST['order']['0']['dir'].' ';
}
else
{
 $query .= 'ORDER BY a.IsActive DESC, Name ASC ';
}

$query1 = '';

if(@$_POST["length"] != -1 && !isset($_POST["rowid"]))
{
 $query1 = 'LIMIT ' . @$_POST['start'] . ', ' . @$_POST['length'];
}

$result = mysqli_query($conn,$query. $query1);

$status = mysqli_query($conn,"SELECT distinct * FROM LookupIsActive");

while($stat = mysqli_fetch_array($status))
	{
		$st[] = $stat;
	}
	

$InstitutionTypes = mysqli_query($conn,"SELECT distinct * FROM LookupInstitutionTypes");

while($types = mysqli_fetch_array($InstitutionTypes))
	{
		$type[] = $types;
	}
	
$HostAdministrators = mysqli_query($conn,"SELECT distinct * FROM users WHERE UserType = '2' ");

while($Administrators = mysqli_fetch_array($HostAdministrators))
	{
		$Administrator[] = $Administrators;
	}

$data = array();


if(isset($_POST["rowid"]) && $_POST["rowid"] == '000')
{
	echo '<div class="col-md-12 col-12">
				<div class="form-group">
					<label for="first-name-column">Institution Name</label>
					<input type="text" id="name" class="form-control" name="name" value="">
				</div>
			</div>';
			
		echo '<div class="col-md-12 col-12">
				<div class="form-group">
					<label for="last-name-column">Institution Type</label>
					<fieldset class="form-group">
				<select class="form-select" name="type" id="type">' ?>

				<?php foreach ($type as $t){ 
				
				echo '<option value="'.$t['InstitutionTypeId'].'" >'.$t['Description'].'</option>'; 
				} 
				
				echo '
				</select>
			</fieldset>
				</div>
			</div>';
			
		echo '<div class="col-md-12 col-12">
				<div class="form-group">
					<label for="last-name-column">Institution Administrator</label>
					<fieldset class="form-group">
				<select class="form-select" name="Administrator" id="Administrator"><option></option>' ?>

				<?php foreach ($Administrator as $admin){ 
				
				echo '<option value="'.$admin['UserID'].'" >'.$admin['UserName'].' ('.$admin['Email'].')</option>'; 
				} 
				
				echo '
				</select>
			</fieldset>
				</div>
			</div>';
			
		echo '<div class="col-md-12 col-12">
				<div class="form-group">
					<label for="last-name-column">Status</label>
					<fieldset class="form-group">
				<select class="form-select" name="status" id="status">' ?>

				<?php foreach ($st as $sta){ 

				echo '<option value="'.$sta['StatusId'].'">'.$sta['Status'].'</option>'; 
				} 
				
				echo '
				</select>
			</fieldset>
				</div>
			</div>';
			
			exit;
}



if(isset($_POST["rowid"]) && $_POST["rowid"] != '000')
{
	while($row = mysqli_fetch_array($result))
	{
		echo '<input type="hidden" id="InstitutionId" class="form-control" name="InstitutionId" value="' . $row["InstitutionId"] . '">';
		echo '<div class="col-md-12 col-12">
				<div class="form-group">
					<label for="first-name-column">Institution Name</label>
					<input type="text" id="name" class="form-control" name="name" value="' . $row["Name"] . '">
				</div>
			</div>';
			
		echo '<div class="col-md-12 col-12">
				<div class="form-group">
					<label for="last-name-column">Institution Type</label>
					<fieldset class="form-group">
				<select class="form-select" name="type" id="type">' ?>

				<?php foreach ($type as $t){ 
				$select = '';
				if($row["Description"] === $t['Description']){
					$select = 'selected="selected"';
				}
				echo '<option value="'.$t['InstitutionTypeId'].'" '.$select.'>'.$t['Description'].'</option>'; 
				} 
				
				echo '
				</select>
			</fieldset>
				</div>
			</div>';
			
			echo '<div class="col-md-12 col-12">
				<div class="form-group">
					<label for="last-name-column">Institution Administrator</label>
					<fieldset class="form-group">
				<select class="form-select" name="Administrator" id="Administrator">
				<option></option>
				' ;
				
				
				
				foreach ($Administrator as $admin){ 
						echo '<option value="'.$admin['UserID'].'" >'.$admin['UserName'].' ('.$admin['Email'].')</option>'; 
				} 
				
				echo '
				</select>
			</fieldset>
				</div>
			</div>';
			
		echo '<div class="col-md-12 col-12">
				<div class="form-group">
					<label for="last-name-column">Status</label>
					<fieldset class="form-group">
				<select class="form-select" name="status" id="status">' ?>

				<?php foreach ($st as $sta){ 
				$select = '';
				if($row["Status"] === $sta['Status']){
					$select = 'selected="selected"';
				}
				echo '<option value="'.$sta['StatusId'].'" '.$select.'>'.$sta['Status'].'</option>'; 
				} 
				
				echo '
				</select>
			</fieldset>
				</div>
			</div>';
	}
	exit;
}


while($row = mysqli_fetch_array($result))
{
 	
 $sub_array = array();
 $sub_array[] = '<div data-id="'.$row["InstitutionId"].'" data-column="Name">' . $row["Name"] . '</div>';
 $sub_array[] = '<div data-id="'.$row["InstitutionId"].'" data-column="InstitutionTypeId">' . $row["Description"] . '</div>';
   $sub_array[] = '<div data-id="'.$row["InstitutionId"].'" data-column="UserID">' . $row["UserName"] . ' ('. $row["Email"] . ')</div>';
 $sub_array[] = '<div data-id="'.$row["InstitutionId"].'" data-column="IsActive">' . $row["Status"] . '</div>';

	$sub_array[] = '<div class="icon dripicons-document-edit" data-id="'.$row["InstitutionId"].'" data-bs-toggle="modal" data-bs-target="#manage_institution"></div>';
 $data[] = $sub_array;
}



function get_all_data($conn)
{
 $query = "SELECT a.*, b.*,c.Status, e.* FROM `LookupInstitutions` a 
left join `LookupInstitutionTypes` b on b.`InstitutionTypeId` = a.`InstitutionTypeId`
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