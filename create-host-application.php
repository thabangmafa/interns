<?php 
include 'admin/connect.php';
$conn = OpenCon();
$menu_item = "3";
$title = "Create Host Application";


if(isset($_POST['InstitutionID']))
{
	$InsertApplication = "INSERT INTO HostApplications (InstitutionID, CallID, UserID)VALUES('".$_POST['InstitutionID']."','".$_POST['CALLID']."','".$_SESSION['id']."')";
	
	 if(mysqli_query($conn,$InsertApplication))
	 {
		$message = 'Application Submitted Successful';
	 }else{
		 $message =  'Oops. Something went wrong. Try Again.';
	 }
}

$query = "SELECT * FROM ApplicantChecklist 	
	WHERE (UserID = '".$_SESSION['id']."' OR InstitutionID = '".$_SESSION['InstitutionID']."')";

	$result = mysqli_query($conn, $query);
	
	
	while($details = mysqli_fetch_array($result)) {
		if($details['Section'] == 'Contact Details'){
			$ContactDetails = 1;
		}
		
		if($details['Section'] == 'Employment Details'){
			$EmploymentDetails = 1;
		}
		
		if($details['Section'] == 'Language Proficiency'){
			$LanguageProficiency = 1;
		}
		
		if($details['Section'] == 'Next Of Kin'){
			$NextOfKin = 1;
		}
		
		if($details['Section'] == 'Position Applied For'){
			$PositionAppliedFor = 1;
		}
		
		if($details['Section'] == 'Personal Profile'){
			$PersonalProfile = 1;
		}
		
		if($details['Section'] == 'Qualifications'){
			$Qualifications = 1;
		}
		
		if($details['Section'] == 'Registration Details'){
			$RegistrationDetails = 1;
		}
		
		if($details['Section'] == 'References'){
			$References = 1;
		}
		
		if($details['Section'] == 'Host Institution'){
			$HostInstitution = 1;
		}
		
		if($details['Section'] == 'Prospective Mentors and Required Intern Profile'){
			$ProspectiveMentorsandRequiredInternProfile = 1;
		}
		
		if($details['Section'] == 'Profile of Requested Interns'){
			$ProfileofRequestedInterns = 1;
		}
		

		
	}
	
	$Total = @$ContactDetails + @$EmploymentDetails + @$LanguageProficiency + @$NextOfKin + @$PositionAppliedFor + @$PersonalProfile + @$Qualifications + @$RegistrationDetails + @$References + @$HostInstitution + @$ProspectiveMentorsandRequiredInternProfile + @$ProfileofRequestedInterns;






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
									<li>Check your intended institution’s internal closing date as it will be prior to the closing date listed for applications, where applicable.</li>
									<li>Due to potential international review of applications and progress reports, the HSRC requires that all applications and progress reports be completed in English.</li>
									<li>Please consult the Funding Framework and Funding & Application Guide for more information to assist you in your choices. These documents can be accessed on the FAQ section.</li>
                                </div>
                                <div class="card-content">
								<?php if(@$message){ ?>	
								<div class="alert alert-success" role="alert"><?php echo @$message; ?></div>
								<?php } ?>
                                    <div class="card-body">
                                        <form class="form">
                                            <div class="row">
											
											<table class="table table-striped" id="table1">
												<thead>
													<tr>
														<th>Title</th>
														<th>Description</th>
														<th>Open Date</th>
														<th>Closing Date</th>
														<th>Requirements Document</th>
														<th>Create</th>
													</tr>
												</thead>
												<tbody> 
<?php
										$query = "SELECT HostInstitutionCalls.*, d.* FROM HostInstitutionCalls 
										left join `CallInstitutionLink` d on d.CallID = HostInstitutionCalls.ID 
										WHERE d.ID != '' AND d.InstitutionID is not null and
										HostInstitutionCalls.IsActive = 1
										AND HostRequirementsFile != '' 
										AND HostRequirementsFile IS NOT NULL 
										AND ApplicantRequirementsFile != '' 
										AND ApplicantRequirementsFile IS NOT NULL 
										AND `ClosingDate` >= CURDATE()
										AND d.Status = 'Active'
										AND InstitutionID != '".$_SESSION["InstitutionID"]."'";

										$result = mysqli_query($conn,$query);

										while($calls = mysqli_fetch_array($result)) {
											
	
											
										$appReq = 'No Document';
										 if($calls["HostRequirementsFile"]){
											 $appReq = '<a target="_blank" href="uploads/calls/'.$calls["ID"].'/'.$calls["HostRequirementsFile"].'">Open Document</a>';
										 }	
										 
										
										 
										
										 
										echo '<tr>';
										echo '<td>'. $calls['Title'].'</td>';
										echo '<td>'. $calls['Description'].'</td>';
										echo '<td>'. $calls['OpenDate'].'</td>';
										echo '<td>'. $calls['ClosingDate'].'</td>';
										echo '<td>'. $appReq.'</td>';
										 if($Total == '12'){
												echo '<td><div class="icon dripicons-enter" data-CallID="'.$calls["ID"].'" data-InstitutionID="'.$_SESSION["InstitutionID"].'" data-bs-toggle="modal" data-bs-target="#capture-new"></div></td>';
											 }else{
												 echo '<td><div class="alert alert-light-danger color-danger"><i class="bi bi-exclamation-circle"></i> Please complete all required sections first.</div></td>';
											 }
											 echo '</tr>';
										}
											 ?>
											
										
										
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
									<form class="form" action="" method="POST">
                                        <div class="me-1 mb-1 d-inline-block">
                  

                                            <!--Extra Large Modal -->
                                            <div class="modal fade text-left w-100" id="capture-new" tabindex="-1"
                                                role="dialog" aria-labelledby="myModalLabel16" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl"
                                                    role="document">
                                                    <div class="modal-content">
                                                        
														<div class="modal-header bg-success">
                                                                    <h5 class="modal-title white" id="myModalLabel160">
                                                                        Apply for Hosting
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
														
                                                            
																<div class="fetched-data"></div>
                                            
															
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-light-secondary"
                                                                data-bs-dismiss="modal">
                                                                <i class="bx bx-x d-block d-sm-none"></i>
                                                                <span class="d-none d-sm-block">Close</span>
                                                            </button>
                                                            <button type="submit" class="btn btn-primary ml-1">
                                                                <i class="bx bx-check d-block d-sm-none"></i>
                                                                <span class="d-none d-sm-block">Accept</span>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
										
										</form>
					
				
				
            </div>

            <?php require_once("footer.php"); ?>
        </div>
    </div>
    <script src="assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
	
	<script src="assets/vendors/simple-datatables/simple-datatables.js"></script>
	<!-- Include Choices JavaScript -->
    <script src="assets/vendors/choices.js/choices.min.js"></script>

    <!-- Include Choices CSS -->
    <link rel="stylesheet" href="assets/vendors/choices.js/choices.min.css" />

    <script src="assets/js/main.js"></script>
