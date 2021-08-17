<?php 
include 'admin/connect.php';
$conn = OpenCon();
$menu_item = "2";
$title = "Registration Details";

$sql = "SELECT distinct Details FROM LookupHeadings WHERE Section='Registration Details' ";
		$result = mysqli_query($conn, $sql);
		$headings = mysqli_fetch_assoc($result);

if(@$_GET['file']){
	$f = "uploads/applicants/".$_SESSION['id']."/".$_GET['file'];
	if( file_exists($f)) unlink($f);
	$query = "UPDATE RegistrationDetails SET IDDocument = '' WHERE UserID = '".$_SESSION['id']."'";
	mysqli_query($conn, $query);
	header('Location: user-registration.php');
}

if (isset($_POST['Submit'])) {
	
	function validate($data){
       $data = trim($data);
	   $data = stripslashes($data);
	   $data = htmlspecialchars($data);
	   return $data;
	}
	$id = $_SESSION['id'];
	
	
	$id_number = validate($_POST['id_number']);
	
	if(strlen($id_number) != '13'){
		$message = '<div class="alert alert-danger" role="alert">Please correct your ID number before you continue.</div>';
		
	}else{
	
	
	
	$passport_number = validate($_POST['passport_number']);
	
	$oldstr = substr($id_number,0,6);

	$newstr = substr_replace($oldstr, '-', 2, 0);
	$newstr = substr_replace($newstr, '-', 5, 0);
	$time = strtotime($newstr);
	$dob = date('Y-m-d',$time);
	
	$date_of_birth = validate($_POST['date_of_birth']);
	$gender = validate($_POST['gender']);
	$race = validate($_POST['race']);
	
	$id_type = validate($_POST['id_type']);
	$citizenship = validate($_POST['citizenship']);
	$country = validate($_POST['country']);
	$maiden_name = validate($_POST['maiden_name']);
	$last_name = validate($_POST['last_name']);
	$first_name = validate($_POST['first_name']);
	$HostedInternsBefore = validate($_POST['HostedInternsBefore']);
	$PreviouslyApplied = validate($_POST['PreviouslyApplied']);
	$HowManyTimes = validate($_POST['HowManyTimes']);
	$initials = validate($_POST['initials']);
	$utitle = validate($_POST['title']);
	$Disability = validate($_POST['Disability']);
	$DisabilityDetails = validate($_POST['DisabilityDetails']);
	$insert1 = '';
	$insert2 = '';
	$update = '';
	
	
	
	
	if(isset($_FILES['id_document']['name'])){

		   /* Getting file name */
		   $IDDocument = $_FILES['id_document']['name'];
			
			
			if (!file_exists('uploads/applicants/'.$id)) {
				mkdir('uploads/applicants/'.$id, 0777, true);
			}
			
		   /* Location */
		   $location = "uploads/applicants/".$id.'/'.$IDDocument;
		   $imageFileType = pathinfo($location,PATHINFO_EXTENSION);
		   $imageFileType = strtolower($imageFileType);

		   /* Valid extensions */
		   $valid_extensions = array("pdf","doc","docx");

		   $response = 0;
		   /* Check file extension */
		   if(in_array(strtolower($imageFileType), $valid_extensions)) {
			  /* Upload file */
			  if(move_uploaded_file($_FILES['id_document']['tmp_name'],$location)){
				 $response = $location;
				 $insert1 = ',IDDocument';
				 $insert2 = ",'$IDDocument'";
				 $update = ",IDDocument = '$IDDocument'";
			  }
		   }

	}

	
	$query = "SELECT * FROM RegistrationDetails WHERE UserID = '".$_SESSION['id']."'";
	$result = mysqli_query($conn, $query);
	if (mysqli_num_rows($result) === 0) {
	
	$sql2 = "INSERT INTO RegistrationDetails(
						UserID,
						DateOfBirth,
						Gender,
						Race,
						IDNumber,
						PassportNumber,
						IDType,
						Citizenship,
						Country,
						MaidenName,
						LastName,
						FirstName,
						Initials,
						Title,
						HostedInternsBefore,
						PreviouslyApplied,
						HowManyTimes,
						Disability,
						DisabilityDetails
						$insert1
) VALUES(
						'$id',
						'$date_of_birth',
						'$gender',
						'$race',
						'$id_number',
						'$passport_number',
						'$id_type',
						'$citizenship',
						'$country',
						'$maiden_name',
						'$last_name',
						'$first_name',
						'$initials',
						'$utitle',
						'$HostedInternsBefore',
						'$PreviouslyApplied',
						'$HowManyTimes',
						 '$Disability',
						 '$DisabilityDetails'
						 $insert2

)";


    $result2 = mysqli_query($conn, $sql2);
	$message = '<div class="alert alert-success" role="alert">Details successfully captured.</div>';
	
	
	$checklist = "INSERT INTO ApplicantChecklist(UserID, Section)VALUES('$id','Registration Details')";
	mysqli_query($conn, $checklist);
	
	unset($_POST);
	}else{
		
	$sql2 = "UPDATE RegistrationDetails SET 
						DateOfBirth = '$date_of_birth',
						Gender = '$gender',
						Race = '$race',
						IDNumber = '$id_number',
						PassportNumber = '$passport_number',
						IDType = '$id_type',
						Citizenship = '$citizenship',
						Country = '$country',
						MaidenName = '$maiden_name',
						LastName = '$last_name',
						FirstName = '$first_name',
						Initials = '$initials',
						Title = '$utitle',
						HostedInternsBefore = '$HostedInternsBefore',
						PreviouslyApplied = '$PreviouslyApplied',
						HowManyTimes = '$HowManyTimes',
						Disability = '$Disability',
						DisabilityDetails = '$DisabilityDetails'
						".$update."
	
	WHERE UserID = '".$id."'";

	$result2 = mysqli_query($conn, $sql2);
	$message = '<div class="alert alert-success" role="alert">Details successfully updated.</div>';
	unset($_POST);	
	}
	
	
	 
	
}
}




	$query = "SELECT a.*, b.Email FROM RegistrationDetails a
	left join users b on b.UserID = a.UserID
	WHERE a.UserID = '".$_SESSION['id']."'";
	$result = mysqli_query($conn, $query);

	while($userdetails = mysqli_fetch_array($result)) {

			$HostedInternsBefore = $userdetails['HostedInternsBefore'];
			$UserGender = $userdetails['Gender'];
			$UserDateofBirth = $userdetails['DateOfBirth'];
			$UserRace = $userdetails['Race'];
			$UserIDNumber = $userdetails['IDNumber'];
			$PassportNumber = $userdetails['PassportNumber'];
			$UserIDType = $userdetails['IDType'];
			$UserCitizenship = $userdetails['Citizenship'];
			$UserCountry = $userdetails['Country'];
			$PreviouslyApplied = $userdetails['PreviouslyApplied'];
			$HowManyTimes = $userdetails['HowManyTimes'];
			$UserMaidenName = $userdetails['MaidenName'];
			$UserLastName = $userdetails['LastName'];
			$UserFirstName = $userdetails['FirstName'];
			$UserInitials = $userdetails['Initials'];
			$UserTitle = $userdetails['Title'];
			$UserDisability = $userdetails['Disability'];
			$DisabilityDetails = $userdetails['DisabilityDetails'];
			$IDDocument = $userdetails['IDDocument'];

	}
 ?>
		<?php require_once("admin/header.php"); ?>
        <?php require_once("menu.php"); ?>
		
        <div id="main">
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>

            <div class="page-heading">
                <div class="page-title">
                    <div class="row">
                        <div class="col-12 col-md-6 order-md-1 order-last">
                            <h3><?php echo $_SESSION['headingType'] . ' - ' . $title; ?></h3>
                            
                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="logout.php">Logout</a></li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>


                <!-- // Basic multiple Column Form section start -->
                <section id="multiple-column-form">
                    <div class="row match-height">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header alert alert-primary alert-dismissible fade show">
                                    <?php echo $headings['Details']; ?>
                                </div>
                                <div class="card-content">
								<?php if(@$message){ ?>	
								<?php echo @$message; ?>
								<?php } ?>
                                    <div class="card-body">
                                        <form class="form" action="" method="post" enctype="multipart/form-data">
                                            <div class="row">
												<div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="first-name-column">Title <span style="color:red">*</span></label>
                                                        <fieldset class="form-group">
                                                    <select class="choices form-select" id="title" name="title" required="required">
													<option></option>
                                                        <?php
				
															$query = "SELECT * FROM LookupUserTitle WHERE IsActive = '1' ORDER BY Title asc";
															$result = mysqli_query($conn, $query);

															while(@$UTitle = mysqli_fetch_array($result)) {
																$select = '';
																if(@$UserTitle == $UTitle['ID']){ $select = "selected='selected'"; }
															 echo '<option value="'.@$UTitle['ID'].'" '.$select.'>'.ucwords(@$UTitle['Title']).'</option>';
															}

														?>
                                                    </select>
                                                </fieldset>
                                                    </div>
                                                </div>
												<div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="first-name-column">Initials <span style="color:red">*</span></label>
                                                        <input type="text" id="initials" name="initials" class="form-control" value="<?php echo @$UserInitials; ?>" required="required">
                                                    </div>
                                                </div>
											
                                                <div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="first-name-column">First Name <span style="color:red">*</span></label>
                                                        <input type="text" id="first_name" name="first_name" value="<?php echo @$UserFirstName; ?>" class="form-control" required="required">
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="last-name-column">Surname <span style="color:red">*</span></label>
                                                        <input type="text" id="last_name" name="last_name" value="<?php echo @$UserLastName; ?>" class="form-control" required="required">
                                                    </div>
                                                </div>
												
												<div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="last-name-column">Maiden Name/Previous Surname</label>
                                                        <input type="text" id="maiden_name" name="maiden_name" value="<?php echo @$UserMaidenName; ?>" class="form-control">
                                                    </div>
                                                </div>
												
												<div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="last-name-column">Country of Birth <span style="color:red">*</span></label>
                                                        <fieldset class="form-group">
                                                    <select class="choices form-select" id="country" name="country" required="required">
													<option> </option>
                                                        <?php
				
															$query = "SELECT * FROM LookupCountry WHERE IsActive = '1' ORDER BY Country asc";
															$result = mysqli_query($conn, $query);
															
															
															while($country = mysqli_fetch_array($result)) {
																$select = '';
																if(@$UserCountry == $country['ID']){ $select = "selected='selected'"; }
															 echo '<option value="'.$country['ID'].'" '.$select.'>'.ucwords($country['Country']).'</option>';
															}

														?>
                                                    </select>
                                                </fieldset>
                                                    </div>
                                                </div>
												
												<div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="last-name-column">South African Citizenship Status <span style="color:red">*</span></label>
                                                        <fieldset class="form-group">
                                                    <select class="choices form-select" id="citizenship" name="citizenship" required="required">
													<option></option>
                                                        <?php
				
															$query = "SELECT * FROM LookupCitizenshipStatus WHERE IsActive = '1' ORDER BY Citizenship asc";
															$result = mysqli_query($conn, $query);
															
															
															while($citizenship = mysqli_fetch_array($result)) {
																$select = '';
																if(@$UserCitizenship == $citizenship['ID']){ $select = "selected='selected'"; }
															 echo '<option value="'.$citizenship['ID'].'" '.$select.'>'.ucwords($citizenship['Citizenship']).'</option>';
															}

														?>
                                                    </select>
                                                </fieldset>
                                                    </div>
                                                </div>
												
												<div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="id_type">ID Type <span style="color:red">*</span></label>
                                                        <fieldset class="form-group">
                                                    <select class="choices form-select" id="id_type" name="id_type" required="required">
														<option></option>
                                                        <?php
				
															$query = "SELECT * FROM LookupIDType WHERE IsActive = '1' ORDER BY Type asc";
															$result = mysqli_query($conn, $query);
															
															
															while($IDType = mysqli_fetch_array($result)) {
																$select = "";
															if(@$UserIDType == $IDType['ID']){ $select = "selected='selected'"; }
															 echo '<option value="'.$IDType['ID'].'" '.$select.'>'.ucwords($IDType['Type']).'</option>';
															}

														?>
                                                    </select>
                                                </fieldset>
                                                    </div>
                                                </div>
												
												<div class="col-md-6 col-12 IDView" <?php if(@$id_type == '2'){ echo 'style="display:none;"'; }elseif(@$id_type == '1' || @$UserIDType == '1'){ echo 'style="display:inline;"'; }else{
													 echo 'style="display:none;"';
												} ?>>
                                                    <div class="form-group">
                                                        <label for="id_number">ID Number <span style="color:red">*</span></label>
                                                        <input type="number" minlength="13" maxlength="13" id="id_number" name="id_number" value="<?php echo @$UserIDNumber; ?>" class="form-control" required="required">
                                                    </div>
                                                </div>
												
												<div class="col-md-6 col-12 PassportView" <?php if(@$id_type == '1'){ echo 'style="display:none;"'; }elseif(@$id_type == '2' || @$UserIDType == '2'){ echo 'style="display:inline;"'; }else{
													 echo 'style="display:none;"';
												} ?>>
                                                    <div class="form-group">
                                                        <label for="passport_number">Passport Number <span style="color:red">*</span></label>
                                                        <input type="text" id="passport_number" name="passport_number" value="<?php echo @$PassportNumber; ?>" class="form-control">
                                                    </div>
                                                </div>
												
												<div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="id_document">ID/Passport Number <span style="color:red">*</span></label> <span  style="float:right"> <?php if(@$IDDocument){
	 echo '<a style="color:red;" class="icon dripicons-document-delete" href="?section=qualifications&file='.@$IDDocument.'"></a> <a target="_blank" href="uploads/applicants/'.$_SESSION['id'].'/'.@$IDDocument.'">Attached Document</a>';
 } ?></span>
                                                        <input type="file" id="id_document" name="id_document" value="<?php echo @$IDDocument; ?>" class="form-control" <?php if(!@$IDDocument){ echo 'required="required"'; } ?>>
                                                    </div>
                                                </div>
												
												<div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="id_number">Date of Birth <span style="color:red">*</span></label>
                                                        <input type="date" id="date_of_birth" name="date_of_birth" value="<?php echo @$UserDateofBirth; ?>" class="form-control" required="required">
                                                    </div>
                                                </div>
												
												
                                                <div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="race">Race <span style="color:red">*</span></label>
                                                        <fieldset class="form-group">
                                                    <select class="choices form-select" id="race" name="race" required="required">
													<option></option>
                                                        <?php
				
															$query = "SELECT * FROM LookupRace WHERE IsActive = '1' ORDER BY Race asc";
															$result = mysqli_query($conn, $query);
															
														
															while($race = mysqli_fetch_array($result)) {
																$select = "";
															if($UserRace == $race['ID']){ $select = "selected='selected'"; }
															 echo '<option value="'.$race['ID'].'" '.$select.'>'.ucwords($race['Race']).'</option>';
															}

														?>
                                                    </select>
                                                </fieldset>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="gender">Gender <span style="color:red">*</span></label>
                                                        <fieldset class="form-group">
                                                    <select class="choices form-select" id="gender" name="gender" required="required">
                                                        <option></option>
                                                        <?php
				
															$query = "SELECT * FROM LookupGender WHERE IsActive = '1' ORDER BY Gender asc";
															$result = mysqli_query($conn, $query);
															

															while($gender = mysqli_fetch_array($result)) {
																$select = "";
																if(@$UserGender == $gender['ID']){ $select = "selected='selected'"; }
															 echo '<option value="'.$gender['ID'].'" '.$select.'>'.ucwords($gender['Gender']).'</option>';
															}

														?>
                                                    </select>
                                                </fieldset>
                                                    </div>
                                                </div>
												
												
								
												
												<div class="col-md-6 col-12" <?php if(@$_SESSION['user_type'] == '2' || @$_SESSION['user_type'] == '3'){ echo 'style="display:none;"'; } ?>>
                                                    <div class="form-group">
                                                        <label for="PreviouslyApplied">Have you previously applied for the DSI Internship? <span style="color:red">*</span></label>
                                                        <fieldset class="form-group">
                                                    <select class="choices form-select" id="PreviouslyApplied" name="PreviouslyApplied">
                                                        <option></option>
                                                        <option <?php if(@$PreviouslyApplied == 'Yes'){ echo "selected='selected'"; } ?>>Yes</option>
                                                        <option <?php if(@$PreviouslyApplied == 'No'){ echo "selected='selected'"; } ?>>No</option>
                                                    </select>
                                                </fieldset>
                                                    </div>
                                                </div>
												
												<div class="col-md-6 col-12" <?php if(@$_SESSION['user_type'] == '3'){ echo 'style="display:inline;"'; }else{ echo 'style="display:none;"'; } ?>>
                                                    <div class="form-group">
                                                        <label for="HostedInternsBefore">Have you previously hosted interns? <span style="color:red">*</span></label>
                                                        <fieldset class="form-group">
                                                    <select class="choices form-select" id="HostedInternsBefore" name="HostedInternsBefore">
                                                        <option></option>
                                                        <option <?php if(@$HostedInternsBefore == 'Yes'){ echo "selected='selected'"; } ?>>Yes</option>
                                                        <option <?php if(@$HostedInternsBefore == 'No'){ echo "selected='selected'"; } ?>>No</option>
                                                    </select>
                                                </fieldset>
                                                    </div>
                                                </div>
												
												<div class="col-md-6 col-12 HowManyTimes"  <?php if(@$_SESSION['user_type'] == '2' || @$_SESSION['user_type'] == '3'){ echo 'style="display:none;"'; } ?> <?php if(@$PreviouslyApplied == 'No' || @$PreviouslyApplied == ''){ echo 'style="display:none;"';} ?>>
                                                    <div class="form-group">
                                                        <label for="HowManyTimes">How many times have you applied</label>
                                                        <input type="number" id="HowManyTimes" class="form-control"
                                                             name="HowManyTimes" value="<?php echo @$HowManyTimes; ?>">
                                                    </div>
                                                </div>

												<div class="col-md-6 col-12" <?php if(@$_SESSION['user_type'] == '2' || @$_SESSION['user_type'] == '3'){ echo 'style="display:none;"'; } ?>>
                                                    <div class="form-group">
                                                        <label for="Disability">Do you have any serious disability that limits your full participation in life activities (such as education, work, social life)? <span style="color:red">*</span></label>
                                                        <fieldset class="form-group">
                                                    <select class="choices form-select" id="Disability" name="Disability">
														<option></option>
                                                        <option <?php if(@$UserDisability == 'Yes'){ echo "selected='selected'"; } ?>>Yes</option>
                                                        <option <?php if(@$UserDisability == 'No'){ echo "selected='selected'"; } ?>>No</option>
                                                    </select>
                                                </fieldset>
                                                    </div>
                                                </div>
												<div class="col-md-6 col-12" <?php if(@$_SESSION['user_type'] == '2' || @$_SESSION['user_type'] == '3'){ echo 'style="display:none;"'; } ?>>
                                                    
													
													<div class="form-group" id="disabilityDiv" <?php if(@$UserDisability == '' || @$UserDisability == 'No'){ echo 'style="display:none;"';} ?>>
                                                        
														<label for="Disability">Disablity Details <span style="color:red">*</span></label>
                                                        <fieldset class="form-group">
                                                    <select class="choices form-select" id="DisabilityDetails" name="DisabilityDetails">
													<option></option>
                                                        <option>None</option>
															<option <?php if(@$DisabilityDetails == 'Sight (blind/severe visual limitation)'){ echo "selected='selected'"; } ?>>Sight (blind/severe visual limitation)</option>
															<option <?php if(@$DisabilityDetails == 'Hearing (deaf, profoundly hard of hearing)'){ echo "selected='selected'"; } ?>>Hearing (deaf, profoundly hard of hearing)</option>
															<option <?php if(@$DisabilityDetails == 'Communication (speech impairment)'){ echo "selected='selected'"; } ?>>Communication (speech impairment)</option>
															<option <?php if(@$DisabilityDetails == 'Physical disability (needs wheelchair, crutches or prosthesis: limb, hand usage limitations)'){ echo "selected='selected'"; } ?>>Physical disability (needs wheelchair, crutches or prosthesis: limb, hand usage limitations)</option>
															<option <?php if(@$DisabilityDetails == 'Intellectual (serious difficulties in learning)'){ echo "selected='selected'"; } ?>>Intellectual (serious difficulties in learning)</option>
															<option <?php if(@$DisabilityDetails == 'Emotional (behavioural, psychological)'){ echo "selected='selected'"; } ?>>Emotional (behavioural, psychological)</option>
                                                    </select>
                                                </fieldset>
                                    
                                                    </div>
                                                </div>
												
                               
                                                <div class="col-12 d-flex justify-content-end">
                                                    
                                                    <button type="reset"
                                                        class="btn btn-light-secondary me-1 mb-1">Reset</button>
														<button type="submit"
                                                        class="btn btn-primary me-1 mb-1" name="Submit" value="Submit">Submit</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- // Basic multiple Column Form section end -->
            </div>

            <?php require_once("footer.php"); ?>
        </div>
    </div>
    <script src="assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    
    <script src="assets/js/main.js"></script>
</body>

</html>

<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script type="text/javascript">
 $(document).ready(function(){
	
$('#PreviouslyApplied').change(function() {
	var val = $(this).val();
		if(val === "Yes") {
			$('.HowManyTimes').show();

		}else{
			$('.HowManyTimes').hide();

		}
	});	
	

$('#Disability').change(function() {
	var val = $(this).val();
    if(val === "Yes") {
		$('#disabilityDiv').show();
	}else{
		$('#disabilityDiv').hide();
	}
});


$('#id_type').change(function() {
	var val = $(this).val();

    if(val === "2") {
		$('.PassportView').show();
		$('.IDView').hide();
	}else{
		$('.PassportView').hide();
		$('.IDView').show();
		
	}
});

});
</script>

