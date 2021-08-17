<?php 

include 'admin/connect.php';
$conn = OpenCon();

$menu_item = "9";
$title = "";
if (@$_POST['Submit'] != '') {
	function validate($data){
       $data = trim($data);
	   $data = stripslashes($data);
	   $data = htmlspecialchars($data);
	   return $data;
	}
	
	$Message = validate($_POST['message']);
	
	if($_SESSION['user_type'] == '1'){
		$user = 'Administrator';
	}else{
		$user = $_SESSION['username'];
	}
	
	$query = "INSERT INTO FAQ(User, Message)VALUES('".$user."', '".$Message."')";
	mysqli_query($conn, $query);
	$email = 'tmafa@hsrc.ac.za';
	$subject = "HSRC Interns Portal FAQ";
				$txt = "Dear Administrator,
				
				A question has been submitted on the FAQ section for your attention.
				
				".$user." said '".$Message."'.
				
				Regards,
				HSRC Team";
				$headers = "From: noreply@hsrc.ac.za" . "\r\n";

				mail($email,$subject,$txt,$headers);
				
	unset($_POST);
	
	
}




 ?>
	<?php require_once("admin/header.php"); ?>
	<?php require_once("menu.php"); ?>
<link rel="stylesheet" href="assets/css/widgets/chat.css">
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
                            <h3>DSI-HSRC Internship Management System</h3>
                            
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
                <section class="section">
                    <div class="row">
					<form class="form" action="" method="post">
                        <div class="col-md-12">
                            <div class="card">
							<div class="card-header alert alert-primary alert-dismissible fade show">
								Type your question or comment here and the system administrator will respond to it in due time.
                                    
                                </div>
                                <div class="card-body bg-grey">
                                    <div class="chat-content">
									<?php
									$query = "SELECT * FROM FAQ ORDER BY SubmittedDate asc";
									$result = mysqli_query($conn, $query);

									while($messages = mysqli_fetch_array($result)) {
										
										$check = '';
										
										if(@$messages['User'] != 'Administrator'){
											$check = 'chat-left';
										}
										
											echo '<div class="chat '.$check.' ">
										
                                            <div class="chat-body">
                                                <div class="chat-message">
												
												<h6 class="mb-0">';
												echo @$messages['User'] . '<br /><small style="font-size:11px">' .@$messages['SubmittedDate'] .'</small></h6>' . @$messages['Message'] ;
                                            echo '</div></div>
                                        </div>';
										
											
									}
									?>
										
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <div class="message-form d-flex flex-direction-column align-items-center">
                                        <a href="http://" class="black"><i data-feather="smile"></i></a>
                                        <div class="d-flex flex-grow-1 ml-4">
                                            <input type="text" name="message" class="form-control" placeholder="Type your message.."><input style="margin-left: 1%;" type="submit" name="Submit"  value="Submit" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
						</form>
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