<?php 
include 'admin/connect.php';
$conn = OpenCon();
$menu_item = "7";
$title = "Manage Calls";

$sql = "SELECT distinct Details FROM LookupHeadings WHERE Section='Manage Calls' ";
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
								<?php echo $headings['Details']; ?>
									
                                </div>
                                <div class="card-content">
                                    <div class="card-body">
                                        
                                            <div class="row">
							<div id="alert_message"></div>				
							<div class="col-12 d-flex justify-content-end">
								<button type="button" name="new" id="new" class="btn btn-primary me-1 mb-1" data-id="000" data-bs-toggle="modal" data-bs-target="#manage_institution">Add New Call</button>
							</div>								

							<table id="user_data" class="table table-bordered table-striped">
							 <thead>
							  <tr>
							   <th>Budget Year</th>
							   <th>Call Type</th>
								<th>Title</th>
								<th>Description</th>
								<th>Open Date</th>
								<th>Closing Date</th>
								<th>Status</th>
								<th>Documents</th>
								<th>Host Link</th>
								<th>Edit</th>
							  </tr>
							 </thead>
							</table>
									
											
							
							<div class="col-12 d-flex justify-content-end">
								<button type="button" name="new" id="new" class="btn btn-primary me-1 mb-1" data-id="000" data-bs-toggle="modal" data-bs-target="#manage_institution">Add New Call</button>
			
							</div>
							
							
											<form class="form" method="post" id="HostDetails" enctype="multipart/form-data">
											<!--primary theme Modal -->
                                                    <div class="modal fade text-left" id="manage_institution" tabindex="-1"
                                                        role="dialog" aria-labelledby="myModalLabel160"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable"
                                                            role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header bg-success">
                                                                    <h5 class="modal-title white" id="myModalLabel160">
                                                                        Add New Call
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
                                                                        data-bs-dismiss="modal" id="updateHost">
                                                                        <i class="bx bx-check d-block d-sm-none"></i>
                                                                        <span class="d-none d-sm-block">Submit</span>
                                                                    </button>
																	<button type="button" class="btn btn-primary ml-1"
                                                                        data-bs-dismiss="modal" id="insert">
                                                                        <i class="bx bx-check d-block d-sm-none"></i>
                                                                        <span class="d-none d-sm-block">Submit</span>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
							

                                        </form>
										
										
										<form class="form" id="UpdateLink" method="post" enctype="multipart/form-data">
											<!--primary theme Modal -->
                                                    <div class="modal fade text-left" id="link_institution" tabindex="-1"
                                                        role="dialog" aria-labelledby="myModalLabel160"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable"
                                                            role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header bg-success">
                                                                    <h5 class="modal-title white" id="myModalLabel160">
                                                                        Link Host Institutions to Call
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
                                                                        data-bs-dismiss="modal" id="updateHostLink" >
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
	 

    $('#manage_institution').on('show.bs.modal', function (e) {
        var rowid = $(e.relatedTarget).data('id');
		if(rowid == '000'){
				$('#updateHost').hide();
				$('#insert').show();
			}else{
				$('#updateHost').show();
				$('#insert').hide();
			}
	
        $.ajax({
            type : 'post',
            url : 'admin/calls/institutions/fetch.php', //Here you will fetch records 
            data :  'rowid='+ rowid, //Pass $id
            success : function(data){
            $('.fetched-data').html(data);//Show fetched data from database
			
			
            }
        });
     });
	 
	 
	 $('#link_institution').on('show.bs.modal', function (e) {
        var rowid = $(e.relatedTarget).data('id');
	
        $.ajax({
            type : 'post',
            url : 'admin/calls/institutions/fetchLinkedHosts.php', //Here you will fetch records 
            data :  'rowid='+ rowid, //Pass $id
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
  
  
  
      $("#updateHost").click(function(){
		  
		  
		  var form = $('#HostDetails')[0];
        var formData = new FormData(form);
        event.preventDefault();
        $.ajax({
            url: "admin/calls/institutions/update.php", // the endpoint
            type: "POST", // http method
            processData: false,
            contentType: false,
            data: formData,        
              success: function(response){
                 location.reload();
             
           }
        });

    });
	

 

	$(document).on('click', '#updateHostLink', function(){
	var ID = $("#ID").val();
   var Institutions = $("#Institutions").val();   


   $.ajax({
    url:"admin/calls/institutions/updateLinkedHosts.php",
    method:"POST",
    data:$("#UpdateLink").serialize(),
    success:function(data)
    {
     $('#alert_message').html('<div class="alert alert-success">'+data+'</div>');
     $('#user_data').DataTable().destroy();
     fetch_data();
    }
   });
   setInterval(function(){
	   location.reload();
    $('#alert_message').html('');
   }, 2000);
   
   
   
  });
  
  $(document).on('click', '#insert', function(){
   var BudgetYear = $("#BudgetYear").val();
   var CallType = $("#CallType").val();
   var Title = $("#Title").val();
   var Description = $("#Description").val();
   var OpenDate = $("#OpenDate").val();
   var ClosingDate = $("#ClosingDate").val();
  
   var IsActive = $("#IsActive").val();
   
   if(BudgetYear != '' && CallType != '' && Description != ''  && OpenDate != '' && ClosingDate != ''  && IsActive != '')
   {
    $.ajax({
     url:"admin/calls/institutions/insert.php",
     method:"POST",
     data:{BudgetYear:BudgetYear,CallType:CallType, Title:Title, Description:Description, OpenDate:OpenDate, ClosingDate:ClosingDate, IsActive:IsActive},
     success:function(data)
     {
      location.reload();
	  
     }
    });
    
   }
   else
   {
    alert("Please make sure all the field have been captured");
   }
  });
  
 });
</script>