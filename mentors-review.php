<?php

include 'admin/connect.php';
$conn = OpenCon();
$menu_item = "1";
$title = "Mentors Applications Review";

$sql = "SELECT distinct Details FROM LookupHeadings WHERE Section='Institutional Review' ";
		$result = mysqli_query($conn, $sql);
		$headings = mysqli_fetch_assoc($result);

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
                            <h3><?php echo $_SESSION['headingType'] . ' - ' . $title; ?></h3>
                            
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
								<?php echo @$headings['Details']; ?>
                                    
                                </div>
                                <div class="card-content">
								<?php if(@$message){ ?>	
								<div class="alert alert-success" role="alert"><?php echo @$message; ?></div>
								<?php } ?>
								
								
								
                                    <div class="card-body">
									
									
                                        
                                            <div class="row">
											
									<form class="form" method="post" action="">		
									<div class="col-md-6 col-6" style="float:left;">
									<div class="form-group">
										<label for="Status">Status</label>
										<fieldset class="form-group">
											<select class="choices form-select" id="Status" name="Status">
												<option></option>
												<option <?php if(@$_POST['Status'] == 'Approved'){ echo "selected='selected'";} ?>>Approved</option>
												<option <?php if(@$_POST['Status'] == 'Rejected'){ echo "selected='selected'";} ?>>Rejected</option>
												<option <?php if(@$_POST['Status'] == 'Withdraw'){ echo "selected='selected'";} ?>>Withdraw</option>
												<option <?php if(@$_POST['Status'] == 'Pending Host Approval'){ echo "selected='selected'";} ?>>Pending Host Approval</option>
												<option <?php if(@$_POST['Status'] == 'Pending Mentor Approval'){ echo "selected='selected'";} ?>>Pending Mentor Approval</option>
											</select>
										</fieldset>
									</div>
									</div>
									
									<div class="col-md-6 col-6" style="float:left;">
									<div class="form-group">
										<label for="Institution">Institution</label>
										<fieldset class="form-group">
											<select class="choices form-select" id="Institution" name="Institution">
											<option></option> 
											<?php $Institutions = mysqli_query($conn,"SELECT distinct a.InstitutionID as ID, b.Name FROM `ProspectiveMentors` a 
													left join LookupInstitutions b on b.InstitutionId = a.InstitutionID");

											while($Institution = mysqli_fetch_array($Institutions))
												{ ?>
												 <option value=" <?php echo $Institution['ID']; ?> " <?php if(@$_POST['Institution'] == $Institution['ID']){ echo "selected='selected'";} ?>><?php echo ucwords($Institution['Name']); ?></option>
												<?php } ?>	
											</select>
										</fieldset>
									</div>
													
                                    </div>
									
									<div class="col-12 d-flex justify-content-end">
														<button type="submit" class="btn btn-primary me-1 mb-1" name="Submit" value="Submit">Search Mentors</button>
														
                                                </div>
									</form>
											
												<table class="table table-striped" id="table1">

												<thead>
													<tr>
														<th>Name</th>
														<th>Email</th>
														<th>Institution</th>
														<th>Status</th>
														<th>View</th>
													</tr>
												</thead>
												<tbody>
													<?php

											if (@$_POST['Status'] != '' || @$_POST['Institution'] != '') {
												$where = '';
												$Status = '';
												$Institution = '';
												
												
												if(@$_POST['Status'] != ''){
													$Status = ' a.Status = "'.@$_POST['Status'].'" and ';
												}
												
												if(@$_POST['Institution'] != ''){
													$Institution = ' a.InstitutionID = "'.@$_POST['Institution'].'" and ';
												}
												
												
												$where .= $Status.$Institution." Status != 'Delete'";
												
												
												$query = 'SELECT distinct c.UserID as ID,CASE WHEN a.Name != "" THEN CONCAT(a.Name , " " , a.Surname) ELSE c.UserName END as Mentor, lower(a.Email) as Email, a.Status, b.Name as Institution FROM `ProspectiveMentors` a left join LookupInstitutions b on b.InstitutionId = a.InstitutionID left join users c on lower(c.Email) = lower(a.Email)
												WHERE '.$where.' order by Institution';		

													$result = mysqli_query($conn, $query);
													while($calls = mysqli_fetch_array($result)) {
														
														echo '<tr>';
															 echo '<td>' . $calls['Mentor'] . '</td>';
															 echo '<td>' . $calls['Email'] . '</td>';
															 echo '<td>' . $calls['Institution'] . '</td>';
															 echo '<td>' . $calls['Status'] . '</td>';
															 echo '<td><div class="icon dripicons-gear" data-id="'.$calls["ID"].'" data-bs-toggle="modal" modal-title="View Mentor Details" data-bs-target="#primary"></div></td>';
															 echo '</tr>';
														}
													}
													?>
													
												</tbody>
											</table>
							
							
			
									<form class="form">
							<!--primary theme Modal -->
                                                    <div class="modal fade text-left" id="primary" tabindex="-1"
                                                        role="dialog" aria-labelledby="myModalLabel160"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl"
                                                            role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header bg-success">
                                                                    <h5 class="modal-title white" id="myModalLabel160">
                                                                        Review Application
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
                                                                    <button type="button"
                                                                        class="btn btn-light-secondary"
                                                                        data-bs-dismiss="modal">
                                                                        <i class="bx bx-x d-block d-sm-none"></i>
                                                                        <span class="d-none d-sm-block">Cancel</span>
                                                                    </button>
                                                                    <button type="button" class="btn btn-primary ml-1"
                                                                         id="update">
                                                                        <i class="bx bx-check d-block d-sm-none"></i>
                                                                        <span class="d-none d-sm-block">Submit</span>
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
       var rowid = $(e.relatedTarget).data('id');
	
	
        $.ajax({
            type : 'post',
            url : 'admin/applications/fetch.php', //Here you will fetch records 
            data :  'rowid='+ rowid, //Pass $id
            success : function(data){
            $('.fetched-data').html(data);//Show fetched data from database

			
            }
        });
		
     });
	 
	 
	 
	 $(document).on('click', '#InterviewDateSet', function(){
		   var recordid = $('#recordid').val();
		   var InterviewDate = $('#InterviewDate').val();

		   $.ajax({
			url:"admin/applications/update.php",
			method:"POST",
			data:{
				UpdateRecordid:recordid,
				InterviewDate:InterviewDate},
			success:function(data)
			{
			
			 location.reload();
			}
		   });
			
   
   
  });
	 
	 
	 

	   $(document).on('click', '#update', function(){
		   var recordid = $('#recordid').val();
		   var UserID = $('#UserID').val();
		   var Ref = $('#Ref').val();
		   var Applicant = $('#Applicant').val();
		   var applicationid = $('#applicationid').val();
		   var MentorInstitution = $('#MentorInstitution').val();
		   
		   var Status = $('#Status').val();
		   var Options = $('#Options').val();

		   var Comments = $("#Comments").val();
		   

		if(MentorInstitution != null){
		   $.ajax({
			url:"admin/applications/update.php",
			method:"POST",
			data:{
				recordid:recordid,
				UserID:UserID,
				Applicant:Applicant,
				Ref:Ref,
				applicationid:applicationid,
				MentorInstitution:MentorInstitution,				
				Options:Options, 
				Status:Status, 
				Comments:Comments},
			success:function(data)
			{
			if(Status == 'Interview date set'){
				$('#update').attr('id', 'InterviewDateSet');
				$('.fetched-data').html('Please confirm interview date: <input type="hidden" name="recordid" id="recordid" value="'+recordid+'" /><input type="date" class="form-control" style="width:20%" name="InterviewDate" id="InterviewDate" />');
			}else{
				$('#alert_message').html('<div class="alert alert-success">'+data+'</div>');
				$('#user_data').DataTable().destroy();
				location.reload();
			}
			 
			}
		   });
		   
		}else{
			if(Status != null){
				alert("You are not aligned to any institution. Please make sure your institution details are correctly captured on the system.");
			}else{
				$('#primary').modal('toggle');
			}
		}
		   
   
  });
  
});	 

</script>