<?php
require('db.php');
require('auth.php');
    $pkey = $_GET['pkey'];
    $query = "SELECT * FROM `users` WHERE pkey='$pkey'";
    $result = mysqli_query($con,$query);
    if($row = mysqli_fetch_array($result)) {
        $verified = $row['verified'];
        $vkey = $row['vkey'];
        $email = $row['email'];
        $username = $row['username'];
    
        $mysqli = mysqli_connect('localhost:3306', 'root', '', 'esharefiles');

        $resultSet = $mysqli->query("SELECT password , vkey FROM users WHERE pkey = '$pkey' LIMIT 1");
    }
?>
<html>
<head>
    <title>Verify Email | eShareFiles</title>
    
  <link href="main.css" rel="stylesheet">
  <link href="main-dashboard.css" rel="stylesheet">
  <link href="css/dashboard.min.css" rel="stylesheet">
</head>
<body>
    <script>
        <?php
            if(isset($_POST['newpwd1'])){
                $pwd1 = $_POST['newpwd1'];
                $pwd2 = $_POST['newpwd2'];
                $newpassword = md5($pwd1);
                if ($pwd1 == $pwd2) {
                    $update = $mysqli->query("UPDATE users SET password='$newpassword' WHERE pkey = '$pkey' LIMIT 1");
                    if($update){
                        ?>
                        alert("Password Changed Successfully");
                        <?php
                        session_start();
                        if(session_destroy())
                        {
                        header("Location: login");
                        }
                    }else{
                        ?>
                        alert("Error");
                        <?php
                    }
                }
                else{
                    ?>
                    alert("Password doesn't match");
                    <?php
                }
            }
        ?>
    </script>
    <div class="form-box-register">
		<form action="" method="POST">
            <img class="profile-img rounded-circle" src="img/avatar.png">
            <h5 class="profile-box-text"><b>Username:</b> <?php echo($username); ?></h5>
            <h5 class="profile-box-text"><b>Email:</b> <?php echo($email); ?></h5>
			<div <?php if (isset($passmatch_error)): ?><?php endif ?> >
			<input class="profile-box-text" type="password" name="newpwd1" placeholder="Enter New Password" value="" required><br>
			<input class="profile-box-text" type="password" name="newpwd2" placeholder="Enter New Password Again" value="" required><br>
			<?php if (isset($passmatch_error)): ?>
				<span class="error"><?php echo $passmatch_error; ?></span>
			<?php endif ?>
			</div>
			<button class="btn-submit" type="submit" name="changepwd" onsubmit="changePwd()">Change Password</button><br>
		</form>
	</div>
</body>
</html>