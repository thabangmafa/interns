<?php 

include 'admin/connect.php';
$conn = OpenCon();

$menu_item = "1";
$title = "";
if (isset($_POST['InstitutionID'])) {
	$_SESSION['InstitutionID'] = $_POST['InstitutionID'];
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
				
            <div class="page-content">
                <section class="row">


					<div class="card">
					
                                    <div class="card-header">
                                        <h4>Activities</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>Date</th>
                                                        <th>Description</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
												<?php
												//System Administrator
														if(@$_SESSION['user_type'] == '1'){
															$query = "SELECT Name, DateUpdated, UserName, a.ID FROM HostAdministrator a
															left join users c on c.UserID = a.UserID
																		left join LookupInstitutions b on b.InstitutionId = a.InstitutionID and b.IsActive = '1'
																		WHERE a.Status = 'Pending' ORDER BY DateUpdated DESC";
															$result = mysqli_query($conn, $query);

															while($institution = mysqli_fetch_array($result)) {
																
																?>
																<tr>
																	<td>
																		<div>
																			<?php echo $institution['DateUpdated']; ?>
																		</div>
																	</td>
																	<td>
																		<?php echo '<div data-id="'.$institution["ID"].'" data-section="HostAdministrator" data-bs-toggle="modal" data-bs-target="#capture-new">Host admin request pending for <strong>' . $institution['UserName'] . '</strong> </div>'; ?>
																	</td>
																</tr>
																
																<?php
																
															}
															
															$query = "SELECT Name, ApplicationDate as DateUpdated, UserName, a.ID, c.Email, a.CallID, a.InstitutionID FROM HostApplications a
																			left join users c on c.UserID = a.UserID
																			left join LookupInstitutions b on b.InstitutionId = a.InstitutionID and b.IsActive = '1'
																			WHERE a.Status = 'Pending' ORDER BY ApplicationDate DESC";
															$result = mysqli_query($conn, $query);

															while($institution = mysqli_fetch_array($result)) {
																
																?>
																<tr>
																	<td>
																		<div>
																			<?php echo $institution['DateUpdated']; ?>
																		</div>
																	</td>
																	<td>
																		<?php echo '<div data-id="'.$institution["ID"].'" data-section="HostApplications" data-cid="'.$institution["ID"].'" data-instid="'.$institution["InstitutionID"].'" data-bs-toggle="modal" data-bs-target="#capture-new">Host Institution application pending for <strong>' . $institution['Name'] . '</strong> </div>'; ?>
																	</td>
																</tr>
																
																<?php
																
															}
														}
														
														//Host Administrator
														if(@$_SESSION['user_type'] == '2'){
															
															
															
															$query = "SELECT a.ID, c.Email, UpdatedDate, UserName FROM ProspectiveMentors a 
															left join users c on c.UserID = a.MentorID 
															WHERE a.InstitutionID  = (SELECT InstitutionID from HostAdministrator WHERE UserID = '".$_SESSION['id']."' and IsActive = '1') 
															and Status = 'Pending Host Approval' ORDER BY UpdatedDate DESC";
															$result = mysqli_query($conn, $query);

															while($institution = mysqli_fetch_array($result)) {
																
																?>
																<tr>
																	<td>
																		<div>
																			<?php echo $institution['UpdatedDate']; ?>
																		</div>
																	</td>
																	<td>
																		<?php echo '<div class="icon dripicons-enter" data-id="'.$institution["ID"].'" data-section="ProspectiveMentors" data-bs-toggle="modal" data-bs-target="#capture-new">Mentor request pending for <strong>' . $institution['UserName'] . '</strong> </div>'; ?>
																	</td>
																</tr>
																
																<?php
																
															}
															
														}
														
														//Mentor
														if(@$_SESSION['user_type'] == '3' || @$_SESSION['user_type'] == '4'){
															
															$query = "SELECT a.ID, a.UpdatedDate, c.FirstName, c.LastName FROM ProspectiveMentors a
															left join RegistrationDetails c on c.UserID = a.AddedBy
																		WHERE a.Email = '".$_SESSION['email']."' and Status = 'Pending Mentor Approval' ORDER BY UpdatedDate";
															$result = mysqli_query($conn, $query);

															while($institution = mysqli_fetch_array($result)) {
																
																?>
																<tr>
																	<td>
																		<div>
																			<?php echo $institution['UpdatedDate']; ?>
																		</div>
																	</td>
																	<td>
																		<?php echo '<div class="icon dripicons-enter" data-id="'.$institution["ID"].'" data-section="ProspectiveMentors" data-bs-toggle="modal" data-bs-target="#capture-new">Invited to become a mentor by <strong>' . $institution['FirstName'] . ' '. $institution['LastName'] . '</strong> </div>'; ?>
																	</td>
																</tr>
																
																<?php
																
															}
															
														}

														?>
													
                                                </tbody>
                                            </table>
											<a href="activities.php" style="float:right">View All</a>
                                        </div>
                                    </div>
                                </div>
								

                </section>
            </div>
			
			<form class="form" action="" method="post" id="QualificationsDetails" name="QualificationsDetails">
                                        <div class="me-1 mb-1 d-inline-block">
                  

                                            <!--Extra Large Modal -->
                                            <div class="modal fade text-left w-100" id="capture-new" tabindex="-1"
                                                role="dialog" aria-labelledby="myModalLabel16" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl"
                                                    role="document">
                                                    <div class="modal-content">
                                                        
														<div class="modal-header bg-success">
                                                                    <h5 class="modal-title white" id="myModalLabel160">
                                                                        Activity Details
                                                                    </h5>
                                                                    <button type="button" class="close"
                                                                        data-bs-dismiss="modal" aria-label="Close">
                                                                        <i data-feather="x"></i>
                                                                    </button>
                                                                </div>
														
                                                        <div class="modal-body">
														
                                                            
																<div class="fetched-data"></div>
                                            
															
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-light-secondary"
                                                                data-bs-dismiss="modal">
                                                                <i class="bx bx-x d-block d-sm-none"></i>
                                                                <span class="d-none d-sm-block">Close</span>
                                                            </button>
															<button type="button" value="Reject" name="Reject" id="reject" class="btn btn-danger"
                                                                data-bs-dismiss="modal">
                                                                <i class="bx bx-x d-block d-sm-none"></i>
                                                                <span class="d-none d-sm-block">Reject</span>
                                                            </button>
                                                            <button type="submit" value="accept" name="accept" id="accept" class="btn btn-primary ml-1" data-bs-dismiss="modal">
                                                                <i class="bx bx-check d-block d-sm-none"></i>
                                                                <span class="d-none d-sm-block">Accept</span>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
										
										</form>

            <?php require_once("footer.php"); ?>
        </div>
    </div>
    <script src="assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>

    <script src="assets/vendors/apexcharts/apexcharts.js"></script>
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
	 

    $('#capture-new').on('show.bs.modal', function (e) {
        var rowid = $(e.relatedTarget).data('id');
		var section = $(e.relatedTarget).data('section');
		var institutionid = $(e.relatedTarget).data('instid');
		var callid = $(e.relatedTarget).data('cid');
	
        $.ajax({
            type : 'post',
            url : 'admin/activities/fetch.php', //Here you will fetch records 
            data :  {rowid:rowid,section:section,institutionid:institutionid,callid:callid}, //Pass $id
            success : function(data){
            $('.fetched-data').html(data);//Show fetched data from database
			if(rowid == '000'){
				$('#updateHost').attr('id', 'insert');
			}
			
            }
        });
     });
	 
  
  fetch_data();

  function fetch_data()
  {
   var dataTable = $('#user_data').DataTable({
    "processing" : true,
    "serverSide" : true,
    "order" : [],
    "ajax" : {
     url:"admin/calls/institutions/fetch.php",
     type:"POST"
    }
   });
  }
  
  $("#reject").click(function(){
		  
		  
		 var form = $('#QualificationsDetails')[0];
        var formData = new FormData(form);
        event.preventDefault();
        $.ajax({
            url: "admin/activities/update.php?action=Rejected", // the endpoint
            type: "POST", // http method
            processData: false,
            contentType: false,
            data: formData,        
              success: function(response){
                 location.reload();
             
           }
        });

    });
	
	$("#accept").click(function(){
		  
		  
		 var form = $('#QualificationsDetails')[0];
        var formData = new FormData(form);
        event.preventDefault();
        $.ajax({
            url: "admin/activities/update.php?action=Approved", // the endpoint
            type: "POST", // http method
            processData: false,
            contentType: false,
            data: formData,        
              success: function(response){
                 location.reload();
             
           }
        });

    });
  
 });
</script>