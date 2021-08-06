<?php 
include 'admin/connect.php';
$conn = OpenCon();
$menu_item = "2";
$title = "Contact Details";

if (isset($_POST['FullTimeStudent'])) {
	
	function validate($data){
       $data = trim($data);
	   $data = stripslashes($data);
	   $data = htmlspecialchars($data);
	   return $data;
	}
	
	$id = $_SESSION['id'];
	$FullTimeStudent = validate($_POST['FullTimeStudent']);
	$CurrentOrganisation = validate($_POST['CurrentOrganisation']);
	$IsOrganisationFundingSalary = validate($_POST['IsOrganisationFundingSalary']);
	$OrganisationFundingSalary = validate($_POST['OrganisationFundingSalary']);
	$DepartmentSchoolInstitution = validate($_POST['DepartmentSchoolInstitution']);
	$Faculty = validate($_POST['Faculty']);
	$WorkPostalAddress = validate($_POST['WorkPostalAddress']);
	$HomePhysicalAddress = validate($_POST['HomePhysicalAddress']);
	$WorkCityTown = validate($_POST['WorkCityTown']);
	$HomeCityTown = validate($_POST['HomeCityTown']);
	$WorkPostalCode = validate($_POST['WorkPostalCode']);
	$HomePostalCode = validate($_POST['HomePostalCode']);
	$WorkProvince = validate($_POST['WorkProvince']);
	$TelephoneNumber = validate($_POST['TelephoneNumber']);
	$MobileNumber = validate($_POST['MobileNumber']);
	$PrimaryEmail = validate($_POST['PrimaryEmail']);
	$ConfirmEmail = validate($_POST['ConfirmEmail']);
	$AlternativeEmail = validate($_POST['AlternativeEmail']);
	$HomeProvince = validate($_POST['HomeProvince']);
	$Country = validate($_POST['Country']);
	
	$query = "SELECT * FROM UserContactDetails WHERE UserID = '".$_SESSION['id']."'";
	$result = mysqli_query($conn, $query);
	if (mysqli_num_rows($result) === 0) {
	
	$sql2 = "INSERT INTO UserContactDetails(
						UserID,
						  FullTimeStudent,
						  CurrentOrganisation,
						  IsOrganisationFundingSalary,
						  OrganisationFundingSalary,
						  DepartmentSchoolInstitution,
						  Faculty,
						  WorkPostalAddress,
						  HomePhysicalAddress,
						  WorkCityTown,
						  HomeCityTown,
						  WorkPostalCode,
						  HomePostalCode,
						  WorkProvince,
						  TelephoneNumber,
						  MobileNumber,
						  PrimaryEmail,
						  ConfirmEmail,
						  AlternativeEmail,
						  HomeProvince,
						  Country
) VALUES(
						'$id',
						  '$FullTimeStudent',
						  '$CurrentOrganisation',
						  '$IsOrganisationFundingSalary',
						  '$OrganisationFundingSalary',
						  '$DepartmentSchoolInstitution',
						  '$Faculty',
						  '$WorkPostalAddress',
						  '$HomePhysicalAddress',
						  '$WorkCityTown',
						  '$HomeCityTown',
						  '$WorkPostalCode',
						  '$HomePostalCode',
						  '$WorkProvince',
						  '$TelephoneNumber',
						  '$MobileNumber',
						  '$PrimaryEmail',
						  '$ConfirmEmail',
						  '$AlternativeEmail',
						  '$HomeProvince',
						  '$Country'

)";


    $result2 = mysqli_query($conn, $sql2);
	$message = "Details successfully captured.";
	$checklist = "INSERT INTO ApplicantChecklist(UserID, Section)VALUES('$id','Contact Details')";
	mysqli_query($conn, $checklist);
	unset($_POST);
	}else{
		
	$sql2 = "UPDATE UserContactDetails SET 
						FullTimeStudent = '$FullTimeStudent',
						  CurrentOrganisation = '$CurrentOrganisation',
						  IsOrganisationFundingSalary = '$IsOrganisationFundingSalary',
						  OrganisationFundingSalary = '$OrganisationFundingSalary',
						  DepartmentSchoolInstitution = '$DepartmentSchoolInstitution',
						  Faculty = '$Faculty',
						  WorkPostalAddress = '$WorkPostalAddress',
						  HomePhysicalAddress = '$HomePhysicalAddress',
						  WorkCityTown = '$WorkCityTown',
						  HomeCityTown = '$HomeCityTown',
						  WorkPostalCode = '$WorkPostalCode',
						  HomePostalCode = '$HomePostalCode',
						  WorkProvince = '$WorkProvince',
						  TelephoneNumber = '$TelephoneNumber',
						  MobileNumber = '$MobileNumber',
						  PrimaryEmail = '$PrimaryEmail',
						  ConfirmEmail = '$ConfirmEmail',
						  AlternativeEmail = '$AlternativeEmail',
						  HomeProvince = '$HomeProvince',
						  Country = '$Country'
	
	WHERE UserID = '".$id."'";

	$result2 = mysqli_query($conn, $sql2);
	$message = "Details successfully updated.";
	unset($_POST);	
	}
	
}

	$query = "SELECT a.*, b.Email FROM UserContactDetails a
	left join users b on b.UserID = a.UserID
	WHERE a.UserID = '".$_SESSION['id']."'";
	$result = mysqli_query($conn, $query);

	while($userdetails = mysqli_fetch_array($result)) {
			$FullTimeStudent = $userdetails['FullTimeStudent'];
			 $CurrentOrganisation = $userdetails['CurrentOrganisation'];
						  $IsOrganisationFundingSalary = $userdetails['IsOrganisationFundingSalary'];
						  $OrganisationFundingSalary = $userdetails['OrganisationFundingSalary'];
						  $DepartmentSchoolInstitution = $userdetails['DepartmentSchoolInstitution'];
						  $Faculty = $userdetails['Faculty'];
						  $WorkPostalAddress = $userdetails['WorkPostalAddress'];
						  $HomePhysicalAddress = $userdetails['HomePhysicalAddress'];
						  $WorkCityTown = $userdetails['WorkCityTown'];
						  $HomeCityTown = $userdetails['HomeCityTown'];
						  $WorkPostalCode = $userdetails['WorkPostalCode'];
						  $HomePostalCode = $userdetails['HomePostalCode'];
						  $WorkProvince = $userdetails['WorkProvince'];
						  $TelephoneNumber = $userdetails['TelephoneNumber'];
						  $MobileNumber = $userdetails['MobileNumber'];
						  $PrimaryEmail = $userdetails['PrimaryEmail'];
						  $ConfirmEmail = $userdetails['ConfirmEmail'];
						  $AlternativeEmail = $userdetails['AlternativeEmail'];
						  $HomeProvince = $userdetails['HomeProvince'];
						  $Country = $userdetails['Country'];

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
                            <h3><?php echo $title; ?></h3>
                            
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
                                    <ul>
									<li>An * at the end of a field label within a section denotes that this is a compulsory field, and the section will not be saved unless all compulsory fields have been completed.</li>
<li>Please ensure that all compulsory fields in this section are complete and correct.</li>
<li>The information icon(i) indicates that there is a tooltip associated with the relevant field. When hoviring over this icon, additional information will show.</li></ul>
                                </div>
                                <div class="card-content">
                                    <div class="card-body">
                                        <form class="form" action="" method="post">
                                            <div class="row">
												<div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="FullTimeStudent">Are you a full time student? <span style="color:red">*</span></label>
                                                        <fieldset class="form-group">
                                                    <select class="form-select" id="FullTimeStudent" name="FullTimeStudent" required="required">
													<option><?php echo @$FullTimeStudent; ?></option>
                                                        <option>Yes</option>
														<option>No</option>
														
                                                    </select>
                                                </fieldset>
                                                    </div>
                                                </div>
												<div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="CurrentOrganisation">Current organisation </label>
                                                        <fieldset class="form-group">
                                                    <select class="form-select" id="CurrentOrganisation" name="CurrentOrganisation">
													<option value="">N/A</option>
                                                        <?php
				
															$query = "SELECT * FROM LookupInstitutions WHERE IsActive = '1' ORDER BY Name asc";
															$result = mysqli_query($conn, $query);
															

															while($institution = mysqli_fetch_array($result)) {
																$select = "";
																if($CurrentOrganisation == $institution['InstitutionId']){ $select = "selected='selected'"; }
															 echo '<option value="'.$institution['InstitutionId'].'" '.$select.'>'.ucwords($institution['Name']).'</option>';
															}

														?>
                                                    </select>
                                                </fieldset>
                                                    </div>
													
                                                </div>
												
												<div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="IsOrganisationFundingSalary">Is this the organisation that funds your salary?</label>
                                                        <fieldset class="form-group">
                                                    <select class="form-select" id="IsOrganisationFundingSalary" name="IsOrganisationFundingSalary">
													<option value="<?php echo @$IsOrganisationFundingSalary; ?>"><?php echo @$IsOrganisationFundingSalary; ?></option>
                                                        <option value="Yes">Yes</option>
														<option value="No">No</option>
														
                                                    </select>
                                                </fieldset>
                                                    </div>
                                                </div>

												
												<div class="col-md-6 col-12 OrganisationFundingSalary" <?php if(@$IsOrganisationFundingSalary == '' || @$IsOrganisationFundingSalary == 'Yes'){ echo 'style="display:none;"';} ?>>
                                                    <div class="form-group">
                                                        <label for="OrganisationFundingSalary">Primary organisation which funds your salary? <span style="color:red">*</span></label>
                                                        <input type="text" id="OrganisationFundingSalary" class="form-control"
                                                             name="OrganisationFundingSalary" value="<?php echo @$OrganisationFundingSalary; ?>" required="required">
                                                    </div>
                                                </div>
												
												<div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="DepartmentSchoolInstitution">Department/School/Institution</label>
                                                        <input type="text" id="DepartmentSchoolInstitution" class="form-control"
                                                             name="DepartmentSchoolInstitution" value="<?php echo @$DepartmentSchoolInstitution; ?>">
                                                    </div>
                                                </div>
												
												<div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="Faculty">Faculty</label>
                                                        <input type="text" id="Faculty" class="form-control"
                                                             name="Faculty" value="<?php echo @$Faculty; ?>">
                                                    </div>
                                                </div>
											
											
											
											
                                                <div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        
                                        <label for="WorkPostalAddress" class="form-label">Work Postal Address (excluding department) </label>
                                        <textarea class="form-control" id="WorkPostalAddress" name="WorkPostalAddress"
                                            rows="3" required="required"><?php echo @$WorkPostalAddress; ?></textarea>
                                    
                                                    </div>
                                                </div>
												<div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        
                                        <label for="HomePhysicalAddress" class="form-label">Home Physical Address <span style="color:red">*</span></label>
                                        <textarea class="form-control" id="HomePhysicalAddress" name="HomePhysicalAddress"
                                            rows="3" required="required"><?php echo @$HomePhysicalAddress; ?></textarea>
                                    
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="WorkCityTown">Work City/Town <span style="color:red">*</span></label>
                                                        <input type="text" id="WorkCityTown" class="form-control"
                                                             name="WorkCityTown" value="<?php echo @$WorkCityTown; ?>" required="required">
                                                    </div>
                                                </div>
												
												<div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="HomeCityTown">Home City/Town <span style="color:red">*</span></label>
                                                        <input type="text" id="HomeCityTown" class="form-control"
                                                             name="HomeCityTown" value="<?php echo @$HomeCityTown; ?>" required="required">
                                                    </div>
                                                </div>
												
												<div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="WorkPostalCode">Work Postal Code</label>
                                                        <input type="text" id="WorkPostalCode" class="form-control"
                                                             name="WorkPostalCode" value="<?php echo @$WorkPostalCode; ?>">
                                                    </div>
                                                </div>
												
												<div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="HomePostalCode">Home Postal Code <span style="color:red">*</span></label>
                                                        <input type="text" id="HomePostalCode" class="form-control"
                                                             name="HomePostalCode" value="<?php echo @$HomePostalCode; ?>" required="required">
                                                    </div>
                                                </div>
												
												<div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="WorkProvince">Work Province/State</label>
                                                        <fieldset class="form-group">
                                                    <select class="form-select" id="WorkProvince" name="WorkProvince">
                                                        <option></option>
                                                        <?php
				
															$query = "SELECT * FROM LookupProvince WHERE IsActive = '1' ORDER BY Name asc";
															$result = mysqli_query($conn, $query);
															

															while($province = mysqli_fetch_array($result)) {
																$select = "";
																if($WorkProvince == $province['ID']){ $select = "selected='selected'"; }
															 echo '<option value="'.$province['ID'].'" '.$select.'>'.ucwords($province['Name']).'</option>';
															}

														?>
                                                    </select>
                                                </fieldset>
                                                    </div>
                                                </div>
												
												
												
												
												
												
												
												<div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="TelephoneNumber">Primary Telephone Number <span style="color:red">*</span></label>
                                                        <input type="text" id="TelephoneNumber" class="form-control"
                                                             name="TelephoneNumber" value="<?php echo @$HomePostalCode; ?>" required="required">
                                                    </div>
                                                </div>
												
												
												
												<div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="MobileNumber">Mobile Number <span style="color:red">*</span></label>
                                                        <input type="text" value="<?php echo $MobileNumber; ?>" id="MobileNumber" class="form-control"
                                                            name="MobileNumber" required="required">
                                                    </div>
                                                </div>
												
												
                                                <div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="PrimaryEmail">Primary Email Address <span style="color:red">*</span></label>
                                                        <input type="email" id="PrimaryEmail" value="<?php echo $PrimaryEmail; ?>" class="form-control"
                                                            name="PrimaryEmail" required="required">
                                                    </div>
                                                </div>
												
												<div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="ConfirmEmail">Confirm Primary Email Address <span style="color:red">*</span></label>
                                                        <input type="email" value="<?php echo $ConfirmEmail; ?>" id="ConfirmEmail" class="form-control"
                                                            name="ConfirmEmail" required="required">
                                                    </div>
                                                </div>
												
												<div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="AlternativeEmail">Alternate Email Address <span style="color:red">*</span></label>
                                                        <input type="email" value="<?php echo $AlternativeEmail; ?>" id="AlternativeEmail" class="form-control"
                                                            name="AlternativeEmail" required="required">
                                                    </div>
                                                </div>
												
								
												<div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="HomeProvince">Home Province <span style="color:red">*</span></label>
                                                        <fieldset class="form-group">
                                                    <select class="form-select" id="HomeProvince" name="HomeProvince" required="required">
                                                        <option></option>
                                                        <?php
				
															$query = "SELECT * FROM LookupProvince WHERE IsActive = '1' ORDER BY Name asc";
															$result = mysqli_query($conn, $query);
															

															while($province = mysqli_fetch_array($result)) {
																$select = "";
																if($HomeProvince == $province['ID']){ $select = "selected='selected'"; }
															 echo '<option value="'.$province['ID'].'" '.$select.'>'.ucwords($province['Name']).'</option>';
															}

														?>
                                                    </select>
                                                </fieldset>
                                                    </div>
                                                </div>
												<div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="Country">Home Country <span style="color:red">*</span></label>
                                                        <fieldset class="form-group">
                                                    <select class="form-select" id="Country" name="Country" required="required">
													<option> </option>
                                                        <?php
				
															$query = "SELECT * FROM LookupCountry WHERE IsActive = '1' ORDER BY Country asc";
															$result = mysqli_query($conn, $query);
															
															
															while($country = mysqli_fetch_array($result)) {
																$select = '';
																if($Country == $country['ID']){ $select = "selected='selected'"; }
															 echo '<option value="'.$country['ID'].'" '.$select.'>'.ucwords($country['Country']).'</option>';
															}

														?>
                                                    </select>
                                                </fieldset>
                                                    </div>
                                                </div>
												
												
                               
                                                <div class="col-12 d-flex justify-content-end">
                                                    <button type="submit"
                                                        class="btn btn-primary me-1 mb-1" name="Submit" value="Submit">Submit</button>
                                                    <button type="reset"
                                                        class="btn btn-light-secondary me-1 mb-1">Reset</button>
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
	
	
	

$('#IsOrganisationFundingSalary').change(function() {
	var val = $(this).val();
		if(val === "No") {
			$('.OrganisationFundingSalary').show();
		}else{
			$('.OrganisationFundingSalary').hide();
		}
	});


});
</script>