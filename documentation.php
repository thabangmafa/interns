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
				
												
										<div class="col-12">		
										 
										 <div class="table-responsive">
                                            <table class="table table-lg">
												<thead>
													<tr>
														<td><strong>Name of document</strong></td>
														<td><strong>See attached PDF</strong></td>
													</tr>
												</thead>
												<tbody>
													<tr>
														<td>DSI-HSRC Internship Programme Framework for HOST Institution Call 2021-23</td><td><a href="documents/DSI-HSRC Internship Programme Framework for HOST Institution Call 2021-23.pdf" target="_blank">Attached</a></td>
													</tr>
													<tr>
														<td>DSI-HSRC Internship Advert - Call for GRADUATES to Apply 2021-23</td><td><a href="documents/DSI-HSRC Internship Advert - Call for GRADUATES to Apply 2021-23.pdf" target="_blank">Attached</a></td>
														</tr>
													<tr>
														<td>DSI-HSRC Internship Programme Web Text - HOST Institution Call 2021-23</td><td><a href="documents/DSI-HSRC Internship Programme Web Text - HOST Institution Call 2021-23.pdf" target="_blank">Attached</a></td>
													</tr>
													<tr>
														<td>DSI-HSRC INTERN Recruitment Process Flowchart</td><td><a href="documents/DSI-HSRC INTERN Recruitment Process Flowchart FINAL.pdf" target="_blank">Attached</a></td>
													</tr>
													<tr>
														<td>DSI-HSRC HOST Institution Recruitment Process Flow Guide</td><td><a href="documents/DSI-HSRC HOST Institution Recruitment Process Flow Guide.pdf" target="_blank">Attached</a></td>
													</tr>
													<tr>
														<td>DSI-HSRC MENTOR INTERN REQUEST FORM</td><td><a href="documents/DSI-HSRC Mentor Intern Request Form.docx" target="_blank">Attached</a></td>
													</tr>
												</tbody>
											</table>
										</div>	 
									</div>	 
                                    </div>

                                </div>
								

                </section>
            </div>
			
			
                                        
										
			</form>

            
        </div>
    </div>

	<?php  require_once("footer.php"); ?>
</body>

</html>

    

