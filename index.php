<?php 

include 'admin/connect.php';
$conn = OpenCon();

$menu_item = "1";
$title = "";

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
                                        <h4>Tracking of Applications</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-hover table-lg">
                                                <thead>
                                                    <tr>
                                                        <th>Funding Opportunity</th>
                                                        <th>Reference</th>
														<th>Status</th>
														<th>Outcome Letter</th>
														<th>Condition of Grant</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td class="col-3">
                                                            <div class="d-flex align-items-center">
                                                                
                                                                Opportunity
                                                            </div>
                                                        </td>
                                                        <td class="col-auto">
                                                            <p class=" mb-0">#10001</p>
                                                        </td>
														<td class="col-auto">
                                                            <p class=" mb-0">Pending</p>
                                                        </td>
														<td class="col-auto">
                                                            <p class=" mb-0">This os the letter</p>
                                                        </td>
														<td class="col-auto">
                                                            <p class=" mb-0">Approved</p>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="col-3">
                                                            <div class="d-flex align-items-center">
                                                                
                                                                Opportunity
                                                            </div>
                                                        </td>
                                                        <td class="col-auto">
                                                            <p class=" mb-0">#100002</p>
                                                        </td>
														<td class="col-auto">
                                                            <p class=" mb-0">Pending</p>
                                                        </td>
														<td class="col-auto">
                                                            <p class=" mb-0">This os the letter</p>
                                                        </td>
														<td class="col-auto">
                                                            <p class=" mb-0">Approved</p>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    
                    </div>
					
					
					<?php if(@$_SESSION['user_type'] == '1'){ ?>
					
                    <div class="col-12 col-lg-3">
                        
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
						
                    </div>
					
					<?php } ?>
					
					<div class="row">
                            <div class="col-12 col-xl-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4>Open Funding Opportunities</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-hover table-lg">
                                                <thead>
                                                    <tr>
                                                        <th>Title</th>
                                                        <th>Description</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td class="col-3">
                                                            <div class="d-flex align-items-center">
                                                                <div class="avatar avatar-md">
                                                                    <img src="assets/images/faces/5.jpg">
                                                                </div>
                                                                <p class="font-bold ms-3 mb-0">Something Here</p>
                                                            </div>
                                                        </td>
                                                        <td class="col-auto">
                                                            <p class=" mb-0">This will be the description</p>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="col-3">
                                                            <div class="d-flex align-items-center">
                                                                <div class="avatar avatar-md">
                                                                    <img src="assets/images/faces/2.jpg">
                                                                </div>
                                                                <p class="font-bold ms-3 mb-0">Something Here</p>
                                                            </div>
                                                        </td>
                                                        <td class="col-auto">
                                                            <p class=" mb-0">This will be the description</p>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
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
