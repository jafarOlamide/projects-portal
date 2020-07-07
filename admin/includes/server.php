<?php
$connection = mysqli_connect('localhost', 'root', '', 'officeprojectscheduler');
        if (!$connection) {
            die("Database Connection Failed: " . mysqli_error());
            
        }  
    require_once "sessions.php";


?>