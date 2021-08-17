<?php 

include 'admin/connect.php';
$conn = OpenCon();

if (isset($_POST['Username']) && isset($_POST['Password'])
    && isset($_POST['Username']) && isset($_POST['Re_Password'])) {

	function validate($data){
       $data = trim($data);
	   $data = stripslashes($data);
	   $data = htmlspecialchars($data);
	   return $data;
	}

	$uname = validate($_POST['Username']);
	$pass = validate($_POST['Password']);

	$re_pass = validate($_POST['Re_Password']);
	$email = validate($_POST['Email']);
	
	$user_type = validate($_POST['user_type']);

	$user_data = 'uname='. $uname. '&email='. $email;


	if (empty($uname)) {
		$error = 'User Name is required.';
	}else if(empty($pass)){
		$error = 'Password is required.';
	}
	else if(empty($re_pass)){
		$error = 'Re Password is requiredr.';
	}
	else if(empty($email)){
		$error = 'Email is required.';
	}
	else if(empty($user_type)){
		$error = 'User type is required.';
	}
	else if($pass !== $re_pass){
		$error = 'The confirmation password  does not match.';
	}

	else{ 
		// hashing the password
        $pass = md5($pass);

	    $sql = "SELECT * FROM users WHERE UserName='$uname' or Email='$email' ";
		$result = mysqli_query($conn, $sql);
		$row = mysqli_fetch_assoc($result);
		$error = '';
		

		if($row['Email'] === $email){
			$error .= 'Email is already registered.';
		}
		
		if($row['UserName'] === $uname){
			if($error){
				$error .= '<br />Username is taken try another.';
			}else{
				$error .= 'Username is taken try another.';
			}
			
		}
		
		if ($error) {
			$error = $error;
		}else {
           $sql2 = "INSERT INTO users(UserName, Password, Email, UserType) VALUES('$uname', '$pass', '$email', '$user_type')";

           $result2 = mysqli_query($conn, $sql2);
           if ($result2) {
			   
				$subject = "HSRC Interns Portal Registration";
				$txt = "Welcome to the HSRC's Interns Portal.
				
				Please note that you will need to login to the portal in order to complete your registration details.
				
				For any queries please contact Sello Raseruthe @ sraseruthe@hsrc.ac.za
				
				Regards,
				HSRC Team";
				$headers = "From: noreply@hsrc.ac.za" . "\r\n";

				mail($email,$subject,$txt,$headers);  
           	 header("Location: login.php");
	         exit();
           }else {
			   $error = 'Unknown error occurred.';
           }
		}
	}
	
}else{

}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DSI-HSRC Internship Management System - Registration</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <link rel="stylesheet" href="assets/vendors/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="assets/css/app.css">
    <link rel="stylesheet" href="assets/css/pages/auth.css">
	<link rel="shortcut icon" href="assets/images/logo/favicon.ico" type="image/x-icon">
</head>

<body>
    <div id="auth">

        <div class="row h-100 d-flex justify-content-center">
            <div class="col-lg-5 col-12">
                <div id="auth-left" style="padding:5rem 7rem">
                    <div class="auth-logo">
                        <a href="index.php"><img src="assets/images/logo/logo.png" style="margin-right:5%" alt="Logo"><img src="assets/images/logo/DSI.png" style="width: 49%;" alt="Logo"></a>
                    </div>

                    <p class="auth-subtitle mb-5">DSI-HSRC Internship Management System.</p>
					<?php if(@$error){ ?>	
					<div class="alert alert-warning" role="alert"><?php echo @$error; ?></div>
					<?php } ?>
                    <form action="" method="post">
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="text" class="form-control form-control-xl" placeholder="Email" name="Email" id="Email" required="required">
                            <div class="form-control-icon">
                                <i class="bi bi-envelope"></i>
                            </div>
                        </div>
						<div class="form-group position-relative has-icon-left mb-4">
                            <input type="text" class="form-control form-control-xl" placeholder="Username" name="Username" id="Username" required="required">
                            <div class="form-control-icon">
                                <i class="bi bi-grid-fill"></i>
                            </div>
                        </div>
                        
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="password" class="form-control form-control-xl" placeholder="Password" name="Password" id="Password" required="required">
                            <div class="form-control-icon">
                                <i class="bi bi-shield-lock"></i>
                            </div>
                        </div>
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="password" class="form-control form-control-xl" placeholder="Confirm Password" name="Re_Password" id="Re_Password" required="required">
                            <div class="form-control-icon">
                                <i class="bi bi-shield-lock"></i>
                            </div>
                        </div>
						<div class="form-group position-relative has-icon-left mb-4">
                            <select class="form-control form-control-xl form-select" id="user_type" name="user_type" required="required">
								<option value="">Select user type</option>
								<option value="4">Intern</option>
								<option value="3">Mentor</option>
								<option value="2">Host Institution Admin</option>
								<!--option value="1">System Admin</option-->
							</select>
                            <div class="form-control-icon">
                                <i class="bi bi-stack"></i>
                            </div>
                        </div>
                        <button class="btn btn-primary btn-block btn-lg shadow-lg mt-5">Register</button>
                    </form>
                    <div class="text-center mt-5 text-lg fs-4">
                        <p class='text-gray-600'>Already have an account? <a href="login.php"
                                class="font-bold">Login</a>.</p>
                    </div>
					For any queries contact: <a href="mailto:DSI_HSRC_Internship.queries@hsrc.ac.za">dsi_hsrc_internship.queries@hsrc.ac.za</a>.
                </div>
            </div>
            
        </div>

    </div>
</body>

</html>