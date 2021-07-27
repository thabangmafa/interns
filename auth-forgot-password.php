<?php 
include 'admin/connect.php';
$conn = OpenCon();

if (isset($_POST['Email']))
{
	function validate($data){
       $data = trim($data);
	   $data = stripslashes($data);
	   $data = htmlspecialchars($data);
	   return $data;
	}
	
	$email = validate($_POST['Email']);
	
	$sql = "SELECT * FROM users WHERE Email='$email' ";
		$result = mysqli_query($conn, $sql);
		$row = mysqli_fetch_assoc($result);
		
			if (mysqli_num_rows($result) > 0) { //if the given email is in database, ie. registered
				$message_success=" Please check your email inbox or spam folder and follow the steps";
				//generating the random key
				$key=md5(time()+123456789% rand(4000, 55000000));
				//insert this temporary key into database
				$sql_insert=mysqli_query($conn,"INSERT INTO forget_password(Email,TempKey) VALUES('$email','$key')");
				//sending email about update

				$subject = 'HSRC Interns Portal - Password Reset';
				$txt = "Please copy the link and paste in your browser address bar". "\r\n"."interns.hsrc.ac.za/auth-forgot-password-reset.php?key=".$key."&email=".$email;
				$headers = "From: noreply@hsrc.ac.za" . "\r\n";

				mail($email,$subject,$txt,$headers); 
			}
			else{
				$message="Sorry! no account associated with this email";
			}

}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Mazer Admin Dashboard</title>
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
                <div id="auth-left">
                    <div class="auth-logo">
                        <a href="index.php"><img src="assets/images/logo/logo.png" alt="Logo"></a>
                    </div>
                    <p class="auth-subtitle mb-5">HSRC Interns Management System.</p>
					<?php if(@$message){ ?>	
					<div class="alert alert-warning" role="alert"><?php echo @$message; ?></div>
					<?php } ?>
					<?php if(@$message_success){ ?>	
					<div class="alert alert-success" role="alert"><?php echo @$message_success; ?></div>
					<?php } ?>
                    <form action="" method="post">
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="email" class="form-control form-control-xl" placeholder="Email" name="Email" id="Email" required="required">
                            <div class="form-control-icon">
                                <i class="bi bi-envelope"></i>
                            </div>
                        </div>
                        <button class="btn btn-primary btn-block btn-lg shadow-lg mt-5">Send</button>
                    </form>
                    <div class="text-center mt-5 text-lg fs-4">
                        <p class='text-gray-600'>Remember your account? <a href="login.php" class="font-bold">Log in</a>.
                        </p>
                    </div>
                </div>
            </div>
            
        </div>

    </div>
</body>

</html>