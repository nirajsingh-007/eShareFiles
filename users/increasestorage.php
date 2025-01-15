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

  <title>Upload File | eShareFiles</title>
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

            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Increase Storage</h1>
            </div><div class="row">

            <div class="col-xl-3 col-md-6 mb-3">
        <div class="card border-left-danger shadow h-100 "><span class="badge-danger text-center">FREE</span>
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2 text-center">
                        <div class="h5 font-weight-bold text-primary text-uppercase mb-1">FREE</div>
                            <hr class="sidebar-divider">
                        <div class="h4 font-weight-bold text-warning text-uppercase mb-3">FREE</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">1GB Storage</div>
                        <hr class="sidebar-divider">
                        <button class="btn btn-secondary btn-lg btn-block" style="cursor:not-allowed;">Using</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6 mb-3">
        <div class="card border-left-warning shadow h-100"><span class="badge-warning text-center">BEST FOR STARTING</span>
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2 text-center">
                        <div class="h5 font-weight-bold text-primary text-uppercase mb-1">Starter</div>
                            <hr class="sidebar-divider">
                        <div class="h4 font-weight-bold text-warning mb-3">$3 /mo</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">5GB Storage</div>
                        <hr class="sidebar-divider">
                        <button class="btn btn-primary btn-lg btn-block">Order Now</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6 mb-3">
        <div class="card border-left-success shadow h-100"><span class="badge-success text-center">BEST VALUE</span>
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2 text-center">
                        <div class="h5 font-weight-bold text-primary text-uppercase mb-1">Pro</div>
                            <hr class="sidebar-divider">
                        <div class="h4 font-weight-bold text-warning mb-3">$7 /mo</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">15GB Storage</div>
                        <hr class="sidebar-divider">
                        <button class="btn btn-primary btn-lg btn-block">Order Now</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6 mb-3">
        <div class="card border-left-primary shadow h-100"><span class="badge-primary text-center">BEST FOR COMPAINES</span>
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2 text-center">
                        <div class="h5 font-weight-bold text-primary text-uppercase mb-1">Enterprise</div>
                            <hr class="sidebar-divider">
                        <div class="h4 font-weight-bold text-warning mb-3">$48 /mo</div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">100GB Storage</div>
                        <hr class="sidebar-divider">
                        <button class="btn btn-primary btn-lg btn-block">Contact Now</button>
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