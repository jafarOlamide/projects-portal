<?php include_once "../admin/config/server.php"; ?>
<?php 

    $user_id = $_POST['user_id'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $user_email = $_POST['email'];
    
    $user_query = mysqli_query($connection,"UPDATE users SET 
    										firstName = '{$first_name}', 
    										lastName = '{$last_name}', 
    										email = '{$user_email}'
    										WHERE user_id = '{$user_id}'");

    header('Content-Type: application/json');

    if (!$user_query) {
        echo json_encode(['status'=>0, 'msg'=>mysqli_error($connection)]);  
    }
    else {        
        echo json_encode(['status'=>1, 'msg'=>"Success"]);
    }

?>