<?php 
  $db = mysqli_connect('localhost:3306', 'root', '', 'esharefiles');
  $username = "";
  $email = "";

  require('db.php');
  use PHPMailer\PHPMailer\PHPMailer;
  use PHPMailer\PHPMailer\SMTP;
  use PHPMailer\PHPMailer\Exception;
  
  require_once __DIR__ . '/vendor/phpmailer/src/Exception.php';
  require_once __DIR__ . '/vendor/phpmailer/src/PHPMailer.php';
  require_once __DIR__ . '/vendor/phpmailer/src/SMTP.php';
  
  require 'credential.php';
  
  if (isset($_POST['register'])) {
  	$username = $_POST['username'];
  	$email = $_POST['email'];
  	$password = $_POST['password'];
	$password2 = $_POST['password2'];
	$password = md5($password);
	$password2 = md5($password2);
	$pkey = md5($email);

  	$sql_u = "SELECT * FROM users WHERE username='$username'";
  	$sql_e = "SELECT * FROM users WHERE email='$email'";
  	$res_u = mysqli_query($db, $sql_u);
  	$res_e = mysqli_query($db, $sql_e);

  	if (mysqli_num_rows($res_u) > 0) {
  	  $name_error = "Sorry... username already taken"; 	
  	}else if(mysqli_num_rows($res_e) > 0){
  	  $email_error = "Sorry... email already registered"; 	
	  }elseif($password != $password2){
		$passmatch_error = "Password didn't match";
	  }
	  else{
			$vkey = md5(time().$username);
			$query = "INSERT INTO users (username, email, password, vkey, pkey) 
					VALUES ('$username', '$email', '$password', '$vkey', '$pkey')";
			$results = mysqli_query($db, $query);
			if ($results) {
			   
				
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
		$mail->Subject = 'Email Verification';
		$mail->Body    = "<a href='https://www.esharefiles.com/user/verify?vkey=$vkey'>Verify My Email</a>";
		$mail->AltBody = "<a href='https://www.esharefiles.com/user/verify?vkey=$vkey'>Verify My Email</a>";

		$mail->send();
			echo '<script>
					alert("Email Verification Sent.");
					window.location.href="dashboard";
				  </script>';
	} catch (Exception $e) {
		echo 'Email Verification Could not Sent.';
		echo $mail->ErrorInfo;
	}
  }
}
}
?>