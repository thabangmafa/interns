<?php

include '../../connect.php';
$conn = OpenCon();

$columns = array('BudgetYear', 'Title', 'IsActive');

$query = "SELECT DISTINCT a.ID AS CID, a.BudgetYear, a.Title, a.Description, a.OpenDate, a.ClosingDate, a.HostRequirementsFile, a.ApplicantRequirementsFile, 
CASE WHEN `ClosingDate` < CURDATE() THEN 'Closed' 
WHEN a.IsActive = 0 THEN 'Inactive' 
WHEN d.InstitutionID = '' OR d.InstitutionID is null THEN 'Missing Institution' 
WHEN HostRequirementsFile = '' OR HostRequirementsFile IS NULL THEN 'Missing Documents' 
WHEN ApplicantRequirementsFile = '' OR ApplicantRequirementsFile IS NULL THEN 'Missing Documents' 
WHEN a.IsActive = 1 AND HostRequirementsFile != '' AND ApplicantRequirementsFile != '' AND `ClosingDate` >= CURDATE() THEN 'Open' END Status , 
c.StatusId,c.Status as IsActive, e.Name as Budgy FROM HostInstitutionCalls a 
left join `LookupIsActive` c on c.`StatusId` = a.`IsActive` 
left join `LookupBudgetYear` e on e.`ID` = a.`BudgetYear`
left join `CallInstitutionLink` d on d.CallID = a.ID";

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
					<label for="BudgetYear">Budget Year</label>
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
					<label for="Title">Title</label>
					<input type="text" id="Title" class="form-control" name="Title" value="" required="required">
				</div>
			</div>';
			
		echo '<div class="col-md-12 col-12">
				<div class="form-group">
					<label for="Description">Description</label>
					<textarea class="form-control" id="Description" name="Description" rows="3" required="required"></textarea>
				</div>
			</div>';
			
		
			
		echo '<div class="col-md-12 col-12">
				<div class="form-group">
					<label for="OpenDate">Open Date</label>
					<input type="date" id="OpenDate" class="form-control" name="OpenDate" value="" required="required">
				</div>
			</div>';
			
			echo '<div class="col-md-12 col-12">
				<div class="form-group">
					<label for="ClosingDate">Closing Date</label>
					<input type="date" id="ClosingDate" class="form-control" name="ClosingDate" value="" required="required">
				</div>
			</div>';
						
			
		echo '<div class="col-md-12 col-12">
				<div class="form-group">
					<label for="last-name-column">Is Active</label>
					<fieldset class="form-group">
				<select class="form-select" name="IsActive" id="IsActive">' ?>

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
					<input type="text" id="Title" class="form-control" name="Title" value="' . $row["Title"] . '" required="required">
				</div>
			</div>';
			
			echo '<div class="col-md-12 col-12">
				<div class="form-group">
					<label for="first-name-column">Description</label>
					<textarea class="form-control" id="Description" name="Description" rows="3" required="required">' . $row["Description"] . '</textarea>
				</div>
			</div>';
		
			echo '<div class="col-md-12 col-12">
				<div class="form-group">
					<label for="first-name-column">Open Date</label>
					<input type="date" id="OpenDate" class="form-control" name="OpenDate" value="' . $row["OpenDate"] . '" required="required">
				</div>
			</div>';
			
			echo '<div class="col-md-12 col-12">
				<div class="form-group">
					<label for="first-name-column">Closing Date</label>
					<input type="date" id="ClosingDate" class="form-control" name="ClosingDate" value="' . $row["ClosingDate"] . '" required="required">
				</div>
			</div>';
			
			echo '<div class="form-group">
				<label for="HostRequirementsFile">Host Requirements</label>
				<input type="file" class="form-control-file" id="HostRequirementsFile" name="HostRequirementsFile">
			  </div>';
			  
			  echo '<div class="form-group">
				<label for="ApplicantRequirementsFile">Applicant Requirements</label>
				<input type="file" class="form-control-file" id="ApplicantRequirementsFile" name="ApplicantRequirementsFile">
			  </div>';
				
			
		echo '<div class="col-md-12 col-12">
				<div class="form-group">
					<label for="last-name-column">Is Active</label>
					<fieldset class="form-group">
				<select class="form-select" name="IsActive" id="IsActive">' ?>

				<?php foreach ($st as $sta){ 
				$select = '';
				if($row["IsActive"] === $sta['Status']){
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
 
 $hostReq = 'No Host Document';
 $appReq = 'No Applicant Document';
 
 if($row["HostRequirementsFile"]){
	 $hostReq = '<a target="_blank" href="../../../uploads/calls/'.$row["CID"].'/'.$row["HostRequirementsFile"].'">Host Requirements</a>';
 }
 
 if($row["ApplicantRequirementsFile"]){
	 $appReq = '<a target="_blank" href="../../../uploads/calls/'.$row["CID"].'/'.$row["ApplicantRequirementsFile"].'">Applicant Requirements</a>';
 }
 
 
 $sub_array = array();
 $sub_array[] = '<div data-id="'.$row["CID"].'" data-column="BudgetYear">' . $row["Budgy"] . '</div>';
 $sub_array[] = '<div data-id="'.$row["CID"].'" data-column="Title">' . $row["Title"] . '</div>';
 $sub_array[] = '<div data-id="'.$row["CID"].'" data-column="Description">' . $row["Description"] . '</div>';
 $sub_array[] = '<div data-id="'.$row["CID"].'" data-column="OpenDate">' . $row["OpenDate"] . '</div>';
 $sub_array[] = '<div data-id="'.$row["CID"].'" data-column="ClosingDate">' . $row["ClosingDate"] . '</div>';
 $sub_array[] = '<div data-id="'.$row["CID"].'" data-column="Status">' . $row["Status"] . '</div>';
 $sub_array[] = '<div data-id="'.$row["CID"].'" data-column="Documents">' .$hostReq. '<br />'.$appReq. '</div>';
 $sub_array[] = '<div class="icon dripicons-enter" data-id="'.$row["CID"].'" data-bs-toggle="modal" data-bs-target="#link_institution"></div>';
 
	$sub_array[] = '<div class="icon dripicons-document-edit" data-id="'.$row["CID"].'" data-bs-toggle="modal" data-bs-target="#manage_institution"></div>';
 $data[] = $sub_array;
}



function get_all_data($conn)
{
 $query = "SELECT DISTINCT a.ID AS CID, a.BudgetYear, a.Title, a.Description, a.OpenDate, a.ClosingDate, a.HostRequirementsFile, a.ApplicantRequirementsFile, 
CASE WHEN `ClosingDate` < CURDATE() THEN 'Closed' 
WHEN a.IsActive = 0 THEN 'Inactive' 
WHEN d.InstitutionID = '' OR d.InstitutionID is null THEN 'Missing Institution' 
WHEN HostRequirementsFile = '' OR HostRequirementsFile IS NULL THEN 'Missing Documents' 
WHEN ApplicantRequirementsFile = '' OR ApplicantRequirementsFile IS NULL THEN 'Missing Documents' 
WHEN a.IsActive = 1 AND HostRequirementsFile != '' AND ApplicantRequirementsFile != '' AND `ClosingDate` >= CURDATE() THEN 'Open' END Status , 
c.StatusId,c.Status as IsActive, e.Name as Budgy FROM HostInstitutionCalls a 
left join `LookupIsActive` c on c.`StatusId` = a.`IsActive` 
left join `LookupBudgetYear` e on e.`ID` = a.`BudgetYear`
left join `CallInstitutionLink` d on d.CallID = a.ID";

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