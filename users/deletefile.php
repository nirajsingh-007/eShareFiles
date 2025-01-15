<html>
    <head>
        <title>Delete File | eShareFiles</title>
    </head>
<body>
<?php

    require('db.php');
    require('auth.php');

    $username = $_SESSION['username'];

    if (isset($_POST['delete'])) {
        $fileid = $_POST['fileToDelete'];

        $query2 = "SELECT * FROM `files` WHERE fileid='$fileid'";
        $result2 = mysqli_query($con, $query2);
        $row2 = mysqli_fetch_array($result2);

        $filesize = $row2['filesizeb'];
        
        $query = "SELECT * FROM `users` WHERE username='$username'";
        $result = mysqli_query($con, $query);
        $row = mysqli_fetch_array($result);
        
        $lastfilesize = $row['storage_used'];

        $removefilesize = $lastfilesize - $filesize;

        $delete =  "DELETE FROM `files` WHERE `files`.`fileid` = '$fileid'";
        $update =  "UPDATE users SET storage_used = '$removefilesize' WHERE username = '$username'";
        $result = mysqli_query($con, $update);
        $result2 = mysqli_query($con, $delete);
        
        if ($result){

            unlink("file/" . $fileid);
            
            echo '<script>
                    alert("File deleted successfully.");
                    window.open("myfiles", "_self");
                  </script>';
        } else {
            echo "Error Deleting your file";
        }
    }else{
        echo "Error <strong>:</strong> Please select a file to upload.";
    }
?>
</body>
</html>