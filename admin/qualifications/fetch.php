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
				
				
				echo '<div class="row"><div class="message"></div>
												<div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="AcademicLevel">Academic Level of Qualification <span style="color:red">*</span></label>
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
                                                        <label for="NameOfDegree">Name of Degree/Diploma <span style="color:red">*</span></label>
                                                        <input type="text" id="NameOfDegree" class="form-control"
                                                             name="NameOfDegree" required="required">
                                                    </div>
                                                </div>
											
											
											
												';
												
												 if(@$_SESSION['user_type'] == '4'){ echo '
                                                <div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="TitleOfResearchProject">Title of thesis (if applicable)</label>
                                                        <input type="text" id="TitleOfResearchProject" class="form-control"
                                                             name="TitleOfResearchProject" required="required">
                                                    </div>
                                                </div>
                                                
												
												<div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="Institution">Institution <span style="color:red">*</span></label>
                                                        <input type="text" id="Institution" class="form-control"
                                                             name="Institution" required="required">
                                                    </div>
                                                </div>
												
												<div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="Fulltime">Full-time <span style="color:red">*</span></label>
                                                        <fieldset class="form-group">
                                                    <select class="form-select" id="Fulltime" name="Fulltime" required="required">
                                                        <option></option>
                                                        <option>Yes</option>
                                                        <option>No</option>
                                                    </select>
                                                </fieldset>
                                                    </div>
                                                </div>
												
												<div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="Distinction">Degree Classification <span style="color:red">*</span></label>
                                                        <fieldset class="form-group">
                                                    <select class="form-select" id="Distinction" name="Distinction" required="required">
													<option></option>
                                                        <option>Distinction</option>
														<option>Merit</option>
														<option>Pass</option>														
                                                    </select>
                                                </fieldset>
                                                    </div>
                                                </div>
												
												<div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="Sector">Sector <span style="color:red">*</span></label>
                                                        <fieldset class="form-group">
                                                    <select class="form-select" id="Sector" name="Sector" required="required">
													<option></option>
                                                    <option>Agriculture, Forestry, And Fishing</option>
													<option>Mining</option>
													<option>Construction</option>
													<option>Manufacturing</option>
													<option>Transportation, Communications, Electric, Gas, and Sanitary Services</option>
													<option>Wholesale Trade</option>
													<option>Retail Trade</option>
													<option>Finance, Insurance, and Real Estate</option>
													<option>Services</option>
													<option>Public Administration</option>
													<option>Eduction (e.g. High Education institutions)</option>
													<option>Research & Development</option>
                                                    </select>
                                                </fieldset>
                                                    </div>
                                                </div>
												
												<div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="DateFirstRegistration">Date of First Registration <span style="color:red">*</span></label>
                                                        <input type="date" id="DateFirstRegistration" class="form-control"
                                                             name="DateFirstRegistration" required="required">
                                                    </div>
                                                </div>
												
												
													<div class="col-md-6 col-12">
														<div class="form-group">
															<label for="Completed">Completed <span style="color:red">*</span></label>
															<fieldset class="form-group">
														<select class="form-select Completed" id="CompletedNew" required="required" name="Completed" onchange="myFunction()">
														<option></option>
															<option>Yes</option>
															<option>No</option> 
														</select>
													</fieldset>
														</div>
													</div>
												
												<div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="HighestCompletedQualification">Is this your Hisgest Completed Qualification? <span style="color:red">*</span></label>
                                                        <fieldset class="form-group">
                                                    <select class="form-select" id="HighestCompletedQualification" name="HighestCompletedQualification" required="required">
													<option></option>
                                                        <option>Yes</option>
														<option>No</option> 
                                                    </select>
                                                </fieldset>
                                                    </div>
                                                </div>
												
												<div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="TranscriptFile">Add Transcript <span style="color:red">*</span></label>
                                                        
                                                <input class="form-control" type="file" id="TranscriptFile" required="required" name="TranscriptFile[]" multiple>
                                                    </div>
                                                </div>
												
												<div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="AnticipatedDateCompletion">Completion date/Anticipated Date of Completion <span style="color:red">*</span></label>
                                                        <input type="date" id="AnticipatedDateCompletion" class="form-control"
                                                            name="AnticipatedDateCompletion">
                                                    </div>
                                                </div>
												
										<div class="row notCompleted" style="visibility: hidden;">
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
												
												
												
                                                
												
											</div>	';
											
												 }
												 echo '
												
                                            </div>';
				
				
			exit;
}



