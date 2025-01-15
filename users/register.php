<?php include('process.php') ?>
<html>
<head>
  <title>Register | eShareFiles</title>
  <link rel="stylesheet" href="main.css">
	<link rel="shortcut icon" href="img/favicon.png">
</head>
<body bgcolor="#1067ad">
  	<div class="form-box-register">
		<form action="" method="POST">
			<img src="img/logo.png">
			<div <?php if (isset($name_error)): ?><?php endif ?> >
			<input class="input" type="text" name="username" placeholder="Username" onkeypress="return AvoidSpace(event)" value="<?php echo $username; ?>" required>
			<?php if (isset($name_error)): ?>
				<span class="error"><?php echo $name_error; ?></span>
			<?php endif ?>
			</div>
			<div <?php if (isset($email_error)): ?><?php endif ?> >
			<input class="input" type="email" name="email" placeholder="Email" value="<?php echo $email; ?>" required>
			<?php if (isset($email_error)): ?>
				<span class="error"><?php echo $email_error; ?></span>
			<?php endif ?>
			</div>
			<div <?php if (isset($passmatch_error)): ?><?php endif ?> >
			<input class="input" type="password" name="password" placeholder="Password" value="" required><br>
			<input class="input" type="password" name="password2" placeholder="Enter Password Again" value="" required><br>
			<?php if (isset($passmatch_error)): ?>
				<span class="error"><?php echo $passmatch_error; ?></span>
			<?php endif ?>
			</div>
			<button class="btn-submit" type="submit" name="register">Register</button><br>
			<p>Already have an account, <a href="login">Login Now</a></p>
		</form>
	</div>
	<script>
		function AvoidSpace(event) {
			var k = event ? event.which : window.event.keyCode;
			if (k == 32) return false;
		}
	</script>	
  </body>
</html>