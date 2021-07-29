<?php 
include 'admin/connect.php';
$conn = OpenCon();

$menu_item = "3";
$title = "Host Institution";

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
                                        <form class="form">
										<div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="InterestedInHosting">Interested in participating in the HSRC Internship Programme</label>
                                                        <fieldset class="form-group">
                                                    <select class="form-select" id="InterestedInHosting" name="InterestedInHosting">
													<option></option>
                                                        <option>Yes</option>
														<option>No</option>
														
                                                    </select>
                                                </fieldset>
                                                    </div>
                                                </div>
                                            <div class="row mainDetails" <?php if(@$UserInterestedInHosting == '' || @$UserInterestedInHosting == 'No'){ echo 'style="display:none;"';} ?>>
												
												
										
												
												<div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="Institution">Name of Institution</label>
                                                        <fieldset class="form-group">
                                                    <select class="form-select" id="Institution" name="Institution">
                                                        <option></option>
														<?php
				
															$query = "SELECT * FROM LookupInstitutions WHERE IsActive = '1' ORDER BY Name asc";
															$result = mysqli_query($conn, $query);

															while($institution = mysqli_fetch_array($result)) {
															 echo '<option value="'.$institution['InstitutionId'].'">'.ucwords($institution['Name']).'</option>';
															}

														?>
                                                    </select>
                                                </fieldset>
                                                    </div>
                                                </div>
												<div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="CategoriseInstitution">Categorise Institution</label>
                                                        <fieldset class="form-group">
                                                    <select class="form-select" id="CategoriseInstitution" name="CategoriseInstitution">
													<option></option>
                                                        <?php
				
															$query = "SELECT * FROM LookupCategoriseInstitution WHERE IsActive = '1' ORDER BY Category asc";
															$result = mysqli_query($conn, $query);

															while($category = mysqli_fetch_array($result)) {
															 echo '<option value="'.$category['ID'].'">'.ucwords($category['Category']).'</option>';
															}

														?>
														
                                                    </select>
                                                </fieldset>
                                                    </div>
                                                </div>
												
												
												<div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="Province">Province</label>
                                                        <fieldset class="form-group">
                                                    <select class="form-select" id="Province" name="Province">
													<option></option>
                                                        <?php
				
															$query = "SELECT * FROM LookupProvince WHERE IsActive = '1' ORDER BY Name asc";
															$result = mysqli_query($conn, $query);

															while($province = mysqli_fetch_array($result)) {
															 echo '<option value="'.$province['ID'].'">'.ucwords($province['Name']).'</option>';
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
                                                    <select class="form-select" id="HostedInternsBefore" name="HostedInternsBefore">
                                                        <option></option>
                                                        <option>Yes</option>
                                                        <option>No</option>
                                                    </select>
                                                </fieldset>
                                                    </div>
                                                </div>
												
								
												
												<div class="col-md-6 col-12"  id="internsHistory" <?php if(@$UserHostedInternsBefore == '' || @$UserHostedInternsBefore == 'No'){ echo 'style="display:none;"';} ?>>
                                                    <div class="form-group">
                                                        <label for="NumberOfInternsHosted">Provide details of previous host</label>

															 <textarea class="form-control" id="NumberOfInternsHosted" name="NumberOfInternsHosted" 
                                            rows="3" placeholder="Capture historical data e.g. specify number of interns hosted, year hosted, status post the internship."><?php echo @$UserNumberOfInternsHosted; ?></textarea>
                                                    </div>
                                                </div>
												
												
												
												<div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="SufficientResources">Do you have sufficient or adequate resources?</label>
                                                        <fieldset class="form-group">
                                                    <select class="form-select" id="SufficientResources" name="SufficientResources">
                                                        <option></option>
                                                        <option>Yes</option>
                                                        <option>No</option>
                                                    </select>
                                                </fieldset>
                                                    </div>
                                                </div>
												
												
												<div class="col-md-6 mb-4">
                                                
                                                <div class="form-group">
												<label for="Resources">List the basic available resources</label>
                                                    <select class="choices form-select" multiple="multiple" id="Resources" name="Resources">
                                                        <?php
				
															$query = "SELECT * FROM LookupResources WHERE IsActive = '1' ORDER BY Resource asc";
															$result = mysqli_query($conn, $query);

															while($resource = mysqli_fetch_array($result)) {
															 echo '<option value="'.$resource['ID'].'">'.ucwords($resource['Resource']).'</option>';
															}

														?>
                                                    </select>
                                                </div>
                                            </div>
												
												
												
												
												
												
												
												<div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="Faculty">Faculty</label>
                                                        <input type="text" id="Faculty" class="form-control"
                                                             name="Faculty">
                                                    </div>
                                                </div>
											
											
											
											
                                                <div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        
                                        <label for="PostalAddress" class="form-label">Work Postal Address (excluding department) </label>
                                        <textarea class="form-control" id="PostalAddress" name="PostalAddress"
                                            rows="3"></textarea>
                                    
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="last-name-column">City/Town</label>
                                                        <input type="text" id="last-name-column" class="form-control"
                                                             name="lname-column">
                                                    </div>
                                                </div>
												
												<div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="PostalCode">Postal Code</label>
                                                        <input type="text" id="PostalCode" class="form-control"
                                                             name="PostalCode">
                                                    </div>
                                                </div>
												
												<div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="TelephoneNumber">Primary Telephone Number</label>
                                                        <input type="text" id="TelephoneNumber" class="form-control"
                                                             name="TelephoneNumber">
                                                    </div>
                                                </div>
												
												<div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="FaxNumber">Fax Number</label>
                                                        <input type="text" id="FaxNumber" class="form-control"
                                                             name="FaxNumber">
                                                    </div>
                                                </div>
												
												<div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="MobileNumber">Mobile Number</label>
                                                        <input type="text" id="MobileNumber" class="form-control"
                                                             name="MobileNumber">
                                                    </div>
                                                </div>
												
												
                                                <div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="PrimaryEmail">Primary Email Address</label>
                                                        <input type="email" id="PrimaryEmail" class="form-control"
                                                            name="PrimaryEmail">
                                                    </div>
                                                </div>
												
												<div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="ConfirmPrimaryEmail">Confirm Primary Email Address</label>
                                                        <input type="email" id="ConfirmPrimaryEmail" class="form-control"
                                                            name="ConfirmPrimaryEmail">
                                                    </div>
                                                </div>
												
												<div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="AlternateEmail">Alternate Email Address</label>
                                                        <input type="email" id="AlternateEmail" class="form-control"
                                                            name="AlternateEmail">
                                                    </div>
                                                </div>
												
												<div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="WebAddress">Web Address</label>
                                                        <input type="text" id="WebAddress" class="form-control"
                                                            name="WebAddress">
                                                    </div>
                                                </div>
												
												<div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="country-floating">Country</label>
                                                        <fieldset class="form-group">
                                                    <select class="form-select" id="disabledSelect">
                                                        <option></option>
                                                        <?php
				
															$query = "SELECT * FROM LookupCountry WHERE IsActive = '1' ORDER BY Country asc";
															$result = mysqli_query($conn, $query);

															while($country = mysqli_fetch_array($result)) {
															 echo '<option value="'.$country['ID'].'">'.ucwords($country['Country']).'</option>';
															}

														?>
                                                    </select>
                                                </fieldset>
                                                    </div>
                                                </div>
												
												<div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="country-floating">Province/State</label>
                                                        <fieldset class="form-group">
                                                    <select class="form-select" id="disabledSelect">
                                                        <option></option>
                                                        <?php
				
															$query = "SELECT * FROM LookupProvince WHERE IsActive = '1' ORDER BY Name asc";
															$result = mysqli_query($conn, $query);

															while($province = mysqli_fetch_array($result)) {
															 echo '<option value="'.$province['ID'].'">'.ucwords($province['Name']).'</option>';
															}

														?>
                                                    </select>
                                                </fieldset>
                                                    </div>
                                                </div>
												
												
                                                
                                            </div>
											<div class="col-12 d-flex justify-content-end">
                                                    <button type="submit"
                                                        class="btn btn-primary me-1 mb-1">Submit</button>
                                                    <button type="reset"
                                                        class="btn btn-light-secondary me-1 mb-1">Reset</button>
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