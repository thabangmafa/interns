<?php 
include 'admin/connect.php';
$menu_item = "2";
$title = "Registration Details";

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
									<li>Kindly note that this registration process hould be completed only once.</li>
<li>You need to comple all the required fields (indicated with *) before you will be able to submit your registration.</li>
<li>Please create a password that is at least 6 characters long, containts small letters, capitals letters and numerals.</li>
<li>Please type a passwrod which meets these requirements and which you will remember!</li>
<li>If you do not have an alternative email address, please leave the field blank and do not enter anything such as N/A.</li>
<li>The field indicated with I are searchable fields. To avoid having to search through the full list, simpluy type one keyword into the field provided. The results will appear in the drop-down list.</li>
<li>After you have successfully registered, login to the system by using the ID/passport number and password you provided.</li>
<li>The information icon (i) indicates that there is a tooltip associated with the relevant field. When hoving over this icon, additional information will show.</li></ul>
                                </div>
                                <div class="card-content">
                                    <div class="card-body">
                                        <form class="form">
                                            <div class="row">
												<div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="first-name-column">Title</label>
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
                                                        <label for="first-name-column">Initials</label>
                                                        <input type="text" id="first-name-column" class="form-control"
                                                             name="fname-column">
                                                    </div>
                                                </div>
											
											
											
											
                                                <div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="first-name-column">First Name</label>
                                                        <input type="text" id="first-name-column" class="form-control"
                                                             name="fname-column">
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="last-name-column">Last Name</label>
                                                        <input type="text" id="last-name-column" class="form-control"
                                                             name="lname-column">
                                                    </div>
                                                </div>
												
												<div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="last-name-column">Maiden Name/Previous Surname</label>
                                                        <input type="text" id="last-name-column" class="form-control"
                                                             name="lname-column">
                                                    </div>
                                                </div>
												
												<div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="last-name-column">Country of Birth</label>
                                                        <fieldset class="form-group">
                                                    <select class="form-select" id="disabledSelect">
													<option></option>
                                                        <option>Green</option>
                                                        <option>Red</option>
                                                        <option>Blue</option>
                                                    </select>
                                                </fieldset>
                                                    </div>
                                                </div>
												
												<div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="last-name-column">South African Citizenship Status</label>
                                                        <fieldset class="form-group">
                                                    <select class="form-select" id="disabledSelect">
													<option></option>
                                                        <option>South African citizen</option>
														<option>South African permanent resident</option> 
														<option>Non-South African citizen</option>
                                                    </select>
                                                </fieldset>
                                                    </div>
                                                </div>
												
												<div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="last-name-column">ID Type</label>
                                                        <fieldset class="form-group">
                                                    <select class="form-select" id="disabledSelect">
														<option></option>
                                                        <option>SA ID Number</option>
														<option>Passport Number</option>
                                                    </select>
                                                </fieldset>
                                                    </div>
                                                </div>
												
												<div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="last-name-column">ID/Passport Number</label>
                                                        <input type="number" id="last-name-column" class="form-control"
                                                             name="lname-column">
                                                    </div>
                                                </div>
												
												
												
												
                                                <div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="city-column">Race</label>
                                                        <fieldset class="form-group">
                                                    <select class="form-select" id="disabledSelect">
													<option></option>
                                                        <option>African</option>
														<option>Coloured</option>
														<option>Indian</option>
														<option>White</option>
                                                    </select>
                                                </fieldset>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="country-floating">Gender</label>
                                                        <fieldset class="form-group">
                                                    <select class="form-select" id="disabledSelect">
                                                        <option></option>
                                                        <option>Male</option>
                                                        <option>Female</option>
                                                    </select>
                                                </fieldset>
                                                    </div>
                                                </div>
												
												
												
												
                                                <div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="company-column">Date of Birth</label>
                                                        <input type="date" id="company-column" class="form-control"
                                                            name="company-column">
                                                    </div>
                                                </div>
												
                                                <div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="email-id-column">Primary Email Address</label>
                                                        <input type="email" id="email-id-column" class="form-control"
                                                            name="email-id-column">
                                                    </div>
                                                </div>
												
												<div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="email-id-column">Confirm Primary Email Address</label>
                                                        <input type="email" id="email-id-column" class="form-control"
                                                            name="email-id-column">
                                                    </div>
                                                </div>
												
												<div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="email-id-column">Alternate Email Address</label>
                                                        <input type="email" id="email-id-column" class="form-control"
                                                            name="email-id-column">
                                                    </div>
                                                </div>
												
												<div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="country-floating">Mobile Number</label>
                                                        <input type="text" id="country-floating" class="form-control"
                                                            name="country-floating">
                                                    </div>
                                                </div>
												
												<div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="country-floating">Are you a full time student?</label>
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
                                                        <label for="country-floating">Current organisation</label>
                                                        <fieldset class="form-group">
                                                    <select class="form-select" id="disabledSelect">
													<option></option>
                                                        <option>Green</option>
                                                        <option>Red</option>
                                                        <option>Blue</option>
                                                    </select>
                                                </fieldset>
                                                    </div>
                                                </div>
												
                               
                                                <div class="col-12 d-flex justify-content-end">
                                                    <button type="submit"
                                                        class="btn btn-primary me-1 mb-1">Submit</button>
                                                    <button type="reset"
                                                        class="btn btn-light-secondary me-1 mb-1">Reset</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- // Basic multiple Column Form section end -->
            </div>

            <?php require_once("footer.php"); ?>
        </div>
    </div>
    <script src="assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>

    <script src="assets/js/main.js"></script>
</body>

</html>