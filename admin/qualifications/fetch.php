<?php

include '../connect.php';
$conn = OpenCon();

$columns = array('Language', 'Speak', 'Read', 'Write');

$query = "SELECT a.*, b.Name as Level FROM Qualifications a 
left join LookupQualificationLevel b on b.ID = a.AcademicLevel
WHERE UserID = '".$_SESSION['id']."'";

if(isset($_POST["search"]["value"]))
{
 $query .= '
 AND (b.Name LIKE "%'.$_POST["search"]["value"].'%" || a.NameOfDegree LIKE "%'.$_POST["search"]["value"].'%" || TitleOfResearchProject LIKE "%'.$_POST["search"]["value"].'%")';
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
 $query .= 'ORDER BY b.Name ASC ';
}

$query1 = '';

if(@$_POST["length"] != -1 && !isset($_POST["rowid"]))
{
 $query1 = 'LIMIT ' . @$_POST['start'] . ', ' . @$_POST['length'];
}


$result = mysqli_query($conn,$query. $query1);

$QualificationLevel = mysqli_query($conn,"SELECT distinct * FROM LookupQualificationLevel WHERE IsActive = '1'");

while($QLevels = mysqli_fetch_array($QualificationLevel))
	{
		$QLevel[] = $QLevels;
	}
	
$data = array();


if(isset($_POST["rowid"]) && $_POST["rowid"] == '000')
{
				
				
				echo '<div class="row">
												<div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="AcademicLevel">Academic Level of Qualification</label>
                                                        <fieldset class="form-group">
                                                    <select class="form-select" id="AcademicLevel" name="AcademicLevel">
													<option></option> ';
													foreach($QLevel as $level){
														echo '<option value="'.$level['ID'].'">'.ucwords($level['Name']).'</option>';
													}
															
                                                   echo ' </select>
                                                </fieldset>
                                                    </div>
													
                                                </div>
												<div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="NameOfDegree">Name of Degree/Diploma (e.g. PhD)</label>
                                                        <input type="text" id="NameOfDegree" class="form-control"
                                                             name="NameOfDegree" required="required">
                                                    </div>
                                                </div>
											
											
											
											
                                                <div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="TitleOfResearchProject">Title of Research Project</label>
                                                        <input type="text" id="TitleOfResearchProject" class="form-control"
                                                             name="TitleOfResearchProject">
                                                    </div>
                                                </div>
                                                
												
												<div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="Institution">Institution</label>
                                                        <input type="text" id="Institution" class="form-control"
                                                             name="Institution">
                                                    </div>
                                                </div>
												
												<div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="Fulltime">Full-time</label>
                                                        <fieldset class="form-group">
                                                    <select class="form-select" id="Fulltime" name="Fulltime">
                                                        <option></option>
                                                        <option>Yes</option>
                                                        <option>No</option>
                                                    </select>
                                                </fieldset>
                                                    </div>
                                                </div>
												
												<div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="Distinction">Distinction</label>
                                                        <fieldset class="form-group">
                                                    <select class="form-select" id="Distinction" name="Distinction">
													<option></option>
                                                        <option>Yes</option>
														<option>No</option> 
                                                    </select>
                                                </fieldset>
                                                    </div>
                                                </div>
												

												
												<div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="DateFirstRegistration">Date of First Registration</label>
                                                        <input type="date" id="DateFirstRegistration" class="form-control"
                                                             name="DateFirstRegistration">
                                                    </div>
                                                </div>
												
												
													<div class="col-md-6 col-12">
														<div class="form-group">
															<label for="Completed">Completed</label>
															<fieldset class="form-group">
														<select class="form-select" id="Completed" name="Completed">
														<option></option>
															<option>Yes</option>
															<option>No</option> 
														</select>
													</fieldset>
														</div>
													</div>
												
												<div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="HighestCompletedQualification">Highest Completed Qualification</label>
                                                        <fieldset class="form-group">
                                                    <select class="form-select" id="HighestCompletedQualification" name="HighestCompletedQualification">
													<option></option>
                                                        <option>Yes</option>
														<option>No</option> 
                                                    </select>
                                                </fieldset>
                                                    </div>
                                                </div>
												
												<div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="TranscriptFile">Add Transcript</label>
                                                        
                                                <input class="form-control" type="file" id="TranscriptFile" name="TranscriptFile[]" multiple>
                                                    </div>
                                                </div>
												
												
                                                <div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="Status">Status</label>
                                                        <fieldset class="form-group">
                                                    <select class="form-select" id="Status" name="Status">
													<option></option>
                                                        <option>Discontinued (stopped)</option>

														<option>In progress</option>

														<option>Suspended (interrupted)</option> 
                                                    </select>
                                                </fieldset>
                                                    </div>
                                                </div>
												
												<div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="Reason">Reason</label>
                                                        <input type="text" id="Reason" class="form-control"
                                                            name="Reason">
                                                    </div>
                                                </div>
												
												
												
                                                <div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="AnticipatedDateCompletion">Anticipated Date of Completion</label>
                                                        <input type="date" id="AnticipatedDateCompletion" class="form-control"
                                                            name="AnticipatedDateCompletion">
                                                    </div>
                                                </div>
												
												
												
                                            </div>';
				
				
			exit;
}



