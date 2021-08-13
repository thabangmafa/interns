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
if (isset($_POST['profile'])) {
	
	$profile = $_POST['profile'];
	
	if (mysqli_num_rows($result) > 0) {
		mysqli_query($conn,"UPDATE UserProfile SET Description = '$profile' WHERE UserID = '".$_SESSION['id']."'");
	}else{
		mysqli_query($conn,"INSERT INTO UserProfile(UserID,Description) VALUES('".$_SESSION['id']."','$profile')");
		$checklist = "INSERT INTO ApplicantChecklist(UserID, Section)VALUES('$id','Personal Profile')";
		mysqli_query($conn, $checklist);
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
												<div class="col-md-12 col-12">
                                                    <div class="form-group">
                                                        
                                        <label for="profile" class="form-label">Description <span style="color:red">*</span></label>
                                        <textarea class="form-control" required="required" name="profile" id="profile"
                                            rows="3"><?php echo @$row['Description']; ?></textarea>
                                    
                                                    </div>
                                                </div>
                               
                                                <div class="col-12 d-flex justify-content-end">
                                                    <button type="submit"
                                                        class="btn btn-primary me-1 mb-1">Submit</button>
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
	
	<!-- Include Choices JavaScript -->
    <script src="assets/vendors/choices.js/choices.min.js"></script>

    <script src="assets/js/main.js"></script>
</body>

</html>