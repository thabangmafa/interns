<?php 

include 'admin/connect.php';
$conn = OpenCon();

$menu_item = "6";
$title = "Page Headings";

if (isset($_POST['Submit'])) {

	foreach($_POST as $key => $details){
		$query = "UPDATE LookupHeadings SET Details = '".$details."' WHERE ID = '".$key."'";
		mysqli_query($conn, $query);
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
                            <h3>HSRC Interns Management System</h3>
                            
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
			<form class="form" action="" method="post">	
            <div class="page-content">
                <section class="row">


					<div class="card">
					
					<div class="card-header">
                                        <h4>Headings</h4>
                                    </div>
					
					<?php

					$sql = "SELECT distinct ID, Section, Details FROM LookupHeadings ";
						$result = mysqli_query($conn, $sql);

					while($headings = mysqli_fetch_array($result)) {
								//echo $headings['Section']. '<br />'.	$headings['Details'];	
							?>
							
									<div class="card-body">
                                        <div class="col-12">
                                                    
													
													<div class="form-group">
                                                        
                                        <label for="DisabilityDetails" class="form-label"><?php echo $headings['Section']; ?></label>
                                        
										
										
										<textarea class="form-control" id="editor<?php echo $headings['ID']; ?>" name="<?php echo $headings['ID']; ?>"
                                            rows="3" ><?php echo $headings['Details']; ?></textarea>
										
										
										
										

                                    
                                                    </div>
                                                </div>
												
												<div class="col-12 d-flex justify-content-end">
                                                    
                                                    
														<button type="submit"
                                                        class="btn btn-primary me-1 mb-1" name="Submit" value="Submit">Save</button>
                                         </div>
                                    </div>
							
							<?php
							
							
							
							}
					?>
					
					
                                    
                                    
                                </div>
								

                </section>
            </div>
			
			
                                        
										
			</form>

            
        </div>
    </div>
    <script src="assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>

    <script src="assets/vendors/apexcharts/apexcharts.js"></script>
	<script src="assets/vendors/ckeditor/ckeditor.js"></script>

			<?php

					$sql = "SELECT distinct ID, Section, Details FROM LookupHeadings ";
						$result = mysqli_query($conn, $sql);

					while($headings = mysqli_fetch_array($result)) { ?>
					<script>
						ClassicEditor
							.create(document.querySelector('#editor<?php echo $headings["ID"]; ?>'))
							.catch(error => {
								console.error(error);
							});
					</script>
	
					<?php } ?>
    <script src="assets/js/main.js"></script>
	<?php // require_once("footer.php"); ?>
</body>

</html>

    

