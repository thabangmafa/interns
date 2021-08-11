<?php 
include 'admin/connect.php';
$conn = OpenCon();
$menu_item = "3";
$title = "List of Applications";

if(isset($_POST['AppID']))
{
	$UpdateApplication = "UPDATE HostApplications SET Status = 'Withdrawn' WHERE CallID = '".$_POST['AppID']."'";
	
	 if(mysqli_query($conn,$UpdateApplication))
	 {
		$message = 'Application Successful Withdrawn';
	 }else{
		 $message =  'Oops. Something went wrong. Try Again.';
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
									<li>Strictly adhere to your institution’s internal closing date for submission of applications, as this will be prior to the NRF’s closing date, where applicable.</li>
<li>Applications must successfully pass through the institution’s internal evaluation processes before submission to the NRF.</li>
<li>A timeout will appear when there is no activity on the system for 25 minutes. Click on the refresh button (in the popup box) as this will enable the continuation/completion of the application. When clicking on the close button the system will close.</li>
<li>Rating 2019 applications: Telephone support from Mondays to Fridays (excluding public holidays) from 09:00 to 13:00 and from 13:30 to 15:30.</li>
<li>Note to applicants: If migrated data is all in CAPS, please change this to title case/lower case (whichever is relevant) as it is difficult to read.</li>
<li>Due to potential international review of applications and progress reports, the NRF requires that all applications and progress reports be completed in English.</li>
<li>Ensure that you complete or update your CV. This is very important as applications without an updated CV will not be considered.</li></ul>
                                </div>
                                <div class="card-content">
								<?php if(@$message){ ?>	
								<div class="alert alert-success" role="alert"><?php echo @$message; ?></div>
								<?php } ?>
                                    <div class="card-body">
                                        
                                            <div class="row">
											
											
											
												<table class="table table-striped" id="table1">

                                <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Description</th>
                                        <th>Open Date</th>
										<th>Closing Date</th>
										<th>Applied Date</th>
										<th>Status</th>
										<th>Withdraw</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
				
										$query = "SELECT b.ID,CallID, Title, Description, OpenDate,ClosingDate,HostRequirementsFile, ApplicationDate, Status FROM HostApplications a 
										left join HostInstitutionCalls b on b.ID = a.CallID
										WHERE a.InstitutionID = '".$_SESSION['InstitutionID']."'";
										$result = mysqli_query($conn, $query);


										while($calls = mysqli_fetch_array($result)) {
										echo '<tr>';
											 echo '<td>' . $calls['Title'] . '</td>';
											 echo '<td>' . $calls['Description'] . '</td>';
											 echo '<td>' . $calls['OpenDate'] . '</td>';
											 echo '<td>' . $calls['ClosingDate'] . '</td>';
											 echo '<td>' . $calls['ApplicationDate'] . '</td>';
											 echo '<td>' . $calls['Status'] . '</td>';
											 echo '<td><div class="icon dripicons-wrong" data-id="'.$calls["ID"].'" data-bs-toggle="modal" modal-title="Confirm Delete Item" data-bs-target="#primary"></div></td>';
										echo '</tr>';
										}

									?>
                                    
                                </tbody>
                            </table>
							
							
							<!--primary theme Modal -->
							<form class="form" action="" method="POST">
                                                    <div class="modal fade text-left" id="primary" tabindex="-1"
                                                        role="dialog" aria-labelledby="myModalLabel160"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable"
                                                            role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header bg-danger">
                                                                    <h5 class="modal-title white" id="myModalLabel160">
                                                                        Confirm Withdraw Application
                                                                    </h5>
                                                                    <button type="button" class="close"
                                                                        data-bs-dismiss="modal" aria-label="Close">
                                                                        <i data-feather="x"></i>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
																<input type="hidden" class="form-control" id="AppID" value="" name="AppID">
                                                                    Are you sure you want to withdraw this application?
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button"
                                                                        class="btn btn-light-secondary"
                                                                        data-bs-dismiss="modal">
                                                                        <i class="bx bx-x d-block d-sm-none"></i>
                                                                        <span class="d-none d-sm-block">No</span>
                                                                    </button>
                                                                    <button type="submit" name="" value="submit" class="btn btn-primary ml-1">
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
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>

  <script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js"></script>
  
<script type="text/javascript" language="javascript" >
 $(document).ready(function(){
	 

    $('#primary').on('show.bs.modal', function (e) {
        var id = $(e.relatedTarget).data('id');
	
        
				$('#AppID').attr('value', id);
			
        });
     });
	 

</script>