if(isset($_POST["rowid"]) && $_POST["rowid"] != '000')
{
	
	@$directory = '../../uploads/qualifications/'.@$_SESSION["id"];
	@$scanned_directory = array_diff(scandir(@$directory), array('..', '.'));
	$files = '';
	$req = '';
	$i = 0;
	if(@$scanned_directory){
	foreach($scanned_directory as $file){
		$i++;
		$files .= '<a style="color:red" class="icon dripicons-document-delete" href="?section=qualifications&file='.@$file.'"></a> <a target="_blank" href="../../uploads/qualifications/'.@$_SESSION["id"].'/'.$file.'"> Transcript '.$i.'</a> | ';
		$req = 'required="required"';
	}
	
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
				
			
			';
			
			
			echo "<div class='col-md-6 col-12'>
					<div class='form-group'>
						<label for='NameOfDegree'>Name of Degree/Diploma</label>
						<input type='text' id='NameOfDegree' class='form-control'
							 name='NameOfDegree' required='required' value='" . $row['NameOfDegree'] . "'>
					</div>
				</div>
				";
				
			if(@$_SESSION['user_type'] == '4'){ echo '
			
				<div class="col-md-6 col-12">
					<div class="form-group">
						<label for="TitleOfResearchProject">Title of thesis (if applicable)</label>
						<input type="text" id="TitleOfResearchProject"  class="form-control"
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
						<label for="Distinction">Degree Classification</label>
						<fieldset class="form-group">
					<select class="form-select" id="Distinction" name="Distinction" required="required">
					<option>' . $row["Distinction"] . '</option>
						<option>Distinction</option>
						<option>Merit</option>
						<option>Pass</option> 
					</select>
				</fieldset>
					</div>
				</div>
				
				<div class="col-md-6 col-12">
					<div class="form-group">
						<label for="Sector">Sector <span style="color:red">*</span></label>
						<fieldset class="form-group">
					<select class="form-select" id="Sector" name="Sector" required="required">
					<option>' . $row["Sector"] . '</option>
					<option>Agriculture, Forestry, And Fishing</option>
					<option>Mining</option>
					<option>Construction</option>
					<option>Manufacturing</option>
					<option>Transportation, Communications, Electric, Gas, and Sanitary Services</option>
					<option>Wholesale Trade</option>
					<option>Retail Trade</option>
					<option>Finance, Insurance, and Real Estate</option>
					<option>Services</option>
					<option>Public Administration</option>
					<option>Eduction (e.g. High Education institutions)</option>
					<option>Research & Development</option>
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
						<select class="form-select Completed" id="Completed" required="required" name="Completed" onchange="myFunction()">
						<option>' . $row["Completed"] . '</option>
							<option>Yes</option>
							<option>No</option> 
						</select>
					</fieldset>
						</div>
					</div>
				
				<div class="col-md-6 col-12">
					<div class="form-group">
						<label for="HighestCompletedQualification">Is this your Hisgest Completed Qualification?</label>
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
				</div>
				
				<div class="col-md-6 col-12">
					<div class="form-group">
						<label for="AnticipatedDateCompletion">Completion date/Anticipated Date of Completion</label>
						<input type="date" id="AnticipatedDateCompletion" class="form-control"
							name="AnticipatedDateCompletion" value=' . $row["AnticipatedDateCompletion"] . '>
					</div>
				</div>
				
				';
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
				
				';
			}
			echo '
				
				</div>';
					
					
		echo '</div>';
	}
	exit;
}


while($row = mysqli_fetch_array($result))
{
 	
 $sub_array = array();
 $sub_array[] = '<div data-id="'.$row["ID"].'" data-column="AcademicLevel">' . $row["Level"] . '</div>';
 $sub_array[] = '<div data-id="'.$row["ID"].'" data-column="NameOfDegree">' . $row["NameOfDegree"] . '</div>';
 if(@$_SESSION['user_type'] == '4'){
 $sub_array[] = '<div data-id="'.$row["ID"].'" data-column="HighestCompletedQualification">' . $row["HighestCompletedQualification"] . '</div>';
  $sub_array[] = '<div data-id="'.$row["ID"].'" data-column="AnticipatedDateCompletion">' . $row["AnticipatedDateCompletion"] . '</div>';
  
 }
	$sub_array[] = '<div class="icon dripicons-document-edit" data-id="'.$row["ID"].'" style="float:left;" data-bs-toggle="modal" data-bs-target="#capture-new"></div><a style="color:red; " class="icon dripicons-document-delete" href="?record='.$row["ID"].'">';
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