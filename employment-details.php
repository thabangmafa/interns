<?php 
include 'admin/connect.php';
$conn = OpenCon();
$menu_item = "2";
$title = "Employment Details";

if (isset($_POST['Submit'])) {
	
	function validate($data){
       $data = trim($data);
	   $data = stripslashes($data);
	   $data = htmlspecialchars($data);
	   return $data;
	}
	$id = $_SESSION['id'];
	$EmploymentStatus = validate($_POST['EmploymentStatus']);
	$Position = validate($_POST['Position']);
	$EmployedFromDate = validate($_POST['EmployedFromDate']);
	$EmployedToDate = validate($_POST['EmployedToDate']);
	$Organization = validate($_POST['Organization']);
	$Type = validate($_POST['Type']);
	
	if($EmploymentStatus == 'Permanent'){
		$EmployedFromDate = '';
		$EmployedToDate = '';
	}
	
	$query = "SELECT * FROM EmploymentDetails WHERE UserID = '".$_SESSION['id']."'";
	$result = mysqli_query($conn, $query);
	if (mysqli_num_rows($result) === 0) {
	
	$sql2 = "INSERT INTO EmploymentDetails(
						UserID,
						EmploymentStatus,
						Position,
						EmployedFromDate,
						EmployedToDate,
						Organization,
						Type
) VALUES(
						'$id',
						'$EmploymentStatus',
						'$Position',
						'$EmployedFromDate',
						'$EmployedToDate',
						'$Organization',
						'$Type'

)";


    $result2 = mysqli_query($conn, $sql2);
	$message = "Details successfully captured.";
	unset($_POST);
	}else{
		
	$sql2 = "UPDATE EmploymentDetails SET 
						EmploymentStatus = '$EmploymentStatus',
						Position = '$Position',
						EmployedFromDate = '$EmployedFromDate',
						EmployedToDate = '$EmployedToDate',
						Organization = '$Organization',
						Type = '$Type'
	
	WHERE UserID = '".$id."'";

	$result2 = mysqli_query($conn, $sql2);
	$message = "Details successfully updated.";
	unset($_POST);	
	}
	
}

	$query = "SELECT * FROM EmploymentDetails a
	WHERE a.UserID = '".$_SESSION['id']."'";
	$result = mysqli_query($conn, $query);

	while($userdetails = mysqli_fetch_array($result)) {

			$EmploymentStatus = $userdetails['EmploymentStatus'];
			$Position = $userdetails['Position'];
			$EmployedFromDate = $userdetails['EmployedFromDate'];
			$EmployedToDate = $userdetails['EmployedToDate'];
			$Organization = $userdetails['Organization'];
			$Type = $userdetails['Type'];
			
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
									<li>Capture current employment details</li>
									</ul>
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
														<label for="EmploymentStatus">Employment Status</label>
														<fieldset class="form-group">
													<select class="form-select" name="EmploymentStatus" id="EmploymentStatus" required="required">
													<option></option>
													<option value="Contract" <?php if(@$EmploymentStatus == 'Contract'){ echo "selected='selected'"; } ?>>Contract</option>
													<option value="Permanent" <?php if(@$EmploymentStatus == 'Permanent'){ echo "selected='selected'"; } ?>>Permanent</option>
													<option value="Temporary" <?php if(@$EmploymentStatus == 'Temporary'){ echo "selected='selected'"; } ?>>Temporary</option>
													</select>
												</fieldset>
													</div>
												</div>
												
												<div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="Position">Position</label>
                                                        <input type="text" id="Position" class="form-control"
                                                             name="Position" value="<?php echo @$Position; ?>" required="required">
                                                    </div>
                                                </div>
												
												<div class="col-md-6 col-12 ContractsView" <?php if(@$EmploymentStatus == 'Permanent' || @$EmploymentStatus == ''){ echo 'style="display:none;"';} ?>>
                                                    <div class="form-group">
                                                        <label for="EmployedFromDate">Employed From Date</label>
                                                        <input type="date" id="EmployedFromDate" class="form-control"
                                                             name="EmployedFromDate" value="<?php echo @$EmployedFromDate; ?>">
                                                    </div>
                                                </div>
												
												<div class="col-md-6 col-12 ContractsView" <?php if(@$EmploymentStatus == 'Permanent' || @$EmploymentStatus == ''){ echo 'style="display:none;"';} ?>>
                                                    <div class="form-group">
                                                        <label for="EmployedToDate">Employed To Date</label>
                                                        <input type="date" id="EmployedToDate" class="form-control"
                                                             name="EmployedToDate" value="<?php echo @$EmployedToDate; ?>">
                                                    </div>
                                                </div>
												
												<div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="Organization">Organization</label>
                                                        <input type="text" id="Organization" class="form-control"
                                                             name="Organization" value="<?php echo @$Organization; ?>" required="required">
                                                    </div>
                                                </div>
												
												<div class="col-md-6 col-12">
													<div class="form-group">
														<label for="Type">Type</label>
														<fieldset class="form-group">
													<select class="form-select" name="Type" id="Type" required="required">
													<option></option>
													<?php
				
													$query = "SELECT * FROM LookupOrganisationType WHERE IsActive = '1'";
													$result = mysqli_query($conn, $query);

													while($institution = mysqli_fetch_array($result)) {
														$selected = '';
														if($institution['ID'] == $Type){ $selected = "selected='selected'"; }
														echo '<option value="' . $institution['ID'] . '" '.$selected.'>' . $institution['Name'] . '</option>';
													}

												?>
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

										
								
				
				
            </div>

            <?php require_once("footer.php"); ?>
        </div>
    </div>
    <script src="assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
	
	<script src="assets/vendors/simple-datatables/simple-datatables.js"></script>
    <script>
        // Simple Datatable
        let table1 = document.querySelector('#table1');
        let dataTable = new simpleDatatables.DataTable(table1);
    </script>

    <script src="assets/js/main.js"></script>
</body>

</html>
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script type="text/javascript">
 $(document).ready(function(){

$('#EmploymentStatus').change(function() {
	var val = $(this).val();
		if(val === "Contract" || val === "Temporary") {
			$('.ContractsView').show();
			$('#EmployedFromDate').attr('required', 'required');
			$('#EmployedToDate').attr('required', 'required');
		}else{
			$('.ContractsView').hide();
			$('#EmployedFromDate').removeAttr('required');
			$('#EmployedToDate').removeAttr('required');
		}
	});

});
</script>