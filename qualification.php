<?php 
include 'admin/connect.php';
$menu_item = "2";
$title = "Qualifications";

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
									<li>If you have completed, or are currently completing, a qualification, please provide the details of each qualification in this section.</li>
<li>Please click on "ADD" or "Add Another" to add a qualification.</li>
<li>To edit a qualification which you have added, click on the "Edit" icon.</li>
<li>The information icon (i) indicates that there is a tooltip associated with the relevant field. When hovering over this icon, additional information will show.</li>
<li>In order to sort the records in the grid below, click on the column heading. The defualt sort order is descending but when clicking the column heading aain, it will sort the records in ascending order.</li>
<li>Note: Postdoctoral fellowships do not fall under Qualifications. Please capture there under Career Profile.</li></ul>
                                </div>
                                <div class="card-content">
                                    <div class="card-body">
                                        <form class="form">
                                            <div class="row">
											
											
											
												<table class="table table-striped" id="user_data">
                                <thead>
                                    <tr>
                                        <th>Level</th>
                                        <th>Degree/Diploma</th>
                                        <th>Highest Qualification</th>
                                        <th>Date Optained</th>
                                        <th>Edit</th>
                                    </tr>
                                </thead>
                                
                            </table>
							<div class="col-12 d-flex justify-content-end">
     
													<div class="btn btn-primary me-1 mb-1" data-bs-toggle="modal" data-id="000" data-bs-target="#capture-new">Add Another</div>
                                                   
                                                </div>
							

                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
				
				
				
				
				
				
				<!--Modal Xl size -->
                                        <div class="me-1 mb-1 d-inline-block">
                  

                                            <!--Extra Large Modal -->
                                            <div class="modal fade text-left w-100" id="capture-new" tabindex="-1"
                                                role="dialog" aria-labelledby="myModalLabel16" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl"
                                                    role="document">
                                                    <div class="modal-content">
                                                        
														<div class="modal-header bg-success">
                                                                    <h5 class="modal-title white" id="myModalLabel160">
                                                                        Add New Qualification
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
                                                            <button type="button" id="insert" class="btn btn-primary ml-1"
                                                                data-bs-dismiss="modal">
                                                                <i class="bx bx-check d-block d-sm-none"></i>
                                                                <span class="d-none d-sm-block">Submit</span>
                                                            </button>
															<button type="button" id="update" class="btn btn-primary ml-1"
                                                                data-bs-dismiss="modal">
                                                                <i class="bx bx-check d-block d-sm-none"></i>
                                                                <span class="d-none d-sm-block">Update</span>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
										
				
				
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
		
		if(rowid == '000'){
				$('#update').hide();
				$('#insert').show();
			}else{
				$('#update').show();
				$('#insert').hide();
			}
	
        $.ajax({
            type : 'post',
            url : 'admin/qualifications/fetch.php', //Here you will fetch records 
            data :  'rowid='+ rowid, //Pass $id
            success : function(data){
            $('.fetched-data').html(data);//Show fetched data from database
			
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
     url:"admin/qualifications/fetch.php",
     type:"POST"
    }
   });
  }
  


  $(document).on('click', '#update', function(){
   var ID = $("#ID").val();
  var AcademicLevel = $("#AcademicLevel").val();
  var NameOfDegree = $("#NameOfDegree").val();
  var TitleOfResearchProject = $("#TitleOfResearchProject").val();
  var Institution = $("#Institution").val();
  var Fulltime = $("#Fulltime").val();
  var Distinction = $("#Distinction").val();
  var DateFirstRegistration = $("#DateFirstRegistration").val();
  var Completed = $("#Completed").val();
  var HighestCompletedQualification = $("#HighestCompletedQualification").val();
  var Transcript = $("#Transcript").val();
  var Status = $("#Status").val();
  var Reason = $("#Reason").val();
  var AnticipatedDateCompletion = $("#AnticipatedDateCompletion").val();

   $.ajax({
    url:"admin/qualifications/update.php",
    method:"POST",
    data:{ID:ID, AcademicLevel:AcademicLevel,
		  NameOfDegree:NameOfDegree,
		  TitleOfResearchProject:TitleOfResearchProject,
		  Institution:Institution,
		  Fulltime:Fulltime,
		  Distinction:Distinction,
		  DateFirstRegistration:DateFirstRegistration,
		  Completed:Completed,
		  HighestCompletedQualification:HighestCompletedQualification,
		  Transcript:Transcript,
		  Status:Status,
		  Reason:Reason,
		  AnticipatedDateCompletion:AnticipatedDateCompletion},
    success:function(data)
    {
     location.reload();
    }
   });
     
   
  });
  


  
  $(document).on('click', '#insert', function(){
	  
  var AcademicLevel = $("#AcademicLevel").val();
  var NameOfDegree = $("#NameOfDegree").val();
  var TitleOfResearchProject = $("#TitleOfResearchProject").val();
  var Institution = $("#Institution").val();
  var Fulltime = $("#Fulltime").val();
  var Distinction = $("#Distinction").val();
  var DateFirstRegistration = $("#DateFirstRegistration").val();
  var Completed = $("#Completed").val();
  var HighestCompletedQualification = $("#HighestCompletedQualification").val();
  var Transcript = $("#Transcript").val();
  var Status = $("#Status").val();
  var Reason = $("#Reason").val();
  var AnticipatedDateCompletion = $("#AnticipatedDateCompletion").val();


    $.ajax({
     url:"admin/qualifications/insert.php",
     method:"POST",
     data:{
		 
		 AcademicLevel:AcademicLevel,
		  NameOfDegree:NameOfDegree,
		  TitleOfResearchProject:TitleOfResearchProject,
		  Institution:Institution,
		  Fulltime:Fulltime,
		  Distinction:Distinction,
		  DateFirstRegistration:DateFirstRegistration,
		  Completed:Completed,
		  HighestCompletedQualification:HighestCompletedQualification,
		  Transcript:Transcript,
		  Status:Status,
		  Reason:Reason,
		  AnticipatedDateCompletion:AnticipatedDateCompletion
	 },
     success:function(data)
     {
      location.reload();
	  
     }
    });
   
   
  });
  
 });
</script>