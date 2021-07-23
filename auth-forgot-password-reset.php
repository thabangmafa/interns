<?php 
include 'admin/connect.php';
$conn = OpenCon();

if(isset($_GET['key']) && isset($_GET['email'])) {
    $key=$_GET['key'];
    $email=$_GET['email'];
    $check=mysqli_query($conn,"SELECT * FROM forget_password WHERE email='$email' and temp_key='$key'");
    //if key doesnt matches
    if (mysqli_num_rows($check)!=1) {
      echo "This url is invalid or already been used. Please verify and try again.";
      exit;
    }
}
else{
  header('location:login.php');
}

if($_SERVER["REQUEST_METHOD"] == "POST"){
        $password1=mysqli_real_escape_string($conn,$_POST['Password1']);
        $password2=mysqli_real_escape_string($conn,$_POST['Password2']);
        if ($password2==$password1) {
            
            $password=md5($password1);
            //destroy the key from table
            mysqli_query($conn,"DELETE FROM forget_password where email='$email' and temp_key='$key'");
            //update password in database
            mysqli_query($conn,"UPDATE users set password='$password' where email='$email'");
			$message_success="Password updated.";
        }
        else{
            $message="Verify your password";
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
                            <input type="Password" class="form-control form-control-xl" name="Password1" id="Password1" placeholder="Enter new Password" required="required">
                            <div class="form-control-icon">
                                <i class="bi bi-person"></i>
                            </div>
                        </div>
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="password" class="form-control form-control-xl" placeholder="Confirm New Password" name="Password2" id="Password2" required="required">
                            <div class="form-control-icon">
                                <i class="bi bi-shield-lock"></i>
                            </div>
                        </div>
                        <button class="btn btn-primary btn-block btn-lg shadow-lg mt-5">Save password</button>
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