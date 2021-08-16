<?php 

include 'admin/connect.php';
$conn = OpenCon();

$menu_item = "1";
$title = "";
if (@$_POST['InstitutionID'] != '') {
	$_SESSION['InstitutionID'] = $_POST['InstitutionID'];
	
	$query = "SELECT Name FROM LookupInstitutions WHERE InstitutionID = '".$_SESSION['InstitutionID']."'";
	$result = mysqli_query($conn, $query);
	$SessionInstitution = mysqli_fetch_array($result);
	
	@$_SESSION['SessionInstitutionName'] = @$SessionInstitution['Name'];
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
                            <h3>HSRC Interns Management System</h3>
                            
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
				
                    <div class="col-12 col-lg-9">
					<?php if(@$_SESSION['user_type'] == '1'){ ?>
                        <div class="row">
                            <div class="col-6 col-lg-3 col-md-6">
                                <div class="card">
                                    <div class="card-body px-3 py-4-5">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="stats-icon purple">
                                                    <i class="iconly-boldAdd-User"></i>
                                                </div>
                                            </div>
                                            <div class="col-md-8">
                                                <h6 class="text-muted font-semibold">Interns</h6>
                                                <h6 class="font-extrabold mb-0">450</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 col-lg-3 col-md-6">
                                <div class="card">
                                    <div class="card-body px-3 py-4-5">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="stats-icon blue">
                                                    <i class="iconly-boldProfile"></i>
                                                </div>
                                            </div>
                                            <div class="col-md-8">
                                                <h6 class="text-muted font-semibold">Mentors</h6>
                                                <h6 class="font-extrabold mb-0">20</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 col-lg-3 col-md-6">
                                <div class="card">
                                    <div class="card-body px-3 py-4-5">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="stats-icon green">
                                                    <i class="iconly-boldWork"></i>
                                                </div>
                                            </div>
                                            <div class="col-md-8">
                                                <h6 class="text-muted font-semibold">Host Institutions</h6>
                                                <h6 class="font-extrabold mb-0">
												<?php
				
													$query = "SELECT count(*) inst FROM LookupInstitutions WHERE IsActive = '1'";
													$result = mysqli_query($conn, $query);

													while($institution = mysqli_fetch_array($result)) {
													 echo '<a href="/institutions.php">' . $institution['inst'] . '</a>';
													}

												?>
												
												</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 col-lg-3 col-md-6">
                                <div class="card">
                                    <div class="card-body px-3 py-4-5">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="stats-icon red">
                                                    <i class="iconly-boldBookmark"></i>
                                                </div>
                                            </div>
                                            <div class="col-md-8">
                                                <h6 class="text-muted font-semibold">Open Applications</h6>
                                                <h6 class="font-extrabold mb-0">112</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4>Interns by Province</h4>
                                    </div>
                                    <div class="card-body">
                                        <div id="chart-profile-visit"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
						
						<?php } ?>
						<div class="row">
                            <div class="col-12 col-xl-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4>Calls</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-striped" id="table1">
                                <thead>
                                    <tr>
                                        <th>Title</th>
										<th>Description</th>
										<th>Open Date</th>
										<th>Closing Date</th>
										<th>Documents</th>
										<th>Status</th>
										
                                    </tr>
                                </thead>
                                <tbody>
                                    
									<?php
									
									$filter = '';
									
									if(@$_SESSION['user_type'] == '4' || @$_SESSION['user_type'] == '3'){
										$filter = "WHERE CallType = 'Graduates'";
									}elseif(@$_SESSION['user_type'] == '2'){
										$filter = "WHERE CallType = 'Host Institutions'";
									}else{
										$filter = '';
									}
				
										$query = "SELECT DISTINCT a.ID, a.BudgetYear, a.Title, a.Description, a.OpenDate, a.ClosingDate, a.HostRequirementsFile, a.ApplicantRequirementsFile, 
													CASE WHEN `ClosingDate` < CURDATE() THEN 'Closed' 
													WHEN a.IsActive = 0 THEN 'Inactive' 
													WHEN d.InstitutionID = '' OR d.InstitutionID is null THEN 'Missing Institution' 
													WHEN HostRequirementsFile = '' OR HostRequirementsFile IS NULL THEN 'Missing Documents' 
													WHEN ApplicantRequirementsFile = '' OR ApplicantRequirementsFile IS NULL THEN 'Missing Documents' 
													WHEN a.IsActive = 1 AND HostRequirementsFile != '' AND ApplicantRequirementsFile != '' AND `ClosingDate` >= CURDATE() THEN 'Open' END Status , 
													c.StatusId,c.Status as IsActive, e.Name as Budgy 
													FROM HostInstitutionCalls a 
													left join `LookupIsActive` c on c.`StatusId` = a.`IsActive` 
													left join `LookupBudgetYear` e on e.`ID` = a.`BudgetYear`
													left join `CallInstitutionLink` d on d.CallID = a.ID
										" . $filter;
										
										  


										
										$result = mysqli_query($conn, $query);

										while($calls = mysqli_fetch_array($result)) {
											
											$hostReq = 'No Host Document';
											 $appReq = 'No Applicant Document';
											 
											 if($calls["HostRequirementsFile"]){
												 $hostReq = '<a target="_blank" href="../../../uploads/calls/'.$calls["ID"].'/'.$calls["HostRequirementsFile"].'">Framework Documents</a>';
											 }
											 
											 if($calls["ApplicantRequirementsFile"]){
												 $appReq = '<a target="_blank" href="../../../uploads/calls/'.$calls["ID"].'/'.$calls["ApplicantRequirementsFile"].'">Advert Documents</a>';
											 }
											
											if(@$_SESSION['user_type'] != '1' && $calls['Status'] == 'Open'){
											echo '<tr>';
												 echo '<td>' . $calls['Title'] . '</td>';
												 echo '<td>' . $calls['Description'] . '</td>';
												 echo '<td>' . $calls['OpenDate'] . '</td>';
												 echo '<td>' . $calls['ClosingDate'] . '</td>';
												 echo '<td>' . $appReq .'<br />'. $hostReq . '</td>';
												 echo '<td>' . $calls['Status'] . '</td>';
											echo '</tr>';
											}else{
												echo '<tr>';
												 echo '<td>' . $calls['Title'] . '</td>';
												 echo '<td>' . $calls['Description'] . '</td>';
												 echo '<td>' . $calls['OpenDate'] . '</td>';
												 echo '<td>' . $calls['ClosingDate'] . '</td>';
												 echo '<td>' . $appReq .'<br />'. $hostReq . '</td>';
												 echo '<td>' . $calls['Status'] . '</td>';
											echo '</tr>';
											}
										}

									?>
                                </tbody>
                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    
                    </div>
					
					
					
					
                    <div class="col-12 col-lg-3">
					
					<?php if(@$_SESSION['user_type'] == '2'){ ?>
					<div class="card">
                            <div class="card-header">
                                <h4>Institution to Manage</h4>
                            </div>
                            <div class="card-body">
							<form class="form" method="post" action="" enctype="multipart/form-data">
                                <select class="choices form-select" id="InstitutionID" name="InstitutionID"  onchange='this.form.submit()' required="required">
                                                        <option></option>
														<?php
				
															$query = "SELECT b.* FROM HostAdministrator a
																		left join LookupInstitutions b on b.InstitutionId = a.InstitutionID and b.IsActive = '1'
																		WHERE b.IsActive = '1' and a.UserID = '".$_SESSION['id']."' ORDER BY Name asc";
															$result = mysqli_query($conn, $query);
															
															while($institution = mysqli_fetch_array($result)) {
																$select = '';
																if(@$_SESSION['InstitutionID'] == $institution['InstitutionId']){ $select = "selected='selected'"; }
															 echo '<option value="'.$institution['InstitutionId'].'" '.$select.'>'.ucwords($institution['Name']).'</option>';
															}

														?>
                                                    </select>
								</form>
                            </div>
                        </div>
					<?php } ?>
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
																		WHERE a.Status = 'Pending' ORDER BY DateUpdated DESC LIMIT 3";
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
															/*
															$query = "SELECT Name, ApplicationDate as DateUpdated, UserName, a.ID, c.Email, a.CallID, a.InstitutionID FROM HostApplications a
																			left join users c on c.UserID = a.UserID
																			left join LookupInstitutions b on b.InstitutionId = a.InstitutionID and b.IsActive = '1'
																			WHERE a.Status = 'Pending' ORDER BY ApplicationDate DESC LIMIT 3";
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
															*/
														}
														
														//Host Administrator
														if(@$_SESSION['user_type'] == '2'){
															
															
															
															$query = "SELECT a.ID, c.Email, UpdatedDate, UserName FROM ProspectiveMentors a 
															left join users c on c.UserID = a.MentorID 
															WHERE a.InstitutionID  in (SELECT InstitutionID from HostAdministrator WHERE UserID = '".$_SESSION['id']."' and IsActive = '1') 
															and Status = 'Pending Host Approval' ORDER BY UpdatedDate DESC LIMIT 3";
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
																		<?php echo '<div class="icon dripicons-enter" data-id="'.@$institution["ID"].'" data-section="ProspectiveMentors" data-bs-toggle="modal" data-bs-target="#capture-new">Mentor request pending for <strong>' . @$institution['UserName'] . '</strong> </div>'; ?>
																	</td>
																</tr>
																
																<?php
																
															}
															
														}
														
														//Mentor
														if(@$_SESSION['user_type'] == '3' || @$_SESSION['user_type'] == '4'){
															
															$query = "SELECT a.ID, a.UpdatedDate, c.FirstName, c.LastName FROM ProspectiveMentors a
															left join RegistrationDetails c on c.UserID = a.AddedBy
																		WHERE a.Email = '".$_SESSION['email']."' and Status = 'Pending Approval' ORDER BY UpdatedDate DESC LIMIT 3";
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
								
                        <?php if(@$_SESSION['user_type'] == '1'){ ?>
                        <div class="card">
                            <div class="card-header">
                                <h4>Interns Qualifications Level</h4>
                            </div>
                            <div class="card-body">
                                <div id="chart-interns-qualifications"></div>
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
						<?php } ?>
						
						
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
<?php
//include 'admin/connect.php';
$conn = OpenCon();
$query = "SELECT count(*) disabled FROM RegistrationDetails WHERE Disability = 'Yes'";
$result = mysqli_query($conn, $query);

$row = mysqli_fetch_array($result);
$disabled = $row['disabled'];	

$query = "SELECT count(*) notdisabled FROM RegistrationDetails WHERE Disability = 'No'";
$result = mysqli_query($conn, $query);

$row = mysqli_fetch_array($result);
$notdisabled = $row['notdisabled'];													
?>
<script>
var disabled = <?php echo $disabled; ?>;
var notdisabled = <?php echo $notdisabled; ?>;
var optionsProfileVisit = {
	annotations: {
		position: 'back'
	},
	dataLabels: {
		enabled:false
	},
	chart: {
		type: 'bar',
		height: 300
	},
	fill: {
		opacity:1
	},
	plotOptions: {
	},
	series: [{
		name: 'Interns',
		data: [9,20,30,20,10,20,30,20,10]
	}],
	colors: '#435ebe',
	xaxis: {
		categories: ["Eastern Cape","Free State","Gauteng","KwaZulu-Natal","Limpopo","Mpumalanga","North West", "Northern Cape","Western Cape"],
	},
}
let optionsVisitorsProfile  = {
	series: [notdisabled, disabled],
	labels: ['Not Disabled', 'Disabled'],
	colors: ['#435ebe','#55c6e8'],
	chart: {
		type: 'donut',
		width: '100%',
		height:'350px'
	},
	legend: {
		position: 'bottom'
	},
	plotOptions: {
		pie: {
			donut: {
				size: '30%'
			}
		}
	}
}
 
let optionsInternsQualifications  = {
	series: [70, 30, 40],
	labels: ['Masters', 'Honours','B Degree'],
	colors: ['#435ebe','#55c6e8','#0C2D48'],
	chart: {
		type: 'donut',
		width: '100%',
		height:'350px'
	},
	legend: {
		position: 'bottom'
	},
	plotOptions: {
		pie: {
			donut: {
				size: '30%'
			}
		}
	}
}

var optionsEurope = {
	series: [{
		name: 'series1',
		data: [310, 800, 600, 430, 540, 340, 605, 805,430, 540, 340, 605]
	}],
	chart: {
		height: 80,
		type: 'area',
		toolbar: {
			show:false,
		},
	},
	colors: ['#5350e9'],
	stroke: {
		width: 2,
	},
	grid: {
		show:false,
	},
	dataLabels: {
		enabled: false
	},
	xaxis: {
		type: 'datetime',
		categories: ["2018-09-19T00:00:00.000Z", "2018-09-19T01:30:00.000Z", "2018-09-19T02:30:00.000Z", "2018-09-19T03:30:00.000Z", "2018-09-19T04:30:00.000Z", "2018-09-19T05:30:00.000Z", "2018-09-19T06:30:00.000Z","2018-09-19T07:30:00.000Z","2018-09-19T08:30:00.000Z","2018-09-19T09:30:00.000Z","2018-09-19T10:30:00.000Z","2018-09-19T11:30:00.000Z"],
		axisBorder: {
			show:false
		},
		axisTicks: {
			show:false
		},
		labels: {
			show:false,
		}
	},
	show:false,
	yaxis: {
		labels: {
			show:false,
		},
	},
	tooltip: {
		x: {
			format: 'dd/MM/yy HH:mm'
		},
	},
};

let optionsAmerica = {
	...optionsEurope,
	colors: ['#008b75'],
}
let optionsIndonesia = {
	...optionsEurope,
	colors: ['#dc3545'],
}



var chartProfileVisit = new ApexCharts(document.querySelector("#chart-profile-visit"), optionsProfileVisit);
var chartVisitorsProfile = new ApexCharts(document.getElementById('chart-visitors-profile'), optionsVisitorsProfile)
var chartInternsQualifications = new ApexCharts(document.getElementById('chart-interns-qualifications'), optionsInternsQualifications)
var chartEurope = new ApexCharts(document.querySelector("#chart-europe"), optionsEurope);
var chartAmerica = new ApexCharts(document.querySelector("#chart-america"), optionsAmerica);
var chartIndonesia = new ApexCharts(document.querySelector("#chart-indonesia"), optionsIndonesia);

chartIndonesia.render();
chartAmerica.render();
chartEurope.render();
chartProfileVisit.render();
chartVisitorsProfile.render()
chartInternsQualifications.render()
</script>


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