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
                <h1 class="h3 mb-0 text-gray-800">Upload File</h1>
            </div>
        
                

                <?php                    

                        $query4 = "SELECT * FROM `users` WHERE username='$username'";
                        $result4 = mysqli_query($con, $query4);
                        $row4 = mysqli_fetch_array($result4);

                        $verify = $row4['verified'];

                        if ($verify == '0') {
                          echo '<div class="alert alert-danger" role="alert" style="margin:10px 0;position:static;">
                                  <h4 class="alert-heading">Verify Your Email</h4>
                                  <p>Please verify your email otherwise you will not be able to upload files.</p>
                                  <hr>
                                  <form action="resendemailverification" method="POST">
                                      <input type="email" name="email" value="<?php print $email ?>" style="display:none;">
                                      <button class="btn btn-info" name="submit" type="submit">Resend Email Verification Code</button>
                                  </form>
                              </div>
                              <br>';
                        }else { 
                            if (!isset($_POST['upload'])) {
                                echo '<form action="" method="post" enctype="multipart/form-data">
                                        <input type="text" name="fileTitle" id="fileTitle" placeholder="File Title" required>
                                        <input type="file" name="fileToUpload" id="fileToUpload">
                                        <input type="submit" value="Upload File" name="upload">
                                      </form>';
                            }else{

                                $uploadedby = $_SESSION['username'];

                                $target_dir = "file/";
                                $file_title = $_REQUEST["fileTitle"];
                                $target_file = $_FILES["fileToUpload"]["name"];
                                $extension = explode('.', $target_file);
                                $file_type = $extension['1'] . ' File';
                                $fileid = md5(rand()) . '.' . $extension['1'];
                                $filename =  $target_dir . $fileid;
                                $filesize = $_FILES['fileToUpload']['size'];
                                $filesizeb = $_FILES['fileToUpload']['size'];
                                $file_size = round($_FILES['fileToUpload']['size']);
                                $uploadOk = 1;

                                $query3 = "SELECT * FROM `users` WHERE username='$username'";
                                $result3 = mysqli_query($con, $query3);
                                $row3 = mysqli_fetch_array($result3);
                                $lastfilesize = $row3['storage_used'];
                                $filesize = $filesize + $lastfilesize;
                                
                                $query3 = "SELECT * FROM `users` WHERE username='$username'";
                                $result3 = mysqli_query($con, $query3);
                                $row3 = mysqli_fetch_array($result3);

                                $storage = $row3['storage'];
                                $storage_used = $row3['storage_used'];


                                if ($uploadOk == 0) {
                                    echo "Sorry, your file was not uploaded.";
                                } elseif($file_size < '1024'){
                                    echo "File is too small please upload atleast 1 KB.";
                                } elseif ($file_size > $storage) {
                                  echo "<b>Error :</b> Please upgrade your storage.";
                                } elseif ($storage_used > $storage) {
                                  echo "<b>Error :</b> Please upgrade your storage.";
                                } elseif ($storage < $storage_used+$file_size) {
                                  echo "<b>Error :</b> Please upgrade your storage.";
                                } else{
                                    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $filename)) {

                                            
                                        echo "File ID : " . $fileid . "<br><br>" ;
                                        echo "File Type : " . $file_type . "<br><br>" ;
                                        if ($file_size >= 1073741824)
                                        {
                                            $file_size = number_format($file_size / 1073741824, 2) . ' GB';
                                        }
                                        elseif ($file_size >= 1048576)
                                        {
                                            $file_size = number_format($file_size / 1048576, 2) . ' MB';
                                        }
                                        elseif ($file_size >= 1024)
                                        {
                                            $file_size = number_format($file_size / 1024, 2) . ' KB';
                                        }
                                        echo "File Size : " . $file_size . "<br><br>" ;
                                        echo "Share URL : https://www.esharefiles.com/download?fileid=" . $fileid . "<br><br>";

                                        $query = "INSERT INTO files (fileid, filetitle, uploadedby, filesize, filesizeb, filetype) 
                                                            VALUES ('$fileid', '$file_title', '$uploadedby', '$file_size', '$filesizeb', '$file_type')";
                                        $results = mysqli_query($con, $query);

                                        $query2 = "UPDATE users SET storage_used = '$filesize' WHERE username = '$username'";
                                        $results2 = mysqli_query($con, $query2);

                                    } else {
                                        echo "Sorry, there was an error uploading your file. <a href='upload'>Upload Again</a>";
                                    }
                                }
                            }
                          }
                        ?>
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