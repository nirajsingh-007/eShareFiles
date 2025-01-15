<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Login | eShareFiles</title>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link rel="shortcut icon" href="img/favicon.png">

	<!----------CSS---------->
	<link rel="stylesheet" href="main.css">
	<!----------CSS---------->
	
</head>
<body bgcolor="#1067ad">
<?php
require('db.php');
session_start();
if (isset($_POST['username'])){
	$username = stripslashes($_REQUEST['username']);
	$username = mysqli_real_escape_string($con,$username);
	$email = stripslashes($_REQUEST['email']);
	$email = mysqli_real_escape_string($con,$email);
	$password = stripslashes($_REQUEST['password']);
	$password = mysqli_real_escape_string($con,$password);
	$password = md5($password);
    $query = "SELECT * FROM `users` WHERE username='$username' and password='$password' and email='$email'";
	$result = mysqli_query($con,$query) or die(mysql_error());
	$rows = mysqli_num_rows($result);
        if($rows==1){
	    $_SESSION['username'] = $username;
	    $_SESSION['email'] = $email;		
	    header("Location: dashboard");
         }else{
	echo "<div class='form'>
<h3>Username/password is incorrect.</h3>
<br/>Click here to <a href='login.php'>Login Again</a></div>";
	}
    }else{
?>
	<div class="form-box-login">
		<form action="" method="POST">
			<img src="img/logo.png">
			<input class="input" type="text" name="username" placeholder="Username" value="" required><br>
			<input class="input" type="email" name="email" placeholder="Email Address" value="" required><br>
			<input class="input" type="password" name="password" placeholder="Password" value="" required><br>
			<button class="btn-submit" type="submit">Login</button><br>
			<p>Don't have an account, <a href="register">Register Now</a></p>
		</form>
	</div>
<?php } ?>
</body>
</html>