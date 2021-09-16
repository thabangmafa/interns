<?php

include 'admin/connect.php';
$conn = OpenCon();
$menu_item = "12";
$title = "Host Institution Allocation Review";

$sql = "SELECT distinct Details FROM LookupHeadings WHERE Section='Host Institution Allocation Review' ";
		$result = mysqli_query($conn, $sql);
		$headings = mysqli_fetch_assoc($result);
		
function validate($data){
       $data = trim($data);
	   $data = stripslashes($data);
	   $data = htmlspecialchars($data);
	   return $data;
	}
	
	
	$id = validate(@$_GET['id']);

if(@$id != '' && @$_POST['Submit'] == ''){
	@$_POST['Institution'] = $_GET['id'];
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
								<?php echo @$headings['Details']; ?>
                                 <input type="button" value="Print to PDF" class="btn btn-info" style="float:right" onclick="PrintScreen();" />   
                                </div>
                                <div class="card-content">
								<?php if(@$message){ ?>	
								<div class="alert alert-success" role="alert"><?php echo @$message; ?></div>
								<?php } ?>
								
								
								
                                    <div class="card-body">
									
									
                                        
                                     <div class="row">
											
										<?php
										
										$query = 'SELECT distinct
a.HostedInternsBefore, 
NumberEmployed,
NumberHosted, 
HostedYear, 
e.Name as Province, 
SufficientResources,
TaxPin,
InstitutionRegistrationCertificate,
c.Category, 
b.Name as Institution,
h.Title,
g.Initials,
g.FirstName,
g.LastName,
d.WorkPostalAddress, 
d.WorkCityTown,
d.WorkPostalCode,
d.PrimaryEmail, 
d.TelephoneNumber,
d.MobileNumber,
d.AlternativeEmail, 
d.AlternateContactName, 
d.AlternateContactEmail, 
d.AlternateContactDesignation, 
d.AlternateContactTelephone, 
d.AlternateContactCellphone,
f.Country,
a.Resources,
a.InstitutionID


FROM `HostInstitutionDetails` a 
left join LookupInstitutions b on b.InstitutionId = a.InstitutionID
left join LookupCategoriseInstitution c on c.ID = a.CategoriseInstitution
left join HostApplications i on i.InstitutionID = a.InstitutionID
left join UserContactDetails d on d.UserID = i.UserID
left join RegistrationDetails g on g.UserID = i.UserID
left join LookupUserTitle h on h.ID = g.Title
left join LookupProvince e on e.ID = d.WorkProvince
left join LookupCountry f on f.ID = d.WorkCountry
where a.InstitutionID = "'.@$_SESSION["InstitutionID"].'"';


$result = mysqli_query($conn,$query);




$query = 'SELECT distinct a.InstitutionID,CASE WHEN a.Allocated = "null" THEN 0 ELSE a.Allocated END as Allocated,a.ID,b.Name as PrimaryScientificField, c.Name as SecondaryScientificField, a.NumberRequired, d.Name as QualificationLevel, e.Name as Location FROM `ProfileOfRequestedInterns` a 
left join LookupStudyField b on b.ID = a.PrimaryScientificField
left join LookupStudyField c on c.ID = a.SecondaryScientificField
left join LookupQualificationLevel d on d.ID = a.QualificationLevel
left join LookupProvince e on e.ID = a.Location
 WHERE a.InstitutionID = "'.@$_SESSION["InstitutionID"].'" order by QualificationLevel, Location';

$RequestedInterns = mysqli_query($conn,$query);

$query = 'SELECT distinct Comments FROM `HostApplications`
 WHERE InstitutionID = "'.@$_SESSION["InstitutionID"].'"';

$Comments = mysqli_query($conn,$query);

$query = 'SELECT count(Email) Mentors FROM `ProspectiveMentors`
 WHERE InstitutionID = "'.@$_SESSION["InstitutionID"].'" AND Status = "Approved"';

$Mentors = mysqli_query($conn,$query);
$Mentor = mysqli_fetch_assoc($Mentors);
$data = array();

if(@$_SESSION["InstitutionID"] != '')
{
	echo '<div class="row table-responsive">';
	//Registration Details
	while($row = mysqli_fetch_array($result))
	{

		echo '<table class="mb-0">';
					
			echo '<tbody>';
				
				echo '<tr>';	
					echo '<th style="width:30%">Name of Institution</th>';
					echo '<td>'.@$row['Institution'] .'</td>';
				echo '</tr>';
				
				echo '<tr>';	
					echo '<th>Categorise Institution</th>';
					echo '<td>'.@$row['Category'].'</td>';
				echo '</tr>';
				
				echo '<tr>';	
					echo '<th>Previously hosted DSI/NRF interns</th>';
					echo '<td>'.@$row['HostedInternsBefore'].'</td>';
				echo '</tr>';
				
				echo '<tr>';	
					echo '<th>Have sufficient or adequate resources</th>';
					echo '<td>'.@$row['SufficientResources'].'</td>';
				echo '</tr>';
				
				
														
				$res = explode(',',@$row['Resources']);


				$query = "SELECT distinct * FROM LookupResources WHERE IsActive = '1' ORDER BY Resource asc";
				$result = mysqli_query($conn, $query);
				
				echo '<tr>';	
					echo '<th>Available resources</th>';
					echo '<td>';
				while($resource = mysqli_fetch_array($result)) {
						@$resou .= ucwords($resource['Resource']) . ', ';
				}
					echo rtrim(@$resou,',');
					echo '</td>';
				echo '</tr>';
													
				
				echo '<tr>';	
					echo '<th>Tax Pin</th>';
					echo '<td><a target="_blank" href="uploads/institution/'.@$row['InstitutionID'].'/'.@$row['TaxPin'].'">View Tax Pin</a></td>';
				echo '</tr>';
				
				echo '<tr>';	
					echo '<th>Registration Certificate</th>';
					echo '<td><a target="_blank" href="uploads/institution/'.@$row['InstitutionID'].'/'.@$row['InstitutionRegistrationCertificate'].'">View Registration Certificate</a></td>';
				echo '</tr>';
				
				echo '<tr>';	
					echo '<th>Physical Address</th>';
					echo '<td>'.@$row['WorkPostalAddress'].'</td>';
				echo '</tr>';
				
				echo '<tr>';	
					echo '<th>City/Town</th>';
					echo '<td>'.@$row['WorkCityTown'].'</td>';
				echo '</tr>';
				
				echo '<tr>';	
					echo '<th>Postal Code</th>';
					echo '<td>'.@$row['WorkPostalCode'] .'</td>';
				echo '</tr>';
				
				echo '<tr>';	
					echo '<th>Province/State</th>';
					echo '<td>'.@$row['Province'].'</td>';
				echo '</tr>';
				
				echo '<tr>';	
					echo '<th>Country</th>';
					echo '<td>'.@$row['Country'].'</td>';
				echo '</tr>';
				
				
				echo '<tr><td colspan="2"><div class="alert alert-info" style="margin-top: 2%; margin-bottom: 2%;">Contact Details.</div></td></tr>';
				
				echo '<tr>';	
					echo '<th>Primary Contat Person</th>';
					echo '<td>'.@$row['Title'] . ' ' . @$row['Initials'] . ' ' .@$row['FirstName'] . ' ' .@$row['LastName'] .'</td>';
				echo '</tr>';
				
				echo '<tr>';
					echo '<th>Primary Email</th>';
					echo '<td>'.@$row['PrimaryEmail'].'</td>';
				echo '</tr>';
				
				echo '<tr>';
					echo '<th>Primary Alternative Email</th>';
					echo '<td>'.@$row['AlternativeEmail'].'</td>';
				echo '</tr>';
				
				
				
				echo '<tr>';	
					echo '<th>Primary Telephone Number</th>';
					echo '<td>'.@$row['TelephoneNumber'].'</td>';
				echo '</tr>';
				
				echo '<tr>';	
					echo '<th>Primary Mobile Number</th>';
					echo '<td>'.@$row['MobileNumber'].'</td>';
				echo '</tr>';
				
				echo '<tr><td colspan="2"><hr /></td></tr>';
				
				echo '<tr>';	
					echo '<th>Alternative Contact Person</th>';
					echo '<td>'.@$row['AlternateContactName'] .'</td>';
				echo '</tr>';
				
				echo '<tr>';	
					echo '<th>Alternative Contact Email</th>';
					echo '<td>'.@$row['AlternateContactEmail'].'</td>';
				echo '</tr>';
				
				echo '<tr>';	
					echo '<th>Alternative Contact Designation</th>';
					echo '<td>'.@$row['AlternateContactDesignation'].'</td>';
				echo '</tr>';
				
				echo '<tr>';	
					echo '<th>Alternative Contact Telephone</th>';
					echo '<td>'.@$row['AlternateContactTelephone'].'</td>';
				echo '</tr>';
				
				echo '<tr>';	
					echo '<th>Alternative Contact Mobile</th>';
					echo '<td>'.@$row['AlternateContactCellphone'].'</td>';
				echo '</tr>';
				

			echo '</tbody>';
		echo '</table>';
		
	}
	
	echo '<div class="alert alert-info" style="margin-top: 2%; margin-bottom: 2%;">Profile of Requested Interns.
	<a href="mentors-review.php?id='.@$_SESSION['InstitutionID'].'" style="float:right" class="btn btn-danger">
                                            Approved Mentors <span class="badge bg-transparent">'.$Mentor['Mentors'].'</span>
                                        </a></div>';
	echo '<table class="mb-0" style="width:100%">';
	echo '<tbody>';
										
		echo '<tr>';
					echo '<th>Primary Scientific Field</th>';
					echo '<th>Secondary Scientific Field</th>';
					echo '<th>Number Required</th>';
					echo '<th>Qualification Level</th>';
					echo '<th>Location</th>';
					echo '<th>Allocation</th>';
				echo '</tr>';
echo '<tr><td colspan="6"><hr /></td></tr>';

$total = 0;
$totalAllocated = 0;
	while(@$Requested = mysqli_fetch_array(@$RequestedInterns))
	{
			$total = (int)$total + (int)$Requested['NumberRequired'];
			$totalAllocated = $totalAllocated + $Requested['Allocated'];
				echo '<tr>';
					echo '<td>'.@$Requested['PrimaryScientificField'].'</td>';
					echo '<td>'.@$Requested['SecondaryScientificField'].'</td>';
					echo '<td>'.@$Requested['NumberRequired'].'</td>';
					echo '<td>'.@$Requested['QualificationLevel'].'</td>';
					echo '<td>'.@$Requested['Location'].'</td>';
					echo '<td>'.@$Requested['Allocated'].'</td>';
				echo '</tr>';
				
				
				
			
	}
	echo '<tr>';
					echo '<td></td>';
					echo '<td></td>';
					echo '<td class="btn btn-success">Total Requested <span class="badge bg-transparent">'.@$total.'</span></td>';
					echo '<td></td>';
					echo '<td></td>';
					echo '<td class="btn btn-success">Total Allocated <span class="badge bg-transparent">'.@$totalAllocated.'</span></td>';
				echo '</tr>';
	echo '<tr><td colspan="6"><hr /></td></tr>';
	
	
	while(@$Comment = mysqli_fetch_array(@$Comments))
	{
		echo '<tr><td colspan="6">'.@$Comment['Comments'].'</td></tr>'; 
	}		
	echo '</tbody>';
		echo '</table>';
	
	echo '</div>';

} ?>
												
													
												
												
										
							
                                        
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
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.min.js"></script>
<script type="text/javascript" src="https://html2canvas.hertzen.com/dist/html2canvas.js"></script>
<script type="text/javascript" language="javascript" >

//Create PDf from HTML...
function PrintScreen() {
    var HTML_Width = $(".card-body").width();
    var HTML_Height = $(".card-body").height();
    var top_left_margin = 15;
    var PDF_Width = HTML_Width + (top_left_margin * 2);
    var PDF_Height = (PDF_Width * 1.5) + (top_left_margin * 2);
    var canvas_image_width = HTML_Width;
    var canvas_image_height = HTML_Height;

    var totalPDFPages = Math.ceil(HTML_Height / PDF_Height) - 1;

    html2canvas($(".card-body")[0]).then(function (canvas) {
        var imgData = canvas.toDataURL("image/jpeg", 1.0);
        var pdf = new jsPDF('p', 'pt', [PDF_Width, PDF_Height]);
        pdf.addImage(imgData, 'JPG', top_left_margin, top_left_margin, canvas_image_width, canvas_image_height);
        for (var i = 1; i <= totalPDFPages; i++) { 
            pdf.addPage(PDF_Width, PDF_Height);
            pdf.addImage(imgData, 'JPG', top_left_margin, -(PDF_Height*i)+(top_left_margin*4),canvas_image_width,canvas_image_height);
        }
        pdf.save("<?php echo $title; ?>.pdf");

    });
}


 $(document).ready(function(){
	 
	 
	 

    $('#primary').on('show.bs.modal', function (e) {
       var rowid = $(e.relatedTarget).data('id');
	
	
        $.ajax({
            type : 'post',
            url : 'admin/HostApplications/fetch.php', //Here you will fetch records 
            data :  'rowid='+ rowid, //Pass $id
            success : function(data){
            $('.fetched-data').html(data);//Show fetched data from database

			
            }
        });
		
     });
	 
	 
	 
	 
	 
	 $("#update").click(function(){
		  
		  
		 var form = $('#HostAllocations')[0];
        var formData = new FormData(form);
        event.preventDefault();
        $.ajax({
            url: "admin/HostApplications/update.php", // the endpoint
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