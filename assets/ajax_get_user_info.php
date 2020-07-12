<?php
define('__ROOT__', dirname(dirname(__FILE__)));
include_once (__ROOT__. DIRECTORY_SEPARATOR . "config" . DIRECTORY_SEPARATOR . "server.php"); 
    
$user_id = $_POST['user_id'];
    
    $user_query = mysqli_query($connection,"SELECT firstName, lastName, email FROM users WHERE user_id = {$user_id}");

    header('Content-Type: application/json');

    if (!$user_query) {
        echo json_encode(['status'=>0, 'msg'=>mysqli_error($connection)]);  
    }
    else {
        while ($row = mysqli_fetch_assoc($user_query)) {
            $fisrt_name = $row['firstName'];
            $last_name = $row['lastName'];
            $email = $row['email'];
        }
        echo json_encode(['status'=>1, 'msg'=>"Success", 'firstName'=>$fisrt_name, 'lastName'=>$last_name, 'userEmail'=>$email, 'userid'=>$user_id]);
    }
?>