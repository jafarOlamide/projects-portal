<?php
$connection = mysqli_connect('localhost', 'root', '', 'officeprojectscheduler');
//$connection = mysqli_connect('us-cdbr-east-02.cleardb.com', 'b0ecebaa70d2bd', 'f1ed49ea', 'heroku_c64291e4f1c514e');

        if (!$connection) {
            die("Database Connection Failed: " . mysqli_error());
        }

require_once (__ROOT__. DIRECTORY_SEPARATOR . "includes" . DIRECTORY_SEPARATOR . "sessions.php"); 
?>
