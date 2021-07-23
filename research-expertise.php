<?php 
include 'admin/connect.php';
$menu_item = "2";
$title = "Research Expertise";

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
									<li>Scientific domain - Select only one scientific domain from the list provided.</li>
<li>Primary research level(s) - Select at least one but not more than two fields (in order of priority) from the list provided which most appropriately reflect/s your primary level(s) of research.</li>
<li>Secondary research level(s) - Select at least one but not more than four fields (in order of priority) from the list provided which most appropriately reflect/s your secondary level(s) of research.</li>
<li>Fields of specialisation - Please include at least one but not more than ten specialisation fields in order of priority (one specialisation per line).</li>
<li>Should you wish a new specialisation field to be added, please click on the “New” button. Your request for a new field will be considered by the NRF and you will be informed by e-mail once the field has been added so that you will be able to update your application form.</li>
<li>For all of the above a separate entry should be completed for each item. Click on ‘Submit’ to save each entry and repeat the process.</li>
<li>The information icon () indicates that there is a tooltip associated with the relevant field. When hovering over this icon, additional information will show.</li></ul>
                                </div>
                                <div class="card-content">
                                    <div class="card-body">
                                        <form class="form">
                                            <div class="row">
											
											
											
								<table class="table table-striped">
                                <thead>
								<tr>
									<td colspan="5" class="font-weight-bolder">Primary Research Field</td>
								</tr>
                                    <tr>
                                        <th>Primary Research Field</th>
                                        <th>Priority</th>
                                        <th>Priority Up</th>
                                        <th>Priority Down</th>
										<th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Biological oceanography</td>
                                        <td>1</td>
                                        <td>Up</td>
                                        <td>Down</td>
										<td><div class="icon dripicons-wrong" data-bs-toggle="modal" data-bs-target="#primary"></div></td>
                                    </tr>
                                    
                                </tbody>
                            </table>
							<div class="col-12 d-flex justify-content-end">
									<div class="btn btn-primary me-1 mb-1" data-bs-toggle="modal" data-bs-target="#capture-new">Add Another</div>
							</div>
							
							
							<table class="table table-striped">
                                <thead>
								<tr>
									<td colspan="5" class="font-weight-bolder">Secondary Research Field</td>
								</tr>
                                    <tr>
                                        <th>Secondary Research Field</th>
                                        <th>Priority</th>
                                        <th>Priority Up</th>
                                        <th>Priority Down</th>
										<th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Biological oceanography</td>
                                        <td>1</td>
                                        <td>Up</td>
                                        <td>Down</td>
										<td><div class="icon dripicons-wrong" data-bs-toggle="modal" data-bs-target="#primary"></div></td>
                                    </tr>
                                    
                                </tbody>
                            </table>
							<div class="col-12 d-flex justify-content-end">
									<div class="btn btn-primary me-1 mb-1" data-bs-toggle="modal" data-bs-target="#capture-new">Add Another</div>
							</div>
							
							
							<table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Field of Specialisation</th>
                                        <th>Priority</th>
                                        <th>Priority Up</th>
                                        <th>Priority Down</th>
										<th>Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Biological oceanography</td>
                                        <td>1</td>
                                        <td>Up</td>
                                        <td>Down</td>
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
                                                                        Confirm Delete Qualification
                                                                    </h5>
                                                                    <button type="button" class="close"
                                                                        data-bs-dismiss="modal" aria-label="Close">
                                                                        <i data-feather="x"></i>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    Are you sure you want to delete this qualification? Please click Yes if you want to delete this qualification. Once it has been deleted you will not be able to retrieve it again.
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
                                                                        Add New Qualification
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
                                                        <label for="first-name-column">Academic Level of Qualification</label>
                                                        <fieldset class="form-group">
                                                    <select class="form-select" id="disabledSelect">
													<option></option>
                                                        <option>Advocate</option>
														<option>Bishop</option>
														<option>Dr</option>
														<option>Judge</option>
														<option>Lord</option>
														<option>Miss</option>
														<option>Mr</option>
														<option>Mrs</option>
														<option>Ms</option>
														<option>Prof</option>
														<option>Sir</option>
                                                    </select>
                                                </fieldset>
                                                    </div>
													
                                                </div>
												<div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="first-name-column">Name of Degree/Diploma (e.g. PhD)</label>
                                                        <input type="text" id="first-name-column" class="form-control"
                                                             name="fname-column">
                                                    </div>
                                                </div>
											
											
											
											
                                                <div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="first-name-column">Title of Research Project</label>
                                                        <input type="text" id="first-name-column" class="form-control"
                                                             name="fname-column">
                                                    </div>
                                                </div>
                                                
												
												<div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="last-name-column">Institution</label>
                                                        <input type="text" id="last-name-column" class="form-control"
                                                             name="lname-column">
                                                    </div>
													<button type="button" class="btn btn-primary ml-1"
                                                                        data-bs-dismiss="modal">
                                                                        <i class="bx bx-check d-block d-sm-none"></i>
                                                                        <span class="d-none d-sm-block">New</span>
                                                                    </button>
                                                </div>
												
												<div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="last-name-column">Full-time</label>
                                                        <fieldset class="form-group">
                                                    <select class="form-select" id="disabledSelect">
													<option></option>
                                                        <option></option>
                                                        <option>Yes</option>
                                                        <option>No</option>
                                                    </select>
                                                </fieldset>
                                                    </div>
                                                </div>
												
												<div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="last-name-column">Distinction</label>
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
                                                        <label for="last-name-column">Date of First Registration</label>
                                                        <input type="date" id="last-name-column" class="form-control"
                                                             name="lname-column">
                                                    </div>
                                                </div>
												
												
													<div class="col-md-6 col-12">
														<div class="form-group">
															<label for="last-name-column">Completed</label>
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
                                                        <label for="last-name-column">Highest Completed Qualification</label>
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
                                                        <label for="company-column">Add Transcript</label>
                                                        
                                                <input class="form-control" type="file" id="formFileMultiple" multiple>
                                                    </div>
                                                </div>
												
												
                                                <div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="city-column">Status</label>
                                                        <fieldset class="form-group">
                                                    <select class="form-select" id="disabledSelect">
													<option></option>
                                                        <option>Discontinued (stopped)</option>

