<?php
$connection = mysqli_connect('', '', '', '');

        if (!$connection) {
            die("Database Connection Failed: " . mysqli_error());
        }

require_once (__ROOT__. DIRECTORY_SEPARATOR . "includes" . DIRECTORY_SEPARATOR . "sessions.php"); 
?>
