<?php

  require('db.php');
  require('auth.php');

  $username = $_SESSION['username'];
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
        <div class="container-fluid">

          <?php
            $query = "SELECT * FROM `users` WHERE username='$username'";
            $result = mysqli_query($con,$query);
        
            if($row = mysqli_fetch_array($result)) {
                $verified = $row['verified'];
                $email = $row['email'];
                $vkey = $row['vkey'];
                if ($verified == "0") {
                    $_SESSION['vkey'] = $vkey;
                    $_SESSION['email'] = $email;
                    ?>
                        <div class="alert alert-danger" role="alert" style="margin:10px 0;position:static;">
                            <h4 class="alert-heading">Verify Your Email</h4>
                            <p>Please verify your email otherwise you will not be able to upload files.</p>
                            <hr>
                            <form action="resendemailverification" method="POST">
                                <input type="email" name="email" value="<?php print $email ?>" style="display:none;">
                                <button class="btn btn-info" name="submit" type="submit">Resend Email Verification Code</button>
                            </form>
                         </div>
                         <br>
                <?php } } ?>

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
            <a href="upload" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-upload fa-sm text-white-50"></i> Upload File</a>
          </div>

          <!-- Content Row -->
          <div class="row">

            <!-- Storage -->
            <div class="col-xl-4 col-md-6 mb-4">
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Storage</div>
                      <?php
                         $query = "SELECT * FROM `users` WHERE username='$username'";
                         $result = mysqli_query($con,$query);
                     
                         if($row = mysqli_fetch_array($result)) {
                             $storage = $row['storage'];
                             $storage_used = $row['storage_used'];

                             if ($storage >= 1073741824)
                             {
                                 $storage = number_format($storage / 1073741824, 2) . ' GB';
                             }
                             elseif ($storage >= 1048576)
                             {
                                 $storage = number_format($storage / 1048576, 2) . ' MB';
                             }
                             elseif ($storage >= 1024)
                             {
                                 $storage = number_format($storage / 1024, 2) . ' KB';
                             }
                             
                            if ($storage_used >= 1073741824)
                                {
                                    $storage_used = number_format($storage_used / 1073741824, 2) . ' GB';
                                }
                                elseif ($storage_used >= 1048576)
                                {
                                    $storage_used = number_format($storage_used / 1048576, 2) . ' MB';
                                }
                                elseif ($storage_used >= 1024)
                                {
                                    $storage_used = number_format($storage_used / 1024, 2) . ' KB';
                                }
                            }
                        ?>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $storage; ?></div>
                      
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-hdd fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Storage (Used) -->
            <div class="col-xl-4 col-md-6 mb-4">
              <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Storage (Used)</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $storage_used; ?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-hdd fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Files (Uploaded) -->
            <div class="col-xl-4 col-md-6 mb-4">
              <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Files (Uploaded)</div>
                      <div class="row no-gutters align-items-center">
                        <div class="col-auto">
                          <?php

                            $query2 = mysqli_query($con,"SELECT COUNT(*) AS `count` FROM `files` WHERE uploadedby='$username'");

                            $row = $query2->fetch_object();

                            $total_file = $row->count;
                          ?>
                          <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php echo $total_file; ?></div>
                        </div>
                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-download fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

        </div>
        <!-- /.container-fluid -->

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
