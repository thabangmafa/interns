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
										<th>Status</th>
										<th>Documents</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
									<?php
				
										$query = "SELECT DISTINCT a.ID, a.BudgetYear, a.Title, a.Description, a.OpenDate, a.ClosingDate, a.HostRequirementsFile, a.ApplicantRequirementsFile, 
													CASE WHEN `ClosingDate` < CURDATE() THEN 'Closed' 
													WHEN a.IsActive = 0 THEN 'Inactive' 
													WHEN d.InstitutionID = '' OR d.InstitutionID is null THEN 'Missing Institution' 
													WHEN HostRequirementsFile = '' OR HostRequirementsFile IS NULL THEN 'Missing Documents' 
													WHEN ApplicantRequirementsFile = '' OR ApplicantRequirementsFile IS NULL THEN 'Missing Documents' 
													WHEN a.IsActive = 1 AND HostRequirementsFile != '' AND ApplicantRequirementsFile != '' AND `ClosingDate` >= CURDATE() THEN 'Open' END Status , 
													c.StatusId,c.Status as IsActive, e.Name as Budgy FROM HostInstitutionCalls a 
													left join `LookupIsActive` c on c.`StatusId` = a.`IsActive` 
													left join `LookupBudgetYear` e on e.`ID` = a.`BudgetYear`
													left join `CallInstitutionLink` d on d.CallID = a.ID
										";
										
										 $hostReq = 'No Host Document';
											$appReq = 'No Applicant Document';
 


										
										$result = mysqli_query($conn, $query);

										while($calls = mysqli_fetch_array($result)) {
											
											 if($calls["HostRequirementsFile"]){
											 $hostReq = '<a target="_blank" href="../../../uploads/calls/'.$calls["ID"].'/'.$calls["HostRequirementsFile"].'">Host Requirements</a>';
										 }
										 
										 if($calls["ApplicantRequirementsFile"]){
											 $appReq = '<a target="_blank" href="../../../uploads/calls/'.$calls["ID"].'/'.$calls["ApplicantRequirementsFile"].'">Applicant Requirements</a>';
										 }
											if(@$_SESSION['user_type'] == '4' && $calls['Status'] == 'Open'){
											echo '<tr>';
												 echo '<td>' . $calls['Title'] . '</td>';
												 echo '<td>' . $calls['Description'] . '</td>';
												 echo '<td>' . $calls['OpenDate'] . '</td>';
												 echo '<td>' . $calls['ClosingDate'] . '</td>';
												 echo '<td>' . $calls['Status'] . '</td>';
												 echo '<td>' .$hostReq. '<br />'.$appReq. '</td>';
												 echo '</tr>';
											}elseif(@$_SESSION['user_type'] != '4'){
												echo '<tr>';
												 echo '<td>' . $calls['Title'] . '</td>';
												 echo '<td>' . $calls['Description'] . '</td>';
												 echo '<td>' . $calls['OpenDate'] . '</td>';
												 echo '<td>' . $calls['ClosingDate'] . '</td>';
												 echo '<td>' . $calls['Status'] . '</td>';
												 echo '<td>' .$hostReq. '<br />'.$appReq. '</td>';
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
																		WHERE a.IsActive = '1' and a.UserID = '".$_SESSION['id']."' ORDER BY Name asc";
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
                                            <table class="table table-hover table-lg">
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
															$query = "SELECT Name, DateUpdated, UserName FROM HostAdministrator a
															left join users c on c.UserID = a.UserID
																		left join LookupInstitutions b on b.InstitutionId = a.InstitutionID and b.IsActive = '1'
																		WHERE a.IsActive = '0' ORDER BY Name asc";
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
																		<?php echo 'Host admin request pending for ' . $institution['UserName']; ?>
																	</td>
																</tr>
																
																<?php
																
															}
														}
														
														//Host Administrator
														if(@$_SESSION['user_type'] == '2'){
															
															$query = "SELECT Name, DateUpdated, UserName FROM HostAdministrator a
															left join users c on c.UserID = a.UserID
																		left join LookupInstitutions b on b.InstitutionId = a.InstitutionID and b.IsActive = '1'
																		WHERE a.IsActive = '0' ORDER BY Name asc";
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
																		<?php echo 'Host admin request pending for ' . $institution['UserName']; ?>
																	</td>
																</tr>
																
																<?php
																
															}
															
														}
														
														//Mentor
														if(@$_SESSION['user_type'] == '3'){
															
															$query = "SELECT a.UpdatedDate, c.FirstName, c.LastName FROM ProspectiveMentors a
															left join RegistrationDetails c on c.UserID = a.AddedBy
																		WHERE a.Email = '".$_SESSION['email']."' ORDER BY Name asc";
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
																		<?php echo 'Invited to become a mentor by ' . $institution['FirstName'] . ' '. $institution['LastName']; ?>
																	</td>
																</tr>
																
																<?php
																
															}
															
														}

														?>
													
                                                </tbody>
                                            </table>
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
