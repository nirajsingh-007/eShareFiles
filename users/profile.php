<?php

  require('db.php');
  require('auth.php');

  $db = mysqli_connect('localhost:3306', 'root', '', 'esharefiles');
  $username = "";
  $email = "";
  $username = $_SESSION['username'];
  $email = $_SESSION['email'];

    $query = "SELECT * FROM `users` WHERE username='$username'";
    $result = mysqli_query($con,$query);

    if($row = mysqli_fetch_array($result)) {
        $pkey = $row['pkey'];
    }


  
  use PHPMailer\PHPMailer\PHPMailer;
  use PHPMailer\PHPMailer\SMTP;
  use PHPMailer\PHPMailer\Exception;
  
  require_once __DIR__ . '/vendor/phpmailer/src/Exception.php';
  require_once __DIR__ . '/vendor/phpmailer/src/PHPMailer.php';
  require_once __DIR__ . '/vendor/phpmailer/src/SMTP.php';
  
  require 'credential.php';
  
if (isset($_POST['resetpwd'])) {
  	$sql_u = "SELECT * FROM users WHERE username='$username'";
  	$sql_e = "SELECT * FROM users WHERE email='$email'";
  	$res_u = mysqli_query($db, $sql_u);
  	$res_e = mysqli_query($db, $sql_e);

	$mail = new PHPMailer(true);

	try {
		// Server settings
		$mail->SMTPDebug = 1; // for detailed debug output
		$mail->isSMTP();
		$mail->Host = 'smtp.gmail.com';
		$mail->SMTPAuth = true;
		$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
		$mail->Port = 587;

		$mail->Username = EMAIL; // YOUR gmail email
		$mail->Password = PASS; // YOUR gmail password

		// Sender and recipient settings
		$mail->setFrom(EMAIL, 'eShareFiles');
		$mail->addAddress($email, $username);
		$mail->addReplyTo(EMAIL, 'eShareFiles'); // to set the reply to

		// Setting the email content
		$mail->IsHTML(true);
		$mail->Subject = 'Reset Password';
		$mail->Body    = "<a href='https://www.esharefiles.com/user/resetpwd?pkey=$pkey'>Reset Password</a>";
		$mail->AltBody = "<a href='https://www.esharefiles.com/user/resetpwd?pkey=$pkey'>Reset Password</a>";

		$mail->send();
			echo '<script>
                    alert("Reset Link Sent to Your Registered Email.");;
				    window.location.href="profile";
				  </script>';
	} catch (Exception $e) {
		echo 'Password Reset Link Could not Sent.';
		echo $mail->ErrorInfo;
	}
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Dashboard | eShareFiles</title>
  <link href="img/favicon.png" rel="shortcut icon">

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/dashboard.min.css" rel="stylesheet">
  <link href="main-dashboard.css" rel="stylesheet">

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    
    <?php include('assets/sidebar.php') ?>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        
    <?php include('assets/topbar.php') ?>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
         <div>
            <form action="" method="POST">
                <div class="profile-box">
                    <img class="profile-img rounded-circle" src="img/avatar.png">
                    <h5 class="profile-box-text"><b>Username:</b> <?php echo($username); ?></h5>
                    <h5 class="profile-box-text"><b>Email:</b> <?php echo($email); ?></h5>
                    <h5 class="profile-box-text"><b>Password:</b> <?php echo("********"); ?></h5>
                    <button class="btn-submit" type="submit" name="resetpwd">Reset Password</button><br>
                    </div>
                </div>
            </form>
         </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      
    <?php include('assets/footer.php') ?>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>
  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/dashboard.min.js"></script>

</body>

</html>
