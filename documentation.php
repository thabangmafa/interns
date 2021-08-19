<?php 

include 'admin/connect.php';
$conn = OpenCon();

$menu_item = "11";
$title = "Supporting Documentation";

if (@$_POST['Submit'] != '') {



		$query = "UPDATE LookupDocumentation SET Details = '".$_POST['deails']."'";
		mysqli_query($conn, $query);

	
	
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
                            <h3>DSI-HSRC Internship Management System</h3>
                            
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
			<form class="form" action="" method="post" enctype="multipart/form-data">	
            <div class="page-content">
                <section class="row">


					<div class="card">
					
					<div class="card-header">
                                        <h4>Supporting Documentation</h4>
                                    </div>
					
					
							
									<div class="card-body">
									<div class="col-12" <?php if($_SESSION['user_type'] == '1'){ echo 'style="display:inline"'; }else{ echo 'style="display:none"';} ?> >
                                                    
													
									<div class="form-group">
										<textarea class="form-control" id="editor" name="deails" rows="3" >
											
											
											<?php

												$sql = "SELECT Details FROM LookupDocumentation ";
													$result = mysqli_query($conn, $sql);

												while($documents = mysqli_fetch_array($result)) {
												echo $documents['Details'];
												}	
											?>
											
										</textarea>
										
                                                    </div>
													
													<div class="col-12 d-flex justify-content-end">
                                                    
                                                    <button type="submit" class="btn btn-primary me-1 mb-1" name="Submit" value="Submit">Save</button>
												</div>
													
													
										</div>
												
												
										 
										 <?php

											$sql = "SELECT Details FROM LookupDocumentation ";
												$result = mysqli_query($conn, $sql);

											while($documents = mysqli_fetch_array($result)) {
											echo $documents['Details'];
											}	
										?>
										 
										 
                                    </div>

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


					<script>
						ClassicEditor
							.create(document.querySelector('#editor'))
							.catch(error => {
								console.error(error);
							});
					</script>
	

    <script src="assets/js/main.js"></script>
	<?php // require_once("footer.php"); ?>
</body>

</html>

    

