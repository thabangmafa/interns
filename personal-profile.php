<?php 
include 'admin/connect.php';
$conn = OpenCon();
$menu_item = "2";
$title = "Personal Profile";

$sql = "SELECT distinct Details FROM LookupHeadings WHERE Section='Personal Profile' ";
		$result = mysqli_query($conn, $sql);
		$headings = mysqli_fetch_assoc($result);

$sql = "SELECT distinct * FROM UserProfile WHERE UserID='".$_SESSION['id']."' ";
		$result = mysqli_query($conn, $sql);
		$row = mysqli_fetch_assoc($result);
$id = $_SESSION['id'];
if (@$_POST['EducationalandProfessional'] != '' || @$_POST['GoalsandAspirations'] != '' || @$_POST['Awards'] != '' || @$_POST['CommunityEngagement'] != '') {
	
	$EducationalandProfessional = $_POST['EducationalandProfessional'];
	$GoalsandAspirations = $_POST['GoalsandAspirations'];
	$Awards = $_POST['Awards'];
	$Platform = $_POST['Platform'];
	$CommunityEngagement = $_POST['CommunityEngagement'];
	
	if (mysqli_num_rows($result) > 0) {
		mysqli_query($conn,"UPDATE UserProfile SET 
		EducationalandProfessional = '$EducationalandProfessional', 
		GoalsandAspirations = '$GoalsandAspirations', 
		Awards = '$Awards', 
		Platform = '$Platform',
		CommunityEngagement = '$CommunityEngagement' WHERE UserID = '".$_SESSION['id']."'");

		$message = "Details successfully updated.";
	}else{
		mysqli_query($conn,"INSERT INTO UserProfile(UserID,EducationalandProfessional,GoalsandAspirations,Awards,CommunityEngagement,Platform) 
		VALUES('".$_SESSION['id']."','$EducationalandProfessional','$GoalsandAspirations','$Awards','$CommunityEngagement','$Platform')");
		$checklist = "INSERT INTO ApplicantChecklist(UserID, Section)VALUES('$id','Personal Profile')";
		mysqli_query($conn, $checklist);
		$message = "Details successfully captured.";
	} 
	
}

$sql = "SELECT distinct * FROM UserProfile WHERE UserID='".$_SESSION['id']."' ";
		$result = mysqli_query($conn, $sql);
		$row = mysqli_fetch_assoc($result);


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
												
												<div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="Platform">Where did you find out about this internship opportunity?</label>
                                                        <fieldset class="form-group">
                                                    <select class="choices form-select" id="Platform" name="Platform">
													<option><?php echo @$row['Platform']; ?></option>
                                                        <option>Newspaper advertisement</option>
														<option>Employment website e.g. Indeed, Careers24.com etc</option>
														<option>HSRC website</option>
														<option>Through social media</option>
														<option>While searching for jobs using the Internet</option>
														<option>Made enquiries at workplaces</option>
														<option>Through recruitment agencies</option>
														<option>From a friend/family member</option>

                                                    </select>
                                                </fieldset>
                                                    </div>
                                                </div>
												
												
												<div class="col-md-12 col-12">
                                                    <div class="form-group">
                                                        
                                        <label for="EducationalandProfessional" class="form-label">Educational and Professional Summary</label>
                                        <textarea class="form-control" name="EducationalandProfessional" id="EducationalandProfessional"
                                            rows="3"><?php echo @$row['EducationalandProfessional']; ?></textarea>
                                    
                                                    </div>
                                                </div>
												
												<div class="col-md-12 col-12">
                                                    <div class="form-group">
                                                        
                                        <label for="GoalsandAspirations" class="form-label">Educational and Career, Goals and Aspirations</label>
                                        <textarea class="form-control" name="GoalsandAspirations" id="GoalsandAspirations"
                                            rows="3"><?php echo @$row['GoalsandAspirations']; ?></textarea>
                                    
                                                    </div>
                                                </div>
												
												<div class="col-md-12 col-12">
                                                    <div class="form-group">
                                                        
                                        <label for="Awards" class="form-label">Awards and Special Achievements</label>
                                        <textarea class="form-control" name="Awards" id="Awards"
                                            rows="3"><?php echo @$row['Awards']; ?></textarea>
                                    
                                                    </div>
                                                </div>
												
												<div class="col-md-12 col-12">
                                                    <div class="form-group">
                                                        
                                        <label for="CommunityEngagement" class="form-label">Civic, community engagement and other interests</label>
                                        <textarea class="form-control" name="CommunityEngagement" id="CommunityEngagement"
                                            rows="3"><?php echo @$row['CommunityEngagement']; ?></textarea>
                                    
                                                    </div>
                                                </div>
                               
                                                <div class="col-12 d-flex justify-content-end">
                                          
                                                    <button type="reset"
                                                        class="btn btn-light-secondary me-1 mb-1">Reset</button>
														<button type="submit"
                                                        class="btn btn-primary me-1 mb-1">Submit</button>
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
	
	<!-- Include Choices JavaScript -->
    <script src="assets/vendors/choices.js/choices.min.js"></script>

    <script src="assets/js/main.js"></script>
</body>

</html>