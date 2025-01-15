<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Download File | eShareFiles</title>
  <link href="img/favicon.png" rel="shortcut icon">

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/dashboard.min.css" rel="stylesheet">

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper" style="min-height:100vh;">

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column align-self-center bg-white">

      <!-- Main Content -->
      <div id="content">

        <!-- Begin Page Content -->
        <div class="container-fluid">
              <?php
                  if(isset($_GET['fileid'])){
                      $fileid = $_GET['fileid'];
                      $file = 'user/file/' . $fileid;
                      
                      if(file_exists($file)){
                          echo '<!-- Page Heading -->
                                <div class="d-sm-flex align-items-center justify-content-center mb-4">
                                    <h1 class="h3 mb-0 text-gray-800">Download File</h1>
                                </div>';
                          echo '<div class="d-sm-flex align-items-center justify-content-center mb-4">';
                          echo '<a class="btn btn-primary" href="'.$file.'" download>Download</a>';
                          echo '</div>';
                      }else{
                          echo "File does not exist.";
                      }
                  }else {
                      die("<div style='text-align:center;font-size:30px;'>Something went wrong.</div>");
                  }
              ?>
        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
</body>

</html>