<option>In progress</option>

<option>Suspended (interrupted)</option> 
                                                    </select>
                                                </fieldset>
                                                    </div>
                                                </div>
												
												<div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="company-column">Reason</label>
                                                        <input type="text" id="company-column" class="form-control"
                                                            name="company-column">
                                                    </div>
                                                </div>
												
												
												
                                                <div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="country-floating">Anticipated Date of Completion</label>
                                                        <input type="date" id="email-id-column" class="form-control"
                                                            name="email-id-column">
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
                                                                        Edit Qualification
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
                                                        <label for="first-name-column">Academic Level of Qualification</label>
                                                        <fieldset class="form-group">
                                                    <select class="form-select" id="disabledSelect">
													<option></option>
                                                        <option>Advocate</option>
														<option>Bishop</option>
														<option>Dr</option>
														<option>Judge</option>
														<option>Lord</option>
														<option>Miss</option>
														<option>Mr</option>
														<option>Mrs</option>
														<option>Ms</option>
														<option>Prof</option>
														<option>Sir</option>
                                                    </select>
                                                </fieldset>
                                                    </div>
													
                                                </div>
												<div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="first-name-column">Name of Degree/Diploma (e.g. PhD)</label>
                                                        <input type="text" id="first-name-column" class="form-control"
                                                             name="fname-column">
                                                    </div>
                                                </div>
											
											
											
											
                                                <div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="first-name-column">Title of Research Project</label>
                                                        <input type="text" id="first-name-column" class="form-control"
                                                             name="fname-column">
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="last-name-column">Field of Study</label>
                                                        <input type="text" id="last-name-column" class="form-control"
                                                             name="lname-column">
                                                    </div>
                                                </div>
												
												<div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="last-name-column">Institution</label>
                                                        <input type="text" id="last-name-column" class="form-control"
                                                             name="lname-column">
                                                    </div>
                                                </div>
												
												<div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="last-name-column">Full-time</label>
                                                        <fieldset class="form-group">
                                                    <select class="form-select" id="disabledSelect">
													<option></option>
                                                        <option></option>
                                                        <option>Yes</option>
                                                        <option>No</option>
                                                    </select>
                                                </fieldset>
                                                    </div>
                                                </div>
												
												<div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="last-name-column">Distinction</label>
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
                                                        <label for="last-name-column">Date of First Registration</label>
                                                        <input type="date" id="last-name-column" class="form-control"
                                                             name="lname-column">
                                                    </div>
                                                </div>
												
												
													<div class="col-md-6 col-12">
														<div class="form-group">
															<label for="last-name-column">Completed</label>
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
                                                        <label for="last-name-column">Highest Completed Qualification</label>
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
                                                        <label for="company-column">Add Transcript</label>
                                                        
                                                <input class="form-control" type="file" id="formFileMultiple" multiple>
                                                    </div>
                                                </div>
												
												
                                                <div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="city-column">Status</label>
                                                        <fieldset class="form-group">
                                                    <select class="form-select" id="disabledSelect">
													<option></option>
                                                        <option>Discontinued (stopped)</option>

<option>In progress</option>

<option>Suspended (interrupted)</option> 
                                                    </select>
                                                </fieldset>
                                                    </div>
                                                </div>
												
												<div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="company-column">Reason</label>
                                                        <input type="text" id="company-column" class="form-control"
                                                            name="company-column">
                                                    </div>
                                                </div>
												
												
												
                                                <div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="country-floating">Anticipated Date of Completion</label>
                                                        <input type="date" id="email-id-column" class="form-control"
                                                            name="email-id-column">
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