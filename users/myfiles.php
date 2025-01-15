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

  <title>My Files | eShareFiles</title>
  <link href="img/favicon.png" rel="shortcut icon">

  <!-- Custom fonts for this template -->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">



  <!-- Custom styles for this template -->
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
          <h1 class="h3 mb-2 text-gray-800">My Files</h1>
          <br>
        
        <div class="table-responsive">
                
                        
        <?php

                $username = $_SESSION['username'];

                $query = "SELECT * FROM `files` WHERE uploadedby='$username'";
                $result = mysqli_query($con,$query);
                echo '<table class="table table-bordered" id="table" width="100%" cellspacing="0">
                        <thead>
                                <tr>
                                <th>File Title</th>
                                <th>File ID</th>
                                <th>Share URL</th>
                                <th>File Type</th>
                                <th>File Size</th>
                                <th>Action</th>
                                </tr>
                        </thead>';
                echo "<tbody>";
                while($row = mysqli_fetch_array($result)) {
                        $fileid = $row['fileid'];
                        $filetitle = $row['filetitle'];
                        $filetype = $row['filetype'];
                        $filesize = $row['filesize'];
                        $query2 = "SELECT * FROM `files` WHERE uploadedby='$username' AND fileid='$fileid'";
                        $result2 = mysqli_query($con,$query2);
                        $row2 = mysqli_fetch_array($result2);
                        $filesizeb = $row2['filesizeb'];
                        $shareurl = 'https://www.esharefiles.com/download?fileid=' . $row['fileid'];
                        echo "<form action='deletefile' method='POST'>";
                        echo "<tr>";
                        echo "<td>" . $filetitle . "</td>";
                        echo "<td><input style='width:330px;color:#858796;border:none;background:none;' type='text' value='$fileid' name='fileToDelete' readonly></td>";
                        echo "<td>" . $shareurl . "</td>";
                        echo "<td>" . $filetype . "</td>";
                        echo "<td>" .$filesize ."<input style='width:100px;color:#858796;border:none;background:none;display:none;' type='text' value='$filesizeb' name='fileSize' readonly></td>";
                        echo "<td><button type='submit' name='delete' class='btn btn-primary' data-toggle='modal' data-target='#deleteModal'>Delete</button></td>";
                        echo "</tr>";
                        echo "</form>";
                }
                        echo "</tbody>";
                        echo "</table>";
        ?>
        
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

</body>
</html>