<?php 
include 'admin/connect.php';
$conn = OpenCon();
$menu_item = "2";
$title = "Contact Details";

$sql = "SELECT distinct Details FROM LookupHeadings WHERE Section='Contact Details' ";
		$result = mysqli_query($conn, $sql);
		$headings = mysqli_fetch_assoc($result);

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
	$WorkCountry = validate($_POST['WorkCountry']);
	
	$Name = validate($_POST['Name']);
	$Telephone = validate($_POST['Telephone']);
	$Cellnumber = validate($_POST['Cellnumber']);
	$Relationship = validate($_POST['Relationship']);
	$Address = validate($_POST['Address']);
	
	$query = "SELECT * FROM NextOfKin WHERE UserID = '".$_SESSION['id']."'";
	$result = mysqli_query($conn, $query);
	if (mysqli_num_rows($result) === 0) {
	
	$sql2 = "INSERT INTO NextOfKin(
						UserID,
						Name,
						Telephone,
						Cellnumber,
						Relationship,
						Address
) VALUES(
						'$id',
						'$Name',
						'$Telephone',
						'$Cellnumber',
						'$Relationship',
						'$Address'

)";


    $result2 = mysqli_query($conn, $sql2);
	
	unset($_POST);
	}else{
		
	$sql2 = "UPDATE NextOfKin SET 
						Name = '$Name',
						Telephone = '$Telephone',
						Cellnumber = '$Cellnumber',
						Relationship = '$Relationship',
						Address = '$Address'
	
	WHERE UserID = '".$id."'";

	$result2 = mysqli_query($conn, $sql2);
	$message = "Details successfully updated.";
	unset($_POST);	
	}
	
	$query = "SELECT * FROM NextOfKin a
	WHERE a.UserID = '".$_SESSION['id']."'";
	$result = mysqli_query($conn, $query);

	while($userdetails = mysqli_fetch_array($result)) {

			$Name = $userdetails['Name'];
			$Telephone = $userdetails['Telephone'];
			$Cellnumber = $userdetails['Cellnumber'];
			$Relationship = $userdetails['Relationship'];
			$Address = $userdetails['Address'];
	}
	
	
	
	$checkOrganisation = "SELECT * FROM LookupInstitutions WHERE lower(Name) = lower('".$CurrentOrganisation."')";
	$result = mysqli_query($conn, $checkOrganisation);
	$Orgs = mysqli_fetch_array($result);
	if (mysqli_num_rows($result) === 0) {
		$insertNew = "INSERT INTO LookupInstitutions(Name, IsActive)VALUES('$CurrentOrganisation','1')";
		mysqli_query($conn, $insertNew);
		$CurrentOrganisation = mysqli_insert_id($conn);
	}else{
		$CurrentOrganisation = $Orgs['InstitutionId'];
	}
	
	
	
	
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
						  Country,
						  WorkCountry
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
						  '$Country',
						  '$WorkCountry'

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
						  Country = '$Country',
						  WorkCountry = '$WorkCountry'
	
	WHERE UserID = '".$id."'";

	$result2 = mysqli_query($conn, $sql2);
	$message = "Details successfully updated.";
	unset($_POST);	
	}
	
}

	$query = "SELECT a.*, b.Email, c.Name as OrganisationName FROM UserContactDetails a
	left join users b on b.UserID = a.UserID
	left join LookupInstitutions c on c.InstitutionId = a.CurrentOrganisation
	WHERE a.UserID = '".$_SESSION['id']."'";
	$result = mysqli_query($conn, $query);

	while($userdetails = mysqli_fetch_array($result)) {
			$FullTimeStudent = $userdetails['FullTimeStudent'];
			 $CurrentOrganisation = $userdetails['CurrentOrganisation'];
			 $OrganisationName = $userdetails['OrganisationName'];
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
						  $WorkCountry = $userdetails['WorkCountry'];

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
                                    <div class="card-body">
                                        <form class="form" action="" method="post">
                                            <div class="row">
												<!--div class="col-md-6 col-12" <?php if(@$_SESSION['user_type'] == '2' || @$_SESSION['user_type'] == '3'){ echo 'style="display:none;"'; } ?>>
                                                    <div class="form-group">
                                                        <label for="FullTimeStudent">Are you a full time student? <span style="color:red">*</span></label>
                                                        <fieldset class="form-group">
                                                    <select class="choices form-select" id="FullTimeStudent" name="FullTimeStudent"  <?php if(@$_SESSION['user_type'] != '2'){ echo 'required="required"'; } ?>>
													<option></option>
                                                        <option <?php if(@$FullTimeStudent == 'Yes'){ echo "selected='selected'"; } ?>>Yes</option>
														<option <?php if(@$FullTimeStudent == 'No'){ echo "selected='selected'"; } ?>>No</option>
														
                                                    </select>
                                                </fieldset>
                                                    </div>
                                                </div-->
												<?php if(@$_SESSION['user_type'] != '4'){  ?>
												<div class="col-md-6 col-12" >
                                                    <div class="form-group">
                                                        <label for="CurrentOrganisation">Current organisation</label>
                                                        <input autocomplete="off" list="OrganisationList" id="CurrentOrganisation" class="form-control" name="CurrentOrganisation" value="<?php echo @$OrganisationName; ?>">
														<datalist id="OrganisationList">
                                                        <?php
				
															$query = "SELECT * FROM LookupInstitutions WHERE IsActive = '1' ORDER BY Name asc";
															$result = mysqli_query($conn, $query);
															

															while($institution = mysqli_fetch_array($result)) {
															 echo '<option>'.ucwords($institution['Name']).'</option>';
															}

														?>
                                                    </datalist>
                                                    </div>
                                                </div>						
												
												<div class="col-md-6 col-12" <?php if(@$_SESSION['user_type'] == '2' || @$_SESSION['user_type'] == '3'){ echo 'style="display:none;"'; } ?>>
                                                    <div class="form-group">
                                                        <label for="IsOrganisationFundingSalary">Is this the organisation that funds your salary?</label>
                                                        <fieldset class="form-group">
                                                    <select class="choices form-select" id="IsOrganisationFundingSalary" name="IsOrganisationFundingSalary">
													<option></option>
                                                        <option value="Yes" <?php if(@$IsOrganisationFundingSalary == 'Yes'){ echo "selected='selected'"; } ?>>Yes</option>
														<option value="No" <?php if(@$IsOrganisationFundingSalary == 'No'){ echo "selected='selected'"; } ?>>No</option>
														
                                                    </select>
                                                </fieldset>
                                                    </div>
                                                </div>

												
												<div class="col-md-6 col-12 OrganisationFundingSalaryView" <?php if(@$IsOrganisationFundingSalary == '' || @$IsOrganisationFundingSalary == 'Yes'){ echo 'style="display:none;"';} ?>>
                                                    <div class="form-group">
                                                        <label for="OrganisationFundingSalary">Primary organisation which funds your salary? </label>
                                                        <input type="text" id="OrganisationFundingSalary" class="form-control"
                                                             name="OrganisationFundingSalary" value="<?php echo @$OrganisationFundingSalary; ?>">
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
											
											<?php } ?>
											
											
											<?php if(@$_SESSION['user_type'] != '4'){  ?>
                                                <div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        
                                        <label for="WorkPostalAddress" class="form-label">Work Postal Address (excluding department) </label>
                                        <textarea class="form-control" id="WorkPostalAddress" name="WorkPostalAddress"
                                            rows="3"><?php echo @$WorkPostalAddress; ?></textarea>
                                    
                                                    </div>
                                                </div>
												<?php } ?>
												
												<div class="col-md-6 col-12" <?php if(@$_SESSION['user_type'] == '2' || @$_SESSION['user_type'] == '3'){ echo 'style="display:none;"'; } ?>>
                                                    <div class="form-group">
                                                        
                                        <label for="HomePhysicalAddress" class="form-label">Home Physical Address <span style="color:red">*</span></label>
                                        <textarea class="form-control" id="HomePhysicalAddress" name="HomePhysicalAddress"
                                            rows="3"  <?php if(@$_SESSION['user_type'] != '2'){ echo 'required="required"'; } ?>><?php echo @$HomePhysicalAddress; ?></textarea>
                                    
                                                    </div>
                                                </div>
												
												<?php if(@$_SESSION['user_type'] != '4'){  ?>
                                                <div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="WorkCityTown">Work City/Town</label>
                                                        <input type="text" id="WorkCityTown" class="form-control"
                                                             name="WorkCityTown" value="<?php echo @$WorkCityTown; ?>">
                                                    </div>
                                                </div>
												<?php } ?>
												
												
												<div class="col-md-6 col-12" <?php if(@$_SESSION['user_type'] == '2' || @$_SESSION['user_type'] == '3'){ echo 'style="display:none;"'; } ?>>
                                                    <div class="form-group">
                                                        <label for="HomeCityTown">Home City/Town <span style="color:red">*</span></label>
                                                        <input type="text" id="HomeCityTown" class="form-control"
                                                             name="HomeCityTown" value="<?php echo @$HomeCityTown; ?>">
                                                    </div>
                                                </div>
												
												<?php if(@$_SESSION['user_type'] != '4'){  ?>
												<div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="WorkPostalCode">Work Postal Code</label>
                                                        <input type="text" id="WorkPostalCode" class="form-control"
                                                             name="WorkPostalCode" value="<?php echo @$WorkPostalCode; ?>">
                                                    </div>
                                                </div>
												<?php } ?>
												
												<div class="col-md-6 col-12" <?php if(@$_SESSION['user_type'] == '2' || @$_SESSION['user_type'] == '3'){ echo 'style="display:none;"'; } ?>>
                                                    <div class="form-group">
                                                        <label for="HomePostalCode">Home Postal Code <span style="color:red">*</span></label>
                                                        <input type="text" id="HomePostalCode" class="form-control"
                                                             name="HomePostalCode" value="<?php echo @$HomePostalCode; ?>">
                                                    </div>
                                                </div>
												
												<?php if(@$_SESSION['user_type'] != '4'){  ?>
												<div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="WorkProvince">Work Province/State</label>
                                                        <fieldset class="form-group">
                                                    <select class="choices form-select" id="WorkProvince" name="WorkProvince">
                                                        <option></option>
                                                        <?php
				
															$query = "SELECT * FROM LookupProvince WHERE IsActive = '1' ORDER BY Name asc";
															$result = mysqli_query($conn, $query);
															

															while($province = mysqli_fetch_array($result)) {
																$select = "";
																if(@$WorkProvince == $province['ID']){ $select = "selected='selected'"; }
															 echo '<option value="'.$province['ID'].'" '.$select.'>'.ucwords($province['Name']).'</option>';
															}

														?>
                                                    </select>
                                                </fieldset>
                                                    </div>
                                                </div>
												<?php } ?>
												
												<div class="col-md-6 col-12" <?php if(@$_SESSION['user_type'] == '2' || @$_SESSION['user_type'] == '3'){ echo 'style="display:none;"'; } ?>>
                                                    <div class="form-group">
                                                        <label for="HomeProvince">Home Province <span style="color:red">*</span></label>
                                                        <fieldset class="form-group">
                                                    <select class="choices form-select" id="HomeProvince" name="HomeProvince">
                                                        <option></option>
                                                        <?php
				
															$query = "SELECT * FROM LookupProvince WHERE IsActive = '1' ORDER BY Name asc";
															$result = mysqli_query($conn, $query);
															

															while($province = mysqli_fetch_array($result)) {
																$select = "";
																if(@$HomeProvince == $province['ID']){ $select = "selected='selected'"; }
															 echo '<option value="'.$province['ID'].'" '.$select.'>'.ucwords($province['Name']).'</option>';
															}

														?>
                                                    </select>
                                                </fieldset>
                                                    </div>
                                                </div>
												
												<?php if(@$_SESSION['user_type'] != '4'){  ?>
												<div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="WorkCountry">Work Country <span style="color:red">*</span></label>
                                                        <fieldset class="form-group">
                                                    <select class="choices form-select" id="WorkCountry" name="WorkCountry">
													<option> </option>
                                                        <?php
				
															$query = "SELECT * FROM LookupCountry WHERE IsActive = '1' ORDER BY Country asc";
															$result = mysqli_query($conn, $query);
															
															
															while($country = mysqli_fetch_array($result)) {
																$select = '';
																if(@$WorkCountry == $country['ID']){ $select = "selected='selected'"; }
															 echo '<option value="'.$country['ID'].'" '.$select.'>'.ucwords($country['Country']).'</option>';
															}

														?>
                                                    </select>
                                                </fieldset>
                                                    </div>
                                                </div>
												<?php } ?>
												<div class="col-md-6 col-12" <?php if(@$_SESSION['user_type'] == '2' || @$_SESSION['user_type'] == '3'){ echo 'style="display:none;"'; } ?>>
                                                    <div class="form-group">
                                                        <label for="Country">Home Country <span style="color:red">*</span></label>
                                                        <fieldset class="form-group">
                                                    <select class="choices form-select" id="Country" name="Country">
													<option> </option>
                                                        <?php
				
															$query = "SELECT * FROM LookupCountry WHERE IsActive = '1' ORDER BY Country asc";
															$result = mysqli_query($conn, $query);
															
															
															while($country = mysqli_fetch_array($result)) {
																$select = '';
																if(@$Country == $country['ID']){ $select = "selected='selected'"; }
															 echo '<option value="'.$country['ID'].'" '.$select.'>'.ucwords($country['Country']).'</option>';
															}

														?>
                                                    </select>
                                                </fieldset>
                                                    </div>
                                                </div>
												
												<div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="TelephoneNumber">Primary Telephone Number <span style="color:red">*</span></label>
                                                        <input type="number" id="TelephoneNumber" class="form-control"
                                                             name="TelephoneNumber" value="<?php echo @$TelephoneNumber; ?>" required="required">
                                                    </div>
                                                </div>
												
												
												
												<div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="MobileNumber">Mobile Number <span style="color:red">*</span></label>
                                                        <input type="number" value="<?php echo @$MobileNumber; ?>" id="MobileNumber" class="form-control"
                                                            name="MobileNumber" required="required">
                                                    </div>
                                                </div>
												
												
                                                <div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="PrimaryEmail">Primary Email Address <span style="color:red">*</span></label>
                                                        <input type="email" id="PrimaryEmail" value="<?php echo @$PrimaryEmail; ?>" class="form-control"
                                                            name="PrimaryEmail" required="required">
                                                    </div>
                                                </div>
												
												<div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="ConfirmEmail">Confirm Primary Email Address <span style="color:red">*</span></label>
                                                        <input type="email" value="<?php echo @$ConfirmEmail; ?>" id="ConfirmEmail" class="form-control"
                                                            name="ConfirmEmail" required="required">
                                                    </div>
                                                </div>
												
												<div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="AlternativeEmail">Alternate Email Address <span style="color:red">*</span></label>
                                                        <input type="email" value="<?php echo @$AlternativeEmail; ?>" id="AlternativeEmail" class="form-control"
                                                            name="AlternativeEmail" required="required">
                                                    </div>
                                                </div>
												
												<div class="alert alert-info" style="margin-top: 2%; margin-bottom: 2%; <?php if(@$_SESSION['user_type'] == '2' || @$_SESSION['user_type'] == '3'){ echo 'display:none;'; } ?>">NEXT OF KIN DETAILS.</div>
												
												
												<div class="col-md-6 col-12" <?php if(@$_SESSION['user_type'] == '2' || @$_SESSION['user_type'] == '3'){ echo 'style="display:none;"'; } ?>>
                                                    <div class="form-group">
                                                        <label for="Name">Name <span style="color:red">*</span></label>
                                                        <input type="text" id="Name" class="form-control"
                                                             name="Name" value="<?php echo @$Name; ?>">
                                                    </div>
                                                </div>
												
												<div class="col-md-6 col-12" <?php if(@$_SESSION['user_type'] == '2' || @$_SESSION['user_type'] == '3'){ echo 'style="display:none;"'; } ?>>
                                                    <div class="form-group">
                                                        <label for="Telephone">Telephone Number <span style="color:red">*</span></label>
                                                        <input type="text" id="Telephone" class="form-control"
                                                             name="Telephone" value="<?php echo @$Telephone; ?>">
                                                    </div>
                                                </div>
												
												<div class="col-md-6 col-12" <?php if(@$_SESSION['user_type'] == '2' || @$_SESSION['user_type'] == '3'){ echo 'style="display:none;"'; } ?>>
                                                    <div class="form-group">
                                                        <label for="Cellnumber">Cellphone Number <span style="color:red">*</span></label>
                                                        <input type="text" id="Cellnumber" class="form-control"
                                                             name="Cellnumber" value="<?php echo @$Cellnumber; ?>">
                                                    </div>
                                                </div>
												
												<div class="col-md-6 col-12" <?php if(@$_SESSION['user_type'] == '2' || @$_SESSION['user_type'] == '3'){ echo 'style="display:none;"'; } ?>>
                                                    <div class="form-group">
                                                        <label for="Relationship">Relationship to you <span style="color:red">*</span></label>
                                                        <input type="text" id="Relationship" class="form-control"
                                                             name="Relationship" value="<?php echo @$Relationship; ?>">
                                                    </div>
                                                </div>
												
												<div class="col-md-6 col-12" <?php if(@$_SESSION['user_type'] == '2' || @$_SESSION['user_type'] == '3'){ echo 'style="display:none;"'; } ?>>
                                                    <div class="form-group">
                                                        <label for="Address">Physical Address <span style="color:red">*</span></label>
                                                        <textarea class="form-control" id="Address" name="Address" rows="3"><?php echo @$Address; ?></textarea>
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

$('#IsOrganisationFundingSalary').change(function() {
	var val = $(this).val();
		if(val === "No") {
			$('.OrganisationFundingSalaryView').show();
		}else{
			$('.OrganisationFundingSalaryView').hide();
		}
	});
	
	 $("#CurrentOrganisation").focus(function() {
 
      this.value = "";

  });

});
</script>