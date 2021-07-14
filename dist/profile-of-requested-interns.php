<?php 

$menu_item = "3";
$title = "Profile of Requested Interns";

 ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HSRC Interns Management System - <?php echo $title; ?></title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/bootstrap.css">
	
	<link rel="stylesheet" href="assets/vendors/dripicons/webfont.css">
    <link rel="stylesheet" href="assets/css/pages/dripicons.css">

	<link rel="stylesheet" href="assets/vendors/simple-datatables/style.css">
    <link rel="stylesheet" href="assets/vendors/perfect-scrollbar/perfect-scrollbar.css">
    <link rel="stylesheet" href="assets/vendors/bootstrap-icons/bootstrap-icons.css">
	
    <link rel="stylesheet" href="assets/css/app.css">
    <link rel="shortcut icon" href="assets/images/favicon.svg" type="image/x-icon">
</head>

<body>
    <div id="app">
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
                                    <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page"><?php echo $title; ?></li>
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
									<li>Please provide all the information requested below.</li></ul>
                                </div>
                                <div class="card-content">
                                    <div class="card-body">
                                        <form class="form">
                                            <div class="row">
											
											
											
												<table class="table table-striped" id="table1">
                                <thead>
                                    <tr>
                                        <th>Primary Scientific Field</th>
                                        <th>Secondary Scientific Field</th>
                                        <th>Number Required</th>
                                        <th>Qualification Level</th>
										<th>Edit</th>
										<th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Information Technology</td>
                                        <td>Human Resources</td>
                                        <td>5</td>
                                        <td>Degree</td>
										
                                        <td><div class="icon dripicons-document-edit" data-bs-toggle="modal" data-bs-target="#edit-qualification"></div></td>
										<td><div class="icon dripicons-wrong" data-bs-toggle="modal" data-bs-target="#primary"></div></td>
                                    </tr>
                                    <tr>
                                        <td>Information Technology</td>
                                        <td>Human Resources</td>
                                        <td>5</td>
                                        <td>Degree</td>
                                        <td><div class="icon dripicons-document-edit" data-bs-toggle="modal" data-bs-target="#edit-qualification"></div></td>
										<td><div class="icon dripicons-wrong" data-bs-toggle="modal" data-bs-target="#primary"></div></td>
                                    </tr>
									<tr>
                                        <td>Information Technology</td>
                                        <td>Human Resources</td>
                                        <td>5</td>
                                        <td>Degree</td>
                                        <td><div class="icon dripicons-document-edit" data-bs-toggle="modal" data-bs-target="#edit-qualification"></div></td>
										<td><div class="icon dripicons-wrong" data-bs-toggle="modal" modal-title="Confirm Delete Item" data-bs-target="#primary"></div></td>
                                    </tr>
                                </tbody>
                            </table>
							<div class="col-12 d-flex justify-content-end">
     
													<div class="btn btn-primary me-1 mb-1" data-bs-toggle="modal" data-bs-target="#capture-new">Add Another</div>
                                                   
                                                </div>
							
							
							
							
							<!--primary theme Modal -->
                                                    <div class="modal fade text-left" id="primary" tabindex="-1"
                                                        role="dialog" aria-labelledby="myModalLabel160"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable"
                                                            role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header bg-danger">
                                                                    <h5 class="modal-title white" id="myModalLabel160">
                                                                        Confirm Delete Profile
                                                                    </h5>
                                                                    <button type="button" class="close"
                                                                        data-bs-dismiss="modal" aria-label="Close">
                                                                        <i data-feather="x"></i>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    Are you sure you want to delete this Profile? Please click Yes if you want to delete this Profile. Once it has been deleted you will not be able to retrieve it again.
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button"
                                                                        class="btn btn-light-secondary"
                                                                        data-bs-dismiss="modal">
                                                                        <i class="bx bx-x d-block d-sm-none"></i>
                                                                        <span class="d-none d-sm-block">No</span>
                                                                    </button>
                                                                    <button type="button" class="btn btn-primary ml-1"
                                                                        data-bs-dismiss="modal">
                                                                        <i class="bx bx-check d-block d-sm-none"></i>
                                                                        <span class="d-none d-sm-block">Yes</span>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
												
												
												
												
													
												
												
												
							
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
				
				
				
				
				
				
				<!--Modal Xl size -->
                                        <div class="me-1 mb-1 d-inline-block">
                  

                                            <!--Extra Large Modal -->
                                            <div class="modal fade text-left w-100" id="capture-new" tabindex="-1"
                                                role="dialog" aria-labelledby="myModalLabel16" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl"
                                                    role="document">
                                                    <div class="modal-content">
                                                        
														<div class="modal-header bg-success">
                                                                    <h5 class="modal-title white" id="myModalLabel160">
                                                                        Add New Profile
                                                                    </h5>
                                                                    <button type="button" class="close"
                                                                        data-bs-dismiss="modal" aria-label="Close">
                                                                        <i data-feather="x"></i>
                                                                    </button>
                                                                </div>
														
                                                        <div class="modal-body">
                                                            <form class="form">
                                            <div class="row">
											
												
												<div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="first-name-column">Primary Scientific Field</label>
                                                        <input type="text" id="first-name-column" class="form-control"
                                                             name="fname-column">
                                                    </div>
                                                </div>
												
												<div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="first-name-column">Secondary Scientific Field</label>
                                                        <input type="text" id="first-name-column" class="form-control"
                                                             name="fname-column">
                                                    </div>
                                                </div>
												
												<div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="first-name-column">Number Required</label>
                                                        <input type="number" id="first-name-column" class="form-control"
                                                             name="fname-column">
                                                    </div>
                                                </div>
												
												<div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="first-name-column">Qualification Level</label>
                                                        <input type="number" id="first-name-column" class="form-control"
                                                             name="fname-column">
                                                    </div>
                                                </div>
												
                                            </div>
                                        </form>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-light-secondary"
                                                                data-bs-dismiss="modal">
                                                                <i class="bx bx-x d-block d-sm-none"></i>
                                                                <span class="d-none d-sm-block">Close</span>
                                                            </button>
                                                            <button type="button" class="btn btn-primary ml-1"
                                                                data-bs-dismiss="modal">
                                                                <i class="bx bx-check d-block d-sm-none"></i>
                                                                <span class="d-none d-sm-block">Accept</span>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
										
										<!--Modal Xl size -->
                                        <div class="me-1 mb-1 d-inline-block">
                  

                                            <!--Extra Large Modal -->
                                            <div class="modal fade text-left w-100" id="edit-qualification" tabindex="-1"
                                                role="dialog" aria-labelledby="myModalLabel16" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl"
                                                    role="document">
                                                    <div class="modal-content">
                                                        
														<div class="modal-header bg-success">
                                                                    <h5 class="modal-title white" id="myModalLabel160">
                                                                        Edit Profile
                                                                    </h5>
                                                                    <button type="button" class="close"
                                                                        data-bs-dismiss="modal" aria-label="Close">
                                                                        <i data-feather="x"></i>
                                                                    </button>
                                                                </div>
																
                                                        <div class="modal-body">
                                                            <form class="form">
                                            <div class="row">
											
												
												<div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="first-name-column">Primary Scientific Field</label>
                                                        <input type="text" id="first-name-column" class="form-control"
                                                             name="fname-column">
                                                    </div>
                                                </div>
												
												<div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="first-name-column">Secondary Scientific Field</label>
                                                        <input type="text" id="first-name-column" class="form-control"
                                                             name="fname-column">
                                                    </div>
                                                </div>
												
												<div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="first-name-column">Number Required</label>
                                                        <input type="number" id="first-name-column" class="form-control"
                                                             name="fname-column">
                                                    </div>
                                                </div>
												
												<div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="first-name-column">Qualification Level</label>
                                                        <input type="number" id="first-name-column" class="form-control"
                                                             name="fname-column">
                                                    </div>
                                                </div>
												
                                            </div>
                                        </form>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-light-secondary"
                                                                data-bs-dismiss="modal">
                                                                <i class="bx bx-x d-block d-sm-none"></i>
                                                                <span class="d-none d-sm-block">Close</span>
                                                            </button>
                                                            <button type="button" class="btn btn-primary ml-1"
                                                                data-bs-dismiss="modal">
                                                                <i class="bx bx-check d-block d-sm-none"></i>
                                                                <span class="d-none d-sm-block">Update</span>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
				
				
            </div>

            <footer>
                <div class="footer clearfix mb-0 text-muted">
                    <div class="float-start">
                        <p>2021 &copy; Mazer</p>
                    </div>
                    <div class="float-end">
                        <p>Crafted with <span class="text-danger"><i class="bi bi-heart"></i></span> by <a
                                href="http://ahmadsaugi.com">A. Saugi</a></p>
                    </div>
                </div>
            </footer>
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