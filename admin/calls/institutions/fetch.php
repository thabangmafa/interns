<?php

include '../../connect.php';
$conn = OpenCon();

$columns = array('BudgetYear', 'Title', 'IsActive');

$query = "SELECT distinct a.ID AS CID,a.BudgetYear,a.Title, a.OpenDate, a.ClosingDate,a.Description, c.*, e.Name as Budgy FROM `HostInstitutionCalls` a 
left join `LookupIsActive` c on c.`StatusId` = a.`IsActive`
left join `LookupBudgetYear` e on e.`ID` = a.`BudgetYear`";

if(isset($_POST["search"]["value"]))
{
 $query .= '
 WHERE Title LIKE "%'.$_POST["search"]["value"].'%" || Status LIKE "%'.$_POST["search"]["value"].'%" || Description LIKE "%'.$_POST["search"]["value"].'%"';
}

if(isset($_POST["rowid"]))
{
 $query .= '
 WHERE a.ID = "'.$_POST["rowid"].'" ';
}

if(isset($_POST["order"]))
{
 $query .= 'ORDER BY '.$columns[$_POST['order']['0']['column']].' '.$_POST['order']['0']['dir'].' ';
}
else
{
 $query .= 'ORDER BY a.IsActive DESC , ClosingDate, Title ASC ';
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
	

$InstitutionTypes = mysqli_query($conn,"SELECT distinct * FROM LookupInstitutions WHERE IsActive = '1'");

while($types = mysqli_fetch_array($InstitutionTypes))
	{
		$type[] = $types;
	}
	
$LookupBudgetYear = mysqli_query($conn,"SELECT distinct * FROM LookupBudgetYear WHERE IsActive = '1'");

while($BudgetYear = mysqli_fetch_array($LookupBudgetYear))
	{
		$Budgy[] = $BudgetYear;
	}

$data = array();


if(isset($_POST["rowid"]) && $_POST["rowid"] == '000')
{
	
	echo '<div class="col-md-12 col-12">
				<div class="form-group">
					<label for="last-name-column">Budget Year</label>
					<fieldset class="form-group">
				<select class="form-select" name="BudgetYear" id="BudgetYear">' ?>

				<?php foreach ($Budgy as $t){ 
				
				echo '<option value="'.$t['ID'].'" >'.$t['Name'].'</option>'; 
				} 
				
				echo '
				</select>
			</fieldset>
				</div>
			</div>';
			
	echo '<div class="col-md-12 col-12">
				<div class="form-group">
					<label for="first-name-column">Title</label>
					<input type="text" id="Title" class="form-control" name="Title" value="">
				</div>
			</div>';
			
		echo '<div class="col-md-12 col-12">
				<div class="form-group">
					<label for="first-name-column">Description</label>
					<textarea class="form-control" id="Description" name="Description" rows="3"></textarea>
				</div>
			</div>';
			
		
			
		echo '<div class="col-md-12 col-12">
				<div class="form-group">
					<label for="first-name-column">Open Date</label>
					<input type="date" id="OpenDate" class="form-control" name="OpenDate" value="">
				</div>
			</div>';
			
			echo '<div class="col-md-12 col-12">
				<div class="form-group">
					<label for="first-name-column">Closing Date</label>
					<input type="date" id="ClosingDate" class="form-control" name="ClosingDate" value="">
				</div>
			</div>';
			
			
		echo '<div class="col-md-12 col-12">
				<div class="form-group">
					<label for="last-name-column">Status</label>
					<fieldset class="form-group">
				<select class="form-select" name="Status" id="Status">' ?>

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
		echo '<input type="hidden" id="ID" class="form-control" name="ID" value="' . $row["CID"] . '">';
		echo '<div class="col-md-12 col-12">
				<div class="form-group">
					<label for="last-name-column">Budget Year</label>
					<fieldset class="form-group">
				<select class="form-select" name="BudgetYear" id="BudgetYear">' ?>
				
				<?php foreach ($Budgy as $t){ 
				$selected = '';
				if($t['ID'] == $row["BudgetYear"]){ $selected = "selected='selected'"; }
				echo '<option value="'.$t['ID'].'" '.$selected.'>'.$t['Name'].'</option>'; 
				} 
				
				echo '
				</select>
			</fieldset>
				</div>
			</div>';
			
			echo '<div class="col-md-12 col-12">
				<div class="form-group">
					<label for="first-name-column">Title</label>
					<input type="text" id="Title" class="form-control" name="Title" value="' . $row["Title"] . '">
				</div>
			</div>';
			
			echo '<div class="col-md-12 col-12">
				<div class="form-group">
					<label for="first-name-column">Description</label>
					<textarea class="form-control" id="Description" name="Description" rows="3">' . $row["Description"] . '</textarea>
				</div>
			</div>';
		
			echo '<div class="col-md-12 col-12">
				<div class="form-group">
					<label for="first-name-column">Open Date</label>
					<input type="date" id="OpenDate" class="form-control" name="OpenDate" value="' . $row["OpenDate"] . '">
				</div>
			</div>';
			
			echo '<div class="col-md-12 col-12">
				<div class="form-group">
					<label for="first-name-column">Closing Date</label>
					<input type="date" id="ClosingDate" class="form-control" name="ClosingDate" value="' . $row["ClosingDate"] . '">
				</div>
			</div>';
				
			
		echo '<div class="col-md-12 col-12">
				<div class="form-group">
					<label for="last-name-column">Status</label>
					<fieldset class="form-group">
				<select class="form-select" name="Status" id="Status">' ?>

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
 $sub_array[] = '<div data-id="'.$row["CID"].'" data-column="BudgetYear">' . $row["Budgy"] . '</div>';
 $sub_array[] = '<div data-id="'.$row["CID"].'" data-column="Title">' . $row["Title"] . '</div>';
 $sub_array[] = '<div data-id="'.$row["CID"].'" data-column="Description">' . $row["Description"] . '</div>';
 $sub_array[] = '<div data-id="'.$row["CID"].'" data-column="OpenDate">' . $row["OpenDate"] . '</div>';
 $sub_array[] = '<div data-id="'.$row["CID"].'" data-column="ClosingDate">' . $row["ClosingDate"] . '</div>';
 $sub_array[] = '<div data-id="'.$row["CID"].'" data-column="Status">' . $row["Status"] . '</div>';
 $sub_array[] = '<div class="icon dripicons-enter" data-id="'.$row["CID"].'" data-bs-toggle="modal" data-bs-target="#link_institution"></div>';
 
	$sub_array[] = '<div class="icon dripicons-document-edit" data-id="'.$row["CID"].'" data-bs-toggle="modal" data-bs-target="#manage_institution"></div>';
 $data[] = $sub_array;
}



function get_all_data($conn)
{
 $query = "SELECT distinct a.ID AS CID,a.BudgetYear,a.Title, a.OpenDate, a.ClosingDate,a.Description, c.*, e.Name as Budgy FROM `HostInstitutionCalls` a 
left join `LookupIsActive` c on c.`StatusId` = a.`IsActive`
left join `LookupBudgetYear` e on e.`ID` = a.`BudgetYear`";

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