if(isset($_POST["rowid"]) && $_POST["rowid"] != '000')
{
	
	$directory = '../../uploads/qualifications/'.$_SESSION["id"];
	$scanned_directory = array_diff(scandir($directory), array('..', '.'));
	$files = '';
	$req = '';
	$i = 0;
	foreach($scanned_directory as $file){
		$i++;
		$files .= '<a style="color:red" class="icon dripicons-document-delete" href="?section=qualifications&file='.$file.'"></a> <a target="_blank" href="../../uploads/qualifications/'.$_SESSION["id"].'/'.$file.'"> Transcript '.$i.'</a> | ';
		$req = 'required="required"';
	}



	while($row = mysqli_fetch_array($result))
	{
		echo '<div class="row">';
		echo '<input type="hidden" id="ID" class="form-control" name="ID" value="' . $row["ID"] . '">';
		echo '<div class="col-md-6 col-12">
					<div class="form-group">
						<label for="AcademicLevel">Academic Level of Qualification</label>
						<fieldset class="form-group">
					<select class="form-select" id="AcademicLevel" name="AcademicLevel" required="required">
					<option></option> ';
							foreach($QLevel as $level){
								$select = '';
								if($level['ID'] == $row["AcademicLevel"]){ $select = "selected='selected'"; }
								echo '<option value="'.$level['ID'].'" '.$select.'>'.ucwords($level['Name']).'</option>';
							}

				   echo ' </select>
				</fieldset>
					</div>
					
				</div>
				<div class="col-md-6 col-12">
					<div class="form-group">
						<label for="NameOfDegree">Name of Degree/Diploma (e.g. PhD)</label>
						<input type="text" id="NameOfDegree" class="form-control"
							 name="NameOfDegree" required="required" value=' . $row["NameOfDegree"] . '>
					</div>
				</div>
			
			
			
			
				<div class="col-md-6 col-12">
					<div class="form-group">
						<label for="TitleOfResearchProject">Title of Research Project</label>
						<input type="text" id="TitleOfResearchProject" required="required" class="form-control"
							 name="TitleOfResearchProject" value=' . $row["TitleOfResearchProject"] . '>
					</div>
				</div>
				
				
				<div class="col-md-6 col-12">
					<div class="form-group">
						<label for="Institution">Institution</label>
						<input type="text" id="Institution" required="required" class="form-control"
							 name="Institution" value=' . $row["Institution"] . '>
					</div>
				</div>
				
				<div class="col-md-6 col-12">
					<div class="form-group">
						<label for="Fulltime">Full-time</label>
						<fieldset class="form-group">
					<select class="form-select" id="Fulltime" name="Fulltime" required="required">
					<option> ' . $row["Fulltime"] . '</option>
						<option></option>
						<option>Yes</option>
						<option>No</option>
					</select>
				</fieldset>
					</div>
				</div>
				
				<div class="col-md-6 col-12">
					<div class="form-group">
						<label for="Distinction">Distinction</label>
						<fieldset class="form-group">
					<select class="form-select" id="Distinction" name="Distinction" required="required">
					<option>' . $row["Distinction"] . '</option>
						<option>Yes</option>
						<option>No</option> 
					</select>
				</fieldset>
					</div>
				</div>
				

				
				<div class="col-md-6 col-12">
					<div class="form-group">
						<label for="DateFirstRegistration">Date of First Registration</label>
						<input type="date" id="DateFirstRegistration" required="required" class="form-control"
							 name="DateFirstRegistration" value=' . $row["DateFirstRegistration"] . '>
					</div>
				</div>
				
				
					<div class="col-md-6 col-12">
						<div class="form-group">
							<label for="Completed">Completed</label>
							<fieldset class="form-group">
						<select class="form-select" id="Completed" required="required" name="Completed" onchange="myFunction()">
						<option>' . $row["Completed"] . '</option>
							<option>Yes</option>
							<option>No</option> 
						</select>
					</fieldset>
						</div>
					</div>
				
				<div class="col-md-6 col-12">
					<div class="form-group">
						<label for="HighestCompletedQualification">Highest Completed Qualification</label>
						<fieldset class="form-group">
					<select class="form-select" id="HighestCompletedQualification" required="required" name="HighestCompletedQualification">
					<option>' . $row["HighestCompletedQualification"] . '</option>
						<option>Yes</option>
						<option>No</option> 
					</select>
				</fieldset>
					</div>
				</div>
				
				
				
				<div class="col-md-6 col-12">
					<div class="form-group">
						<label for="TranscriptFile">Add Transcript </label><span  style="float:right">'.$files.'</span>
						<input class="form-control" type="file" id="TranscriptFile" required="required" name="TranscriptFile[]" multiple $req>
					</div>
				</div>
				</div>';
				$visibility = 'visibility: hidden;';
					if($row["Completed"] == 'No'){$visibility = 'visibility: visible;';}
				echo '<div class="row notCompleted" style="'.$visibility.'">
				
				<div class="col-md-6 col-12 ">
					<div class="form-group">
						<label for="Status">Status</label>
						<fieldset class="form-group">
					<select class="form-select" id="Status" name="Status">
					<option>' . $row["Status"] . '</option>
						<option>Discontinued (stopped)</option>

						<option>In progress</option>

						<option>Suspended (interrupted)</option> 
					</select>
				</fieldset>
					</div>
				</div>
				
				<div class="col-md-6 col-12">
					<div class="form-group">
						<label for="Reason">Reason</label>
						<input type="text" id="Reason" class="form-control Reason"
							name="Reason" value=' . $row["Reason"] . '>
					</div>
				</div>
				
				
				
				<div class="col-md-6 col-12">
					<div class="form-group">
						<label for="AnticipatedDateCompletion">Anticipated Date of Completion</label>
						<input type="date" id="AnticipatedDateCompletion" class="form-control"
							name="AnticipatedDateCompletion" value=' . $row["AnticipatedDateCompletion"] . '>
					</div>
				</div></div>';
					
					
		echo '</div>';
	}
	exit;
}


while($row = mysqli_fetch_array($result))
{
 	
 $sub_array = array();
 $sub_array[] = '<div data-id="'.$row["ID"].'" data-column="AcademicLevel">' . $row["Level"] . '</div>';
 $sub_array[] = '<div data-id="'.$row["ID"].'" data-column="NameOfDegree">' . $row["NameOfDegree"] . '</div>';
 $sub_array[] = '<div data-id="'.$row["ID"].'" data-column="HighestCompletedQualification">' . $row["HighestCompletedQualification"] . '</div>';
  $sub_array[] = '<div data-id="'.$row["ID"].'" data-column="AnticipatedDateCompletion">' . $row["AnticipatedDateCompletion"] . '</div>';
	$sub_array[] = '<div class="icon dripicons-document-edit" data-id="'.$row["ID"].'" data-bs-toggle="modal" data-bs-target="#capture-new"></div>';
 $data[] = $sub_array;
}



function get_all_data($conn)
{
 $query = "SELECT a.*, b.Name as Level FROM Qualifications a 
left join LookupQualificationLevel b on b.ID = a.AcademicLevel
WHERE UserID = '".$_SESSION['id']."'";

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