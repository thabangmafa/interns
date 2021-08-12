<?php

include '../connect.php';
$conn = OpenCon();

$columns = array('PrimaryScientificField', 'SecondaryScientificField', 'QualificationLevel', 'NumberRequired');

$query = "SELECT a.ID,a.NumberRequired, b.Name, c.Name as PrimaryScientificField, d.Name as SecondaryScientificField, e.Name as QualificationLevel FROM ProfileOfRequestedInterns a 
left join LookupInstitutions b on b.InstitutionId = a.InstitutionID
left join LookupStudyField c on c.ID = a.PrimaryScientificField
left join LookupStudyField d on d.ID = a.SecondaryScientificField
left join LookupQualificationLevel e on e.ID = a.QualificationLevel
WHERE a.InstitutionID = '".$_SESSION['InstitutionID']."'
";

if(isset($_POST["search"]["value"]))
{
 $query .= '
 AND (b.Name LIKE "%'.$_POST["search"]["value"].'%" || c.Name LIKE "%'.$_POST["search"]["value"].'%" || d.Name LIKE "%'.$_POST["search"]["value"].'%" || e.Name LIKE "%'.$_POST["search"]["value"].'%")';
}

if(isset($_POST["rowid"]))
{
 $query .= '
 AND a.ID = "'.$_POST["rowid"].'" ';
}

if(isset($_POST["order"]))
{
 $query .= 'ORDER BY '.$columns[$_POST['order']['0']['column']].' '.$_POST['order']['0']['dir'].' ';
}
else
{
 $query .= 'ORDER BY PrimaryScientificField ASC ';
}

$query1 = '';

if(@$_POST["length"] != -1 && !isset($_POST["rowid"]))
{
 $query1 = 'LIMIT ' . @$_POST['start'] . ', ' . @$_POST['length'];
}


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
				
				echo '<input type="hidden" id="InstitutionID" class="form-control" name="InstitutionID" value="' . @$_SESSION['InstitutionID'] . '">';
				echo '<div class="row"><div class="message"></div>
				
												<div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="PrimaryScientificField">Primary Scientific Field <span style="color:red">*</span></label>
                                                        <fieldset class="form-group">
                                                    <select class="choices form-select" id="PrimaryScientificField" name="PrimaryScientificField">
													<option></option> ';
													foreach($Fields as $Field){
														echo '<option value="'.$Field['ID'].'">'.ucwords($Field['Name']).'</option>';
													}
															
                                                   echo ' </select>
                                                </fieldset>
                                                    </div>
													
                                                </div>
												
												<div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="SecondaryScientificField">Secondary Scientific Field <span style="color:red">*</span></label>
                                                        <fieldset class="form-group">
                                                    <select class="choices form-select" id="SecondaryScientificField" name="SecondaryScientificField">
													<option></option> ';
													foreach($Fields as $Field){
														echo '<option value="'.$Field['ID'].'">'.ucwords($Field['Name']).'</option>';
													}
															
                                                   echo ' </select>
                                                </fieldset>
                                                    </div>
													
                                                </div>
											
                                                <div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="NumberRequired">NumberRequired <span style="color:red">*</span></label>
                                                        <input type="text" id="NumberRequired" class="form-control"
                                                             name="NumberRequired">
                                                    </div>
                                                </div>
												
												<div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="QualificationLevel">Qualification Level <span style="color:red">*</span></label>
                                                        <fieldset class="form-group">
                                                    <select class="choices form-select" id="QualificationLevel" name="QualificationLevel">
													<option></option> ';
													foreach($Levels as $level){
														echo '<option value="'.$level['ID'].'">'.ucwords($level['Name']).'</option>';
													}
															
                                                   echo ' </select>
                                                </fieldset>
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
		
		
		echo '
				
		<div class="col-md-6 col-12">
			<div class="form-group">
				<label for="PrimaryScientificField">Primary Scientific Field</label>
				<fieldset class="form-group">
			<select class="choices form-select" id="PrimaryScientificField" name="PrimaryScientificField">
			<option></option> ';
			foreach($Fields as $Field){
				$select = '';
				if(ucwords($Field['Name']) == ucwords($row["PrimaryScientificField"])){ $select = "selected='selected'"; }
				echo '<option value="'.$Field['ID'].'" '.$select.'>'.ucwords($Field['Name']).'</option>';
			}
					
		   echo ' </select>
		</fieldset>
			</div>
			
		</div>
		
		<div class="col-md-6 col-12">
			<div class="form-group">
				<label for="SecondaryScientificField">Secondary Scientific Field</label>
				<fieldset class="form-group">
			<select class="choices form-select" id="SecondaryScientificField" name="SecondaryScientificField">
			<option></option> ';
			foreach($Fields as $Field){
				$select = '';
				if($Field['Name'] == $row["SecondaryScientificField"]){ $select = "selected='selected'"; }
				echo '<option value="'.$Field['ID'].'" '.$select.'>'.ucwords($Field['Name']).'</option>';
			}
					
		   echo ' </select>
		</fieldset>
			</div>
			
		</div>
	
		<div class="col-md-6 col-12">
			<div class="form-group">
				<label for="NumberRequired">Number Required</label>
				<input type="text" id="NumberRequired" class="form-control"
					 name="NumberRequired" value="' . $row["NumberRequired"] . '">
			</div>
		</div>
		
		<div class="col-md-6 col-12">
			<div class="form-group">
				<label for="QualificationLevel">Qualification Level</label>
				<fieldset class="form-group">
			<select class="choices form-select" id="QualificationLevel" name="QualificationLevel">
			<option></option> ';
			foreach($Levels as $level){
				$select = '';
				if($level['Name'] == $row["QualificationLevel"]){ $select = "selected='selected'"; }
				echo '<option value="'.$level['ID'].'" '.$select.'>'.ucwords($level['Name']).'</option>';
			}
					
		   echo ' </select>
		</fieldset>
			</div>
			
		</div>';
					
					
		echo '</div>';
	}
	exit;
}


while($row = mysqli_fetch_array($result))
{
 	
 $sub_array = array();
 $sub_array[] = '<div data-id="'.$row["ID"].'" data-column="PrimaryScientificField">' . $row["PrimaryScientificField"] . '</div>';
 $sub_array[] = '<div data-id="'.$row["ID"].'" data-column="SecondaryScientificField">' . $row["SecondaryScientificField"] . '</div>';
 $sub_array[] = '<div data-id="'.$row["ID"].'" data-column="NumberRequired">' . $row["NumberRequired"] . '</div>';
 $sub_array[] = '<div data-id="'.$row["ID"].'" data-column="QualificationLevel">' . $row["QualificationLevel"] . '</div>';
 $sub_array[] = '<div class="icon dripicons-document-edit" data-id="'.$row["ID"].'" data-bs-toggle="modal" data-bs-target="#capture-new"></div>';
 $data[] = $sub_array;
}



function get_all_data($conn)
{
 $query = "SELECT a.ID,a.NumberRequired, b.Name, c.Name as PrimaryScientificField, d.Name as SecondaryScientificField, e.Name as QualificationLevel FROM ProfileOfRequestedInterns a 
left join LookupInstitutions b on b.InstitutionId = a.InstitutionID
left join LookupStudyField c on c.ID = a.PrimaryScientificField
left join LookupStudyField d on d.ID = a.SecondaryScientificField
left join LookupQualificationLevel e on e.ID = a.QualificationLevel
WHERE a.InstitutionID = '".$_SESSION['InstitutionID']."'
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