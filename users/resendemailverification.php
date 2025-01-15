<html>
<head>
	<title>Resend Email Verification | eShareFiles</title>
</head>
<body>

<?php
require('db.php');
require('auth.php');

$username = $_SESSION['username'];

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require_once __DIR__ . '/vendor/phpmailer/src/Exception.php';
require_once __DIR__ . '/vendor/phpmailer/src/PHPMailer.php';
require_once __DIR__ . '/vendor/phpmailer/src/SMTP.php';

require 'credential.php';

// passing true in constructor enables exceptions in PHPMailer
if(!isset($_POST["email"])){
	echo '<script>
			alert("Something Went Wrong.");
			window.location.href="dashboard";
		  </script>';
}else{
	$vkey = $_SESSION['vkey'];
                
    $email = $_POST['email'];
	$mail = new PHPMailer(true);

		try {
			// Server settings
			$mail->SMTPDebug = SMTP::DEBUG_OFF; // for detailed debug output
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
		}
	}
?>

</body>
</html>