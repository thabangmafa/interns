<?php 
include 'admin/connect.php';
$conn = OpenCon();

$menu_item = "3";
$title = "Host Institution";

if (isset($_POST['Country']) && $_POST['Country'] != '' && isset($_POST['InstitutionID']) && $_POST['InstitutionID'] != '' && $_POST['Submit'] != '') {

	function validate($data){
       $data = trim($data);
	   $data = stripslashes($data);
	   $data = htmlspecialchars($data);
	   return $data;
	}

	$InstitutionID = validate($_POST['InstitutionID']);
  $CategoriseInstitution = validate($_POST['CategoriseInstitution']);
  $Province = validate($_POST['Province']);
  $HostedInternsBefore = validate($_POST['HostedInternsBefore']);
  $PastHostedDetails = validate($_POST['PastHostedDetails']);
  $SufficientResources = validate($_POST['SufficientResources']);
  $Resources = implode(',',$_POST['Resources']);
  $Faculty = validate($_POST['Faculty']);
  $PostalAddress = validate($_POST['PostalAddress']);
  $CityTown = validate($_POST['CityTown']);
  $FaxNumber = validate($_POST['FaxNumber']);
  $PostalCode = validate($_POST['PostalCode']);
  $TelephoneNumber = validate($_POST['TelephoneNumber']);
  $PrimaryEmail = validate($_POST['PrimaryEmail']);
  $ConfirmPrimaryEmail = validate($_POST['ConfirmPrimaryEmail']);
  $AlternateEmail = validate($_POST['AlternateEmail']);
  $WebAddress = validate($_POST['WebAddress']);
  $Country = validate($_POST['Country']);
  $UpdatedBy = $_SESSION['id'];
	

	
	$query = "SELECT * FROM HostInstitutionDetails WHERE InstitutionID = '".$InstitutionID."'";
	$result = mysqli_query($conn, $query);
	if (mysqli_num_rows($result) === 0) {
	
	$sql2 = "INSERT INTO HostInstitutionDetails(
						InstitutionID,
						  CategoriseInstitution,
						  Province,
						  HostedInternsBefore,
						  PastHostedDetails,
						  SufficientResources,
						  Resources,
						  Faculty,
						  PostalAddress,
						  CityTown,
						  FaxNumber,
						  PostalCode,
						  TelephoneNumber,
						  PrimaryEmail,
						  ConfirmPrimaryEmail,
						  AlternateEmail,
						  WebAddress,
						  Country,
						  UpdatedBy
) VALUES(
							'$InstitutionID',
						  '$CategoriseInstitution',
						  '$Province',
						  '$HostedInternsBefore',
						  '$PastHostedDetails',
						  '$SufficientResources',
						  '$Resources',
						  '$Faculty',
						  '$PostalAddress',
						  '$CityTown',
						  '$FaxNumber',
						  '$PostalCode',
						  '$TelephoneNumber',
						  '$PrimaryEmail',
						  '$ConfirmPrimaryEmail',
						  '$AlternateEmail',
						  '$WebAddress',
						  '$Country',
						  '$UpdatedBy'

)";


    $result2 = mysqli_query($conn, $sql2);
	$message = "Details successfully captured.";
	$checklist = "INSERT INTO ApplicantChecklist(InstitutionID, Section)VALUES('$InstitutionID','Host Institution')";
	mysqli_query($conn, $checklist);
	unset($_POST);
	}else{
		
	$sql2 = "UPDATE HostInstitutionDetails SET 
			  CategoriseInstitution = '$CategoriseInstitution',
			  Province = '$Province',
			  HostedInternsBefore = '$HostedInternsBefore',
			  PastHostedDetails = '$PastHostedDetails',
			  SufficientResources = '$SufficientResources',
			  Resources = '$Resources',
			  Faculty = '$Faculty',
			  PostalAddress = '$PostalAddress',
			  CityTown = '$CityTown',
			  FaxNumber = '$FaxNumber',
			  PostalCode = '$PostalCode',
			  TelephoneNumber = '$TelephoneNumber',
			  PrimaryEmail = '$PrimaryEmail',
			  ConfirmPrimaryEmail = '$ConfirmPrimaryEmail',
			  AlternateEmail = '$AlternateEmail',
			  WebAddress = '$WebAddress',
			  Country = '$Country',
			  UpdatedBy = '$UpdatedBy'
	
	WHERE InstitutionID = '".$InstitutionID."'";

	$result2 = mysqli_query($conn, $sql2);
	$message = "Details successfully updated.";
	unset($_POST);	
	}
	
}

