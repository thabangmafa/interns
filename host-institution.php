<?php 

$menu_item = "3";
$title = "Host Institution";

 ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HSRC Interns Management System - <?php echo $title; ?></title>
	
	<!-- Include Choices CSS -->
    <link rel="stylesheet" href="assets/vendors/choices.js/choices.min.css" />

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/bootstrap.css">

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
									<li>Please provide all the information requested below.</li>
<li>Please select the "Support" link and enter your request to add an institution that does not appear on the list by stating the name of the institution to be added to the list.</li>
<li>Please indicate the status of each hosted intern on exit of the programme during 2020/21.</li></ul>
                                </div>
                                <div class="card-content">
                                    <div class="card-body">
                                        <form class="form">
                                            <div class="row">
												<div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="first-name-column">Interested in participating in the DST-NRF Internship Programme</label>
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
                                                        <label for="country-floating">Name of Institution</label>
                                                        <fieldset class="form-group">
                                                    <select class="form-select" id="disabledSelect">
                                                        <option></option>
                                                        <option>Red</option>
                                                        <option>Blue</option>
                                                    </select>
                                                </fieldset>
                                                    </div>
                                                </div>
												<div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="first-name-column">Categorise Institution</label>
                                                        <fieldset class="form-group">
                                                    <select class="form-select" id="disabledSelect">
													<option></option>
                                                        <option>Government Agency</option> 

<option>Government Sector</option> 

<option>Industry</option> 

<option>Museum</option> 

<option>National Facility</option> 

<option>Public and Private Universities</option> 

<option>Research Institute</option> 

<option>Science Centre</option> 

<option>Science Council</option>
														
                                                    </select>
                                                </fieldset>
                                                    </div>
                                                </div>
												
												<div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        
                                        <label for="exampleFormControlTextarea1" class="form-label">Work Postal Address (excluding department) </label>
                                        <textarea class="form-control" id="exampleFormControlTextarea1"
                                            rows="3"></textarea>
                                    
                                                    </div>
                                                </div>
												
												
												<div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="first-name-column">Province</label>
                                                        <fieldset class="form-group">
                                                    <select class="form-select" id="disabledSelect">
													<option></option>
                                                        <option>Eastern Cape</option> 

<option>Free State</option> 

<option>Gauteng</option> 

<option>KwaZulu-Natal</option> 

<option>Limpopo</option> 

<option>Mpumalanga</option> 

<option>North West</option> 

<option>Northern Cape</option> 

<option>Western Cape</option>
														
                                                    </select>
                                                </fieldset>
                                                    </div>
                                                </div>
												
												<div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="country-floating">Have you previously hosted DST/NRF interns from the 2018/19 and 2019/20 cohorts?</label>
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
                                                        <label for="first-name-column">Number of interns hosted</label>
                                                        <input type="number" id="first-name-column" class="form-control"
                                                             name="fname-column">
                                                    </div>
                                                </div>
												
												<div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="country-floating">Do you have sufficient or adequate resources?</label>
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
                                                        <label for="country-floating">List the basic available resources</label>
                                                        <fieldset class="form-group">
                                                    <select class="form-select" id="disabledSelect">
                                                        <option></option>
                                                        <option>Yes</option>
                                                        <option>No</option>
                                                    </select>
                                                </fieldset>
                                                    </div>
                                                </div>
												
												
												<div class="col-md-6 mb-4">
                                                
                                                <div class="form-group">
												<label for="country-floating">List the basic available resources</label>
                                                    <select class="choices form-select" multiple="multiple">
                                                        <option value="square">Square</option>
                                                        <option value="rectangle">Rectangle</option>
                                                        <option value="rombo">Rombo</option>
                                                        <option value="romboid">Romboid</option>
                                                        <option value="trapeze">Trapeze</option>
                                                        <option value="traible">Triangle</option>
                                                        <option value="polygon">Polygon</option>
                                                    </select>
                                                </div>
                                            </div>
												
												
												
												
												
												
												
												<div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="first-name-column">Faculty</label>
                                                        <input type="text" id="first-name-column" class="form-control"
                                                             name="fname-column">
                                                    </div>
                                                </div>
											
											
											
											
                                                <div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        
                                        <label for="exampleFormControlTextarea1" class="form-label">Work Postal Address (excluding department) </label>
                                        <textarea class="form-control" id="exampleFormControlTextarea1"
                                            rows="3"></textarea>
                                    
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="last-name-column">City/Town</label>
                                                        <input type="text" id="last-name-column" class="form-control"
                                                             name="lname-column">
                                                    </div>
                                                </div>
												
												<div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="last-name-column">Postal Code</label>
                                                        <input type="text" id="last-name-column" class="form-control"
                                                             name="lname-column">
                                                    </div>
                                                </div>
												
												<div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="last-name-column">Primary Telephone Number</label>
                                                        <input type="text" id="last-name-column" class="form-control"
                                                             name="lname-column">
                                                    </div>
                                                </div>
												
												<div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="last-name-column">Fax Number</label>
                                                        <input type="text" id="last-name-column" class="form-control"
                                                             name="lname-column">
                                                    </div>
                                                </div>
												
												<div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="last-name-column">Mobile Number</label>
                                                        <input type="text" id="last-name-column" class="form-control"
                                                             name="lname-column">
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
                                                        <label for="country-floating">Web Address</label>
                                                        <input type="text" id="country-floating" class="form-control"
                                                            name="country-floating">
                                                    </div>
                                                </div>
												
												<div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="country-floating">Country</label>
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
                                                        <label for="country-floating">Province/State</label>
                                                        <fieldset class="form-group">
                                                    <select class="form-select" id="disabledSelect">
                                                        <option></option>
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
	
	<!-- Include Choices JavaScript -->
    <script src="assets/vendors/choices.js/choices.min.js"></script>

    <script src="assets/js/main.js"></script>
</body>

</html>