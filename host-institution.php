<?php 
include 'admin/connect.php';
$conn = OpenCon();

$menu_item = "3";
$title = "Host Institution";

if(@$_GET['tax']){
	$f = "uploads/institution/".@$_SESSION['InstitutionID']."/".$_GET['tax'];
	if( file_exists($f)) unlink($f);
	$query = "UPDATE HostInstitutionDetails SET TaxPin = '' WHERE UserID = '".$_SESSION['id']."'";
	mysqli_query($conn, $query);
	header('Location: host-institution.php');
}

if(@$_GET['certificate']){
	$f = "uploads/institution/".@$_SESSION['InstitutionID']."/".$_GET['certificate'];
	if( file_exists($f)) unlink($f);
	$query = "UPDATE HostInstitutionDetails SET InstitutionRegistrationCertificate = '' WHERE UserID = '".$_SESSION['id']."'";
	mysqli_query($conn, $query);
	header('Location: host-institution.php');
}

$sql = "SELECT distinct Details FROM LookupHeadings WHERE Section='Host Institution' ";
		$result = mysqli_query($conn, $sql);
		$headings = mysqli_fetch_assoc($result);

if (@$_SESSION['InstitutionID'] != '' && @$_POST['Submit'] != '') {

	function validate($data){
       $data = trim($data);
	   $data = stripslashes($data);
	   $data = htmlspecialchars($data);
	   return $data;
	}

	$InstitutionID = $_SESSION['InstitutionID'];
  $CategoriseInstitution = validate($_POST['CategoriseInstitution']);

  $HostedInternsBefore = validate($_POST['HostedInternsBefore']);
  
    $NumberEmployed = validate($_POST['NumberEmployed']);
	$NumberHosted = validate($_POST['NumberHosted']);
	$HostedYear = validate($_POST['HostedYear']);
  
  
  $SufficientResources = validate($_POST['SufficientResources']);
  $Resources = implode(',',$_POST['Resources']);
  

  $update = '';
  $UpdatedBy = $_SESSION['id'];
  
  if(isset($_FILES['TaxPin']['name'])){

		   /* Getting file name */
		   $TaxPin = $_FILES['TaxPin']['name'];
			
			
			if (!file_exists('uploads/institution/'.$_SESSION['InstitutionID'])) {
				mkdir('uploads/institution/'.$_SESSION['InstitutionID'], 0777, true);
			}
			
		   /* Location */
		   $location = "uploads/institution/".$_SESSION['InstitutionID'].'/'.$TaxPin;
		   $imageFileType = pathinfo($location,PATHINFO_EXTENSION);
		   $imageFileType = strtolower($imageFileType);

		   /* Valid extensions */
		   $valid_extensions = array("pdf","doc","docx","png","gif","tif","tiff","jpg","jpeg");

		   $response = 0;
		   /* Check file extension */
		   if(in_array(strtolower($imageFileType), $valid_extensions)) {
			  /* Upload file */
			  if(move_uploaded_file($_FILES['TaxPin']['tmp_name'],$location)){
				 $response = $location;
				 $update .= ",TaxPin = '$TaxPin'";
			  }
		   }

	}
	
	if(isset($_FILES['InstitutionRegistrationCertificate']['name'])){

		   /* Getting file name */
		   $InstitutionRegistrationCertificate = $_FILES['InstitutionRegistrationCertificate']['name'];
			
			
			if (!file_exists('uploads/institution/'.$_SESSION['InstitutionID'])) {
				mkdir('uploads/institution/'.$_SESSION['InstitutionID'], 0777, true);
			}
			
		   /* Location */
		   $location = "uploads/institution/".$_SESSION['InstitutionID'].'/'.$InstitutionRegistrationCertificate;
		   $imageFileType = pathinfo($location,PATHINFO_EXTENSION);
		   $imageFileType = strtolower($imageFileType);

		   /* Valid extensions */
		   $valid_extensions = array("pdf","doc","docx","png","gif","tif","tiff","jpg","jpeg");

		   $response = 0;
		   /* Check file extension */
		   if(in_array(strtolower($imageFileType), $valid_extensions)) {
			  /* Upload file */
			  if(move_uploaded_file($_FILES['InstitutionRegistrationCertificate']['tmp_name'],$location)){
				 $response = $location;
				 $update .= ",InstitutionRegistrationCertificate = '$InstitutionRegistrationCertificate'";
			  }
		   }

	}
	
	
	
	$query = "SELECT * FROM HostInstitutionDetails WHERE InstitutionID = '".$InstitutionID."'";
	$result = mysqli_query($conn, $query);
	if (mysqli_num_rows($result) === 0) {
	
	$sql2 = "INSERT INTO HostInstitutionDetails(
						InstitutionID,
						  CategoriseInstitution,
	
						  HostedInternsBefore,
						  NumberEmployed,
							NumberHosted,
							HostedYear,
						  SufficientResources,
						  Resources,
						  TaxPin,
						  InstitutionRegistrationCertificate,
						  UpdatedBy
) VALUES(
							'$InstitutionID',
						  '$CategoriseInstitution',
			
						  '$HostedInternsBefore',
						  '$NumberEmployed',
							'$NumberHosted',
							'$HostedYear',
						  '$SufficientResources',
						  '$Resources',
						  '$TaxPin',
						  '$InstitutionRegistrationCertificate',
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

			  HostedInternsBefore = '$HostedInternsBefore',
			  NumberEmployed = '$NumberEmployed',
				NumberHosted = '$NumberHosted',
				HostedYear = '$HostedYear',
			  SufficientResources = '$SufficientResources',
			  Resources = '$Resources',
			  
			  UpdatedBy = '$UpdatedBy'
				".$update."
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

	  $HostedInternsBefore = $userdetails['HostedInternsBefore'];
	  $NumberEmployed = $userdetails['NumberEmployed'];
		$NumberHosted = $userdetails['NumberHosted'];
		$HostedYear = $userdetails['HostedYear'];
	  $SufficientResources = $userdetails['SufficientResources'];
	  $Resources = $userdetails['Resources'];
	  $TaxPin = $userdetails['TaxPin'];
	  $InstitutionRegistrationCertificate = $userdetails['InstitutionRegistrationCertificate'];
	  
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
                        <div class="col-12 col-md-10 order-md-1 order-last">
                            <h3><?php echo @$_SESSION['headingType'] .' (' . @$_SESSION['SessionInstitutionName'] . ')' . ' - ' . $title; ?></h3>
                            
                        </div>
                        <div class="col-12 col-md-2 order-md-2 order-first">
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
                                                        <label for="CategoriseInstitution">Categorise Institution <span style="color:red">*</span></label>
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
                                                        <label for="HostedInternsBefore">Have you previously hosted DSI/NRF interns? <span style="color:red">*</span></label>
                                                        <fieldset class="form-group">
                                                    <select class="form-select" id="HostedInternsBefore" name="HostedInternsBefore" required="required">
                                                        <option></option>
                                                        <option <?php if(@$HostedInternsBefore == 'Yes'){ echo 'selected="selected"'; } ?>>Yes</option>
                                                        <option <?php if(@$HostedInternsBefore == 'No'){ echo 'selected="selected"'; } ?>>No</option>
                                                    </select>
                                                </fieldset>
                                                    </div>
                                                </div>

													<div class="col-md-6 col-12 internsHistory" <?php if(@$HostedInternsBefore == '' || @$HostedInternsBefore == 'No'){ echo 'style="display:none;"';}else{ echo 'style="display:inline;"'; } ?>>
                                                    <div class="form-group">
                                                        <label for="HostedYear">When was the first year your institution hosted an intern? <span style="color:red">*</span></label>
                                                        <fieldset class="form-group">
                                                    <select class="form-select" id="HostedYear" name="HostedYear">
                                                        <option></option>
                                                        <option <?php if(@$HostedYear == '2021'){ echo 'selected="selected"'; } ?>>2021</option>
                                                        <option <?php if(@$HostedYear == '2020'){ echo 'selected="selected"'; } ?>>2020</option>
														<option <?php if(@$HostedYear == '2019'){ echo 'selected="selected"'; } ?>>2019</option>
														<option <?php if(@$HostedYear == '2018'){ echo 'selected="selected"'; } ?>>2018</option>
														<option <?php if(@$HostedYear == '2017'){ echo 'selected="selected"'; } ?>>2017</option>
														<option <?php if(@$HostedYear == '2016'){ echo 'selected="selected"'; } ?>>2016</option>
														<option <?php if(@$HostedYear == '2015'){ echo 'selected="selected"'; } ?>>2015</option>
														<option <?php if(@$HostedYear == '2014'){ echo 'selected="selected"'; } ?>>2014</option>
														<option <?php if(@$HostedYear == '2013'){ echo 'selected="selected"'; } ?>>2013</option>
														<option <?php if(@$HostedYear == '2012'){ echo 'selected="selected"'; } ?>>2012</option>
														<option <?php if(@$HostedYear == '2011'){ echo 'selected="selected"'; } ?>>2011</option>
														<option <?php if(@$HostedYear == '2010'){ echo 'selected="selected"'; } ?>>2010</option>
														<option <?php if(@$HostedYear == '2009'){ echo 'selected="selected"'; } ?>>2009</option>
														<option <?php if(@$HostedYear == '2008'){ echo 'selected="selected"'; } ?>>2008</option>
														<option <?php if(@$HostedYear == '2007'){ echo 'selected="selected"'; } ?>>2007</option>
														<option <?php if(@$HostedYear == '2006'){ echo 'selected="selected"'; } ?>>2006</option>
														<option <?php if(@$HostedYear == '2005'){ echo 'selected="selected"'; } ?>>2005</option>
														
                                                    </select>
                                                </fieldset>
                                                    </div>
													</div>
                                               
													
													
												<div class="col-md-6 col-12 internsHistory" <?php if(@$HostedInternsBefore == '' || @$HostedInternsBefore == 'No'){ echo 'style="display:none;"';}else{ echo 'style="display:inline;"'; } ?>>
                                                    <div class="form-group">
                                                        <label for="NumberHosted">Total number of interns hosted by your institution <span style="color:red">*</span></label>
                                                        <input type="number" id="NumberHosted" class="form-control"
                                                             name="NumberHosted" value="<?php echo @$NumberHosted; ?>">
                                                    </div>
                                                </div>	
													
												<div class="col-md-6 col-12 internsHistory" <?php if(@$HostedInternsBefore == '' || @$HostedInternsBefore == 'No'){ echo 'style="display:none;"';} ?>>
                                                    <div class="form-group">
                                                        <label for="NumberEmployed">How many interns have been employed by your institution after their internship? <span style="color:red">*</span></label>
                                                        <input type="number" id="NumberEmployed" class="form-control"
                                                             name="NumberEmployed" value="<?php echo @$NumberEmployed; ?>">
                                                    </div>
                                                </div>	
													
													
                                         
												
												
												
												<div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="SufficientResources">Do you have sufficient or adequate resources? <span style="color:red">*</span></label>
                                                        <fieldset class="form-group">
                                                    <select class="form-select" id="SufficientResources" name="SufficientResources" required="required">
                                                        <option><?php echo @$SufficientResources; ?></option>
                                                        <option>Yes</option>
                                                        <option>No</option>
                                                    </select>
                                                </fieldset>
                                                    </div>
                                                </div>
												
												
												<div class="col-md-6 mb-4">
                                                
                                                <div class="form-group">
												<label for="Resources">List the basic available resources <span style="color:red">*</span></label>
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
                                                        <label for="TaxPin">Attach Tax Pin  (Accepted attachment types: pdf,doc,docx,png,gif,jpg,jpeg)<span style="color:red">*</span></label> <span  style="float:right"> <?php if(@$TaxPin){
	 echo '<a style="color:red;" class="icon dripicons-document-delete" href="?tax='.@$TaxPin.'"></a> <a target="_blank" href="uploads/institution/'.$_SESSION['InstitutionID'].'/'.@$TaxPin.'">Attached Document</a>';
 } ?></span>
                                                        <input type="file" id="TaxPin" name="TaxPin" value="<?php echo @$TaxPin; ?>" class="form-control" <?php if(!@$TaxPin){ echo 'required="required"'; } ?>>
                                                    </div>
                                                </div>
												
												<div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="InstitutionRegistrationCertificate">Attach institution registration certificate  (Accepted attachment types: pdf,doc,docx,png,gif,jpg,jpeg)<span style="color:red">*</span></label> <span  style="float:right"> <?php if(@$InstitutionRegistrationCertificate){
	 echo '<a style="color:red;" class="icon dripicons-document-delete" href="?certificate='.@$InstitutionRegistrationCertificate.'"></a> <a target="_blank" href="uploads/institution/'.$_SESSION['InstitutionID'].'/'.@$InstitutionRegistrationCertificate.'">Attached Document</a>';
 } ?></span>
                                                        <input type="file" id="InstitutionRegistrationCertificate" name="InstitutionRegistrationCertificate" value="<?php echo @$InstitutionRegistrationCertificate; ?>" class="form-control" <?php if(!@$InstitutionRegistrationCertificate){ echo 'required="required"'; } ?>>
                                                    </div>
                                                </div>

                                                
                                            </div>
											<div class="col-12 d-flex justify-content-end">
                                                    <?php if(@$_SESSION['user_type'] == '2'){ ?>
                                                    <button type="reset"
                                                        class="btn btn-light-secondary me-1 mb-1">Reset</button>
														<button type="submit"
                                                        class="btn btn-primary me-1 mb-1" name="Submit" value="Submit">Submit</button>
														<?php }else{ echo '<div class="alert alert-light-danger color-danger"><i class="bi bi-exclamation-circle"></i>Only Host Admin can capture this information</div>'; } ?>
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
		$('.internsHistory').show();
	}else{
		$('.internsHistory').hide();
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