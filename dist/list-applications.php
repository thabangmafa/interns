<?php 

$menu_item = "4";
$title = "List of Applications";

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
                                    <li class="breadcrumb-item"><a href="index.php">Logout</a></li>
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
									<li>Strictly adhere to your institution’s internal closing date for submission of applications, as this will be prior to the NRF’s closing date, where applicable.</li>
<li>Applications must successfully pass through the institution’s internal evaluation processes before submission to the NRF.</li>
<li>A timeout will appear when there is no activity on the system for 25 minutes. Click on the refresh button (in the popup box) as this will enable the continuation/completion of the application. When clicking on the close button the system will close.</li>
<li>Rating 2019 applications: Telephone support from Mondays to Fridays (excluding public holidays) from 09:00 to 13:00 and from 13:30 to 15:30.</li>
<li>Note to applicants: If migrated data is all in CAPS, please change this to title case/lower case (whichever is relevant) as it is difficult to read.</li>
<li>Due to potential international review of applications and progress reports, the NRF requires that all applications and progress reports be completed in English.</li>
<li>Ensure that you complete or update your CV. This is very important as applications without an updated CV will not be considered.</li></ul>
                                </div>
                                <div class="card-content">
                                    <div class="card-body">
                                        <form class="form">
                                            <div class="row">
											
											
											
												<table class="table table-striped" id="table1">
                                <thead>
                                    <tr>
                                        <th>Funding Category</th>
                                        <th>Funding Opportunity</th>
                                        <th>Reference</th>
                                        <th>Applied Date</th>
										<th>Status</th>
										<th>Complete</th>
                                        <th>Edit</th>
										<th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Graiden</td>
                                        <td>vehicula.aliquet@semconsequat.co.uk</td>
                                        <td>076 4820 8838</td>
                                        <td>Offenburg</td>
										<td>Offenburg</td>
										<td>Offenburg</td>
                                        <td><div class="icon dripicons-document-edit" data-bs-toggle="modal" data-bs-target="#edit-qualification"></div></td>
										<td><div class="icon dripicons-wrong" data-bs-toggle="modal" data-bs-target="#primary"></div></td>
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
                                                                        Confirm Delete Record
                                                                    </h5>
                                                                    <button type="button" class="close"
                                                                        data-bs-dismiss="modal" aria-label="Close">
                                                                        <i data-feather="x"></i>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    Are you sure you want to delete this Record? Please click Yes if you want to delete this Record. Once it has been deleted you will not be able to retrieve it again.
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
                                                                        Add New Record
                                                                    </h5>
                                                                    <button type="button" class="close"
                                                                        data-bs-dismiss="modal" aria-label="Close">
                                                                        <i data-feather="x"></i>
                                                                    </button>
                                                                </div>
														<div class="card-header alert alert-primary alert-dismissible fade show">
                                    <ul>
									<li>An * at the end of a field label within a section denotes that this is a compulsory field, and the section will not be saved unless al compulsory fields have been completed.</li>
<li>Please list all the positions you have held in the past (inclding non-academic positions where applicable), as well as your current position. Note: Should you select "Yes" from the dropdown list for your current position, the "Period to" field will not be displayed.</li>
<li>Postdoctoral fellowships must be capture here.</li></ul>
                                </div>
                                                        <div class="modal-body">
                                                            <form class="form">
                                            <div class="row">
											<div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="first-name-column">Position</label>
                                                        <input type="text" id="first-name-column" class="form-control"
                                                             name="fname-column">
                                                    </div>
                                                </div>
												
												<div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="first-name-column">Organisation</label>
                                                        <input type="text" id="first-name-column" class="form-control"
                                                             name="fname-column">
                                                    </div>
                                                </div>
											
												<div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="first-name-column">Sector</label>
                                                        <fieldset class="form-group">
                                                    <select class="form-select" id="disabledSelect">
													<option></option>
                                                        <option>Business Sector and Commercial Research Houses</option>
														<option>Government Sector</option>
														<option>Higher Education Sector</option>
														<option>Non-Governmental Sector and Civil Society (NGO and CBO)</option>
														<option>Science Councils and National Research Facilities</option>
                                                    </select>
                                                </fieldset>
                                                    </div>
													
                                                </div>
												
												<div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="last-name-column">Type</label>
                                                        <fieldset class="form-group">
                                                    <select class="form-select" id="disabledSelect">
											
                                                        <option></option>
                                                        <option>Contract</option>
														<option>Permanent</option>
														<option>Temporary</option>
                                                    </select>
                                                </fieldset>
                                                    </div>
                                                </div>
												
												
												<div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="first-name-column">Appointment From</label>
                                                        <input type="date" id="first-name-column" class="form-control"
                                                             name="fname-column">
                                                    </div>
                                                </div>
												
												<div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="last-name-column">Current</label>
                                                        <fieldset class="form-group">
                                                    <select class="form-select" id="disabledSelect">
													
                                                        <option></option>
                                                        <option>Yes</option>
                                                        <option>No</option>
                                                    </select>
                                                </fieldset>
                                                    </div>
                                                </div>
												
												<div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="first-name-column">Appointment To</label>
                                                        <input type="date" id="first-name-column" class="form-control"
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
                                                                        Edit Position
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
                                                        <label for="first-name-column">Position</label>
                                                        <input type="text" id="first-name-column" class="form-control"
                                                             name="fname-column">
                                                    </div>
                                                </div>
												
												<div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="first-name-column">Organisation</label>
                                                        <input type="text" id="first-name-column" class="form-control"
                                                             name="fname-column">
                                                    </div>
                                                </div>
											
												<div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="first-name-column">Sector</label>
                                                        <fieldset class="form-group">
                                                    <select class="form-select" id="disabledSelect">
													<option></option>
                                                        <option>Business Sector and Commercial Research Houses</option>
														<option>Government Sector</option>
														<option>Higher Education Sector</option>
														<option>Non-Governmental Sector and Civil Society (NGO and CBO)</option>
														<option>Science Councils and National Research Facilities</option>
                                                    </select>
                                                </fieldset>
                                                    </div>
													
                                                </div>
												
												<div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="last-name-column">Type</label>
                                                        <fieldset class="form-group">
                                                    <select class="form-select" id="disabledSelect">
													
                                                        <option></option>
                                                        <option>Contract</option>
														<option>Permanent</option>
														<option>Temporary</option>
                                                    </select>
                                                </fieldset>
                                                    </div>
                                                </div>
												
												
												<div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="first-name-column">Appointment From</label>
                                                        <input type="date" id="first-name-column" class="form-control"
                                                             name="fname-column">
                                                    </div>
                                                </div>
												
												<div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="last-name-column">Current</label>
                                                        <fieldset class="form-group">
                                                    <select class="form-select" id="disabledSelect">
													
                                                        <option></option>
                                                        <option>Yes</option>
                                                        <option>No</option>
                                                    </select>
                                                </fieldset>
                                                    </div>
                                                </div>
												
												<div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="first-name-column">Appointment To</label>
                                                        <input type="date" id="first-name-column" class="form-control"
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