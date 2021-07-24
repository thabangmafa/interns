<?php 
include 'admin/connect.php';
$conn = OpenCon();
$menu_item = "2";
$title = "Disability";
unset($row);
$sql = "SELECT distinct * FROM UserDisability WHERE userid='".$_SESSION['id']."' ";
		$result = mysqli_query($conn, $sql);
		$row = mysqli_fetch_assoc($result);

if (isset($_POST['description'])) {
	
	$disability = $_POST['disability'];
	$description = $_POST['description'];
	
	if($disability == 'No'){
		$description = '';
	}
	
	if (mysqli_num_rows($result) > 0) {
		mysqli_query($conn,"UPDATE UserDisability SET description = '$description', disability = '$disability' WHERE userid = '".$_SESSION['id']."'");
	}else{
		mysqli_query($conn,"INSERT INTO UserDisability(userid,description,disability) VALUES('".$_SESSION['id']."','$description','$disability')");
	} 
	
}

$sql = "SELECT distinct * FROM UserDisability WHERE userid='".$_SESSION['id']."' ";
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
									<li>An * at the end of a field label within a section denotes a compulsory field, and the section will not be saved unless all compulsory fields have been completed.</li>
									<li>Additional funding to cater for a disablity of a team member and/or a student in terms of the proposed research, can be requsted under the budgetary item "Research Materials and Supplies".</li>
									<li>Note that funding support to cater for a diability will only be allotted to people with disabilities as specified in the "Code of Good Practice on Employment of People with Disabilities" as in the Employment Equity Act No. 55 of 1998 below.</li>
									<!--li>In order to edit an existing medical certificate, click on the delete icon and unpload a new version.</li--></ul>
                                </div>
                                <div class="card-content">
                                    <div class="card-body">
                                        <form class="form" action="" method="post">
                                            <div class="row">
											<div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="last-name-column">Do you have any disability?</label>
                                                        <fieldset class="form-group">
                                                    <select class="form-select" id="disability" name="disability">
													<option><?php echo @$row['disability']; ?></option>
                                                        <option>Yes</option>
                                                        <option>No</option>
                                                    </select>
                                                </fieldset>
                                                    </div>
                                                </div>
												<div class="col-md-12 col-12">
                                                    
													
													<div class="form-group" id="disabilityDiv" <?php if(@$row['disability'] == '' || @$row['disability'] == 'No'){ echo 'style="display:none;"';} ?>>
                                                        
                                        <label for="exampleFormControlTextarea1" class="form-label">Disablity Description</label>
                                        <textarea class="form-control" id="disablity" name="description" id="description"
                                            rows="3" ><?php echo @$row['description']; ?></textarea>
                                    
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
					</section>
				
				
				
            </div>

            <?php require_once("footer.php"); ?>
        </div>
    </div>
    <script src="assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
	
	<script src="assets/vendors/simple-datatables/simple-datatables.js"></script>


    <script src="assets/js/main.js"></script>
</body>

</html>
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script type="text/javascript">
 $(document).ready(function(){
	
	
	

$('#disability').change(function() {
	var val = $(this).val();
    if(val === "Yes") {
		$('#disabilityDiv').show();
	}else{
		$('#disabilityDiv').hide();
	}
});


});
</script>