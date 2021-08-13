<?php 
include 'admin/connect.php';
$conn = OpenCon();
$menu_item = "2";
$title = "Next of Kin";

$sql = "SELECT distinct Details FROM LookupHeadings WHERE Section='Next of Kin' ";
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
	$message = "Details successfully captured.";
	$checklist = "INSERT INTO ApplicantChecklist(UserID, Section)VALUES('$id','Next Of Kin')";
	mysqli_query($conn, $checklist);
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
                                                        <label for="Name">Name <span style="color:red">*</span></label>
                                                        <input type="text" id="Name" class="form-control"
                                                             name="Name" value="<?php echo @$Name; ?>" required="required">
                                                    </div>
                                                </div>
												
												<div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="Telephone">Telephone Number <span style="color:red">*</span></label>
                                                        <input type="text" id="Telephone" class="form-control"
                                                             name="Telephone" value="<?php echo @$Telephone; ?>" required="required">
                                                    </div>
                                                </div>
												
												<div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="Cellnumber">Cellphone Number <span style="color:red">*</span></label>
                                                        <input type="text" id="Cellnumber" class="form-control"
                                                             name="Cellnumber" value="<?php echo @$Cellnumber; ?>" required="required">
                                                    </div>
                                                </div>
												
												<div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="Relationship">Relationship to you <span style="color:red">*</span></label>
                                                        <input type="text" id="Relationship" class="form-control"
                                                             name="Relationship" value="<?php echo @$Relationship; ?>" required="required">
                                                    </div>
                                                </div>
												
												<div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="Address">Physical Address <span style="color:red">*</span></label>
                                                        <textarea class="form-control" id="Address" name="Address" rows="3" required="required"><?php echo @$Address; ?></textarea>
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