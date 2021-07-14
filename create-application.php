<?php 

$menu_item = "4";
$title = "Create Application";

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
									<li>Check your intended institution’s internal closing date as it will be prior to the closing date listed for applications, where applicable.</li>
<li>A timeout will appear when there is no activity on the system for 25 minutes. Click on the refresh button (in the popup box) as this will enable the continuation/completion of the application. When clicking on the close button the system will close.</li>
<li>Due to potential international review of applications and progress reports, the NRF requires that all applications and progress reports be completed in English.</li>
<li>Please consult the Funding Framework and Funding & Application Guide for more information to assist you in your choices. These documents can be accessed at https://www.nrf.ac.za/funding/framework-documents.</li>
<li>Ensure that you complete or update your CV. This is very important as applications without an updated CV will not be considered.</li>
<li>Please ensure that you update your CV before creating a application/progress report to ensure that the latest information reflects on the progress report.</li></ul>
                                </div>
                                <div class="card-content">
                                    <div class="card-body">
                                        <form class="form">
                                            <div class="row">
											
											
											
												<table class="table table-striped" id="table1">
                                <thead>
                                    <tr>
                                        <th>Funding Category</th>
										<th>Create</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>NRF / UP Co-funded Research Chairs</td>
                                        <td><div class="icon dripicons-enter" data-bs-toggle="modal" data-bs-target="#capture-new"></div></td>
                                    </tr>
                                    <tr>
                                        <td>NRF / CSIR (Smart Mobility) Co-funded Chair</td>
                                        <td><div class="icon dripicons-enter" data-bs-toggle="modal" data-bs-target="#capture-new"></div></td>
                                    </tr>
									<tr>
                                        <td>DSI/NRF/WRC Water RDI Roadmap Research Chairs</td>
                                        <td><div class="icon dripicons-enter" data-bs-toggle="modal" data-bs-target="#capture-new"></div></td>
                                    </tr>
									<tr>
                                        <td>NRF Postgraduate Scholarships</td>
                                        <td><div class="icon dripicons-enter" data-bs-toggle="modal" data-bs-target="#capture-new"></div></td>
                                    </tr>
                                </tbody>
                            </table>
												
							
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
                                                                        Registration Details
                                                                    </h5>
                                                                    <button type="button" class="close"
                                                                        data-bs-dismiss="modal" aria-label="Close">
                                                                        <i data-feather="x"></i>
                                                                    </button>
                                                                </div>
														<div class="card-header alert alert-primary alert-dismissible fade show">
                                    <ul>
									<li>In order to ensure that we have your correct information, please confirm that the details below are correct. If not, please provide the correct information.</li></ul>
                                </div>
                                                        <div class="modal-body">
                                                            <form class="form">
                                            <div class="row">
											<table>
											<tr>
												<td>Title</td>
												<td>Mr</td>
											</tr>
											<tr>
												<td>Surname</td>
												<td>Mafa</td>
											</tr>
											<tr>
												<td>Initials</td>
												<td>TL</td>
											</tr>
											<tr>
												<td>First Name</td>
												<td>Thabang</td>
											</tr>
											<tr>
												<td>ID/Passport Number</td>
												<td>8608085372086</td>
											</tr>
											<tr>
												<td>Primary Email Address</td>
												<td>tmafa@hsrc.ac.za</td>
											</tr>
											<tr>
												<td>Mobile Number</td>
												<td>0740739335</td>
											</tr>
											<tr>
												<td>Primary Telephone Number</td>
												<td>0123022615</td>
											</tr>
											<tr>
												<td>Current Organisation</td>
												<td>Human Sciences Research Council (HSRC)</td>
											</tr>
											</table>
											
											

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