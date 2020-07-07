<?php 
include_once "../admin/config/server.php";
$user_ids = $_POST['user_ids'];

foreach($user_ids as $user_id){
	// Delete record
	$query = "DELETE FROM users WHERE user_id=".$user_id;
	$del_user_query = mysqli_query($connection,$query);
	header("Content-Type: application/json");
	if (!$del_user_query) {
		echo json_encode(['status'=> 0, 'msg'=>"Database Query Failed" . mysqli_error($connection)]);
	} else{
		echo json_encode(['status'=> 1, 'msg'=>'Success', 'uid'=>$user_id]);
	}
}

