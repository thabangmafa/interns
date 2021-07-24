<?php
$conn = OpenCon();

if (isset($_SESSION['id']) && isset($_SESSION['username'])) {
	
	if( $_SESSION['last_activity'] < time()-$_SESSION['expire_time'] ) { 
    header('Location: logout.php');
	} else{ 
		$_SESSION['last_activity'] = time(); 
	}
	
	}else{
     header("Location: login.php");
     exit();
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HSRC Interns Management System - <?php echo $title; ?></title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/bootstrap.css">

	<link rel="stylesheet" href="assets/vendors/dripicons/webfont.css">
    <link rel="stylesheet" href="assets/css/pages/dripicons.css">

	<link rel="stylesheet" href="assets/vendors/simple-datatables/style.css">
    <link rel="stylesheet" href="assets/vendors/perfect-scrollbar/perfect-scrollbar.css">
    <link rel="stylesheet" href="assets/vendors/bootstrap-icons/bootstrap-icons.css">

    <link rel="stylesheet" href="assets/css/app.css">
    <link rel="shortcut icon" href="assets/images/logo/favicon.ico" type="image/x-icon">
</head>

<body>
    <div id="app">