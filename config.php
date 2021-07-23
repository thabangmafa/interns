<?php 
include 'admin/connect.php';
$menu_item = "2";
$title = "Qualifications";

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
					
					<div class="col-12 col-lg-3">
                        <div class="card">
                            <div class="card-body py-4 px-5">
                                <div class="d-flex align-items-center">
                                    <div class="avatar avatar-xl">
                                        <img src="assets/images/faces/1.jpg" alt="Face 1">
                                    </div>
                                    <div class="ms-3 name">
                                        <h5 class="font-bold">John Duck</h5>
                                        <h6 class="text-muted mb-0">@johnducky</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <h4>Interns Qualifications Level</h4>
                            </div>
                            <div class="card-body">
                                <table class="table table-striped" id="table1">
                                <thead>
                                    <tr>
                                        <th>Level</th>
                                        <th>Degree/Diploma</th>
                                        <th>Highest Qualification</th>
                                        <th>Date Optained</th>
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
                                        <td><div class="icon dripicons-document-edit" data-bs-toggle="modal" data-bs-target="#edit-qualification"></div></td>
										<td><div class="icon dripicons-wrong" data-bs-toggle="modal" data-bs-target="#primary"></div></td>
                                    </tr>
                                    <tr>
                                        <td>Graiden</td>
                                        <td>vehicula.aliquet@semconsequat.co.uk</td>
                                        <td>076 4820 8838</td>
                                        <td>Offenburg</td>
                                        <td><div class="icon dripicons-document-edit" data-bs-toggle="modal" data-bs-target="#edit-qualification"></div></td>
										<td><div class="icon dripicons-wrong" data-bs-toggle="modal" data-bs-target="#primary"></div></td>
                                    </tr>
									<tr>
                                        <td>Graiden</td>
                                        <td>vehicula.aliquet@semconsequat.co.uk</td>
                                        <td>076 4820 8838</td>
                                        <td>Offenburg</td>
                                        <td><div class="icon dripicons-document-edit" data-bs-toggle="modal" data-bs-target="#edit-qualification"></div></td>
										<td><div class="icon dripicons-wrong" data-bs-toggle="modal" modal-title="Confirm Delete Item" data-bs-target="#primary"></div></td>
                                    </tr>
                                </tbody>
                            </table>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <h4>Interns Disability Status</h4>
                            </div>
                            <div class="card-body">
                                <div id="chart-visitors-profile"></div>
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