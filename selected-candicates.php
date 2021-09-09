<?php

include 'admin/connect.php';
$conn = OpenCon();
$menu_item = "13";
$title = "Selected Applications";

$sql = "SELECT distinct Details FROM LookupHeadings WHERE Section='Selected Applications' ";
		$result = mysqli_query($conn, $sql);
		$headings = mysqli_fetch_assoc($result);

 ?>
<?php require_once("admin/header.php"); ?>
        <?php require_once("menu.php"); ?>
		<style>
			strong{color:blue;}
		</style>
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
									
									
                                        
                                           
									
											
												<table class="table table-striped" id="table1">

												<thead>
													<tr>
														<th>Responder(s)</th>
														<th>Response</th>
														
														<th>Applicant</th>
														<th>ID/Passport Number</th>
														<th>Location</th>
														<th>Discipline</th>
														<th>Qualifications</th>
													
														<th>Action</th>
													</tr>
												</thead>
												<tbody>
													<?php

												$where = '';
												if(@$_SESSION['user_type'] == '1'){
													
													$where = ' where (FirstOptionInstitutionResponse != "" || 
															SecondOptionInstitutionResponse != "" || 
															ThirdOptionInstitutionResponse != "")';
												}
												
												if(@$_SESSION['user_type'] == '2'){
													$where = ' where (FirstOptionInstitutionResponse = "'.@$_SESSION['InstitutionID'].'" || 
															SecondOptionInstitutionResponse = "'.@$_SESSION['InstitutionID'].'" || 
															ThirdOptionInstitutionResponse = "'.@$_SESSION['InstitutionID'].'")';
												}
												if(@$_SESSION['user_type'] == '3'){
													
													$where = ' where (FirstOptionInstitutionResponse IN (SELECT distinct InstitutionID FROM ProspectiveMentors WHERE Status = "Approved" AND lower(Email) = lower("'.@$_SESSION['email'].'")) || 
															SecondOptionInstitutionResponse IN (SELECT distinct InstitutionID FROM ProspectiveMentors WHERE Status = "Approved" AND lower(Email) = lower("'.@$_SESSION['email'].'")) || 
															ThirdOptionInstitutionResponse IN (SELECT distinct InstitutionID FROM ProspectiveMentors WHERE Status = "Approved" AND lower(Email) = lower("'.@$_SESSION['email'].'")))';
													
												}
												
												
												$query = 'SELECT 
												CONCAT(
												"1st: ",CASE WHEN i.Name != "" THEN i.Name ELSE "" END ,
												"<br />2nd: ", CASE WHEN p.Name != "" THEN p.Name ELSE "" END ,
												"<br />3rd: ", CASE WHEN o.Name != "" THEN o.Name ELSE "" END ) Responder,
												
												CONCAT(
												"1st: ",CASE WHEN FirstOptionStatus != "" THEN FirstOptionStatus ELSE "" END ,
												"<br />2nd: ",CASE WHEN SecondOptionStatus != "" THEN SecondOptionStatus ELSE "" END ,
												"<br />3rd: ",CASE WHEN ThirdOptionStatus != "" THEN ThirdOptionStatus ELSE "" END ) Response,
												
												a.ID, 
												z.Name as Home, 
												c.Title, 
												b.Initials,
												b.LastName,
												b.IDNumber,
												b.PassportNumber, 
												CONCAT(
													"1st: ", e.Name, " (" , j.Name, ")", 
													"<br />2nd: ", CASE WHEN f.Name != "" THEN f.Name ELSE "N/A" END, " (" , CASE WHEN k.Name != "" THEN k.Name ELSE "N/A" END, ")", 
													"<br />3rd: ", CASE WHEN g.Name != "" THEN g.Name ELSE "N/A" END, " (" , CASE WHEN l.Name != "" THEN l.Name ELSE "N/A" END, ")" ) as Discipline,  
												GROUP_CONCAT(DISTINCT  CONCAT( h.NameOfDegree," (",n.Name,") - ",CASE WHEN h.Completed = "Yes" THEN "Completed" ELSE "Not Completed" END) SEPARATOR "<br />") NameOfDegree, a.Status FROM UserApplications a 
																											right join RegistrationDetails b on b.UserID = a.UserID
																											left join LookupUserTitle c on c.ID = b.TItle
																											left join PositionAppliedFor d on d.UserID = a.UserID
																											Left join LookupDisciplines e on e.ID = d.FirstDiscipline
																											Left join LookupDisciplines f on f.ID = d.SecondDiscipline
																											Left join LookupDisciplines g on g.ID = d.ThirdDiscipline
																											left join Qualifications h on h.UserID = a.UserID
																											left join LookupQualificationLevel n on n.ID = h.AcademicLevel
																											left join LookupInstitutions i on i.InstitutionId = d.FirstOptionInstitutionResponse
																											left join LookupInstitutions p on p.InstitutionId = d.SecondOptionInstitutionResponse
																											left join LookupInstitutions o on o.InstitutionId = d.ThirdOptionInstitutionResponse
																											
																											left join LookupProvince j on j.ID = d.FirstProvince
																											left join LookupProvince k on k.ID = d.SecondProvince
																											left join LookupProvince l on l.ID = d.ThirdProvince
																					
																											right join UserContactDetails m on m.UserID = a.UserID
																											left join LookupProvince z on z.ID = m.HomeProvince
																											'.$where.'
																											group by a.UserID';				
													$result = mysqli_query($conn, $query);

													while($calls = mysqli_fetch_array($result)) {
														
														echo '<tr>';
															 echo '<td>' . $calls['Responder'] . '</td>';
															 echo '<td>' . $calls['Response'] . '</td>';
															 echo '<td>' . $calls['Title'].' ' . $calls['Initials'] . ' ' .$calls['LastName'] . '</td>';
															 echo '<td>' . $calls['IDNumber'].$calls['PassportNumber'] . '</td>';
															 echo '<td>' . $calls['Home'] . '</td>';
															 echo '<td>' . $calls['Discipline'] . '</td>';
															 echo '<td>' . ucwords($calls['NameOfDegree']) . '</td>';
															 
															 echo '<td><div class="icon dripicons-gear" data-id="'.$calls["ID"].'" data-bs-toggle="modal" modal-title="Respond to Application" data-bs-target="#primary"></div></td>';
															 echo '</tr>';
														}
													//}
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