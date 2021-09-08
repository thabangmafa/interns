<?php 
include 'admin/connect.php';
$conn = OpenCon();
$menu_item = "4";
$title = "List of Applications";

$sql = "SELECT distinct Details FROM LookupHeadings WHERE Section='List of Applications' ";
		$result = mysqli_query($conn, $sql);
		$headings = mysqli_fetch_assoc($result);

if(@$_POST['AppID'] != '')
{
	$UpdateApplication = "UPDATE UserApplications SET Status = 'Withdrawn' WHERE CallID = '".$_POST['AppID']."' AND UserID = '".$_SESSION['id']."'";
	
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
								<?php echo $headings['Details']; ?>
                                    
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
													<th>Open Date</th>
													<th>Closing Date</th>
														<th>Responder(s)</th>
														<th>Response</th>
														
														
														<th>Position Applied For</th>

														<th>Withdraw</th>
													</tr>
												</thead>
												<tbody>
													<?php

						
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
												q.Title as CallTitle,
												q.OpenDate,
												q.ClosingDate,
												
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
																											left join HostInstitutionCalls q on q.ID = a.CallID
																											left join LookupProvince z on z.ID = m.HomeProvince
																											WHERE a.UserID = "'.$_SESSION['id'].'"  group by a.UserID';				
													$result = mysqli_query($conn, $query);
													
													while($calls = mysqli_fetch_array($result)) {
														
														echo '<tr>';
														echo '<td>' . $calls['CallTitle'] . '</td>';
														echo '<td>' . $calls['OpenDate'] . '</td>';
														echo '<td>' . $calls['ClosingDate'] . '</td>';
															 echo '<td>' . $calls['Responder'] . '</td>';
															 echo '<td>' . $calls['Response'] . '</td>';
			
															 echo '<td>' . $calls['Discipline'] . '</td>';
													
															 
															 echo '<td><div class="icon dripicons-wrong" data-id="'.$calls["ID"].'" data-bs-toggle="modal" modal-title="Confirm Delete Item" data-bs-target="#primary"></div></td>';
															 echo '</tr>';
														}
													//}
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