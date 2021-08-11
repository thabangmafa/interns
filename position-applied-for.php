<?php 
include 'admin/connect.php';
$conn = OpenCon();
$menu_item = "2";
$title = "Position Applied For";

$sql = "SELECT distinct Details FROM LookupHeadings WHERE Section='Position Applied For' ";
		$result = mysqli_query($conn, $sql);
		$headings = mysqli_fetch_assoc($result);

if (isset($_POST['Submit'])) {
	
	function validate($data){
       $data = trim($data);
	   $data = stripslashes($data);
	   $data = htmlspecialchars($data);
	   return $data;
	}
	$id = $_SESSION['id'];
	$CurrentInstitution = validate($_POST['CurrentInstitution']);
	$PreviouslyApplied = validate($_POST['PreviouslyApplied']);
	$HowManyTimes = validate($_POST['HowManyTimes']);
	$FirstProvince = validate($_POST['FirstProvince']);
	$FirstDiscipline = validate($_POST['FirstDiscipline']);
	$SecondProvince = validate($_POST['SecondProvince']);
	$SecondDiscipline = validate($_POST['SecondDiscipline']);
	$ThirdProvince = validate($_POST['ThirdProvince']);
	$ThirdDiscipline = validate($_POST['ThirdDiscipline']);
	
	if($PreviouslyApplied == 'No'){
		$HowManyTimes = '';
	}
	
	$query = "SELECT * FROM PositionAppliedFor WHERE UserID = '".$_SESSION['id']."'";
	$result = mysqli_query($conn, $query);
	if (mysqli_num_rows($result) === 0) {
	
	$sql2 = "INSERT INTO PositionAppliedFor(
						UserID,
						CurrentInstitution,
						PreviouslyApplied,
						HowManyTimes,
						FirstProvince,
						FirstDiscipline,
						SecondProvince,
						SecondDiscipline,
						ThirdProvince,
						ThirdDiscipline
) VALUES(
						'$id',
						'$CurrentInstitution',
						'$PreviouslyApplied',
						'$HowManyTimes',
						'$FirstProvince',
						'$FirstDiscipline',
						'$SecondProvince',
						'$SecondDiscipline',
						'$ThirdProvince',
						'$ThirdDiscipline'

)";


    $result2 = mysqli_query($conn, $sql2);
	$message = "Details successfully captured.";
	$checklist = "INSERT INTO ApplicantChecklist(UserID, Section)VALUES('$id','Position Applied For')";
		mysqli_query($conn, $checklist);
	unset($_POST);
	}else{
		
	$sql2 = "UPDATE PositionAppliedFor SET 
	
						CurrentInstitution = '$CurrentInstitution',
						PreviouslyApplied = '$PreviouslyApplied',
						HowManyTimes = '$HowManyTimes',
						FirstProvince = '$FirstProvince',
						FirstDiscipline = '$FirstDiscipline',
						SecondProvince = '$SecondProvince',
						SecondDiscipline = '$SecondDiscipline',
						ThirdProvince = '$ThirdProvince',
						ThirdDiscipline = '$ThirdDiscipline'
							
	WHERE UserID = '".$id."'";

	$result2 = mysqli_query($conn, $sql2);
	$message = "Details successfully updated.";
	unset($_POST);	
	}
	
}

	$query = "SELECT a.*, c.Name as OrganisationName FROM PositionAppliedFor a
	left join LookupInstitutions c on c.InstitutionId = a.CurrentInstitution
	WHERE a.UserID = '".$_SESSION['id']."'";
	$result = mysqli_query($conn, $query);

	while($userdetails = mysqli_fetch_array($result)) {

			$CurrentInstitution = $userdetails['CurrentInstitution'];
			$OrganisationName = $userdetails['OrganisationName'];
			$PreviouslyApplied = $userdetails['PreviouslyApplied'];
			$HowManyTimes = $userdetails['HowManyTimes'];
			$FirstProvince = $userdetails['FirstProvince'];
			$FirstDiscipline = $userdetails['FirstDiscipline'];
			$SecondProvince = $userdetails['SecondProvince'];
			$SecondDiscipline = $userdetails['SecondDiscipline'];
			$ThirdProvince = $userdetails['ThirdProvince'];
			$ThirdDiscipline = $userdetails['ThirdDiscipline'];
			
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
								<?php echo $headings['Details']; ?>
                                    
                                </div>
                                <div class="card-content">
								<?php if(@$message){ ?>	
								<div class="alert alert-success" role="alert"><?php echo @$message; ?></div>
								<?php } ?>
                                    <div class="card-body">
									<div class="row">
                                        <form class="form" method="POST" action="">
                                            <div class="row">
												
												<div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="CurrentInstitution">Organization</label>
                                                        <input autocomplete="off" list="OrganisationList" id="CurrentInstitution" class="form-control" name="CurrentInstitution" value="<?php echo @$OrganisationName; ?>">
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
												
												<div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="PreviouslyApplied">Have you previously applied for the DST Internship?</label>
                                                        <fieldset class="form-group">
                                                    <select class="choices form-select" id="PreviouslyApplied" name="PreviouslyApplied" required="required">
                                                        <option></option>
                                                        <option <?php if(@$PreviouslyApplied == 'Yes'){ echo "selected='selected'"; } ?>>Yes</option>
                                                        <option <?php if(@$PreviouslyApplied == 'No'){ echo "selected='selected'"; } ?>>No</option>
                                                    </select>
                                                </fieldset>
                                                    </div>
                                                </div>
												
												<div class="col-md-6 col-12 HowManyTimes" <?php if(@$PreviouslyApplied == 'No' || @$PreviouslyApplied == ''){ echo 'style="display:none;"';} ?>>
                                                    <div class="form-group">
                                                        <label for="HowManyTimes">How many times have you applied</label>
                                                        <input type="text" id="HowManyTimes" class="form-control"
                                                             name="HowManyTimes" value="<?php echo @$HowManyTimes; ?>">
                                                    </div>
                                                </div>
												
												
												<h5 class="divider divider-left">
                                        <div class="divider-text">Option 1:</div>
                                    </h5>
												
												<div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="FirstProvince">Province</label>
                                                        <fieldset class="form-group">
                                                    <select class="choices form-select" id="FirstProvince" name="FirstProvince" required="required">
                                                        <option></option>
                                                        <?php
				
															$query = "SELECT * FROM LookupProvince WHERE IsActive = '1' ORDER BY Name asc";
															$result = mysqli_query($conn, $query);
															

															while($province = mysqli_fetch_array($result)) {
																$select = "";
																if($FirstProvince == $province['ID']){ $select = "selected='selected'"; }
															 echo '<option value="'.$province['ID'].'" '.$select.'>'.ucwords($province['Name']).'</option>';
															}

														?>
                                                    </select>
                                                </fieldset>
                                                    </div>
                                                </div>
												
												<div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="FirstDiscipline">Discipline/Area of Specialisation</label>
                                                        <fieldset class="form-group">
                                                    <select class="choices form-select" id="FirstDiscipline" name="FirstDiscipline">
                                                        <option></option>
                                                        <?php
				
															$query = "SELECT * FROM LookupDisciplines WHERE IsActive = '1' ORDER BY Name asc";
															$result = mysqli_query($conn, $query);
															

															while($province = mysqli_fetch_array($result)) {
																$select = "";
																if($FirstDiscipline == $province['ID']){ $select = "selected='selected'"; }
															 echo '<option value="'.$province['ID'].'" '.$select.'>'.ucwords($province['Name']).'</option>';
															}

														?>
                                                    </select>
                                                </fieldset>
                                                    </div>
                                                </div>
												
												
												<h5 class="divider divider-left">
                                        <div class="divider-text">Option 2:</div>
                                    </h5>
												
												<div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="SecondProvince">Province</label>
                                                        <fieldset class="form-group">
                                                    <select class="choices form-select" id="SecondProvince" name="SecondProvince">
                                                        <option></option>
                                                        <?php
				
															$query = "SELECT * FROM LookupProvince WHERE IsActive = '1' ORDER BY Name asc";
															$result = mysqli_query($conn, $query);
															

															while($province = mysqli_fetch_array($result)) {
																$select = "";
																if($SecondProvince == $province['ID']){ $select = "selected='selected'"; }
															 echo '<option value="'.$province['ID'].'" '.$select.'>'.ucwords($province['Name']).'</option>';
															}

														?>
                                                    </select>
                                                </fieldset>
                                                    </div>
                                                </div>
												
												<div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="SecondDiscipline">Discipline/Area of Specialisation</label>
                                                        <fieldset class="form-group">
                                                    <select class="choices form-select" id="SecondDiscipline" name="SecondDiscipline">
                                                        <option></option>
                                                        <?php
				
															$query = "SELECT * FROM LookupDisciplines WHERE IsActive = '1' ORDER BY Name asc";
															$result = mysqli_query($conn, $query);
															

															while($province = mysqli_fetch_array($result)) {
																$select = "";
																if($SecondDiscipline == $province['ID']){ $select = "selected='selected'"; }
															 echo '<option value="'.$province['ID'].'" '.$select.'>'.ucwords($province['Name']).'</option>';
															}

														?>
                                                    </select>
                                                </fieldset>
                                                    </div>
                                                </div>
												
												<h5 class="divider divider-left">
                                        <div class="divider-text">Option 3:</div>
                                    </h5>
												
												<div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="ThirdProvince">Province</label>
                                                        <fieldset class="form-group">
                                                    <select class="choices form-select" id="ThirdProvince" name="ThirdProvince">
                                                        <option></option>
                                                        <?php
				
															$query = "SELECT * FROM LookupProvince WHERE IsActive = '1' ORDER BY Name asc";
															$result = mysqli_query($conn, $query);
															

															while($province = mysqli_fetch_array($result)) {
																$select = "";
																if($ThirdProvince == $province['ID']){ $select = "selected='selected'"; }
															 echo '<option value="'.$province['ID'].'" '.$select.'>'.ucwords($province['Name']).'</option>';
															}

														?>
                                                    </select>
                                                </fieldset>
                                                    </div>
                                                </div>
												
												<div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="ThirdDiscipline">Discipline/Area of Specialisation</label>
                                                        <fieldset class="form-group">
                                                    <select class="choices form-select" id="ThirdDiscipline" name="ThirdDiscipline">
                                                        <option></option>
                                                        <?php
				
															$query = "SELECT * FROM LookupDisciplines WHERE IsActive = '1' ORDER BY Name asc";
															$result = mysqli_query($conn, $query);
															

															while($province = mysqli_fetch_array($result)) {
																$select = "";
																if($ThirdDiscipline == $province['ID']){ $select = "selected='selected'"; }
															 echo '<option value="'.$province['ID'].'" '.$select.'>'.ucwords($province['Name']).'</option>';
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
												
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
				</div>
				</div>
            </section>
				
				
				
				
				
				
				
										
		

            
        </div>
		<?php require_once("footer.php"); ?>
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

$('#PreviouslyApplied').change(function() {
	var val = $(this).val();
		if(val === "Yes") {
			$('.HowManyTimes').show();
			$('#HowManyTimes').attr('required', 'required');
		}else{
			$('.HowManyTimes').hide();
			$('#HowManyTimes').removeAttr('required');
		}
	});

});
</script>