</body>

</html>
<style>
.pagination{display:inline-block;padding-left:0;margin:20px 0;border-radius:4px}.pagination>li{display:inline}.pagination>li>a,.pagination>li>span{position:relative;float:left;padding:6px 12px;margin-left:-1px;line-height:1.42857143;color:#337ab7;text-decoration:none;background-color:#fff;border:1px solid #ddd}.pagination>li:first-child>a,.pagination>li:first-child>span{margin-left:0;border-top-left-radius:4px;border-bottom-left-radius:4px}.pagination>li:last-child>a,.pagination>li:last-child>span{border-top-right-radius:4px;border-bottom-right-radius:4px}.pagination>li>a:focus,.pagination>li>a:hover,.pagination>li>span:focus,.pagination>li>span:hover{z-index:2;color:#23527c;background-color:#eee;border-color:#ddd}.pagination>.active>a,.pagination>.active>a:focus,.pagination>.active>a:hover,.pagination>.active>span,.pagination>.active>span:focus,.pagination>.active>span:hover{z-index:3;color:#fff;cursor:default;background-color:#337ab7;border-color:#337ab7}.pagination>.disabled>a,.pagination>.disabled>a:focus,.pagination>.disabled>a:hover,.pagination>.disabled>span,.pagination>.disabled>span:focus,.pagination>.disabled>span:hover{color:#777;cursor:not-allowed;background-color:#fff;border-color:#ddd}.pagination-lg>li>a,.pagination-lg>li>span{padding:10px 16px;font-size:18px;line-height:1.3333333}.pagination-lg>li:first-child>a,.pagination-lg>li:first-child>span{border-top-left-radius:6px;border-bottom-left-radius:6px}.pagination-lg>li:last-child>a,.pagination-lg>li:last-child>span{border-top-right-radius:6px;border-bottom-right-radius:6px}.pagination-sm>li>a,.pagination-sm>li>span{padding:5px 10px;font-size:12px;line-height:1.5}.pagination-sm>li:first-child>a,.pagination-sm>li:first-child>span{border-top-left-radius:3px;border-bottom-left-radius:3px}.pagination-sm>li:last-child>a,.pagination-sm>li:last-child>span{border-top-right-radius:3px;border-bottom-right-radius:3px}.pager{padding-left:0;margin:20px 0;text-align:center;list-style:none}.pager li{display:inline}.pager li>a,.pager li>span{display:inline-block;padding:5px 14px;background-color:#fff;border:1px solid #ddd;border-radius:15px}.pager li>a:focus,.pager li>a:hover{text-decoration:none;background-color:#eee}.pager .next>a,.pager .next>span{float:right}.pager .previous>a,.pager .previous>span{float:left}.pager .disabled>a,.pager .disabled>a:focus,.pager .disabled>a:hover,.pager .disabled>span{color:#777;cursor:not-allowed;background-color:#fff}.label{display:inline;padding:.2em .6em .3em;font-size:75%;font-weight:700;line-height:1;color:#fff;text-align:center;white-space:nowrap;vertical-align:baseline;border-radius:.25em}
.dataTables_filter label {
    width: 100%;
}
#user_data_paginate{
	display:none;
}
</style>


  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>

  <script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.css" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.js"></script>
  

<script type="text/javascript" language="javascript" >
 $(document).ready(function(){
	 

    $('#capture-new').on('show.bs.modal', function (e) {
        var CallID = $(e.relatedTarget).data('callid');
		var InstitutionID = $(e.relatedTarget).data('institutionid');
        $.ajax({
            type : 'post',
            url : 'admin/user/fetchHost.php', //Here you will fetch records 
            data :  {CallID:CallID, InstitutionID:InstitutionID}, //Pass $id
            success : function(data){
            $('.fetched-data').html(data);//Show fetched data from database
			if(CallID == '000'){
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
  
 });
</script>