if(@$_SESSION['InstitutionID']){
	
	
	
	
	
	
	
	
	
	$query = "SELECT b.*, a.Name as InstitutionName FROM LookupInstitutions a
	LEFT JOIN HostInstitutionDetails b ON b.InstitutionID = a.InstitutionId
	WHERE a.InstitutionId = '".@$_SESSION['InstitutionID']."'";
	$result = mysqli_query($conn, $query);
	
	while(@$userdetails = mysqli_fetch_array($result)) {
		
	$InstitutionName = $userdetails['InstitutionName'];	
	$InstitutionID = $userdetails['InstitutionID'];
	  $CategoriseInstitution = $userdetails['CategoriseInstitution'];
	  $Province = $userdetails['Province'];
	  $HostedInternsBefore = $userdetails['HostedInternsBefore'];
	  $PastHostedDetails = $userdetails['PastHostedDetails'];
	  $SufficientResources = $userdetails['SufficientResources'];
	  $Resources = $userdetails['Resources'];
	  $Faculty = $userdetails['Faculty'];
	  $PostalAddress = $userdetails['PostalAddress'];
	  $CityTown = $userdetails['CityTown'];
	  $FaxNumber = $userdetails['FaxNumber'];
	  $PostalCode = $userdetails['PostalCode'];
	  $TelephoneNumber = $userdetails['TelephoneNumber'];
	  $PrimaryEmail = $userdetails['PrimaryEmail'];
	  $ConfirmPrimaryEmail = $userdetails['ConfirmPrimaryEmail'];
	  $AlternateEmail = $userdetails['AlternateEmail'];
	  $WebAddress = $userdetails['WebAddress'];
	  $Country = $userdetails['Country'];
	  $UpdatedBy = $userdetails['UpdatedBy'];
		

	}
	
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
									<li>Please provide all the information requested below.</li>
<li>Please select the "Support" link and enter your request to add an institution that does not appear on the list by stating the name of the institution to be added to the list.</li>
<li>Please indicate the status of each hosted intern on exit of the programme during 2020/21.</li></ul>
                                </div>
                                <div class="card-content">
                                    <div class="card-body">
                                        <form class="form" method="post" action="" enctype="multipart/form-data">

                                            <div class="row mainDetails" <?php // if(@$UserInterestedInHosting == '' || @$UserInterestedInHosting == 'No'){ echo 'style="display:none;"';} ?>>
	
												<input type="hidden" id="InstitutionID" class="form-control" name="InstitutionID" value="<?php echo @$_SESSION['InstitutionID']; ?>">
												<div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="InstitutionID">Name of Institution</label>
                                                        <input type="text" class="form-control" disabled="disabled" value="<?php echo @$InstitutionName; ?>">
                                                    </div>
                                                </div>
												
												
												<div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="CategoriseInstitution">Categorise Institution</label>
                                                        <fieldset class="form-group">
                                                    <select class="choices form-select" id="CategoriseInstitution" name="CategoriseInstitution" required="required">
													<option></option>
                                                        <?php
				
															$query = "SELECT * FROM LookupCategoriseInstitution WHERE IsActive = '1' ORDER BY Category asc";
															$result = mysqli_query($conn, $query);

															while($category = mysqli_fetch_array($result)) {
																$select = '';
																if(@$CategoriseInstitution == $category['ID']){ $select = "selected='selected'"; }
															 echo '<option value="'.$category['ID'].'" '.$select.'>'.ucwords($category['Category']).'</option>';
															}

														?>
														
                                                    </select>
                                                </fieldset>
                                                    </div>
                                                </div>
												
												<div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="HostedInternsBefore">Have you previously hosted DST interns?</label>
                                                        <fieldset class="form-group">
                                                    <select class="form-select" id="HostedInternsBefore" name="HostedInternsBefore" required="required">
                                                        <option><?php echo @$HostedInternsBefore; ?></option>
                                                        <option>Yes</option>
                                                        <option>No</option>
                                                    </select>
                                                </fieldset>
                                                    </div>
                                                </div>
												
								
												
												<div class="col-md-6 col-12"  id="internsHistory" <?php if(@$UserHostedInternsBefore == '' || @$UserHostedInternsBefore == 'No'){ echo 'style="display:none;"';} ?>>
                                                    <div class="form-group">
                                                        <label for="PastHostedDetails">Provide details of previous host</label>

															 <textarea class="form-control" id="PastHostedDetails" required="required" name="PastHostedDetails" 
                                            rows="3" placeholder="Capture historical data e.g. specify number of interns hosted, year hosted, status post the internship."><?php echo @$PastHostedDetails; ?></textarea>
                                                    </div>
                                                </div>
												
												
												
												<div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="SufficientResources">Do you have sufficient or adequate resources?</label>
                                                        <fieldset class="form-group">
                                                    <select class="form-select" id="SufficientResources" name="SufficientResources" required="required">
                                                        <option><?php echo @$HostedInternsBefore; ?></option>
                                                        <option>Yes</option>
                                                        <option>No</option>
                                                    </select>
                                                </fieldset>
                                                    </div>
                                                </div>
												
												
												<div class="col-md-6 mb-4">
                                                
                                                <div class="form-group">
												<label for="Resources">List the basic available resources</label>
                                                    <select class="choices form-select" multiple="multiple" required="required" id="Resources" name="Resources[]">
                                                        <?php
														
														$res = explode(',',$Resources);
								
				
															$query = "SELECT * FROM LookupResources WHERE IsActive = '1' ORDER BY Resource asc";
															$result = mysqli_query($conn, $query);

															while($resource = mysqli_fetch_array($result)) {
																if(in_array($resource['ID'],$res)) $select = "selected='selected'";
																	else $select="";
																	if(@$r == $resource['ID']){ $select = "selected='selected'"; }
															 echo '<option value="'.$resource['ID'].'" '.$select.'>'.ucwords($resource['Resource']).'</option>';
															}

														?>
                                                    </select>
                                                </div>
                                            </div>
												

												
												<div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="Faculty">Faculty</label>
                                                        <input type="text" id="Faculty" class="form-control"
                                                             name="Faculty" required="required" value="<?php echo @$Faculty; ?>">
                                                    </div>
                                                </div>
											
											<div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="TelephoneNumber">Primary Telephone Number</label>
                                                        <input type="text" required="required" id="TelephoneNumber" class="form-control"
                                                             name="TelephoneNumber" value="<?php echo @$TelephoneNumber; ?>">
                                                    </div>
                                                </div>
												
												<div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="FaxNumber">Fax Number</label>
                                                        <input type="text" required="required" id="FaxNumber" class="form-control"
                                                             name="FaxNumber" value="<?php echo @$FaxNumber; ?>">
                                                    </div>
                                                </div>
												
												
												
                                                <div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="PrimaryEmail">Primary Email Address</label>
                                                        <input type="email" id="PrimaryEmail" class="form-control"
                                                            name="PrimaryEmail" value="<?php echo @$PrimaryEmail; ?>">
                                                    </div>
                                                </div>
												
												<div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="ConfirmPrimaryEmail">Confirm Primary Email Address</label>
                                                        <input type="email" required="required" id="ConfirmPrimaryEmail" class="form-control"
                                                            name="ConfirmPrimaryEmail" value="<?php echo @$ConfirmPrimaryEmail; ?>">
                                                    </div>
                                                </div>
												
												<div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="AlternateEmail">Alternate Email Address</label>
                                                        <input type="email" required="required" id="AlternateEmail" class="form-control"
                                                            name="AlternateEmail" value="<?php echo @$AlternateEmail; ?>">
                                                    </div>
                                                </div>
												
												<div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="WebAddress">Web Address</label>
                                                        <input type="text" required="required" id="WebAddress" class="form-control"
                                                            name="WebAddress" value="<?php echo @$WebAddress; ?>">
                                                    </div>
                                                </div>
											
											
                                                <div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        
                                        <label for="PostalAddress" class="form-label">Work Postal Address (excluding department) </label>
                                        <textarea class="form-control" required="required" id="PostalAddress" name="PostalAddress"
                                            rows="3"><?php echo @$PostalAddress; ?></textarea>
                                    
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="CityTown">City/Town</label>
                                                        <input type="text" required="required" id="CityTown" class="form-control"
                                                             name="CityTown" value="<?php echo @$CityTown; ?>">
                                                    </div>
                                                </div>
												
												<div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="PostalCode">Postal Code</label>
                                                        <input type="text" required="required" id="PostalCode" class="form-control"
                                                             name="PostalCode" value="<?php echo @$PostalCode; ?>">
                                                    </div>
                                                </div>
												
												<div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="Province">Province</label>
                                                        <fieldset class="form-group">
                                                    <select class="choices form-select" required="required" id="Province" name="Province">
													<option></option>
                                                        <?php
				
															$query = "SELECT * FROM LookupProvince WHERE IsActive = '1' ORDER BY Name asc";
															$result = mysqli_query($conn, $query);

															while($province = mysqli_fetch_array($result)) {
																$select = '';
																if(@$Province == $province['ID']){ $select = "selected='selected'"; }
															 echo '<option value="'.$province['ID'].'" '.$select.'>'.ucwords($province['Name']).'</option>';
															}

														?>
														
                                                    </select>
                                                </fieldset>
                                                    </div>
                                                </div>
												
												<div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="Country">Country</label>
                                                        <fieldset class="form-group">
                                                    <select class="choices form-select" required="required" id="Country" name="Country">
                                                        <option></option>
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
												
												
												
												
												

                                                
                                            </div>
											<div class="col-12 d-flex justify-content-end">
                                                    
                                                    <button type="reset"
                                                        class="btn btn-light-secondary me-1 mb-1">Reset</button>
														<button type="submit"
                                                        class="btn btn-primary me-1 mb-1" name="Submit" value="Submit">Submit</button>
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
	<!-- Include Choices CSS -->
    <link rel="stylesheet" href="assets/vendors/choices.js/choices.min.css" />
	<!-- Include Choices JavaScript -->
    <script src="assets/vendors/choices.js/choices.min.js"></script>

    <script src="assets/js/main.js"></script>
</body>

</html>
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script type="text/javascript">
 $(document).ready(function(){
	
	
	

$('#HostedInternsBefore').change(function() {
	var val = $(this).val();
    if(val === "Yes") {
		$('#internsHistory').show();
	}else{
		$('#internsHistory').hide();
	}
});

$('#InterestedInHosting').change(function() {
	var val = $(this).val();
    if(val === "Yes") {
		$('.mainDetails').show();
	}else{
		$('.mainDetails').hide();
	}
});


});
</script>