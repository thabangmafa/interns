<?php 
include 'admin/connect.php';
$conn = OpenCon();
$error = '';
if (isset($_POST['Email']) && isset($_POST['Password'])) {
	


	function validate($data){
       $data = trim($data);
	   $data = stripslashes($data);
	   $data = htmlspecialchars($data);
	   return $data;
	}

	$uname = validate(strtolower($_POST['Email']));
	$pass = validate($_POST['Password']);

	if (empty($uname)) {
		$error = 'Username is required.';
	}else if(empty($pass)){
		$error = 'Password is required.';
	}else{
		// hashing the password
        $pass = md5($pass);

        
		$sql = "SELECT * FROM users WHERE lower(Email)='$uname' AND Password='$pass'";

		$result = mysqli_query($conn, $sql);
		
		

		if (mysqli_num_rows($result) === 1) {
			$row = mysqli_fetch_assoc($result);
            if ($row['Email'] === $uname && $row['Password'] === $pass) {
            	$_SESSION['username'] = $row['Email'];
            	$_SESSION['email'] = $row['Email'];
            	$_SESSION['id'] = $row['UserID'];
				$_SESSION['user_type'] = $row['UserType'];
				if($row['UserType'] == '4'){
					$_SESSION['headingType'] = 'Intern';
				}
				
				if($row['UserType'] == '3'){
					$_SESSION['headingType'] = 'Mentor';
				}
				
				if($row['UserType'] == '2'){
					$_SESSION['headingType'] = 'Host Administrator';
				}
				
				if($row['UserType'] == '1'){
					$_SESSION['headingType'] = 'System Administrator';
				}
				$_SESSION['last_activity'] = time();
				$_SESSION['expire_time'] = 30 * 60; 
            	header("Location: /");
		        exit();
            }else{
				$error = 'Incorrect username or password.';
			}
		}else{
			$error = 'Incorrect username or password.';

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
    <title>DSI-HSRC Internship Management System - Login</title>
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
                        <a href="index.php"><img src="assets/images/logo/logo.png" style="margin-right:5%" alt="Logo"><img src="assets/images/logo/DSI.png" style="width: 49%;" alt="Logo"></a>
                    </div>
                    <p class="auth-subtitle mb-5">DSI-HSRC Internship Management System.</p>
					<?php if(@$error){ ?>	
					<div class="alert alert-warning" role="alert"><?php echo @$error; ?></div>
					<?php } ?>
                    <form action="" method="post">
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="text" class="form-control form-control-xl" name="Email" id="Email" placeholder="Email" required="required">
                            <div class="form-control-icon">
                                <i class="bi bi-person"></i>
                            </div>
                        </div>
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="password" class="form-control form-control-xl" placeholder="Password" name="Password" id="Password" required="required">
                            <div class="form-control-icon">
                                <i class="bi bi-shield-lock"></i>
                            </div>
                        </div>
                        
                        <button class="btn btn-primary btn-block btn-lg shadow-lg mt-5">Log in</button>
                    </form>
                    <div class="text-center mt-5 text-lg fs-4">
                        <p class="text-gray-600">Not yet registered? <a href="auth-register.php"
                                class="font-bold">Register</a>.</p>
                        <p><a class="font-bold" href="auth-forgot-password.php">Forgot password?</a>.</p>
                    </div>
					For any queries contact: <a href="mailto:DSI_HSRC_Internship.queries@hsrc.ac.za">dsi_hsrc_internship.queries@hsrc.ac.za</a>.
                </div>
            </div>

        </div>

    </div>
</body>

</html>