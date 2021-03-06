<?php 
include 'admin/connect.php';
$conn = OpenCon();
$menu_item = "2";
$title = "Contact Details";

$sql = "SELECT distinct Details FROM LookupHeadings WHERE Section='Contact Details' ";
		$result = mysqli_query($conn, $sql);
		$headings = mysqli_fetch_assoc($result);

if (@$_POST['Submit'] != '') {
	
	function validate($data){
       $data = trim($data);
	   $data = stripslashes($data);
	   $data = htmlspecialchars($data);
	   return $data;
	}
	
	$id = $_SESSION['id'];
	$FullTimeStudent = validate(@$_POST['FullTimeStudent']);
	$CurrentOrganisation = validate(@$_POST['CurrentOrganisation']);
	$IsOrganisationFundingSalary = validate(@$_POST['IsOrganisationFundingSalary']);
	$OrganisationFundingSalary = validate(@$_POST['OrganisationFundingSalary']);
	$DepartmentSchoolInstitution = validate(@$_POST['DepartmentSchoolInstitution']);
	$Faculty = validate(@$_POST['Faculty']);
	$WorkPostalAddress = validate(@$_POST['WorkPostalAddress']);
	$HomePhysicalAddress = validate(@$_POST['HomePhysicalAddress']);
	$WorkCityTown = validate(@$_POST['WorkCityTown']);
	$HomeCityTown = validate(@$_POST['HomeCityTown']);
	$WorkPostalCode = validate(@$_POST['WorkPostalCode']);
	$HomePostalCode = validate(@$_POST['HomePostalCode']);
	$WorkProvince = validate(@$_POST['WorkProvince']);
	$TelephoneNumber = validate(@$_POST['TelephoneNumber']);
	$MobileNumber = validate(@$_POST['MobileNumber']);
	$PrimaryEmail = validate(@$_POST['PrimaryEmail']);
	$ConfirmEmail = validate(@$_POST['ConfirmEmail']);
	$AlternativeEmail = validate(@$_POST['AlternativeEmail']);
	$HomeProvince = validate(@$_POST['HomeProvince']);
	$Country = validate(@$_POST['Country']);
	$WorkCountry = validate(@$_POST['WorkCountry']);
	$AlternateContactName = validate(@$_POST['AlternateContactName']);
	$AlternateContactEmail = validate(@$_POST['AlternateContactEmail']);
	$AlternateContactDesignation = validate(@$_POST['AlternateContactDesignation']);
	$AlternateContactTelephone = validate(@$_POST['AlternateContactTelephone']);
	$AlternateContactCellphone = validate(@$_POST['AlternateContactCellphone']);
	
	$Name = validate(@$_POST['Name']);
	$Telephone = validate(@$_POST['Telephone']);
	$Cellnumber = validate(@$_POST['Cellnumber']);
	$Relationship = validate(@$_POST['Relationship']);
	$Address = validate(@$_POST['Address']);
	
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
						  WorkCountry,
						  AlternateContactName,
							AlternateContactEmail,
							AlternateContactDesignation,
							AlternateContactTelephone,
							AlternateContactCellphone
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
						  '$WorkCountry',
						  '$AlternateContactName',
							'$AlternateContactEmail',
							'$AlternateContactDesignation',
							'$AlternateContactTelephone',
							'$AlternateContactCellphone'

)";


    $result2 = mysqli_query($conn, $sql2);
	//if(mysqli_insert_id($conn)){
		$message = "Details successfully captured.";
		$checklist = "INSERT INTO ApplicantChecklist(UserID, Section)VALUES('$id','Contact Details')";
		mysqli_query($conn, $checklist);
		unset($_POST);
	//}
	
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
						  WorkCountry = '$WorkCountry',
						  AlternateContactName = '$AlternateContactName',
							AlternateContactEmail = '$AlternateContactEmail',
							AlternateContactDesignation = '$AlternateContactDesignation',
							AlternateContactTelephone = '$AlternateContactTelephone',
							AlternateContactCellphone = '$AlternateContactCellphone'
	
	WHERE UserID = '".$id."'";

	$result2 = mysqli_query($conn, $sql2);
	$message = "Details successfully updated.";
	$checklist = "INSERT INTO ApplicantChecklist(UserID, Section)VALUES('$id','Contact Details')";
		mysqli_query($conn, $checklist);
	unset($_POST);	
	}
	
}

	$query = "SELECT a.*, b.Email, c.Name as OrganisationName, d.Name, d.Telephone, d.Cellnumber, d.Relationship, d.Address FROM UserContactDetails a
	left join users b on b.UserID = a.UserID
	left join LookupInstitutions c on c.InstitutionId = a.CurrentOrganisation
	left join NextOfKin d on d.UserID = a.UserID
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
						  $AlternateContactName = $userdetails['AlternateContactName'];
							$AlternateContactEmail = $userdetails['AlternateContactEmail'];
							$AlternateContactDesignation = $userdetails['AlternateContactDesignation'];
							$AlternateContactTelephone = $userdetails['AlternateContactTelephone'];
							$AlternateContactCellphone = $userdetails['AlternateContactCellphone'];
							$Name = $userdetails['Name'];
							$Telephone = $userdetails['Telephone'];
							$Cellnumber = $userdetails['Cellnumber'];
							$Relationship = $userdetails['Relationship'];
							$Address = $userdetails['Address'];

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
								<div class="alert alert-success" role="alert"><?php echo @$message; ?></div>
								<?php } ?>
                                    <div class="card-body">
                                        <form class="form" action="" method="post">
                                            <div class="row">

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
                                                        
                                        <label for="WorkPostalAddress" class="form-label">Work Physical Address <span style="color:red">*</span> </label>
                                        <textarea class="form-control" id="WorkPostalAddress" name="WorkPostalAddress"
                                            rows="3" <?php if(@$_SESSION['user_type'] != '4'){ echo 'required="required"'; } ?>><?php echo @$WorkPostalAddress; ?></textarea>
                                    
                                                    </div>
                                                </div>
												<?php } ?>
												
												<div class="col-md-6 col-12" <?php if(@$_SESSION['user_type'] == '2' || @$_SESSION['user_type'] == '3'){ echo 'style="display:none;"'; } ?>>
                                                    <div class="form-group">
                                                        
                                        <label for="HomePhysicalAddress" class="form-label">Home Physical Address <span style="color:red">*</span></label>
                                        <textarea class="form-control" id="HomePhysicalAddress" name="HomePhysicalAddress"
                                            rows="3"  <?php if(@$_SESSION['user_type'] == '4'){ echo 'required="required"'; } ?>><?php echo @$HomePhysicalAddress; ?></textarea>
                                    
                                                    </div>
                                                </div>
												
												<?php if(@$_SESSION['user_type'] != '4'){  ?>
                                                <div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="WorkCityTown">Work City/Town <span style="color:red">*</span></label>
                                                        <input type="text" id="WorkCityTown" class="form-control"
                                                             name="WorkCityTown" <?php if(@$_SESSION['user_type'] != '4'){ echo 'required="required"'; } ?> value="<?php echo @$WorkCityTown; ?>">
                                                    </div>
                                                </div>
												<?php } ?>
												
												
												<div class="col-md-6 col-12" <?php if(@$_SESSION['user_type'] == '2' || @$_SESSION['user_type'] == '3'){ echo 'style="display:none;"'; } ?>>
                                                    <div class="form-group">
                                                        <label for="HomeCityTown">Home City/Town <span style="color:red">*</span></label>
                                                        <input type="text" id="HomeCityTown" class="form-control"
                                                             name="HomeCityTown" <?php if(@$_SESSION['user_type'] == '4'){ echo 'required="required"'; } ?> value="<?php echo @$HomeCityTown; ?>">
                                                    </div>
                                                </div>
												
												<?php if(@$_SESSION['user_type'] != '4'){  ?>
												<div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="WorkPostalCode">Work Postal Code <span style="color:red">*</span></label>
                                                        <input type="text" id="WorkPostalCode" class="form-control"
                                                             name="WorkPostalCode" <?php if(@$_SESSION['user_type'] != '4'){ echo 'required="required"'; } ?> value="<?php echo @$WorkPostalCode; ?>">
                                                    </div>
                                                </div>
												<?php } ?>
												
												<div class="col-md-6 col-12" <?php if(@$_SESSION['user_type'] == '2' || @$_SESSION['user_type'] == '3'){ echo 'style="display:none;"'; } ?>>
                                                    <div class="form-group">
                                                        <label for="HomePostalCode">Home Postal Code <span style="color:red">*</span></label>
                                                        <input type="text" id="HomePostalCode" class="form-control"
                                                             name="HomePostalCode" <?php if(@$_SESSION['user_type'] == '4'){ echo 'required="required"'; } ?> value="<?php echo @$HomePostalCode; ?>">
                                                    </div>
                                                </div>
												
												<?php if(@$_SESSION['user_type'] != '4'){  ?>
												<div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="WorkProvince">Work Province/State <span style="color:red">*</span></label>
                                                        <fieldset class="form-group">
                                                    <select class="choices form-select" <?php if(@$_SESSION['user_type'] != '4'){ echo 'required="required"'; } ?> id="WorkProvince" name="WorkProvince">
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
                                                    <select class="choices form-select" id="HomeProvince" name="HomeProvince" <?php if(@$_SESSION['user_type'] == '4'){ echo 'required="required"'; } ?>>
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
                                                    <select class="choices form-select" id="WorkCountry" name="WorkCountry" <?php if(@$_SESSION['user_type'] != '4'){ echo 'required="required"'; } ?>>
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
                                                    <select class="choices form-select" id="Country" name="Country" <?php if(@$_SESSION['user_type'] == '4'){ echo 'required="required"'; } ?>>
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
                                                        <label for="TelephoneNumber">Telephone Number</label>
                                                        <input type="number" id="TelephoneNumber" class="form-control"
                                                             name="TelephoneNumber" maxlength="10" value="<?php echo @$TelephoneNumber; ?>">
                                                    </div>
                                                </div>
												
												
												
												<div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="MobileNumber">Mobile Number <span style="color:red">*</span><span id="cellChecker"></span></label>
                                                        <input type="number" value="<?php echo @$MobileNumber; ?>" id="MobileNumber" class="form-control"
                                                            name="MobileNumber"  maxlength="10" required="required">
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
                                                        <label for="ConfirmEmail">Confirm Primary Email Address <span style="color:red">*</span><span id="checkEmail"></span></label>
                                                        <input type="email" value="<?php echo @$ConfirmEmail; ?>" id="ConfirmEmail" class="form-control"
                                                            name="ConfirmEmail" required="required">
                                                    </div>
                                                </div>
												
												<div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="AlternativeEmail">Alternate Email Address</label>
                                                        <input type="email" value="<?php echo @$AlternativeEmail; ?>" id="AlternativeEmail" class="form-control"
                                                            name="AlternativeEmail">
                                                    </div>
                                                </div>

												
												<div class="alert alert-info" style="margin-top: 2%; margin-bottom: 2%; <?php if(@$_SESSION['user_type'] == '2'){ echo 'display:inline;'; }else{ echo 'display:none;'; } ?>">Alternate Contact Person in Institution.</div>
												
												<div class="col-md-6 col-12" <?php if(@$_SESSION['user_type'] == '2'){ echo 'style="display:inline;"'; }else{ echo 'style="display:none;"'; } ?>>
                                                    <div class="form-group">
                                                        <label for="AlternateContactName">Name <span style="color:red">*</span></label>
                                                        <input type="text" id="AlternateContactName" class="form-control"
                                                             name="AlternateContactName" <?php if(@$_SESSION['user_type'] == '2'){ echo 'required="required"'; } ?> value="<?php echo @$AlternateContactName; ?>">
                                                    </div>
                                                </div>
												
												<div class="col-md-6 col-12" <?php if(@$_SESSION['user_type'] == '2'){ echo 'style="display:inline;"'; }else{ echo 'style="display:none;"'; } ?>>
                                                    <div class="form-group">
                                                        <label for="AlternateContactEmail">Email <span style="color:red">*</span></label>
                                                        <input type="email" id="AlternateContactEmail" class="form-control"
                                                             name="AlternateContactEmail" <?php if(@$_SESSION['user_type'] == '2'){ echo 'required="required"'; } ?> value="<?php echo @$AlternateContactEmail; ?>">
                                                    </div>
                                                </div>
												
												<div class="col-md-6 col-12" <?php if(@$_SESSION['user_type'] == '2'){ echo 'style="display:inline;"'; }else{ echo 'style="display:none;"'; } ?>>
                                                    <div class="form-group">
                                                        <label for="AlternateContactDesignation">Designation <span style="color:red">*</span></label>
                                                        <input type="text" id="AlternateContactDesignation" class="form-control"
                                                             name="AlternateContactDesignation" <?php if(@$_SESSION['user_type'] == '2'){ echo 'required="required"'; } ?> value="<?php echo @$AlternateContactDesignation; ?>">
                                                    </div>
                                                </div>
												
												<div class="col-md-6 col-12" <?php if(@$_SESSION['user_type'] == '2'){ echo 'style="display:inline;"'; }else{ echo 'style="display:none;"'; } ?>>
                                                    <div class="form-group">
                                                        <label for="AlternateContactTelephone">Telephone</label>
                                                        <input type="number" maxlength="10" id="AlternateContactTelephone" class="form-control"
                                                             name="AlternateContactTelephone" value="<?php echo @$AlternateContactTelephone; ?>">
                                                    </div>
                                                </div>
												
												<div class="col-md-6 col-12" <?php if(@$_SESSION['user_type'] == '2'){ echo 'style="display:inline;"'; }else{ echo 'style="display:none;"'; } ?>>
                                                    <div class="form-group">
                                                        <label for="AlternateContactCellphone">Cellphone <span style="color:red">*</span></label>
                                                        <input type="number" maxlength="10" id="AlternateContactCellphone" class="form-control"
                                                             name="AlternateContactCellphone" <?php if(@$_SESSION['user_type'] == '2'){ echo 'required="required"'; } ?> value="<?php echo @$AlternateContactCellphone; ?>">
                                                    </div>
                                                </div>
												
												
												<div class="alert alert-info" style="margin-top: 2%; margin-bottom: 2%; <?php if(@$_SESSION['user_type'] == '2' || @$_SESSION['user_type'] == '3'){ echo 'display:none;'; } ?>">NEXT OF KIN DETAILS.</div>
												
												
												<div class="col-md-6 col-12" <?php if(@$_SESSION['user_type'] == '2' || @$_SESSION['user_type'] == '3'){ echo 'style="display:none;"'; } ?>>
                                                    <div class="form-group">
                                                        <label for="Name">Name <span style="color:red">*</span></label>
                                                        <input type="text" <?php if(@$_SESSION['user_type'] == '4'){ echo 'required="required"'; } ?> id="Name" class="form-control"
                                                             name="Name" value="<?php echo @$Name; ?>">
                                                    </div>
                                                </div>
												
												<div class="col-md-6 col-12" <?php if(@$_SESSION['user_type'] == '2' || @$_SESSION['user_type'] == '3'){ echo 'style="display:none;"'; } ?>>
                                                    <div class="form-group">
                                                        <label for="Telephone">Telephone Number</label>
                                                        <input type="number" maxlength="10" id="Telephone" class="form-control"
                                                             name="Telephone" value="<?php echo @$Telephone; ?>">
                                                    </div>
                                                </div>
												
												<div class="col-md-6 col-12" <?php if(@$_SESSION['user_type'] == '2' || @$_SESSION['user_type'] == '3'){ echo 'style="display:none;"'; } ?>>
                                                    <div class="form-group">
                                                        <label for="Cellnumber">Cellphone Number <span style="color:red">*</span></label>
                                                        <input type="number" maxlength="10" id="Cellnumber" class="form-control"
                                                             name="Cellnumber" <?php if(@$_SESSION['user_type'] == '4'){ echo 'required="required"'; } ?> value="<?php echo @$Cellnumber; ?>">
                                                    </div>
                                                </div>
												
												<div class="col-md-6 col-12" <?php if(@$_SESSION['user_type'] == '2' || @$_SESSION['user_type'] == '3'){ echo 'style="display:none;"'; } ?>>
                                                    <div class="form-group">
                                                        <label for="Relationship">Relationship to you <span style="color:red">*</span></label>
                                                        <input type="text" id="Relationship" class="form-control"
                                                             name="Relationship" <?php if(@$_SESSION['user_type'] == '4'){ echo 'required="required"'; } ?> value="<?php echo @$Relationship; ?>">
                                                    </div>
                                                </div>
												
												<div class="col-md-6 col-12" <?php if(@$_SESSION['user_type'] == '2' || @$_SESSION['user_type'] == '3'){ echo 'style="display:none;"'; } ?>>
                                                    <div class="form-group">
                                                        <label for="Address">Physical Address <span style="color:red">*</span></label>
                                                        <textarea class="form-control" <?php if(@$_SESSION['user_type'] == '4'){ echo 'required="required"'; } ?> id="Address" name="Address" rows="3"><?php echo @$Address; ?></textarea>
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
  

	
	
$('#ConfirmEmail').blur(function() {


	if($(this).val() != $('#PrimaryEmail').val()){
		$('#checkEmail').html('<span style="color:red"> Confirmation email  '+ $(this).val() +' does not match your primary email.</span>');
		this.value = "";
	}else{
		$('#checkEmail').html('');
	}
});


$('#MobileNumber').blur(function() {

var CellNumber = $(this).val();

	if(CellNumber.length != '10'){
		$('#cellChecker').html('<span style="color:red"> Mobile number  '+ $(this).val() +' does not seem to be correct.</span>');
		this.value = "";
	}else{
		$('#cellChecker').html('');
	}
});





});
</script>